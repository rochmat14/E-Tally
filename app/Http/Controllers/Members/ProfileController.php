<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\RoleModel;
use App\UserDescription;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Validator;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{
    private $controller = 'members_profile';
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
        

        return view('members.profile.index',compact('user','userRole','users_desc'))->with(['controller'=>$this->controller, 'title'=>$this->title]);
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

        return redirect('members/profile/')->with('status_profile', __( 'Data Berhasil DI Update', ['page' => __('Update Data Gambar')] ) );

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
            return redirect('members/profile/')
                ->withErrors($validator)
                ->withInput();
        }

        $passwordLama = $request->get('old_password');
        $passwordConfirm = $request->get('password_confirmation');
        if(Hash::check($request->get('current_password'), $row->password)){
            $row->password = Hash::make($request->get('password'));
            $row->save();

            return redirect('members/profile/')->with('status', __( 'main.data_has_been_updated', ['page' => __('main.change_password')] ) );
        } else {
            return redirect('members/profile/')->with('error', __( 'main.old_password_fail' ) );
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
            return redirect('members/profile/')
                ->withErrors($validator)
                ->withInput();

        }

        

        $id = $request->get('id_users_desc');
        $nama_depan = $request->get('nama_depan');
        $nama_belakang = $request->get('nama_belakang');
        
        $tempat_lahir = $request->get('tempat_lahir');
        $tanggal_lahir = $request->get('tanggal_lahir');
        $jenis_kelamin = $request->get('jenis_kelamin');
        $pendidikan_terakhir = $request->get('pendidikan_terakhir');
        $phone = $request->get('phone');
        $alamat_rumah = $request->get('alamat_rumah');
    


        $pk = UserDescription::find($id);
        
        $pk->nama_depan = $nama_depan;
        $pk->nama_belakang = $nama_belakang;
        $pk->tempat_lahir = $tempat_lahir;
        $pk->tanggal_lahir = $tanggal_lahir;
        $pk->jenis_kelamin = $jenis_kelamin;
        $pk->pendidikan_terakhir = $pendidikan_terakhir;
        $pk->phone = $phone;
        $pk->alamat_rumah = $alamat_rumah;
        $pk->updated_by =Auth::user()->id;
        $pk->save();

        return redirect('members/profile/')->with('status_profile', __( 'Data Biodata Profile Berhasil DI Update', ['page' => __('Update Data Profile')] ) );

    }


    public function change_instansi(Request $request){
        if (!auth()->user()->can($this->controller.'-update')){
            return view('errors.401');    
        }

        $validator = Validator::make($request->all(), [
            'nama_instansi' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('members/profile/')
                ->withErrors($validator)
                ->withInput();

        }

        $id = $request->get('id_users_desc');
        $nama_instansi = $request->get('nama_instansi');
        $telp_instansi = $request->get('telp_instansi');
        $email_instansi = $request->get('email_instansi');
        $alamat_instansi = $request->get('alamat_instansi');

        $pk = UserDescription::find($id);
        $pk->nama_instansi = $nama_instansi;
        $pk->telp_instansi = $telp_instansi;
        $pk->email_instansi = $email_instansi;
        $pk->alamat_instansi = $alamat_instansi;
        $pk->updated_by =Auth::user()->id;
        $pk->save();

        return redirect('members/profile/')->with('status_profile', __( 'Data Biodata Instansi Berhasil DI Update', ['page' => __('Update Data Profile')] ) );

    }
}
