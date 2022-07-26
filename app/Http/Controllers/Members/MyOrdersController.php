<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Members\UploadBuktiRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;





class MyOrdersController extends Controller
{
    private $controller = 'members_myorders';
    private $title = 'My Orders';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }

        $user = auth()->user();

        $title = $this->title;

        return view('members.myorders.index',compact('user','title'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

   
}
