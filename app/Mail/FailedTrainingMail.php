<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Notifikasi;


class FailedTrainingMail extends Mailable
{
    use Queueable, SerializesModels;


    public $data;


    public function __construct($data)
    {
        $this->data = $data;
    }

    
    public function build()
    {
        $data_param = $this->data;
        $data = $data_param;

        // save notifikasi 
        $nt = new Notifikasi;
        $nt->id_user = $data['id_peserta'];
        $nt->judul ="Informasi Gagal Mengikuti Training";
        $nt->text ="Mohon Maaf ! <br> Anda Tidak Berhasil Dalam Mengikuti Training <strong>".$data['nama_training']."</strong> Dengan alasa ".$data['remarks'].". <br><br>Anda Bisa Mencoba Lagi Di lain Waktu";
        $nt->status ='un_read';
        $nt->created_by = $data['id_peserta'];
        $nt->save();

        
        return $this->view('email.orders_training_failed', compact('data'));
    }


}
