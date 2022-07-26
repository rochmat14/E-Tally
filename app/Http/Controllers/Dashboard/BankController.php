<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bank;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Backend\BankRequest;
use Illuminate\Support\Facades\Auth;




class BankController extends Controller
{
    //

    private $controller = 'bank';
    private $title = 'Bank Data';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if (!$user->can($this->controller.'-index')){
            return view('errors.401');    
        }

        return view('backend.'.$this->controller.'.index')->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    public function getData(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [
            1=>'id', 
            2=>'bank_name', 
            3=>'bank_rekening',
            4=>'atas_nama',
            5=>'bank_logo'
        ];


        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = Bank::select([
            'id',
            'bank_name',
            'bank_rekening',
            'atas_nama',
            'bank_logo'
        ])
        ->where('status',1)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('bank_logo', function ($row) {
                return $row->bank_logo;
            })
            ->addColumn('editUrl', function ($row) {
                return $row->id;
            })
            ->addColumn('deleteUrl', function ($row) {
                return $row->id;
            })
            ->make();
    }


    public function save(BankRequest $request)
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }


        $bank_name = $request->get('bank_name');
        $bank_rekening = $request->get('bank_rekening');
        $atas_nama = $request->get('atas_nama');


        //saving table
        $data = new Bank;
        $data->bank_name = $bank_name;
        $data->bank_rekening = $bank_rekening;
        $data->atas_nama = $atas_nama;
        if($request->bank_logo){
            // upload logo bank
            $bank_logo = $request->bank_logo;
            $destinationPath = 'images/bank/';
            $filename = time().'.'.$request->bank_logo->extension();  
            $request->bank_logo->move($destinationPath, $filename);
            $data->bank_logo = $filename;

        }
        $data->created_by = Auth::user()->id;
        $data->save();
        echo json_encode(array("status" => TRUE));
    }

    public function get_data_byid(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }
        $id= $request->get('id');

        $datas = Bank::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }

    public function update(BankRequest $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $bank_name = $request->get('bank_name');
        $bank_rekening = $request->get('bank_rekening');
        $atas_nama = $request->get('atas_nama');
    

        //update 
        $pk = Bank::find($id);
        $pk->bank_name = $bank_name;
        $pk->atas_nama = $atas_nama;
        $pk->bank_rekening = $bank_rekening;
        if($request->bank_logo){
            // upload logo bank
            $bank_logo = $request->bank_logo;
            $destinationPath = 'images/bank/';
            $filename = time().'.'.$request->bank_logo->extension();  
            $request->bank_logo->move($destinationPath, $filename);
            $pk->bank_logo = $filename;

        }
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
        $pk = Bank::find($id);
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
