<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Master\TransBooking;
use App\Master\TransBookingDetail;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Wilayah\Districts;
use Illuminate\Support\Facades\Crypt;
use App\Bank;
use App\Master\ProgresCategory;
use App\Master\TransBookingProgress;

class BookingController extends Controller
{
    //
    private $controller = 'members_myorders';

    public function getDataTransactionBooking(Request $request){

        $user = auth()->user();


        $arrColumns = [
            1=>'id', 
            2=>'booking_code', 
            3=>'type_booking', 
            4=>'from_district',
            5=>'to_district',
            6=>'waktu_kirim',
            7=>'bongkar_muat',
            8=>'pilihan_layanan',
            9=>'nama',
            10=>'phone',
            11=>'status_transaction',
            12=>'created_at'
        ];


        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = TransBooking::select([
            'kk_trans_booking.id',
            'booking_code',
            'type_booking',
            'from_district',
            'to_district',
            'kk_ms_waktu_kirim.name as waktu_kirim',
            'bongkar_muat',
            'pilihan_layanan',
            'nama',
            'phone',
            'status_transaction',
            'kk_trans_booking.created_at'
        ])
        ->where('kk_trans_booking.status',1)
        ->whereNotIn('kk_trans_booking.status_transaction', ['finish','cancel'])
        ->where('members_id',$user->id)
        ->join('kk_ms_waktu_kirim','kk_trans_booking.waktu_kirim','=','kk_ms_waktu_kirim.id')
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
        ->addIndexColumn()
        

        ->addColumn('distrik_from', function ($row) {
            $id_distrik = $row->from_district;

            $get_distrik = Districts::select([
                'ms_wil_districts.id',
                'ms_wil_regencies.province_id',
                'ms_wil_districts.regency_id',
                'ms_wil_provinces.name AS provinsi_name',
                'ms_wil_regencies.name AS regencies_name',
                'ms_wil_districts.name AS districts_name',
            ])
            ->join('ms_wil_regencies','ms_wil_districts.regency_id','ms_wil_regencies.id')
            ->join('ms_wil_provinces','ms_wil_regencies.province_id','ms_wil_provinces.id')
            ->where('ms_wil_districts.id',$id_distrik)

            ->first();

            return $get_distrik->provinsi_name.','.$get_distrik->regencies_name.', '.$get_distrik->districts_name;
        })

        ->addColumn('distrik_to', function ($row) {
            $id_distrik = $row->to_district;
            $get_distrik = Districts::select([
                'ms_wil_districts.id',
                'ms_wil_regencies.province_id',
                'ms_wil_districts.regency_id',
                'ms_wil_provinces.name AS provinsi_name',
                'ms_wil_regencies.name AS regencies_name',
                'ms_wil_districts.name AS districts_name',
            ])
            ->join('ms_wil_regencies','ms_wil_districts.regency_id','ms_wil_regencies.id')
            ->join('ms_wil_provinces','ms_wil_regencies.province_id','ms_wil_provinces.id')
            ->where('ms_wil_districts.id',$id_distrik)
            ->first();

            return $get_distrik->provinsi_name.','.$get_distrik->regencies_name.', '.$get_distrik->districts_name;
        })

        ->addColumn('booking_code', function ($row) {


            $id = Crypt::encryptString($row->id);
            $url = route('members.view_booking', array('id'=>$id));


            
            $booking_code = "<span class='badge badge-pill badge-info mt-2'><a href='".$url."'>".$row->booking_code."</a></span>";

            

            return $booking_code;
        })
        ->escapeColumns('active')
        

        ->addColumn('status_transaction', function ($row) {
            $status_transaction = $row->status_transaction;

            if($status_transaction =='booking'){
                $status = 'On Booking';
            }elseif($status_transaction =='follow'){
                $status = 'On Negotiation';
            }elseif($status_transaction =='proses'){

                $id = Crypt::encryptString($row->id);
                $url = route('members.view_booking_progress', array('id'=>$id));

                $show_progress = "<span class='badge badge-pill badge-warning mt-2'><a href='".$url."'>Show Progress</a></span>";
                $status = 'On Proses'.$show_progress;




            }elseif($status_transaction =='cancel'){
                $status = 'Cancel Transaction';
            }elseif($status_transaction =='finish'){
                $status = 'Finish Transaction';
            }



            return $status;
        })
        ->addColumn('created_at', function ($row) {
            $created_at = $row->created_at;
            

            return date('d-m-Y h:i:s', strtotime($created_at));;
        })


        ->make();
    }


