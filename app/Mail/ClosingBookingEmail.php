<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Master\TransBookingProgress;


class ClosingBookingEmail extends Mailable
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


        $data_progress = TransBookingProgress::select([
                'kk_trans_booking_progress.id',
                'orders_id',
                'id_progress_category',
                'progress_description',
                'progress_time',
                'kk_ms_progress_category.progress_name'
            ])
            ->join('kk_ms_progress_category','kk_trans_booking_progress.id_progress_category','=','kk_ms_progress_category.id')
            ->where('kk_trans_booking_progress.status',1)
            ->where('kk_trans_booking_progress.orders_id',$data_param['booking_id'])
            ->orderBy('progress_time','desc')
            ->get();


        


       

        $subject="Informasi Closing Orders ".$data_param['type_booking']." | INB Logisitik";

        return $this->view('email.email_closing_booking', compact('return_data','data_progress'))->subject($subject);
    }
}
