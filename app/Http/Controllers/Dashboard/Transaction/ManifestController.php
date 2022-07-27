<?php

namespace App\Http\Controllers\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ManifestModel;
use App\Model\BillOfLaddingModel;
use App\Model\Customer;
use App\Model\Vassel;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Model\ShipAgent;
use App\Model\Stevedoring;
use PharIo\Manifest\Manifest;

class ManifestController extends Controller
{
    //
    private $controller = 'manifest';
    private $title = 'Manifest';

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (!auth()->user()->can($this->controller.'-index')){
        //     return view('errors.401');    
        // }
        $user = auth()->user();
        $data=array();
        
        
        return view('backend.'.$this->controller.'.index', compact('data'))->with(['controller'=>$this->controller, 'title'=>$this->title]);

        
    }

    public function create(){
        $controller = $this->controller;

        $title = $this->title;
        
        $customer = Customer::select('id', 'customer_name')->get();
        
        $vassel = Vassel::select('id', 'nama_kapal')->get();

        $ship_agent = ShipAgent::select('id', 'nama_perusahaan')->get();

        $stevedoring = Stevedoring::select('id', 'nama_perusahaan')->get();
        
        return view('backend.manifest.create', compact('vassel', 'ship_agent', 'customer', 'stevedoring', 'controller', 'title'));
    }

    public function store(Request $request){
        $kode_manifest = $request->kode_manifest;
        $country = $request->country;
        $id_customer = $request->id_customer;
        $date_of = $request->date_of;
        $port_name = $request->port_name;
        $vassel_id = $request->vassel_id;
        $ship_agent_id = $request->ship_agent_id;
        $stevedoring_id = $request->stevedoring_id;
        $voy = $request->voy;
        $berth_no = $request->berth_no;
        $berthed_on = $request->berthed_on;
        $berthed_on_hours = $request->berthed_on_hours;
        $departed_on = $request->departed_on;
        $departed_on_hours = $request->departed_on_hours;

        $data = new ManifestModel;
        
        $data->kode_manifest = $kode_manifest;
        $data->country = $country;
        $data->id_customer = $id_customer;
        $data->date_of = $date_of;
        $data->port_name = $port_name;
        $data->vassel_id = $vassel_id;
        $data->ship_agent_id = $ship_agent_id;
        $data->stevedoring_id = $stevedoring_id;
        $data->voy = $voy;
        $data->berth_no = $berth_no;
        $data->berthed_on = $berthed_on;
        $data->berthed_on_hours = $berthed_on_hours;
        $data->departed_on = $departed_on;
        $data->departed_on_hours = $departed_on_hours;
        $data->status = 1;

        $data->save();

        return redirect('/dashboard/manifest');
    }

    public function getData(Request $request)
    {
        // if (!auth()->user()->can($this->controller.'-index')){
        //     return view('errors.401');    
        // }
        
        $arrColumns = [
            1=>'id', 
            2=>'kode_manifest',
            3=>'country',
            4=>'date_of',
            5=>'port_name'
        ];
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        
        $rows = ManifestModel::select([
            'kk_tr_manifest.id',
            'kk_tr_manifest.kode_manifest',
            'kk_tr_manifest.country',
            'kk_tr_manifest.date_of',
            'kk_tr_manifest.port_name',
            'ms_customer.customer_name',
            'ms_customer.phone as customer_phone',
            'ms_customer.email as customer_email',
            'kk_tr_manifest.created_at'            
        ])
        ->join('ms_customer','kk_tr_manifest.id_customer','=','ms_customer.id')
        ->where('kk_tr_manifest.status',1)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('total_bl', function ($row) {
                
                $get_bl = BillOfLaddingModel::where('status',1)->where('id_manfest',$row->id)->count();

                return $get_bl.' Bill Of Lading';

                // return route($this->controller.'.edit', $row->id);
            })
            ->addColumn('editUrl', function ($row) {
                // return $row->id;
                return route($this->controller.'.edit', $row->id);
            })
            ->addColumn('viewUrl', function ($row) {
                return route($this->controller.'.view', $row->id);
            })
            ->make();
    }


    public function show($id){
        $id_manifest = $id;


        $data=ManifestModel::select(
            'kk_tr_manifest.id',
            'kk_tr_manifest.kode_manifest',
            'kk_tr_manifest.country',
            'kk_tr_manifest.date_of',
            'kk_tr_manifest.port_name',
            'ms_customer.customer_name',
            'ms_customer.phone as customer_phone',
            'ms_customer.email as customer_email',
            'kk_tr_manifest.created_at'            
        )   
        ->join('ms_customer','kk_tr_manifest.id_customer','=','ms_customer.id')
        ->where('kk_tr_manifest.status',1)
        ->where('kk_tr_manifest.id',$id_manifest)
        ->first();

        $total_bl = BillOfLaddingModel::where('status',1)->where('id_manfest',$id_manifest)->count();
        
        
        return view('backend.'.$this->controller.'.view', compact('data','id_manifest','total_bl'))->with(['controller'=>$this->controller, 'title'=>$this->title]);

    }

    public function edit($id){
        $manifest = ManifestModel::find($id);

        $customer = Customer::select('id', 'customer_name')->get();
        
        $vassel = Vassel::select('id', 'nama_kapal')->get();

        $ship_agent = ShipAgent::select('id', 'nama_perusahaan')->get();

        $stevedoring = Stevedoring::select('id', 'nama_perusahaan')->get();

        $controller = $this->controller;

        $title = $this->title;

        return view('backend.manifest.edit', compact('manifest', 'vassel', 'customer', 'ship_agent', 'stevedoring', 'controller', 'title'));
        // return $vassel;
    }

    public function update(Request $request, $id){
        $kode_manifest = $request->kode_manifest;
        $country = $request->country;
        $id_customer = $request->id_customer;
        $date_of = $request->date_of;
        $port_name = $request->port_name;
        $vassel_id = $request->vassel_id;
        $ship_agent_id = $request->ship_agent_id;
        $stevedoring_id = $request->stevedoring_id;
        $voy = $request->voy;
        $berth_no = $request->berth_no;
        $berthed_on = $request->berthed_on;
        $berthed_on_hours = $request->berthed_on_hours;
        $departed_on = $request->departed_on;
        $departed_on_hours = $request->departed_on_hours;

        $data = ManifestModel::find($id);
        
        $data->kode_manifest = $kode_manifest;
        $data->country = $country;
        $data->id_customer = $id_customer;
        $data->date_of = $date_of;
        $data->port_name = $port_name;
        $data->vassel_id = $vassel_id;
        $data->ship_agent_id = $ship_agent_id;
        $data->stevedoring_id = $stevedoring_id;
        $data->voy = $voy;
        $data->berth_no = $berth_no;
        $data->berthed_on = $berthed_on;
        $data->berthed_on_hours = $berthed_on_hours;
        $data->departed_on = $departed_on;
        $data->departed_on_hours = $departed_on_hours;
        $data->status = 1;

        $data->save();

        return redirect('/dashboard/manifest');
    }
}