    public function getDataTransactionBookingClose(Request $request){
        $user = auth()->user();


        $arrColumns = [
            1=>'id', 
            2=>'booking_code', 
            3=>'type_booking', 
            4=>'from_district',
            5=>'to_district',
            6=>'waktu_kirim',
            7=>'bongkar_muat',
            8=>'pilihan_layanan',
            9=>'nama',
            10=>'phone',
            11=>'status_transaction',
            12=>'created_at'
        ];


        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = TransBooking::select([
            'kk_trans_booking.id',
            'booking_code',
            'type_booking',
            'from_district',
            'to_district',
            'kk_ms_waktu_kirim.name as waktu_kirim',
            'bongkar_muat',
            'pilihan_layanan',
            'nama',
            'phone',
            'status_transaction',
            'kk_trans_booking.created_at'
        ])
        // ->where('kk_trans_booking.status',1)
        ->whereNotIn('kk_trans_booking.status_transaction', ['booking','follow','proses'])
        ->where('members_id',$user->id)
        ->join('kk_ms_waktu_kirim','kk_trans_booking.waktu_kirim','=','kk_ms_waktu_kirim.id')
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
        ->addIndexColumn()
        

        ->addColumn('distrik_from', function ($row) {
            $id_distrik = $row->from_district;

            $get_distrik = Districts::select([
                'ms_wil_districts.id',
                'ms_wil_regencies.province_id',
                'ms_wil_districts.regency_id',
                'ms_wil_provinces.name AS provinsi_name',
                'ms_wil_regencies.name AS regencies_name',
                'ms_wil_districts.name AS districts_name',
            ])
            ->join('ms_wil_regencies','ms_wil_districts.regency_id','ms_wil_regencies.id')
            ->join('ms_wil_provinces','ms_wil_regencies.province_id','ms_wil_provinces.id')
            ->where('ms_wil_districts.id',$id_distrik)

            ->first();

            return $get_distrik->provinsi_name.','.$get_distrik->regencies_name.', '.$get_distrik->districts_name;
        })

        ->addColumn('distrik_to', function ($row) {
            $id_distrik = $row->to_district;
            $get_distrik = Districts::select([
                'ms_wil_districts.id',
                'ms_wil_regencies.province_id',
                'ms_wil_districts.regency_id',
                'ms_wil_provinces.name AS provinsi_name',
                'ms_wil_regencies.name AS regencies_name',
                'ms_wil_districts.name AS districts_name',
            ])
            ->join('ms_wil_regencies','ms_wil_districts.regency_id','ms_wil_regencies.id')
            ->join('ms_wil_provinces','ms_wil_regencies.province_id','ms_wil_provinces.id')
            ->where('ms_wil_districts.id',$id_distrik)
            ->first();

            return $get_distrik->provinsi_name.','.$get_distrik->regencies_name.', '.$get_distrik->districts_name;
        })

        ->addColumn('booking_code', function ($row) {


            $id = Crypt::encryptString($row->id);
            $url = route('members.view_booking', array('id'=>$id));


            
            $booking_code = "<span class='badge badge-pill badge-info mt-2'><a href='".$url."'>".$row->booking_code."</a></span>";

            

            return $booking_code;
        })
        ->escapeColumns('active')
        

        ->addColumn('status_transaction', function ($row) {
            $status_transaction = $row->status_transaction;

            if($status_transaction =='booking'){
                $status = 'On Booking';
            }elseif($status_transaction =='follow'){
                $status = 'On Negotiation';
            }elseif($status_transaction =='proses'){

                $id = Crypt::encryptString($row->id);
                $url = route('members.view_booking_progress', array('id'=>$id));

                $show_progress = "<span class='badge badge-pill badge-warning mt-2'><a href='".$url."'>Show Progress</a></span>";
                $status = 'On Proses'.$show_progress;




            }elseif($status_transaction =='cancel'){
                $status = 'Cancel Transaction';
            }elseif($status_transaction =='finish'){

                $id = Crypt::encryptString($row->id);
                $url = route('members.view_booking_progress', array('id'=>$id));

                $show_progress = "<span class='badge badge-pill badge-warning mt-2'><a href='".$url."'>Show Progress</a></span>";

                $status = 'Finish Transaction'.$show_progress;
            }



            return $status;
        })
        ->addColumn('created_at', function ($row) {
            $created_at = $row->created_at;
            

            return date('d-m-Y h:i:s', strtotime($created_at));;
        })


        ->make();
    }



