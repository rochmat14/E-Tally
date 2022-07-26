<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Notifikasi;


class ConfirmTrainingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;


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
        $data = $data_param;

        // save notifikasi 
        $nt = new Notifikasi;
        $nt->id_user = $data['id_peserta'];
        $nt->judul ="Informasi Pembayaran Training";
        $nt->text ="Selamat Anda Telah Berhasil Melakukan Pembayaran Terkait Kode Booking ".$data['kode_booking']." Berdasarkan Nama Training ".$data['nama_training']." Silahkan Cek Menu My Orders. Terimakasih";
        $nt->status ='un_read';
        $nt->created_by = $data['id_peserta'];
        $nt->save();

        
        return $this->view('email.orders_training_confirm', compact('data'));
    }
}
