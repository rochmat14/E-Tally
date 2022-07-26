<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notifikasi;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    private $controller = 'members_notification';
    private $title = 'Notification';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        $user = auth()->user();

        $title = $this->title;

        return view('members.notification.index',compact('user','title'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }


    public function getData(Request $request)
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [
            1=>'id', 
            2=>'id_user',
            3=>'judul',
            4=>'text',
            5=>'created_at',
            6=>'status',
        ];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        

        $user = auth()->user();

        $rows = Notifikasi::select([
            'id',
            'id_user',
            'judul',
            'text',
            'status',
            'created_at'
        ])
        ->where('id_user',$user->id)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('deskripsi', function ($row) {

                $deskripsi = substr(strip_tags($row->text), 0, 20).'....';
                return $deskripsi;
            })
            ->addColumn('created_at', function ($row) {

                $created_at = date('d-M-Y h:i', strtotime( $row->created_at ));
                return $row->created_at;
            })

            ->addColumn('viewUrl', function ($row) {
                return $row->id;
            })
            ->make();
    }


    public function get_data_byid(Request $request){
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }
        $id= $request->get('id');


        // update status
        $pk = Notifikasi::find($id);
        $pk->status = 'read';
        $pk->updated_by =Auth::user()->id;
        $pk->save();

        $datas = Notifikasi::where('id',$id)->first();

        $created_at = date('d-M-Y h:i:s', strtotime( $datas->created_at ));
        
        $data_return =array('data'=>$datas,'created_at'=>$created_at);
        return response()->json($data_return);
    }



}
