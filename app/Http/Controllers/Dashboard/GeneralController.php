<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\KabKota;
use App\Provinsi;
use App\Port;
class GeneralController extends Controller
{
    
    public function kota(Request $request){

    	$id_provinces = $request->id_provinces;

    	$get_kota = KabKota::where('id_prov',$id_provinces)->get();

    	foreach ($get_kota as $key => $value) {
    		echo "<option value=".$value->id_kab.">".$value->nama."</option>";
    	}
    }

    public function port(Request $request){
    	$id_prov = $request->id_provinces;


    	$get_prov = Provinsi::where('id_prov',$id_prov)->first();


    	$get_port = Port::where('id_prov',$get_prov->id)->get();

    	foreach ($get_port as $key => $value) {
    		echo "<option value=".$value->id.">".$value->port_name."</option>";
    	}

    }
}
