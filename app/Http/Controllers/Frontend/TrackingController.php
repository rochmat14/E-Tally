<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;
use App\Page;
use App\Master\TransBookingProgress;
use App\Master\TransBooking;

class TrackingController extends Controller
{
    private $controller = 'frontend';

    public function index(Request $request){
        $page = Page::where('status',1)->where('jenis',2)->whereId(23)->firstOrFail();
        $pageDescription = $page->description()->select('name', 'description')->where('language_id',LaravelLocalization::getCurrentLocale())->first();
        
        $header_home = false;
        
        

        $tracking_id = $request->tracking_id;


        // cek tracking id
        $cek_booking = TransBooking::where('booking_code',$tracking_id)
        ->where('status_transaction','proses')
        ->where('status',1)
        ->first();

        if($cek_booking){

            $data_progress =  TransBookingProgress::select([
                'kk_trans_booking_progress.id',
                'orders_id',
                'id_progress_category',
                'progress_description',
                'progress_time',
                'kk_ms_progress_category.progress_name'
            ])
            ->join('kk_ms_progress_category','kk_trans_booking_progress.id_progress_category','=','kk_ms_progress_category.id')
            ->where('kk_trans_booking_progress.status',1)
            ->where('kk_trans_booking_progress.orders_id',$cek_booking->id)
            ->orderBy('progress_time','desc')
            ->get();

            $status_progress = true;

        }else{
            $data_progress = array();
            $status_progress = false;
        }


        $status_progress = true;
        $navActive ='booking';
        return view('frontend.booking.trace', compact(
            'page', 
            'pageDescription',
            'header_home',
            'navActive',
            'data_progress',
            'tracking_id',
            'status_progress',
            'cek_booking'
        ))->with(array('controller' => $this->controller));
    }
}
