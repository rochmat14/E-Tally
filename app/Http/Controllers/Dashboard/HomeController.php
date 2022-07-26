<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\RoleModel;


class HomeController extends Controller
{
    //
    private $controller = 'dashboard';
    private $title = 'Dashboard';

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        $user = auth()->user();
    	
        $total_members = TotalMembers();
            
        $total_booking = 0;
        $total_transaction_process = 0;
        $total_transaction_finish = 0;

        $data= array(
            'total_members'=>$total_members,
            'total_booking'=>$total_booking,
            'total_transaction_process'=>$total_transaction_process,
            'total_transaction_finish'=>$total_transaction_finish,

        );


            
        return view('backend.'.$this->controller.'.home', compact('data'))->with(['controller'=>$this->controller, 'title'=>$this->title]);

        
    }
}
