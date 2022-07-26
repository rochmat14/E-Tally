<?php

namespace App\Http\Controllers\Dashboard\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;


class InboxController extends Controller
{
    private $controller = 'inbox';
    private $title = 'Data Inbox';

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
            2=>'name',
            3=>'email',
            4=>'phone',
            5=>'subject',
            6=>'status_read',
            7=>'date_contact'
        ];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = Contact::select([
            'id',
            'name',
            'email',
            'phone',
            'subject',
            'status_read',
            'date_contact'
        ])
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->escapeColumns('active')
            
            ->addColumn('showUrl', function ($row) {
                return $row->id;
            })

            ->addColumn('statusRead', function ($row) {

                $status_read = $row->status_read;

                if($status_read =='N'){
                    $status = "Un Read";
                }else{
                    $status ="Read";
                }

                return $status;
                
            })
            
            ->make();
    }

    public function get_data_byid(Request $request){
        if (!auth()->user()->can($this->controller.'-show')){
            return view('errors.401');    
        }
        $id= $request->get('id');
        //update  
        $pk = Contact::find($id);
        $pk->status_read = 'Y';
        $pk->updated_by =Auth::user()->id;
        $pk->save();


        $datas = Contact::where('id',$id)->first();
        
        $data_return =array('data'=>$datas);
        return response()->json($data_return);
    }
}
