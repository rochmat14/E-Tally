<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ProductCategory;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Backend\ProductCategoryRequest;
use Illuminate\Support\Facades\Auth;



class ProductCategoryController extends Controller
{
    private $controller = 'product_category';
    private $title = 'Data Product Category';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }

        return view('backend.'.$this->controller.'.index')->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }


    public function getData(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [1=>'id', 2=>'category_product',3=>'description'];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = ProductCategory::select([
            'id',
            'category_product',
            'description'
        ])
        ->where('status',1)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('editUrl', function ($row) {
                return $row->id;
                // return route($this->controller.'.edit', $row->id);
            })
            ->addColumn('deleteUrl', function ($row) {
                return $row->id;

                // return route($this->controller.'.destroy', $row->id);
            })
            ->make();
    }

    public function save(ProductCategoryRequest $request)
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }


        $category_product = $request->get('category_product');
        $description = $request->get('description');
        //saving table
        $data = new ProductCategory;
        $data->category_product = $category_product;
        $data->description = $description;
        $data->status = 1;
        $data->created_by = Auth::user()->id;
        $data->save();
        echo json_encode(array("status" => TRUE));
    }

    public function get_data_byid(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }
        $id= $request->get('id');

        $datas = ProductCategory::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }

    public function update(ProductCategoryRequest $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $category_product = $request->get('category_product');
        $description = $request->get('description');
    

        //update 
        $pk = ProductCategory::find($id);
        $pk->category_product = $category_product;
        $pk->description = $description;
        $pk->updated_by =Auth::user()->id;
        $pk->save();
        echo json_encode(array("status" => TRUE));

    }

    public function delete(Request $request){
        if (!auth()->user()->can($this->controller.'-delete')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        //update  
        $pk = ProductCategory::find($id);
        $pk->status = 0;
        $pk->updated_by =Auth::user()->id;
        $pk->save();


        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "success",
                    "message"=>"Success ! Deleted data"
                )
            );
        echo json_encode($result);
    }
}
