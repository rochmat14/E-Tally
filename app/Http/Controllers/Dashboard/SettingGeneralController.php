<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;


use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Backend\PermissionsRequest;
use Illuminate\Support\Facades\Auth;
use App\SettingGeneral;

use Illuminate\Support\Facades\Crypt;


class SettingGeneralController extends Controller
{
    private $controller = 'setting_general';
    private $title = 'Setting General';

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
        
        $arrColumns = [1=>'id', 2=>'name',3=>'value',4=>'description'];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = SettingGeneral::select([
            'id',
            'name',
            'value',
            'description'
        ])
        ->where('type_setting','general')
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('editUrl', function ($row) {
                return $row->id;
                // return route($this->controller.'.edit', $row->id);
            })
            ->addColumn('data_value', function ($row) {
                return $row->name;
                // return route($this->controller.'.edit', $row->id);
            })
            ->make();
    }


    public function getDataSystem(Request $request){
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [1=>'id', 2=>'name',3=>'value',4=>'description'];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = SettingGeneral::select([
            'id',
            'name',
            'value',
            'description'
        ])
        ->where('type_setting','system')
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('editUrl', function ($row) {
                // return $row->id;


                $id = Crypt::encryptString($row->id);

                return route($this->controller.'.edit_data_system', array('id'=>$id));
            })

            ->addColumn('data_value', function ($row) {
                return $row->name;
                // return route($this->controller.'.edit', $row->id);
            })
            
            ->make();
    }


    public function get_data_byid(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }
        $id= $request->get('id');

        $datas = SettingGeneral::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }
    
    public function update(PermissionsRequest $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $name = $request->get('name');
        $value = $request->get('value');
        $description = $request->get('description');
    

        //update 
        $pk = SettingGeneral::find($id);
        $pk->name = $name;
        $pk->value = $value;
        $pk->description = $description;
        $pk->updated_by =Auth::user()->id;
        $pk->save();
        echo json_encode(array("status" => TRUE));

    }



    public function edit_data_system($id){
        $id = Crypt::decryptString($id);
        $row_data= SettingGeneral::where('id',$id)->first();
        return view('backend.'.$this->controller.'.edit_data_system',compact('row_data'))->with(['controller'=>$this->controller, 'title'=>$this->title]);

    }


    public function act_update(Request $request){


        $id = $request->get('id');
        $name = $request->get('name');
        
        $description = $request->get('description');


        if($name == 'logo' || $name == 'future_image'){
            $this->validate($request, [
                'value'      => 'required|image'
            ]);
            $file = $request->file('value');
            // Mendapatkan Nama File
            $nama_file = time().'_'.$file->getClientOriginalName();
            // Mendapatkan Extension File
            $extension = $file->getClientOriginalExtension();
            // Mendapatkan Ukuran File
            $ukuran_file = $file->getSize();
            // Proses Upload File
            $destinationPath = 'images/logo';
            $file->move($destinationPath,$nama_file);

            $pk = SettingGeneral::find($id);
            $pk->value = $nama_file;
            $pk->description = $description;
            $pk->updated_by =Auth::user()->id;
            $pk->save();

            

        }else{


            $pk = SettingGeneral::find($id);
            $pk->value = $request->get('value');
            $pk->description = $description;
            $pk->updated_by =Auth::user()->id;
            $pk->save();

        }
        return redirect('dashboard/setting_general')->with('status', __( 'Data berhasil di update !', ['page' => __('Setting General') ] ) );

        

        

    }
}
