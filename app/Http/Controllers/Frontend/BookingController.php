<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;
use App\Page;
use App\Master\Merk;
use App\Master\WaktuKirim;
use App\Master\TransBooking;
use App\Master\Kontainer;
use App\User;
use App\UserDescription;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;



class BookingController extends Controller
{
    //
    private $controller = 'frontend';

    public function mobil_motor(){

        $page = Page::where('status',1)->where('jenis',2)->whereId(20)->firstOrFail();
        $pageDescription = $page->description()->select('name', 'description')->where('language_id',LaravelLocalization::getCurrentLocale())->first();
        
        $header_home = false;
        
        $data_merk = Merk::where('status',1)->get();
        $maktu_kirim = WaktuKirim::where('status',1)->get();

        
        $navActive ='booking';
        return view('frontend.booking.mobil_motor', compact(
            'page', 
            'pageDescription',
            'header_home',
            'navActive',
            'data_merk',
            'maktu_kirim'
        ))->with(array('controller' => $this->controller));

    }


    public function mobil_motor_act(Request $request){

        $booking_code = BookingController::code_orders();
        $from_district = $request->from_district;
        $to_district = $request->to_district;
        $type_booking = 'kendaraan';
        $kendaraan_merk_id = $request->kendaraan_merk_id;
        $kendaraan_model_id = $request->kendaraan_model_id;
        $kendaraan_tahun = $request->kendaraan_tahun;
        $kendaraan_kondisi = $request->kendaraan_kondisi;

        $kendaraan_dikendarai = $request->kendaraan_dikendarai;
        if($kendaraan_dikendarai =='ya'){
            $kendaraan_dikendarai ='Y';
        }else{
            $kendaraan_dikendarai ='N';
        }


        $asuransi = $request->asuransi;
        if($asuransi =='ya'){
            $asuransi ='Y';
        }else{
            $asuransi ='N';
        }


        $waktu_kirim = $request->waktu_kirim;

        $bongkar_muat = $request->bongkar_muat;
        if($bongkar_muat =='ya'){
            $bongkar_muat ='Y';
        }else{
            $bongkar_muat ='N';
        }
        $pilihan_layanan = $request->layanan;
        $atas_nama_penjemputan = $request->atas_nama_penjemputan;
        $alamat_penjemputan = $request->alamat_penjemputan;
        $nama_penerima = $request->nama_penerima;
        $alamat_penerima = $request->alamat_penerima;
        $phone_penerima = $request->phone_penerima;
        $type_customer = $request->type_customer;
        $nama_perusahaan = $request->nama_perusahaan;
        $nama = $request->nama;
        $email = $request->email;
        $alamat = $request->alamat;
        $phone = $request->phone;
        $status_transaction ='booking';


        // saving orders booking

        // cek users email members
        $cek_members = User::where('email',$email)->first();

        if($cek_members){
            $members_id = $cek_members->id;
        }else{

            // create users members
            $activation_code = Str::random(60).$email;
            $password =$email.'123';
            $user = User::create([
                'name'      => $nama,
                'email'  => $email,
                'password'  => Hash::make($password),
                'status'     => 1,
                'verified_status'     => 0,
                'activation_code'=>$activation_code
            ]);

            $user->syncRoles('members');
            $user->save();

            // saving users desc
            $data = new UserDescription;
            $data->users_id = $user->id;
            $data->nama_depan = $nama;
            $data->type_user = $type_customer;
            $data->nama_instansi = $nama_perusahaan;
            $data->alamat_rumah = $alamat;
            $data->phone = $phone;
            $data->nama_belakang = null;
            $data->jenis_kelamin = null;
            $data->tempat_lahir = null;
            $data->tanggal_lahir = null;
            $data->tanggal_masuk = null;
            $data->status = 1;
            $data->created_by =$user->id;
            $data->save();

            $members_id = $user->id;

        }

        // saving booking orders


        //saving table
        $orders = new TransBooking;
        $orders->booking_code = $booking_code;
        $orders->from_district = $from_district;
        $orders->to_district = $to_district;
        $orders->type_booking = $type_booking;
        $orders->kendaraan_merk_id = $kendaraan_merk_id;
        $orders->kendaraan_model_id = $kendaraan_model_id;
        $orders->kendaraan_tahun = $kendaraan_tahun;
        $orders->kendaraan_kondisi = $kendaraan_kondisi;
        $orders->kendaraan_dikendarai = $kendaraan_dikendarai;
        $orders->asuransi = $asuransi;
        $orders->waktu_kirim = $waktu_kirim;
        $orders->bongkar_muat = 'N';
        $orders->pilihan_layanan = $pilihan_layanan;
        $orders->atas_nama_penjemputan = $atas_nama_penjemputan;
        $orders->alamat_penjemputan = $alamat_penjemputan;
        $orders->nama_penerima = $nama_penerima;
        $orders->alamat_penerima = $alamat_penerima;
        $orders->phone_penerima = $phone_penerima;
        $orders->members_id = $members_id;
        $orders->type_customer = $type_customer;
        $orders->nama_perusahaan = $nama_perusahaan;
        $orders->nama = $nama;
        $orders->email = $email;
        $orders->alamat = $alamat;
        $orders->phone = $phone;
        $orders->status_transaction = 'booking';
        $orders->created_at = date("Y-m-d h:i:s");        
        $orders->save();


        
        $text = "Terimakasih <strong>".$nama.'</strong> Sudah melakukan orders pengiriman kendaraan, <br> Kami akan segera mem-proses pesanan anda, pastikan email dan nomor Whatsapp anda aktif untuk bisa segera kami follow up. :D';

        return redirect(LaravelLocalization::getCurrentLocale().'/booking/pengiriman-kendaraan-dan-alat-berat')->with('status', $text);



    }

