<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
// use App\Notifikasi;

class VerifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }
    

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $data_users = $this->user;

        $data = array(
            'name'=>$data_users['name'],
            'code'=>$data_users['activation_code']
        );


        // $nt = new Notifikasi;
        // $nt->id_user = $data_users['id'];
        // $nt->judul ="Informasi Aktivasi Akun";
        // $nt->text ="Selamat Akun Anda Berhasil Di-Verifikasi, Silahkan Lengkapi Data Profile Anda Pada Menu My Profile. Terimakasih";
        // $nt->status ='un_read';
        // $nt->created_by = $data['id'];
        // $nt->save();
        

        return $this->view('email.verifyUser', compact('data'));
    }
}
