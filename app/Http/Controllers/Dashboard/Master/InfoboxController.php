<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\InfoBox;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Backend\InfoBoxRequest;


class InfoboxController extends Controller
{
    //

    private $controller = 'infobox';
    private $title = 'Data Info-box';

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
        
        $arrColumns = [
            1=>'id', 
            2=>'title',
            3=>'link',
            4=>'image',
            5=>'status'
        ];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = InfoBox::select([
            'id',
            'title',
            'link',
            'image',
            'status'
        ])
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->escapeColumns('active')
            
            ->addColumn('image', function ($row) {
                return $row->image;
            })

            ->addColumn('editUrl', function ($row) {
                return $row->id;
            })
            
            ->make();
    }


    public function get_data_byid(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }
        $id= $request->get('id');

        $datas = InfoBox::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }

    public function update(InfoBoxRequest $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $id = $request->get('id');
        $title = $request->get('title');
        $link = $request->get('link');
        $status = $request->get('status');
    

        //update 
        $pk = InfoBox::find($id);
        $pk->title = $title;
        $pk->link = $link;
        $pk->status = $status;
        if($request->image){
            // upload logo bank
            $image = $request->image;
            $destinationPath = 'images/infobox/';
            $filename = time().'.'.$request->image->extension();  
            $request->image->move($destinationPath, $filename);
            $pk->image = $filename;

        }
        $pk->updated_by =Auth::user()->id;
        $pk->save();
        echo json_encode(array("status" => TRUE));

    }

}
