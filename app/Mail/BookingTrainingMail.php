<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Notifikasi;

class BookingTrainingMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        $nt->judul ="Informasi Booking Training";
        $nt->text ="Anda Berhasil Melakukan Booking Training ".$data['nama_training']." Berdasarkan nomor orders  = ".$data['kode_booking']. ". Silahkan lakukan bukti pembayaran lewat sistem untuk proses selanjutnya. Terimakasih";
        $nt->status ='un_read';
        $nt->created_by = $data['id_peserta'];
        $nt->save();

        
        return $this->view('email.orders_training', compact('data'));
    }
}
