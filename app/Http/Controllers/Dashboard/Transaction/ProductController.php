<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use App\Model\ProductBLModel;
use App\Model\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $controller = "product";
    private $title = "Product";

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $product_category = ProductCategory::select('id', 'category_product')->get();
        
        $bill_of_lading_id = $id;
        $controller = $this->controller;
        $title = $this->title;

        return view('backend.product.create' ,compact('product_category', 'bill_of_lading_id', 'controller', 'title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $file      = $request->file('image_moving');
        $filenameOri  = $file->getClientOriginalName();
        $picture   = 'images/vassel/' . date('His') . '-' . $filenameOri;
        $filename   = date('His') . '-' . $filenameOri;
        $file->move(public_path('images/product/'), $picture);
        
        $product_code  = $request->product_code;
        $product_name   = $request->product_name;
        $bill_of_lading_id = $request->bill_of_lading_id;
        $product_satuan   = $request->product_satuan;
        $product_category   = $request->product_category;
        $total   = $request->total;
        $status_product   = $request->status_product;
        $from_moving   = $request->from_moving;
        $to_moving   = $request->to_moving;
        $description_moving   = $request->description_moving;

        $data = new ProductBLModel();

        $data->product_code = $product_code;
        $data->product_name = $product_name;
        $data->bill_of_lading_id = $bill_of_lading_id;
        $data->product_satuan = $product_satuan;
        $data->product_category = $product_category;
        $data->total = $total;
        $data->status_product = $status_product;
        $data->from_moving = $from_moving;
        $data->to_moving = $to_moving;
        $data->description_moving = $description_moving;
        $data->image_moving = $filename;
        $data->status = 1;

        $data->save();

        return redirect('/dashboard/bill_of_lading/'.$bill_of_lading_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = ProductBLModel::find($id);
        $product_category = ProductCategory::select('id', 'category_product')->get();

        $controller = $this->controller;
        $title = $this->title;

        return view('backend.product.edit', compact('product', 'product_category', 'controller', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product_code  = $request->product_code;
        $product_name   = $request->product_name;
        $bill_of_lading_id = $request->bill_of_lading_id;
        $product_satuan   = $request->product_satuan;
        $product_category   = $request->product_category;
        $total   = $request->total;
        $status_product   = $request->status_product;
        $from_moving   = $request->from_moving;
        $to_moving   = $request->to_moving;
        $description_moving   = $request->description_moving;

        if($request->hasFile('image_moving')) {

            $file      = $request->file('image_moving');
            $filenameOri  = $file->getClientOriginalName();
            $picture   = 'images/product/' . date('His') . '-' . $filenameOri;
            $filename   = date('His') . '-' . $filenameOri;
            $file->move(public_path('images/product/'), $picture);
        

            $data = ProductBLModel::find($id);

            $data->product_code = $product_code;
            $data->product_name = $product_name;
            $data->bill_of_lading_id = $bill_of_lading_id;
            $data->product_satuan = $product_satuan;
            $data->product_category = $product_category;
            $data->total = $total;
            $data->status_product = $status_product;
            $data->from_moving = $from_moving;
            $data->to_moving = $to_moving;
            $data->description_moving = $description_moving;
            $data->image_moving = $filename;

            $data->save();

            $checkFile =  public_path().'/images/product/'.$request->image_value;

            if(file_exists($checkFile)) {

                @unlink($checkFile);

            } else {
                return "kosong";
            }
        }else{
            $data = ProductBLModel::find($id);

            $data->product_code = $product_code;
            $data->product_name = $product_name;
            $data->bill_of_lading_id = $bill_of_lading_id;
            $data->product_satuan = $product_satuan;
            $data->product_category = $product_category;
            $data->total = $total;
            $data->status_product = $status_product;
            $data->from_moving = $from_moving;
            $data->to_moving = $to_moving;
            $data->description_moving = $description_moving;

            $data->save();
        }

        return redirect('/dashboard/bill_of_lading/'.$bill_of_lading_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
