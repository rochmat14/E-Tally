<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BillOfLaddingModel;
use App\Model\ProductBLModel;
use App\Http\Requests\API\ProductByBLRequest;


class ProductController extends Controller
{
    public function index(ProductByBLRequest $request){


        $bl_id = $request->bl_id;

        $status_product = $request->status_product;


        $bl_data = BillOfLaddingModel::select(
            'kk_tr_bill_of_lading.id',
            'kk_tr_bill_of_lading.kode_bill_of_lading',
            'kk_tr_bill_of_lading.date_of_bill',
            'telly_man'
        )
        ->where('kk_tr_bill_of_lading.status',1)
        ->where('kk_tr_bill_of_lading.id',$bl_id)
        ->first();


        $bill_of_lading=array(
            'id'=>$bl_data->id,
            'kode_bill_of_lading'=>$bl_data->kode_bill_of_lading,
            'date_of_bill'=>$bl_data->date_of_bill,
            'telly_man'=>$bl_data->telly_man,
            'barcode_bl'=>URL('images/barcode-sample.png')
        );

        if($status_product =='finish'){
            $product_list = ProductBLModel::select(
                'kk_ms_product.id',
                'kk_ms_product.product_code',
                'kk_ms_product.product_name',
                'kk_ms_product.status_product'
            )
            ->where('kk_ms_product.bill_of_lading_id',$bl_id)
            ->where('kk_ms_product.status_product','finish')
            ->get();
        }else{
            $product_list = ProductBLModel::select(
                'kk_ms_product.id',
                'kk_ms_product.product_code',
                'kk_ms_product.product_name',
                'kk_ms_product.status_product'
            )
            ->where('kk_ms_product.bill_of_lading_id',$bl_id)
            ->where('kk_ms_product.status_product','proses')
            ->get();
        }

        
        

        $data_product=array();
        foreach($product_list AS $key => $value){
            $data_product[] = array(
                'product_id'=>$value->id,
                'product_code'=>$value->product_code,
                'product_name'=>$value->product_name,
                'status_product'=>$value->status_product,
                'barcode_images'=>URL('images/barcode-sample.png')
            );
        }

        $data_merge=array(
            'data_bill_of_lading'=>$bill_of_lading,
            'list_product'=>$data_product
        );


        
        $data=array(
            'status'=>'success',
            'data'=>$data_merge,
            'message'=>'success get data Bill Of Lading'
        );


        return response()->json($data);

    }


    public function detail($id){
        $product_id = $id;

        $data_product =ProductBLModel::select(
            'kk_ms_product.id',
            'kk_ms_product.product_code',
            'kk_ms_product.product_name',
            'ms_satuan.satuan_name',
            'kk_ms_product.total',
            'ms_product_category.category_product',
            'kk_ms_product.status_product',
            'kk_ms_product.from_moving',
            'kk_ms_product.to_moving',
            'kk_ms_product.description_moving',
            'kk_ms_product.image_moving'
        )
        ->join('ms_satuan','kk_ms_product.product_satuan','ms_satuan.id')
        ->join('ms_product_category','kk_ms_product.product_category','ms_product_category.id')
        ->where('kk_ms_product.id',$product_id)
        ->first();

        $data_product =array(
            'product_id'=>$data_product->id,
            'product_code'=>$data_product->product_code,
            'product_name'=>$data_product->product_name,
            'satuan_name'=>$data_product->satuan_name,
            'total'=>$data_product->total,
            'category_product'=>$data_product->category_product,
            'barcode_images'=>URL('images/barcode-sample.png'),
            'status_product'=>$data_product->status_product,
            'from'=>$data_product->from_moving,
            'to'=>$data_product->to_moving,
            'remark'=>$data_product->description_moving,
            'capture'=>url('images/capture').'/'.$data_product->image_moving
        );


        $data_merge=array(
            'product_detail'=>$data_product
        );

        $data=array(
            'status'=>'success',
            'data'=>$data_merge,
            'message'=>'success get data Bill Of Lading'
        );


        return response()->json($data);
    }


    public function process(Request $request, $id){
        $product_id = $id;
        $from = $request->from;
        $to = $request->to;
        $remark = $request->remark;


        
        $pk = ProductBLModel::find($id);
        $pk->from_moving = $from;
        $pk->to_moving = $to;
        $pk->description_moving = $remark;
        if($request->capture){
            // upload logo bank
            $capture = $request->capture;
            $destinationPath = 'images/capture/';
            $filename = time().'.'.$request->capture->extension();  
            $request->capture->move($destinationPath, $filename);
            $pk->image_moving = $filename;

        }
        $pk->status_product = 'finish';
        $pk->save();

        $data=array(
            'status'=>'success',
            'data'=>$pk,
            'message'=>'success Process Product'
        );

        return response()->json($data);

    }
}
