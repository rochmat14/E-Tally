<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Model\BillOfLaddingModel;
use App\Model\ProductBLModel;
use App\Model\Satuan;
use App\Model\ProductCategory;

use App\Http\Requests\Backend\ProductRequest;
use App\Model\Customer;

class BillOfLadingController extends Controller
{
    
    private $controller = 'bill_of_lading';

    private $title ='Bill Of Lading';

    public function create($id_manifest){
        
        $customer = Customer::select('id', 'customer_name')->get();
        
        $controller = $this->controller;
        $title = $this->title;
        
        return view('backend.bill_of_lading.create', compact('id_manifest', 'customer', 'controller', 'title'));
    }

    public function store(Request $request){

        $id_manfest = $request->id_manfest;
        $kode_bill_of_lading = $request->kode_bill_of_lading;
        $customer_id = $request->customer_id;
        $transfer_to = $request->transfer_to;
        $ship_name = $request->ship_name;
        $country = $request->country;
        $date_of_bill = $request->date_of_bill;
        $telly_man = $request->telly_man;
        
        $data = new BillOfLaddingModel;

        $data->id_manfest = $id_manfest;
        $data->kode_bill_of_lading = $kode_bill_of_lading;
        $data->customer_id = $customer_id;
        $data->transfer_to = $transfer_to;
        $data->ship_name = $ship_name;
        $data->country = $country;
        $data->date_of_bill = $date_of_bill;
        $data->telly_man = $telly_man;
        $data->status = 1;

        $data->save();

        return redirect('dashboard/manifest/'.$id_manfest);
    }

    public function update(Request $request, $id){

        $kode_bill_of_lading = $request->kode_bill_of_lading;
        $customer_id = $request->customer_id;
        $transfer_to = $request->transfer_to;
        $ship_name = $request->ship_name;
        $country = $request->country;
        $date_of_bill = $request->date_of_bill;
        $telly_man = $request->telly_man;
        
        $data = BillOfLaddingModel::find($id);

        $data->kode_bill_of_lading = $kode_bill_of_lading;
        $data->customer_id = $customer_id;
        $data->transfer_to = $transfer_to;
        $data->ship_name = $ship_name;
        $data->country = $country;
        $data->date_of_bill = $date_of_bill;
        $data->telly_man = $telly_man;

        $data->save();

        return redirect('dashboard/manifest/'.$id);
    }

    public function edit($id){
    
        $bill_of_landing = BillOfLaddingModel::find($id);
        
        $customer = Customer::select('id', 'customer_name')->get();

        $controller = $this->controller;
        $title = $this->title;

        return view('backend.bill_of_lading.edit', compact('bill_of_landing', 'customer', 'controller', 'title'));
    }

    public function getData(Request $request,$id)
    {
        
        $id_manifest = $id;


        $arrColumns = [
            1=>'id', 
            2=>'kode_bill_of_lading',
            3=>'date_of_bill',
            4=>'telly_man'
        ];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = BillOfLaddingModel::select([
            'kk_tr_bill_of_lading.id',
            'kk_tr_bill_of_lading.kode_bill_of_lading',
            'kk_tr_bill_of_lading.date_of_bill',
            'telly_man'           
        ])
        ->where('kk_tr_bill_of_lading.status',1)
        ->where('kk_tr_bill_of_lading.id_manfest',$id_manifest)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('total_product_process', function ($row) {
                $get_product = ProductBLModel::where('status',1)->where('bill_of_lading_id',$row->id)
                ->where('status_product','proses')
                ->count();
                return $get_product.' Product';
            })
            ->addColumn('total_product_finish', function ($row) {
                $get_product = ProductBLModel::where('status',1)->where('bill_of_lading_id',$row->id)
                ->where('status_product','finish')
                ->count();
                return $get_product.' Product';
            })

            ->addColumn('barcode', function ($row) {
                return url('images/barcode-sample.png');
            })
            ->addColumn('editUrl', function ($row) {

                // return $row->id;

                return '/dashboard/bill-of-lading/'. $row->id. '/edit';

            })
            ->addColumn('viewUrl', function ($row) {

                 return route('bill_of_lading.view', $row->id);

            })
            ->make();

        
    }


