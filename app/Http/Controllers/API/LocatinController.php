<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\LocationModel;

class LocatinController extends Controller
{

    public function index(Request $request){
        $datax=LocationModel::where('status',1)->get();

        $data=array(
            'success'=>true,
            'data'=>$datax,
            'message'=>'success get data Location'
        );


        return response()->json($data);

        
    }
}