    public function cargo(){

        $page = Page::where('status',1)->where('jenis',2)->whereId(21)->firstOrFail();
        $pageDescription = $page->description()->select('name', 'description')->where('language_id',LaravelLocalization::getCurrentLocale())->first();
        
        $header_home = false;
        
        
        $navActive ='booking';
        return view('frontend.booking.cargo', compact('page', 'pageDescription','header_home','navActive'))->with(array('controller' => $this->controller));

    }

    public function kontainer(){

        $page = Page::where('status',1)->where('jenis',2)->whereId(22)->firstOrFail();
        $pageDescription = $page->description()->select('name', 'description')->where('language_id',LaravelLocalization::getCurrentLocale())->first();
        
        $header_home = false;
        
        $data_kontainer = Kontainer::where('status',1)->get();
        $maktu_kirim = WaktuKirim::where('status',1)->get();
        
        $navActive ='booking';
        return view('frontend.booking.kontainer', compact(
            'page', 
            'pageDescription',
            'header_home',
            'navActive',
            'data_kontainer',
            'maktu_kirim'
        ))->with(array('controller' => $this->controller));

    }


    public function kontainer_act(Request $request){

        $booking_code = BookingController::code_orders();
        $from_district = $request->from_district;
        $to_district = $request->to_district;
        $kontainer_type = $request->kontainer_type;
        $kontainer_jumlah = $request->kontainer_jumlah;
        $kontainer_kemasan_barang = $request->kontainer_kemasan_barang;
        $asuransi = $request->asuransi;
        if($asuransi =='ya'){
            $asuransi ='Y';
        }else{
            $asuransi ='N';
        }
        $waktu_kirim = $request->waktu_kirim;

        $bongkar_muat = $request->bongkar_muat;
        if($bongkar_muat =='ya'){
            $bongkar_muat ='Y';
        }else{
            $bongkar_muat ='N';
        }

        $pilihan_layanan = $request->layanan;
        $atas_nama_penjemputan = $request->atas_nama_penjemputan;
        $alamat_penjemputan = $request->alamat_penjemputan;
        $nama_penerima = $request->nama_penerima;
        $alamat_penerima = $request->alamat_penerima;
        $phone_penerima = $request->phone_penerima;
        $type_customer = $request->type_customer;
        $nama_perusahaan = $request->nama_perusahaan;
        $nama = $request->nama;
        $email = $request->email;
        $alamat = $request->alamat;
        $phone = $request->phone;
        $status_transaction ='booking';

        
        // cek users email members
        $cek_members = User::where('email',$email)->first();
        if($cek_members){
            $members_id = $cek_members->id;
        }else{
            // create users members
            $activation_code = Str::random(60).$email;
            $password =$email.'123';
            $user = User::create([
                'name'      => $nama,
                'email'  => $email,
                'password'  => Hash::make($password),
                'status'     => 1,
                'verified_status'     => 0,
                'activation_code'=>$activation_code
            ]);

            $user->syncRoles('members');
            $user->save();
            // saving users desc
            $data = new UserDescription;
            $data->users_id = $user->id;
            $data->nama_depan = $nama;
            $data->type_user = $type_customer;
            $data->nama_instansi = $nama_perusahaan;
            $data->alamat_rumah = $alamat;
            $data->phone = $phone;
            $data->nama_belakang = null;
            $data->jenis_kelamin = null;
            $data->tempat_lahir = null;
            $data->tanggal_lahir = null;
            $data->tanggal_masuk = null;
            $data->status = 1;
            $data->created_by =$user->id;
            $data->save();

            $members_id = $user->id;

        }


        //saving table
        $orders = new TransBooking;
        $orders->booking_code = $booking_code;
        $orders->from_district = $from_district;
        $orders->to_district = $to_district;
        $orders->type_booking = 'kontainer';
        $orders->kontainer_type = $kontainer_type;
        $orders->kontainer_jumlah = $kontainer_jumlah;
        $orders->kontainer_kemasan_barang = $kontainer_kemasan_barang;
        $orders->asuransi = $asuransi;
        $orders->waktu_kirim = $waktu_kirim;
        $orders->bongkar_muat = $bongkar_muat;
        $orders->pilihan_layanan = $pilihan_layanan;
        $orders->atas_nama_penjemputan = $atas_nama_penjemputan;
        $orders->alamat_penjemputan = $alamat_penjemputan;
        $orders->nama_penerima = $nama_penerima;
        $orders->alamat_penerima = $alamat_penerima;
        $orders->phone_penerima = $phone_penerima;
        $orders->members_id = $members_id;
        $orders->type_customer = $type_customer;
        $orders->nama_perusahaan = $nama_perusahaan;
        $orders->nama = $nama;
        $orders->email = $email;
        $orders->alamat = $alamat;
        $orders->phone = $phone;
        $orders->status_transaction = 'booking';
        $orders->created_at = date("Y-m-d h:i:s");        
        $orders->save();


        
        $text = "Terimakasih <strong>".$nama.'</strong> Sudah melakukan orders Pengiriman Kontainer, <br> Kami akan segera mem-proses pesanan anda, pastikan email dan nomor Whatsapp anda aktif untuk bisa segera kami follow up. :D';

        return redirect(LaravelLocalization::getCurrentLocale().'/booking/pengiriman-kontainer')->with('status', $text);


    }



    function code_orders(){

        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $characters[rand(0, strlen($characters) - 1)];

        // shuffle the result
        $code = str_shuffle($pin);

        // cek code booking in db
        $cek_code = TransBooking::where('booking_code',$code)->first();

        if($cek_code){
            // jika sudah ada, maka generate lagi 
            $seken_char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $seken_pin = mt_rand(1000000, 9999999)
            . mt_rand(1000000, 9999999)
            . $seken_char[rand(0, strlen($seken_char) - 1)];
            $booking_code = $seken_pin;

        }else{
            // jika belum ada, maka boleh pakai code 

            $booking_code = $code;
        }

        return $booking_code;


    }
}
