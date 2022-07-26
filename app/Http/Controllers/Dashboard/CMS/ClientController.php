<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ClientData;
use App\Http\Requests\Backend\ClientRequest;
use App\Http\Requests\Backend\ClientEditRequest;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;






class ClientController extends Controller
{
    private $controller = 'client';
    private $title = 'Data Client';

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
        
        $arrColumns = [1=>'id', 2=>'nama_client',3=>'nama_client'];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = ClientData::select([
            'id',
            'nama_client',
            'logo'
        ])
        ->where('status',1)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->escapeColumns('active')
            ->addColumn('logo', function ($row) {

                $logo  = "<img src='".url('images/client').'/'.$row->logo."' style='width:200px;height:200px;'>";
                return $logo;
            })
            ->addColumn('editUrl', function ($row) {
                return $row->id;
            })
            ->addColumn('deleteUrl', function ($row) {
                return $row->id;

            })
            ->make();
    }

    public function save(ClientRequest $request)
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }


        $nama_client = $request->get('nama_client');


        //saving table
        $data = new ClientData;
        $data->nama_client = $nama_client;

        if($request->logo){
            // upload logo bank
            $logo = $request->logo;
            $destinationPath = 'images/client/';
            $filename = time().'.'.$request->logo->extension();  
            $request->logo->move($destinationPath, $filename);
            $data->logo = $filename;

        }

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

        $datas = ClientData::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }

    public function update(ClientEditRequest $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $nama_client = $request->get('nama_client');
    

        //update 
        $pk = ClientData::find($id);
        $pk->nama_client = $nama_client;

        if($request->logo){
            // upload logo bank
            $logo = $request->logo;
            $destinationPath = 'images/client/';
            $filename = time().'.'.$request->logo->extension();  
            $request->logo->move($destinationPath, $filename);
            $pk->logo = $filename;

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
        $pk = ClientData::find($id);
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