    public function views(Request $request){

        $id = $request->id;
        $id_booking = Crypt::decryptString($request->id);
        $user = auth()->user();

        $data_booking = TransBooking::select(
            'kk_trans_booking.id',
            'booking_code',
            'type_booking',
            'from_district',
            'to_district',
            'kk_ms_merk.merk',
            'kk_ms_model.model',
            'kendaraan_tahun',
            'kendaraan_kondisi',
            'kontainer_jumlah',
            'kk_ms_kontainer.type_kontainer',
            'kontainer_kemasan_barang',
            'asuransi',
            'kk_ms_waktu_kirim.name as waktu_kirim',
            'bongkar_muat',
            'pilihan_layanan',
            'nama',
            'phone',
            'atas_nama_penjemputan',
            'alamat_penjemputan',
            'nama_penerima',
            'alamat_penerima',
            'phone_penerima',
            'type_customer',
            'nama_perusahaan',
            'nama',
            'email',
            'alamat',
            'phone',
            'status_transaction',
            'kk_trans_booking.created_at'
        )
        // ->where('kk_trans_booking.status',1)
        // ->where('kk_trans_booking.status_transaction','booking')y
        ->join('kk_ms_waktu_kirim','kk_trans_booking.waktu_kirim','=','kk_ms_waktu_kirim.id')
        ->leftjoin('kk_ms_kontainer','kk_trans_booking.kontainer_type','=','kk_ms_kontainer.id')
        ->leftjoin('kk_ms_merk','kk_trans_booking.kendaraan_merk_id','=','kk_ms_merk.id')
        ->leftjoin('kk_ms_model','kk_trans_booking.kendaraan_model_id','=','kk_ms_model.id')
        ->where('kk_trans_booking.id',$id_booking)
        ->where('members_id',$user->id)
        ->first();


        if($data_booking->type_booking =='kendaraan'){
            $type_booking = 'Pengiriman Kendaraan';
        }else{
            $type_booking = 'Pengiriman Kontainer';
        }


        $from = Districts::select(
            'ms_wil_districts.id',
            'ms_wil_regencies.province_id',
            'ms_wil_districts.regency_id',
            'ms_wil_provinces.name AS provinsi_name',
            'ms_wil_regencies.name AS regencies_name',
            'ms_wil_districts.name AS districts_name'
        )
        ->join('ms_wil_regencies','ms_wil_districts.regency_id','ms_wil_regencies.id')
        ->join('ms_wil_provinces','ms_wil_regencies.province_id','ms_wil_provinces.id')
        ->where('ms_wil_districts.id',$data_booking->from_district)
        ->first();

        $to = Districts::select(
            'ms_wil_districts.id',
            'ms_wil_regencies.province_id',
            'ms_wil_districts.regency_id',
            'ms_wil_provinces.name AS provinsi_name',
            'ms_wil_regencies.name AS regencies_name',
            'ms_wil_districts.name AS districts_name'
        )
        ->join('ms_wil_regencies','ms_wil_districts.regency_id','ms_wil_regencies.id')
        ->join('ms_wil_provinces','ms_wil_regencies.province_id','ms_wil_provinces.id')
        ->where('ms_wil_districts.id',$data_booking->to_district)
        ->first();


        if($data_booking->kendaraan_dikendarai =='Y'){
            $kendaraan_dikendarai ='Ya';
        }else{
            $kendaraan_dikendarai ='Tidak';
        }

        if($data_booking->asuransi =='Y'){
            $asuransi ='Ya';
        }else{
            $asuransi ='Tidak';
        }

        if($data_booking->bongkar_muat =='Y'){
            $bongkar_muat ='Ya';
        }else{
            $bongkar_muat ='Tidak';
        }

        if($data_booking->pilihan_layanan =='door_to_door'){
            $pilihan_layanan ='Door To Door';
        }else{
            $pilihan_layanan ='Port to door';
        }

        


        $data= array(
            'type_booking'=>$type_booking,
            'pengirman_dari'=>$from->provinsi_name.','.$from->regencies_name.', '.$from->districts_name,
            'tujuan_pengiriman'=>$to->provinsi_name.','.$to->regencies_name.', '.$to->districts_name,
            'kendaraan_dikendarai'=>$kendaraan_dikendarai,
            'asuransi'=>$asuransi,
            'bongkar_muat'=>$bongkar_muat,
            'pilihan_layanan'=>$pilihan_layanan
        );

        $data_service = TransBookingDetail::where('booking_id',$id_booking)->where('status',1)->get();
        $data_bank = Bank::where('status',1)->get();
        $title = "Booking Detail : ".$data_booking->booking_code;
        return view('members.myorders.details',compact(
            'data_booking',
            'data',
            'id',
            'data_service',
            'data_bank'
        ))
        ->with(['controller'=>$this->controller, 'title'=>$title]);



    }


