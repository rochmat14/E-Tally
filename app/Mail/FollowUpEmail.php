<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Master\TransBookingDetail;


class FollowUpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $data_param = $this->data;

        $return_data= array(
            'booking_id'=>$data_param['booking_id'],
            'booking_code'=>$data_param['booking_code'],
            'nama'=>$data_param['nama'],
            'type_booking'=>$data_param['type_booking'],
            'pengirman_dari'=>$data_param['pengirman_dari'],
            'tujuan_pengiriman'=>$data_param['tujuan_pengiriman'],
            'waktu_kirim'=>$data_param['waktu_kirim'],
            'asuransi'=>$data_param['asuransi'],
            'bongkar_muat'=>$data_param['bongkar_muat'],
            'pilihan_layanan'=>$data_param['pilihan_layanan'],
            'jenis_booking'=>$data_param['jenis_booking'],
            'merk'=>$data_param['merk'],
            'model'=>$data_param['model'],
            'kendaraan_tahun'=>$data_param['kendaraan_tahun'],
            'kendaraan_kondisi'=>$data_param['kendaraan_kondisi'],
            'kendaraan_dikendarai'=>$data_param['kendaraan_dikendarai'],
            'type_kontainer'=>$data_param['type_kontainer'],
            'kontainer_jumlah'=>$data_param['kontainer_jumlah'],
            'kontainer_kemasan_barang'=>$data_param['kontainer_kemasan_barang']

        );


        $data_service = TransBookingDetail::where('status',1)
        ->where('booking_id',$data_param['booking_id'])
        ->get();

        $subject="Informasi Estimasi Pembiayaan ".$data_param['type_booking']." | INB Logisitik";

        return $this->view('email.email_followup', compact('return_data','data_service'))->subject($subject);


    }
}
