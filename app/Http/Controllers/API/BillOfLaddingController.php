<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\API\BillOfLaddingRequest;
use App\Model\ManifestModel;
use App\Model\BillOfLaddingModel;


class BillOfLaddingController extends Controller
{
    //

    public function index(BillOfLaddingRequest $request){


        $manifest_id = $request->manifest_id;


        $manifest=ManifestModel::select(
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
        ->where('kk_tr_manifest.id',$manifest_id)->first();

        $bill_of_lading = BillOfLaddingModel::select(
            'kk_tr_bill_of_lading.id',
            'kk_tr_bill_of_lading.kode_bill_of_lading',
            'kk_tr_bill_of_lading.date_of_bill',
            'telly_man'
        )
        ->where('kk_tr_bill_of_lading.status',1)
        ->where('kk_tr_bill_of_lading.id_manfest',$manifest_id)
        ->get();



        $data_bl=array();
        foreach($bill_of_lading AS $key => $value){
            $data_bl[] = array(
                'id'=>$value->id,
                'kode_bill_of_lading'=>$value->kode_bill_of_lading,
                'date_of_bill'=>$value->date_of_bill,
                'telly_man'=>$value->telly_man,
                'barcode_bl'=>URL('images/barcode-sample.png')
            );
        }

        $data_merge=array(
            'manifest'=>$manifest,
            'data_bill_of_lading'=>$data_bl
        );


        
        $data=array(
            'status'=>'success',
            'data'=>$data_merge,
            'message'=>'success get data Bill Of Lading'
        );


        return response()->json($data);

    }
}