    public function progress_info(Request $request){
        $id_booking = Crypt::decryptString($request->id);

        $data_booking = TransBooking::select(
            'kk_trans_booking.id',
            'booking_code',
            'type_booking',
            'from_district',
            'to_district',
            'kk_ms_merk.merk',
            'kk_ms_model.model',
            'kendaraan_tahun',
            'kendaraan_kondisi',
            'kontainer_jumlah',
            'kk_ms_kontainer.type_kontainer',
            'kontainer_kemasan_barang',
            'asuransi',
            'kk_ms_waktu_kirim.name as waktu_kirim',
            'bongkar_muat',
            'pilihan_layanan',
            'nama',
            'phone',
            'atas_nama_penjemputan',
            'alamat_penjemputan',
            'nama_penerima',
            'alamat_penerima',
            'phone_penerima',
            'type_customer',
            'nama_perusahaan',
            'nama',
            'email',
            'alamat',
            'phone',
            'status_transaction',
            'kk_trans_booking.created_at'
        )
        ->where('kk_trans_booking.status',1)
        // ->where('kk_trans_booking.status_transaction','booking')y
        ->join('kk_ms_waktu_kirim','kk_trans_booking.waktu_kirim','=','kk_ms_waktu_kirim.id')
        ->leftjoin('kk_ms_kontainer','kk_trans_booking.kontainer_type','=','kk_ms_kontainer.id')
        ->leftjoin('kk_ms_merk','kk_trans_booking.kendaraan_merk_id','=','kk_ms_merk.id')
        ->leftjoin('kk_ms_model','kk_trans_booking.kendaraan_model_id','=','kk_ms_model.id')
        ->where('kk_trans_booking.id',$id_booking)->first();


        if($data_booking->type_booking =='kendaraan'){
            $type_booking = 'Pengiriman Kendaraan';
        }else{
            $type_booking = 'Pengiriman Kontainer';
        }


        $from = Districts::select(
            'ms_wil_districts.id',
            'ms_wil_regencies.province_id',
            'ms_wil_districts.regency_id',
            'ms_wil_provinces.name AS provinsi_name',
            'ms_wil_regencies.name AS regencies_name',
            'ms_wil_districts.name AS districts_name'
        )
        ->join('ms_wil_regencies','ms_wil_districts.regency_id','ms_wil_regencies.id')
        ->join('ms_wil_provinces','ms_wil_regencies.province_id','ms_wil_provinces.id')
        ->where('ms_wil_districts.id',$data_booking->from_district)
        ->first();

        $to = Districts::select(
            'ms_wil_districts.id',
            'ms_wil_regencies.province_id',
            'ms_wil_districts.regency_id',
            'ms_wil_provinces.name AS provinsi_name',
            'ms_wil_regencies.name AS regencies_name',
            'ms_wil_districts.name AS districts_name'
        )
        ->join('ms_wil_regencies','ms_wil_districts.regency_id','ms_wil_regencies.id')
        ->join('ms_wil_provinces','ms_wil_regencies.province_id','ms_wil_provinces.id')
        ->where('ms_wil_districts.id',$data_booking->to_district)
        ->first();


        if($data_booking->kendaraan_dikendarai =='Y'){
            $kendaraan_dikendarai ='Ya';
        }else{
            $kendaraan_dikendarai ='Tidak';
        }

        if($data_booking->asuransi =='Y'){
            $asuransi ='Ya';
        }else{
            $asuransi ='Tidak';
        }

        if($data_booking->bongkar_muat =='Y'){
            $bongkar_muat ='Ya';
        }else{
            $bongkar_muat ='Tidak';
        }

        if($data_booking->pilihan_layanan =='door_to_door'){
            $pilihan_layanan ='Door To Door';
        }else{
            $pilihan_layanan ='Port to door';
        }

        


        $data= array(
            'type_booking'=>$type_booking,
            'pengirman_dari'=>$from->provinsi_name.','.$from->regencies_name.', '.$from->districts_name,
            'tujuan_pengiriman'=>$to->provinsi_name.','.$to->regencies_name.', '.$to->districts_name,
            'kendaraan_dikendarai'=>$kendaraan_dikendarai,
            'asuransi'=>$asuransi,
            'bongkar_muat'=>$bongkar_muat,
            'pilihan_layanan'=>$pilihan_layanan
        );


        $title = "Booking Order :".$data_booking->booking_code;

        // get data progress category
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
        ->where('kk_trans_booking_progress.orders_id',$id_booking)
        ->orderBy('progress_time','desc')
        ->get();

        return view('members.myorders.views_prgress',compact(
            'data_booking',
            'data',
            'data_progress'
        ))
        ->with(['controller'=>$this->controller, 'title'=>$title]);

    }
}
