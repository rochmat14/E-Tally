<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Backend\PermissionsRequest;
use Illuminate\Support\Facades\Auth;
use App\RoleModel;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\UserDescription;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;



class ProfileController extends Controller
{
    private $controller = 'profile';
    private $title = 'My Profile';

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if (!auth()->user()->can($this->controller.'-index')){
            return view('errors.401');    
        }


        $user = auth()->user();

        $roles = RoleModel::pluck('name','name')->all();
        $userRole = $user->roles->pluck('deskripsi')->first();


        $users_desc = UserDescription::select('ms_users_description.*')
                    ->where('ms_users_description.users_id',$user->id)
                    ->first();

        

        return view('backend.'.$this->controller.'.index',compact('user','userRole','users_desc'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
    }

    public function updatePassword(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $row = Auth::user();
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/profile/')
                ->withErrors($validator)
                ->withInput();
        }

        $passwordLama = $request->get('old_password');
        $passwordConfirm = $request->get('password_confirmation');
        if(Hash::check($request->get('current_password'), $row->password)){
            $row->password = Hash::make($request->get('password'));
            $row->save();

            return redirect('dashboard/profile/')->with('status', __( 'main.data_has_been_updated', ['page' => __('main.change_password')] ) );
        } else {
            return redirect('dashboard/profile/')->with('error', __( 'main.old_password_fail' ) );
        }
    }


    public function change_profile(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('dashboard/profile/')
                ->withErrors($validator)
                ->withInput();
        }


        $id = $request->get('id_users_desc');
        $nama_depan = $request->get('nama_depan');
        $nama_belakang = $request->get('nama_belakang');
        $tempat_lahir = $request->get('tempat_lahir');
        $tanggal_lahir = $request->get('tanggal_lahir');
        $alamat_rumah = $request->get('alamat_rumah');
        $telp = $request->get('telp');
        $jenis_kelamin = $request->get('jenis_kelamin');
        $id_agama = $request->get('id_agama');


        $pk = UserDescription::find($id);
        $pk->nama_depan = $nama_depan;
        $pk->nama_belakang = $nama_belakang;
        $pk->tempat_lahir = $tempat_lahir;
        $pk->tanggal_lahir = $tanggal_lahir;
        $pk->alamat_rumah = $alamat_rumah;
        $pk->phone = $telp;
        $pk->jenis_kelamin = $jenis_kelamin;

        $pk->updated_by =Auth::user()->id;
        $pk->save();

        return redirect('dashboard/profile/')->with('status_profile', __( 'Data Berhasil DI Update', ['page' => __('Update Data Profile')] ) );

    }


    public function change_image(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $this->validate($request, [
            'file'      => 'required|image'
        ]);

        $row = Auth::user();

        $file = $request->file;


        $destinationPath = 'images/users/';
        $filename = $file->getClientOriginalName();
        $fileTmp = time() . '.' . $file->getClientOriginalExtension();

        $image = Image::make($file);
        $isJpg = $image->mime() === 'image/jpg' || $image->mime() === 'image/jpeg';
        if($isJpg && $image->exif('Orientation'))
            $image = orientate($image, $image->exif('Orientation'));

        //$image->fit(300, 300)->save(public_path() .'/'. $destinationPath. $filename);
        $image->fit(300, 300)->save($destinationPath. $filename);

        $row->images = $filename;
        $row->save(); 

        return redirect('dashboard/profile/')->with('status_profile', __( 'Data Berhasil DI Update', ['page' => __('Update Data Gambar')] ) );



    }
}
