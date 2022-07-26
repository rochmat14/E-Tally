<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ManifestModel;

class ManifestController extends Controller
{
    //


    public function index(Request $request){

        $datax=ManifestModel::select(
            'kk_tr_manifest.id',
            'kk_tr_manifest.kode_manifest',
            'kk_tr_manifest.country',
            'kk_tr_manifest.date_of',
            'kk_tr_manifest.port_name',
            'ms_customer.customer_name',
            'ms_customer.phone as customer_phone',
            'ms_customer.email as customer_email',
            'kk_tr_manifest.created_at'            
        )   
        ->join('ms_customer','kk_tr_manifest.id_customer','=','ms_customer.id')
        ->where('kk_tr_manifest.status',1)
        ->get();

        $data=array(
            'success'=>true,
            'data'=>$datax,
            'message'=>'success get data Manifes'
        );


        return response()->json($data);

    }
}
