<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wilayah\Regencies;
use App\Wilayah\Districts;
use App\Master\MasterModel;


class GetAjaxController extends Controller
{
    //

    public function index(Request $request){

        $search = $request->search;

        $rows = Districts::select(
            'ms_wil_districts.id',
            'ms_wil_regencies.province_id',
            'ms_wil_districts.regency_id',
            'ms_wil_provinces.name AS provinsi',
            'ms_wil_regencies.name AS kota',
            'ms_wil_districts.name AS kecamatan',
        )
        ->join('ms_wil_regencies','ms_wil_districts.regency_id','ms_wil_regencies.id')
        ->join('ms_wil_provinces','ms_wil_regencies.province_id','ms_wil_provinces.id')
        ->where('ms_wil_provinces.name','like','%'.$search.'%')
        ->orwhere('ms_wil_regencies.name','like','%'.$search.'%')
        ->orwhere('ms_wil_districts.name','like','%'.$search.'%')
        ->get();

        $datas = array();
        foreach($rows AS $key => $value){
            $datas[]=array(
                'id'=>$value->id,
                'text'=>$value->provinsi.', '.$value->kota.', '.$value->kecamatan
            );
        }
        
        echo json_encode($datas);

    }


    public function get_merk(Request $request){

        $merk_id = $request->merk_id;

        $get_data_model = MasterModel::where('merk_id',$merk_id)
        ->where('status',1)
        ->get();

        $datas='';
        foreach($get_data_model AS $key => $value){
            // $datas[]=array(
            //     'id'=>$value->id,
            //     'model'=>$value->model
            // );

            $datas.= "<option value=".$value->id.">".$value->model."</option>";

        }

        return $datas;
        // return json_encode($datas);
        // return $datas;

    }
}
