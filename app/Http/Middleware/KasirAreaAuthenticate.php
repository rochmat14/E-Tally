<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\UsersArea;


class KasirAreaAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()){
            return redirect('/');
        } else {
            $user = Auth::user();
            

            if ($user->status == 0) {
                Auth::logout();
                return redirect('/');
            }
            if ($user->hasRole('users_area')){
                
                $user_area = UsersArea::select('ms_divisi.divisi_name','ms_users_area.id_divisi','ms_users_area.id','ms_users_area.users_id')
                            ->where('users_id',$user->id)
                            ->join('ms_divisi','ms_users_area.id_divisi','=','ms_divisi.id')
                            ->first();

                $cek_divisi = $user_area->divisi_name;

                if($cek_divisi == 'kasir-area'){
                    return $next($request);
                }
                else{
                    Auth::logout();
                    return redirect('/');
                }

            } else {
                return redirect('/');
            }
        }
    }
}
