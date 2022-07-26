<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Slideshow;
use App\Page;
use App\Blog;
use App\Category;
use App\ClientData;
use App\Testimonial;
use App\Contact;
use App\Tags;
use App\Model\InfoBox;


class PagesController extends Controller
{
    //
    private $controller = 'frontend';


    public function index(Request $request){

        $page = Page::where('status',1)->where('jenis',1)->whereId(1)->firstOrFail();
        $pageDescription = $page->description()->select('name', 'description')->where('language_id',LaravelLocalization::getCurrentLocale())->first();
        
        $title = '';
        $meta_keywords = '';
        $meta_description = '';
        $url = url();
        $url_future_image = url('images/logo').'/'.AppFutureImageDefault();


        $infobox = InfoBox::first();


        $partner = ClientData::where('status',1)->get();

        $compact = compact(
            'page',
            'pageDescription',
            'title',
            'meta_keywords',
            'meta_description',
            'url',
            'url_future_image',
            'infobox'
        );


        return view('frontend.home', $compact)->with(array('controller' => $this->controller));


    }



}
