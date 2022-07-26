<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subsribe;
use Validator;

class SubscribeController extends Controller
{
    //

    public function subscribe(Request $request){

        $rules = [
            'email'     => 'required|email|unique:kk_subscribe'
        ];

        $messages = [
            'email.required'         => 'Email wajib diisi.',
            'email.email'            => 'Email tidak valid.',
            'email.unique'           => 'Email sudah terdaftar sebagai subsriber aktif.',
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
         
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }


            
        $subscribe           = new Subsribe;
        $subscribe->email     = $request->email;
        $subscribe->save();
       
        return back()->with('success_subscribe', 'Subscribe successfully. Thanks You...');


    }
}
