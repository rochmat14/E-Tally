<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Blog;
use App\BlogDescription;
use App\Category;
use App\Tags;

use App\Http\Requests\Admin\BlogFormRequest;
use App\Http\Requests\Admin\BlogEditFormRequest;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;



class NewsController extends Controller
{
    private $controller = 'news';
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function title(){
        return __('main.news');
    }


    public function index(Request $request)
    {
        if (!Auth::user()->can($this->controller.'-index')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $q = $request->get('q');
        $datas = Blog::orderBy('id','DESC');
        if ($q !== false){
            $datas->where('slug','LIKE','%'.$q.'%');
        }
        $rows = $datas->paginate(10);
        return view('backend.'.$this->controller.'.index', compact('rows'))->with(array('controller' => $this->controller, 'title' => $this->title(), 'q' => $q));
    }


    public function create()
    {
        if (!Auth::user()->can($this->controller.'-create')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $category = Category::where('status',1)->get();
        $tags = Tags::where('status',1)->get();


        return view('backend.'.$this->controller.'.create',compact('category','tags'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }

    public function store(BlogFormRequest $request)
    {
        if (!Auth::user()->can($this->controller.'-create')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $tags=serialize($request->post_tags);


        $row = Blog::create([
            'published_on' => date('Y-m-d H:i:s', strtotime($request->get('published_on'))),
            'id_category' => $request->get('category'),
            'tags'=>$tags,
            'status' => $request->get('status'),
            'slug' => setUrlSlug(strtolower($request->get('slug'))),
            'meta_keyword'=>$request->get('meta_keyword'),
            'meta_description'=>$request->get('meta_description'),
            'image' => ''
        ]);

        if ($row->save()) {

            if(!empty($request->image)){
                $file = $request->image;
                $destinationPath = 'images/news/'.$row->id.'/' ;
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }
                
                $filename = $file->getClientOriginalName();
                $image = Image::make($file);
                $isJpg = $image->mime() === 'image/jpg' || $image->mime() === 'image/jpeg';
                if($isJpg && $image->exif('Orientation'))
                    $image = orientate($image, $image->exif('Orientation'));

                //$image->save(public_path() .'/'. $destinationPath. $filename);
                $image->save($destinationPath. $filename);
                //$image->fit(750, 500)->save(public_path() .'/'. $destinationPath. 'thumb-'. $filename);
                $image->fit(750, 500)->save($destinationPath. 'thumb-'. $filename);
                $row->image = $filename;
                $row->save(); 

            }
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $rowDesc = new BlogDescription(array(
                    'blog_id' => $row->id,
                    'language_id' => $localeCode,
                    'title' => $request->get('title')[$localeCode],
                    'description' => $request->get('description')[$localeCode]
                ));
                $rowDesc->save();
            }

            return redirect(LaravelLocalization::getCurrentLocale().'/dashboard/'.$this->controller)->with('status', __( 'main.data_has_been_added', ['page' => $this->title()] ) );
        } else {
            return redirect(LaravelLocalization::getCurrentLocale().'/dashboard/'.$this->controller)->with('error', 'Data has not been added' );
        }
    }

    public function edit($id)
    {
        if (!Auth::user()->can($this->controller.'-update')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $row           = Blog::whereId($id)->firstOrFail();
        $rowDescriptions = $row->description()->get();

        
        
        $data_tags= unserialize($row->tags);



        $descriptions = array();
        foreach ($rowDescriptions as $description) {
            $descriptions[$description->language_id] = $description;
        }


        $category = Category::where('status',1)->get();

        $tags = Tags::where('status',1)->get();

        return view('backend.'.$this->controller.'.edit', compact('row','descriptions','data_tags','category','tags'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }

    public function update(BlogEditFormRequest $request, $id)
    {
        if (!Auth::user()->can($this->controller.'-update')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $tags=serialize($request->post_tags);

        $row           = Blog::whereId($id)->firstOrFail();


        $row->id_category =$request->get('category');
        $row->tags =$tags;
        $row->published_on = date('Y-m-d H:i:s', strtotime($request->get('published_on')));
        $row->status = $request->get('status');
        $row->slug = setUrlSlug(strtolower($request->get('slug')));
        $row->meta_keyword = $request->get('meta_keyword');
        $row->meta_description = $request->get('meta_description');

        if ($row->save()) {
            $row->description()->delete();

            $file = $request->image;
            if ($file !== null && $file->isValid()) {
                $imageOld = $row->image;
                $destinationPath = 'images/news/'.$row->id.'/' ;
                if(!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0775, true);
                }
                $filename = $file->getClientOriginalName();

                $image = Image::make($file);
                $isJpg = $image->mime() === 'image/jpg' || $image->mime() === 'image/jpeg';
                if($isJpg && $image->exif('Orientation'))
                    $image = orientate($image, $image->exif('Orientation'));

                //$image->save(public_path() .'/'. $destinationPath. $filename);
                $image->save($destinationPath. $filename);
                //$image->fit(750, 500)->save(public_path() .'/'. $destinationPath. 'thumb-'. $filename);
                $image->fit(750, 500)->save($destinationPath. 'thumb-'. $filename);

                $row->image = $filename;
                $row->save(); 

                if ($imageOld != '') {
                    //Storage::delete([public_path() .'/'. $destinationPath . $filename, public_path() .'/'. $destinationPath. 'thumb-'. $filename]);
                    Storage::delete([$destinationPath . $filename, $destinationPath. 'thumb-'. $filename]);
                }
            }

            
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $rowDesc = new BlogDescription(array(
                    'blog_id' => $row->id,
                    'language_id' => $localeCode,
                    'title' => $request->get('title')[$localeCode],
                    'description' => $request->get('description')[$localeCode]
                ));

                $rowDesc->save();
            }

            return redirect(LaravelLocalization::getCurrentLocale().'/dashboard/'.$this->controller)->with('status', __( 'main.data_has_been_updated', ['page' => $this->title()] ) );
        }
    }

    public function show($id)
    {
        if (!Auth::user()->can($this->controller.'-index')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $row           = Blog::whereId($id)->firstOrFail();

        $rowDescriptions = $row->description()->get();

        $descriptions = array();
        foreach ($rowDescriptions as $description) {
            $descriptions[$description->language_id] = $description;
        }

        return view('backend.'.$this->controller.'.view', compact('row','descriptions'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }
}
