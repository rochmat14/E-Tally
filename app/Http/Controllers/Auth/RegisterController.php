<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\UserDescription;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],[
                'name.required' => 'Harap isi nama anda terlebih dahulu',
                'email.required' => 'Harap masukan email anda',
                'email.email' => 'Harap masukan email anda dengan benar',
                'email.unique:users' => 'Email yang anda masukan sudah terdaftar',
                'password.required' => 'Masukan password anda, minimal password 8 karakter',
                'password.confirmed' => 'Konfirmasi Password tidak sama dengan kode password',
            ]

        );
    }

    

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {



        $activation_code = Str::random(60).$data['email'];

        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];
        // $nama_instansi = $data['nama_instansi'];

    

        $user = User::create([
            'name'      => $name,
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
        $data->nama_depan = $name;
        $data->nama_belakang = null;
        $data->jenis_kelamin = null;
        $data->tempat_lahir = null;
        $data->tanggal_lahir = null;
        $data->tanggal_masuk = null;
        $data->alamat_rumah = null;
        // $data->nama_instansi = $nama_instansi;
        $data->status = 1;
        $data->created_by =$user->id;
        $data->save();

        \Mail::to($user->email)->send(new VerifyMail($user));

        return $user;

    }

    public function verifyUser($token)
    {
        # code...
        $verifyUser = VerifyUser::where('token', $token)->first();

        if(isset($verifyUser) ){
            $get_users = User::where('id',$verifyUser->user_id)->first();

            if(!$get_users->verified_status) {
                $get_users->verified_status = 1;
                $get_users->save();
                $status = "Your e-mail is verified. You can now login. in apps";
            }else{
                $status = "Your e-mail is already verified. You can now login in apps.";
            }
        }else{
            $status= "Sorry your email cannot be identified.";
        }
 
        return redirect('/login')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'Selamat, pendaftaran anda berhasil, mohon check email anda, dan klik link verifikasinya, untuk bisa login sebagai members');
    }


    public function activate($code, User $user)
    {
        if ($user->activateAccount($code)) {
            // return 'Activated !';
            return redirect('/members/profile')->with('status_profile', 'Selamat, akun anda berhasil di verifikasi, jangan lupa untuk melengkapi data di sini :)');
        }

        return redirect('/login')->with('status', 'Mohon maaf, akun anda belum ter-verifikasi');
        return 'Fail';
        
    }
}
