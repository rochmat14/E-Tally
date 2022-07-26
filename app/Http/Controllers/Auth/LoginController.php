<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Mail\VerifyMail;


class LoginController extends Controller
{
    

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard';
    // protected $redirectPath = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->redirectTo = url()->previous();
    }

    public function authenticated(Request $request, $user)
    {
        // check users verified
        if ($user->verified_status != 1) {
            \Mail::to($user->email)->send(new VerifyMail($user));
            auth()->logout();
            return back()->with('status', 'Mohon Maaf ! Anda perlu mem-verfikasi akun Anda Terlebih Dahulu. Kami telah mengirimkan kode aktivasi, Silakan periksa email Anda untuk proses aktivasi.');


        }
        return redirect()->intended($this->redirectPath());

        // return redirect()->previous();
        // return redirect(session('link'));

    }

    

    // check users status 1 == active 
    protected function credentials( Request $request )
    {
        $credentials = $request->only('email', 'password');
        $credentials['status'] = 1;
        return $credentials;

    }


    // public function showLoginForm()
    // {
    //     if(!session()->has('url.intended'))
    //     {
    //         session(['url.intended' => url()->previous()]);
    //     }
    //     return view('auth.login');
    // }


    
}