    public function show($id){
        // menadapatkan id bill-of-lading
        $id_bl = $id;

        $bl_data = BillOfLaddingModel::select(
            'kk_tr_bill_of_lading.id',
            'kk_tr_bill_of_lading.kode_bill_of_lading',
            'kk_tr_bill_of_lading.date_of_bill',
            'telly_man'
        )
        ->where('kk_tr_bill_of_lading.status',1)
        ->where('kk_tr_bill_of_lading.id',$id_bl)
        ->first();

        $data=array(
            'id'=>$bl_data->id,
            'kode_bill_of_lading'=>$bl_data->kode_bill_of_lading,
            'date_of_bill'=>$bl_data->date_of_bill,
            'telly_man'=>$bl_data->telly_man,
            'barcode_bl'=>URL('images/barcode-sample.png')
        );


        $total_product = ProductBLModel::where('status',1)->where('bill_of_lading_id',$id_bl)->count();
        
        $satuan = Satuan::where('status',1)->get();
        $product_category = ProductCategory::where('status',1)->get();
        
        return view('backend.'.$this->controller.'.view', compact('data','total_product','id_bl','satuan','product_category'))->with(['controller'=>$this->controller, 'title'=>$this->title]);

    }


    public function getDataProductProccess(Request $request,$id){
        $id_bl = $id;

        $arrColumns = [
            1=>'id', 
            2=>'product_code',
            3=>'product_name',
            4=>'category_product',
            5=>'satuan_name',
        ];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = ProductBLModel::select([
            'kk_ms_product.id',
            'kk_ms_product.product_code',
            'kk_ms_product.bill_of_lading_id',
            'kk_ms_product.product_name',
            'ms_satuan.satuan_name',
            'kk_ms_product.total',
            'ms_product_category.category_product',
            'kk_ms_product.status_product',
            'kk_ms_product.from_moving',
            'kk_ms_product.to_moving',
            'kk_ms_product.description_moving',
            'kk_ms_product.image_moving'           
        ])
        ->join('ms_satuan','kk_ms_product.product_satuan','ms_satuan.id')
        ->join('ms_product_category','kk_ms_product.product_category','ms_product_category.id')
        ->where('kk_ms_product.status_product','proses')
        ->where('kk_ms_product.bill_of_lading_id',$id_bl)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            

            ->addColumn('barcode', function ($row) {
                return url('images/barcode-sample.png');
            })
            ->addColumn('editUrl', function ($row) {
                return '/Dashboard/product/'.$row->id.'/edit';
            })
        
            ->make();

    }


    public function save_product(ProductRequest $request){

        $bill_of_lading_id = $request->get('bill_of_lading_id');
        $product_name = $request->get('product_name');
        $product_satuan = $request->get('product_satuan');
        $product_category = $request->get('product_category');
        $product_code ="PR .".rand();

        //saving table
        $data = new ProductBLModel;
        $data->bill_of_lading_id = $bill_of_lading_id;
        $data->product_code = $product_code;
        $data->product_name = $product_name;
        $data->product_satuan = $product_satuan;
        $data->product_category = $product_category;
        $data->created_by = Auth::user()->id;
        $data->save();
        echo json_encode(array("status" => TRUE));


    }


    public function getDataProductFinish(Request $request,$id){
        $id_bl = $id;

        $arrColumns = [
            1=>'id', 
            2=>'product_code',
            3=>'product_name',
            4=>'category_product',
            5=>'satuan_name',
            6=>'from_moving',
            7=>'to_moving',
            8=>'description_moving',
        ];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = ProductBLModel::select([
            'kk_ms_product.id',
            'kk_ms_product.product_code',
            'kk_ms_product.bill_of_lading_id',
            'kk_ms_product.product_name',
            'ms_satuan.satuan_name',
            'kk_ms_product.total',
            'ms_product_category.category_product',
            'kk_ms_product.status_product',
            'kk_ms_product.from_moving',
            'kk_ms_product.to_moving',
            'kk_ms_product.description_moving',
            'kk_ms_product.image_moving'           
        ])
        ->join('ms_satuan','kk_ms_product.product_satuan','ms_satuan.id')
        ->join('ms_product_category','kk_ms_product.product_category','ms_product_category.id')
        ->where('kk_ms_product.status_product','finish')
        ->where('kk_ms_product.bill_of_lading_id',$id_bl)
        // ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            
            ->addColumn('product_data', function ($row) {
                $produt_data ='Product Code : '.$row->product_code.'<br>';
                $produt_data .='Product Name : '.$row->product_name.'<br>';
                $produt_data .='Satuan : '.$row->satuan_name.'<br>';
                $produt_data .='Kategori : '.$row->category_product.'<br>';

                return $produt_data;
            })

            ->addColumn('barcode', function ($row) {
                return url('images/barcode-sample.png');
            })

            ->addColumn('images', function ($row) {
                return url('images').'/capture/'.$row->image_moving;
            })
            ->escapeColumns('active')
            ->make();
    }
}
