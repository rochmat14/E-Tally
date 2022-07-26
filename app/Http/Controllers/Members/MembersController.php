<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserDescription;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Master\TransBooking;



class MembersController extends Controller
{
    private $controller = 'dashboard';
    private $title = 'Dashboard Members';

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware( 'memberauth');
    }
    
    public function index(){
        $user = auth()->user();

        $title = $this->title;
        $total_orders = 10;
        $url_total_orders = url(LaravelLocalization::getCurrentLocale().'/members/my_orders/');
        $url_profile = url(LaravelLocalization::getCurrentLocale().'/members/profile/');
        


        $total_booking = TransBooking::where('status',1)->where('status_transaction','booking')->where('members_id',$user->id)->count();
        $total_transaction_process = TransBooking::where('status',1)->where('status_transaction','proses')->where('members_id',$user->id)->count();
        $total_transaction_finish = TransBooking::where('status',1)->where('status_transaction','finish')->where('members_id',$user->id)->count();

        
        $data=array(
            
            'url_total_orders'=>$url_total_orders,
            'url_profile'=>$url_profile,
            'total_booking'=>$total_booking,
            'total_transaction_process'=>$total_transaction_process,
            'total_transaction_finish'=>$total_transaction_finish,
        );



        $get_user_desc = UserDescription::select(
            'id',
            'users_id',
            'nama_depan',
            'nama_belakang',
            'jenis_kelamin',
            'phone',
            'alamat_rumah',
            'tempat_lahir',
            'tanggal_lahir',
            'nama_instansi',
            'alamat_instansi',
            'telp_instansi',
            'email_instansi'
        )
        ->where('users_id',$user->id)
        ->whereNotNull('nama_depan')
        ->whereNotNull('nama_belakang')
        ->whereNotNull('jenis_kelamin')
        ->whereNotNull('phone')
        ->whereNotNull('alamat_rumah')
        ->whereNotNull('tempat_lahir')
        ->whereNotNull('tanggal_lahir')
        ->whereNotNull('nama_instansi')
        ->whereNotNull('alamat_instansi')
        ->whereNotNull('telp_instansi')
        ->whereNotNull('email_instansi')

        ->first();

        
        if(!$get_user_desc){
            $status_profile = "warning";
        }else{
            $status_profile ="success";
        }

        

        return view('members.home',compact('user','title','data','status_profile'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }
}