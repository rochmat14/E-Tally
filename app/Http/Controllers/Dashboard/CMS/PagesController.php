<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Page;
use App\PageDescription;
use App\Category;
use App\Tags;
use App\Http\Requests\Admin\PageFormRequest;
use App\Http\Requests\Admin\PageEditFormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class PagesController extends Controller
{
    
    private $controller = 'pages';

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function title(){
        return __('main.pages');
    }

    private function arrJenis()
    {
        return array(1=>'Menu', 2=>'Text');
    }


    public function children($parent_id, $depth, $return=false)
    {

        if ($parent_id > 0) {
            $root = Page::whereId($parent_id)->firstOrFail();
            $childrens = $root->children()->orderBy('sort_order','ASC')->get();
        } else {
            $childrens = Page::where('depth', '=', '0')->orderBy('sort_order','ASC')->get();
        }

        $expanded_rows = isset($_COOKIE['expanded_rows_page']) ? explode(',', $_COOKIE['expanded_rows_page']): array();

        foreach ($childrens as $index => $child)
        {
            $childrens[$index]->is_expanded = in_array($child->id, $expanded_rows);
            if ($childrens[$index]->is_expanded)
                $childrens[$index]->children_rows = $this->children($child->id, $depth+1, true);
        }

        $content = view('backend.'.$this->controller.'.children', compact('childrens', 'depth', 'parent_id'))->with(array('depth' => $depth + 1, 'controller' => $this->controller, 'arrJenis' => $this->arrJenis()));

        if ($return)
            return $content;

        echo $content;
    }

    public function index() {
        if (!Auth::user()->can($this->controller.'-index')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $content_children = $this->children(0, 0, true);
        
        return view('backend.'.$this->controller.'.index', compact('content_children'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }


    public function reorder($parent_id, Request $request)
    {
        $categories = $request->get('categories');
        //parse_str($categories);

        foreach ($categories as $position => $page_id)
        {
            $menu = Page::whereId($page_id)->firstOrFail();
            $menu->sort_order = (int) $position;
            $menu->save();
        }

    }


    public function create($parentId = 0) {
        if (!Auth::user()->can($this->controller.'-create')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $root = false;
        if ($parentId > 0) {
            $root = Page::whereId($parentId)->firstOrFail();
        }

        $category = Category::where('status',1)->get();

        return view('backend.'.$this->controller.'.create', compact('root','category'))->with(array('controller' => $this->controller, 'title' => $this->title(), 'arrJenis' => $this->arrJenis()));
    }


    public function store(PageFormRequest $request, $parentId = 0) {
        $sortOrder = 1;
        if ($parentId > 0) {
            $root = Page::whereId($parentId)->firstOrFail();
            $row = Page::selectRaw('MAX(sort_order) last_sort_order')->where('parent_id', '=', $root->id)->first();
            if ($row->last_sort_order !== null) {
                $sortOrder = $row->last_sort_order + 1;
            }
        } else {
            $row = Page::selectRaw('MAX(sort_order) last_sort_order')->where('depth', '=', '0')->first();
            if ($row->last_sort_order !== null) {
                $sortOrder = $row->last_sort_order + 1;
            }
        }





        if(!empty($request->image)){
            $file = $request->image;
            $destinationPath = 'images/pages/'.$row->id.'/' ;
            if(!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }
            $lid = "_IDT";
            $filename = $lid.'_'.time().'_'.$file->getClientOriginalName();

        
            $image = Image::make($file);
            $isJpg = $image->mime() === 'image/jpg' || $image->mime() === 'image/jpeg';
            if($isJpg && $image->exif('Orientation'))
                $image = orientate($image, $image->exif('Orientation'));
            
            $image->save($destinationPath. $filename);
            //$image->fit(750, 500)->save(public_path() .'/'. $destinationPath. 'thumb-'. $filename);
            // $image->fit(750, 500)->save($destinationPath. 'thumb-'. $filename);

            $arrContent = [
                'slug' => setUrlSlug(strtolower($request->get('slug'))),
                'status' => $request->get('status'),
                'id_category' => $request->get('category'),
                'tags' => $request->get('post_tags'),
                'jenis' => $request->get('jenis'),
                'sort_order' => $sortOrder,
                'image' => $filename
            ];

        }else{

            $arrContent = [
                'slug' => setUrlSlug(strtolower($request->get('slug'))),
                'status' => $request->get('status'),
                'id_category' => $request->get('category'),
                'tags' => $request->get('post_tags'),
                'jenis' => $request->get('jenis'),
                'sort_order' => $sortOrder,
                'image' => ''
            ];

        }


        if ($parentId > 0) {
            $root->children()->create($arrContent);
        } else {
            $root = Page::create($arrContent);
        }

        $childrens = $root->children()->get();
        $countChildren = count($childrens);
        $menuRow = false;
        if ($countChildren > 0) {
            $menuRow = $childrens[$countChildren-1];
        }

        if (!$menuRow) {
            $menuRow = $root;
        }

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $rowDesc = new PageDescription(array(
                'page_id' => $menuRow->id,
                'language_id' => $localeCode,
                'name' => $request->get('name')[$localeCode],
                'description' => $request->get('description')[$localeCode]
            ));

            $rowDesc->save();
        }

        return redirect(LaravelLocalization::getCurrentLocale().'/dashboard/'.$this->controller)->with('status', __( 'main.data_has_been_added', ['page' => $this->title()] ) );
    }

    public function edit($id){
        if (!Auth::user()->can($this->controller.'-update')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $row = Page::whereId($id)->firstOrFail();
        $rowDescriptions = $row->description()->get();

        $tags=$row->tags;

        $data_tags=explode(",",$tags);

        $rows=array();
        foreach ($data_tags as $value_tags) {
            $tags_id = $value_tags;
            $list =Tags::where('id',$tags_id)->get();                   
            foreach ($list as $key) {
                $id_tags_post=$key->id;
                $tags_name=$key->name;           

                $rows[]=array("id"=>$id_tags_post,"name"=>$tags_name);
            }                    
        }
        $data_tags= json_encode($rows); 
        $category = Category::where('status',1)->get();


        $descriptions = array();
        foreach ($rowDescriptions as $description) {
            $descriptions[$description->language_id] = $description;
        }
        return view('backend.'.$this->controller.'.edit', compact('row','descriptions','data_tags','category'))->with(array('controller' => $this->controller, 'title' => $this->title(), 'arrJenis' => $this->arrJenis()));
    }

    public function update($id, PageEditFormRequest $request)
    {
        if (!Auth::user()->can($this->controller.'-update')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $row = Page::whereId($id)->firstOrFail();
        $file = $request->image;
        if ($file !== null && $file->isValid()) {
            $imageOld = $row->image;
            $destinationPath = 'images/pages/' ;
            if(!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }
           

            $lid = "_IDT";
            $filename = $lid.'_'.time().'_'.$file->getClientOriginalName();

            $image = Image::make($file);
            $isJpg = $image->mime() === 'image/jpg' || $image->mime() === 'image/jpeg';
            if($isJpg && $image->exif('Orientation'))
                $image = orientate($image, $image->exif('Orientation'));

            
            $image->save($destinationPath. $filename);
            // $image->fit(750, 500)->save($destinationPath. 'thumb-'. $filename);
            $row->image = $filename;
            if ($imageOld != '') {
                
                Storage::delete([$destinationPath . $filename, $destinationPath. 'thumb-'. $filename]);
            }
        }
        $row->slug = setUrlSlug(strtolower($request->get('slug')));
        $row->status = $request->get('status');
        $row->jenis = $request->get('jenis');
        $row->id_category =$request->get('category');
        $row->tags =$request->get('post_tags');
        
        if ($row->save()) {
            $row->description()->delete();

            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $rowDesc = new PageDescription(array(
                    'page_id' => $row->id,
                    'language_id' => $localeCode,
                    'name' => $request->get('name')[$localeCode],
                    'description' => $request->get('description')[$localeCode]
                ));

                $rowDesc->save();
            }

            return redirect(LaravelLocalization::getCurrentLocale().'/dashboard/'.$this->controller)->with('status', __( 'main.data_has_been_updated', ['page' => $this->title()] ) );
        } else {
            return redirect('/dashboard/'.$this->controller)->with('error', $this->title . ' GAGAL diupdate!');
        }

    }

    public function show($id)
    {
        if (!Auth::user()->can($this->controller.'-index')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $row = Page::whereId($id)->firstOrFail();
        $rowDescriptions = $row->description()->get();

        $descriptions = array();
        foreach ($rowDescriptions as $description) {
            $descriptions[$description->language_id] = $description;
        }
        return view('backend.'.$this->controller.'.view', compact('row','descriptions'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }
}
