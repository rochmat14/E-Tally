<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\RoleModel;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;


class RolesController extends Controller
{
    //
    private $controller = 'roles';
    private $title = 'Group User';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user->can($this->controller.'-index')){
            return view('errors.401');    
        }

        //$blade = !empty($user->organization_id) ? '_organization' : '';
        return view('backend.'.$this->controller.'.index')->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can($this->controller.'-create')){
            return view('errors.401');    
        }

        return view('backend.'.$this->controller.'.create')->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if (!$user->can($this->controller.'-create')){
            return view('errors.401');    
        }

        request()->validate([
            'name' => 'required|max:191|unique:roles',
            'deskripsi' =>'required'
        ]);

        $arrSaves = [];
        /*
        if (!empty($user->organization_id)){
            $arrSaves['organization_id'] = $user->organization_id;    
        }
        */
        $arrSaves['name'] = $request->name;
        $arrSaves['deskripsi'] = $request->deskripsi;
        
        RoleModel::create($arrSaves);

        return redirect()->route($this->controller.'.index')->with('status', __( 'main.data_has_been_added', ['page' => $this->title] ) );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(RoleModel $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleModel $role)
    {
        $user = auth()->user();
        if (!$user->can($this->controller.'-update')){
            return view('errors.401');    
        }

        /*
        if (!empty($user->organization_id)){
            if ($role->organization_id <> $user->organization_id){
                return view('errors.401');           
            }
        }
		*/
        return view('backend.'.$this->controller.'.edit', compact('role'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleModel $role)
    {
        $user = auth()->user();
        if (!$user->can($this->controller.'-update')){
            return view('errors.401');    
        }
        /*
        if (!empty($user->organization_id)){
            if ($role->organization_id <> $user->organization_id){
                return view('errors.401');           
            }
        }
		*/
        request()->validate([
            'name' => 'required|max:191|unique:roles,name,'.$role->id,
            'deskripsi' =>'required',
            // 'persentasi_penghasilan' =>'required'
        ]);

        $role->name = $request->name;
        $role->deskripsi = $request->deskripsi;
        // $role->persentasi_penghasilan = $request->persentasi_penghasilan;
        $role->save();

        return redirect()->route($this->controller.'.index')->with('status', __( 'main.data_has_been_updated', ['page' => $role->name] ) );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleModel $role)
    {
        $user = auth()->user();
        if (!$user->can($this->controller.'-delete')){
            return view('errors.401');    
        }
        /*
        if (!empty($user->organization_id)){
            if ($role->organization_id <> $user->organization_id){
                return view('errors.401');           
            }
        }
		*/
        $role->delete();
        return redirect()->route($this->controller.'.index')->with('status', __( 'main.data_has_been_deleted', ['page' => $role->name] ) );
    }

    public function permission(RoleModel $role)
    {
        $user = auth()->user();
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        //if (!empty($user->organization_id)){
            //$roleOrganization = RoleModel::whereId(3)->first();
            //$permissions = $roleOrganization->permissions;
        //} else {
            $permissions = Permission::get();
        //}
        
        $permissions = $permissions->each(function ($item, $key) {
            $name = $item['name'];
            $nameArray = explode('-', $name);
            $module = $nameArray[0];
            $operation = $nameArray[1];
            $item['module'] = $module;
            $item['operation'] = $operation;
            return $item;
        });
        $permissions = $permissions->groupBy('module')->sortKeys();
        $rolePermission = $role->permissions()->pluck('id')->toArray();

        return view('backend.'.$this->controller.'.permission', compact('role', 'permissions', 'rolePermission'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    public function updatePermission(RoleModel $role)
    {
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $permission = request('permission');
        $ids = collect($permission)->keys();
        $role->syncPermissions($ids);

        return redirect()->route($this->controller.'.index')->with('status', __( 'main.data_has_been_updated', ['page' => 'Permission ' . $role->name] ) );
    }

    public function getData(Request $request)
    {
        $user = auth()->user();
        if (!$user->can($this->controller.'-index')){
            return view('errors.401');    
        }
        
        $arrColumns = [1=>'id', 2=>'name',3=>'deskripsi'];
        
        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $orderBy = $request->get('order')[0]['column'];
        $orderAD = $request->get('order')[0]['dir'];
        $q = $request->get('search')['value'];
        $where = [];
        $rows = RoleModel::select([
            'id',
            'name',
            'deskripsi',
            'persentasi_penghasilan'
        ])
        ->where($where)
        ->orderBy($arrColumns[$orderBy],$orderAD)
        ->get();

        return Datatables::of($rows)
            ->addIndexColumn()
            ->addColumn('persentasi_penghasilan', function ($row) {


                $get_angka = $row->persentasi_penghasilan;

                $angka=$get_angka;

                return $angka."%";
            })

            ->addColumn('permissionUrl', function ($row) {
                return route($this->controller.'.permission', $row->id);
            })
            ->addColumn('editUrl', function ($row) {
                return route($this->controller.'.edit', $row->id);
            })
            ->addColumn('deleteUrl', function ($row) {
                return route($this->controller.'.destroy', $row->id);
            })
            ->make();
    }

}
