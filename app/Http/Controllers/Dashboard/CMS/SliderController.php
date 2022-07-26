<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slideshow;
use App\SlideshowDescription;
use App\Http\Requests\Admin\SlideshowFormRequest;
use App\Http\Requests\Admin\SlideshowEditFormRequest;

use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    private $controller = 'slider';
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    private function title(){
        return __('main.slideshow');
    }

    public function index(Request $request)
    {
        if (!Auth::user()->can($this->controller.'-index')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $q = $request->get('q');
        $datas = Slideshow::orderBy('id','DESC');
        $rows = $datas->paginate(10);

        return view('backend.'.$this->controller.'.index', compact('rows'))->with(array('controller' => $this->controller, 'title' => $this->title()));


    }

    public function create()
    {
        if (!Auth::user()->can($this->controller.'-create')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        return view('backend.'.$this->controller.'.create')->with(array('controller' => $this->controller, 'title' => $this->title()));
    }


    public function store(SlideshowFormRequest $request)
    {
        if (!Auth::user()->can($this->controller.'-create')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $row = Slideshow::create([
            'status' => $request->get('status'),
            'sort_order' => $request->get('sort_order'),
            'image' => '',
            'url' => $request->get('url'),
            'target' => $request->get('target')
        ]);

        if ($row->save()) {
            $file = $request->image;
            $destinationPath = 'images/slideshows/' ;
            
            $filename = $file->getClientOriginalName();

            $image = Image::make($file);
            $isJpg = $image->mime() === 'image/jpg' || $image->mime() === 'image/jpeg';
            if($isJpg && $image->exif('Orientation'))
                $image = orientate($image, $image->exif('Orientation'));

            // list($width, $height) = getimagesize($file);

            // if ($width != 1920 && $height != 540) {
            //     //$image->fit(1920, 540)->save(public_path() .'/'. $destinationPath. $filename);    
            //     $image->fit(1920, 540)->save($destinationPath. $filename);    
            // } else {
            //     //$image->save(public_path() .'/'. $destinationPath. $filename);    
            //     // $image->save($destinationPath. $filename);    
            // }
            $image->save($destinationPath. $filename);    

            $row->image = $filename;
            $row->save(); 

            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {

                if(empty($request->get('title')[$localeCode])){
                    $title = " ";
                }else{
                    $title =$request->get('title')[$localeCode];
                }
                if(empty($request->get('button_text')[$localeCode])){
                    $button_text = " ";
                }else{
                    $button_text = $request->get('button_text')[$localeCode];
                }
                $rowDesc = new SlideshowDescription(array(
                    'slideshow_id' => $row->id,
                    'language_id' => $localeCode,
                    'title' => $title,
                    'subtitle' => $request->get('subtitle')[$localeCode],
                    'button_text' => $button_text
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

        $row           = Slideshow::whereId($id)->firstOrFail();
        $rowDescriptions = $row->description()->get();

        $descriptions = array();
        foreach ($rowDescriptions as $description) {
            $descriptions[$description->language_id] = $description;
        }

        return view('backend.'.$this->controller.'.edit', compact('row','descriptions'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }

    public function update(SlideshowEditFormRequest $request, $id)
    {
        if (!Auth::user()->can($this->controller.'-update')){
            return view('backend.errors.401')->with(['url' => '/dashboard']);
        }

        $row = Slideshow::whereId($id)->firstOrFail();
        $row->target = $request->get('target');
        $row->url = $request->get('url');
        $row->sort_order = $request->get('sort_order');
        $row->status = $request->get('status');

        if ($row->save()) {
            $row->description()->delete();

            $file = $request->image;
            if ($file !== null && $file->isValid()) {
                $imageOld = $row->image;
                $destinationPath = 'images/slideshows/';
                
                $filename = $file->getClientOriginalName();

                $image = Image::make($file);
                $isJpg = $image->mime() === 'image/jpg' || $image->mime() === 'image/jpeg';
                if($isJpg && $image->exif('Orientation'))
                    $image = orientate($image, $image->exif('Orientation'));

                // list($width, $height) = getimagesize($file);

                // if ($width != 1920 && $height != 540) {
                //     //$image->fit(1920, 540)->save(public_path() .'/'. $destinationPath. $filename);    
                //     $image->fit(1920, 540)->save($destinationPath. $filename);    
                // } else {
                //     //$image->save(public_path() .'/'. $destinationPath. $filename);    
                //     $image->save($destinationPath. $filename);    
                // }
                $image->save($destinationPath. $filename);   
                $row->image = $filename;
                $row->save(); 

                if ($imageOld != '') {
                    //Storage::delete([public_path() .'/'. $destinationPath . $filename]);
                    Storage::delete([$destinationPath . $filename]);
                }
            }

            
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {


                if(empty($request->get('title')[$localeCode])){
                    $title = " ";
                }else{
                    $title =$request->get('title')[$localeCode];
                }
                if(empty($request->get('button_text')[$localeCode])){
                    $button_text = " ";
                }else{
                    $button_text = $request->get('button_text')[$localeCode];
                }

                $rowDesc = new SlideshowDescription(array(
                    'slideshow_id' => $row->id,
                    'language_id' => $localeCode,
                    'title' => $title,
                    'subtitle' => $request->get('subtitle')[$localeCode],
                    'button_text' => $button_text
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

        $row           = Slideshow::whereId($id)->firstOrFail();

        $rowDescriptions = $row->description()->get();

        $descriptions = array();
        foreach ($rowDescriptions as $description) {
            $descriptions[$description->language_id] = $description;
        }

        return view('backend.'.$this->controller.'.view', compact('row','descriptions'))->with(array('controller' => $this->controller, 'title' => $this->title()));
    }
}
