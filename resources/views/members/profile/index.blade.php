@extends('layouts.members.app')
@php 
    $assets = asset('template_assets');
@endphp

@section('content')

<div class="app-content page-body">
    <div class="container">

        
        <div class="page-header">
            <div class="page-leftheader">
                <h4 class="page-title">{{ $title }}</h4>
            </div>
            <div class="page-rightheader ml-auto d-lg-flex d-none">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.index') }}" class="d-flex">
                            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                                <path d="M0 0h24v24H0V0z" fill="none" />
                                <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                                <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                            </svg>
                            <span class="breadcrumb-icon"> Home</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                </ol>
            </div>
        </div>

        <div class="row">
          <div class="col-xl-4 col-lg-5">
            <div class="card box-widget widget-user">
              <div class="widget-user-image mx-auto mt-5"><img alt="User Avatar" class="rounded-circle" src="{{ $user->images != '' ? asset('/images/users/') . '/' . $user->images : asset('/images/users/no-user.jpg') }}"></div>
              <div class="card-body text-center">
                <div class="pro-user">
                  <h3 class="pro-user-username text-dark mb-1">{{ $user->name }}</h3>
                  <h6 class="pro-user-desc text-muted">{{ $userRole }}</h6>
                  
                </div>
              </div>

              <div class="card-footer p-0">
                <div class="row">
                  <div class="col-sm-12 border-right text-center">
                    <div class="description-block p-4">
                      <form role="form" action="{{ route('members_profile.change_image') }}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                        <div class="card-body">
                          <div class="form-group">
                              <label for="name" class="control-label">Ganti Photo <span class="required" aria-required="true"> * </span></label>
                              <input id="file" type="file" class="form-control" name="file" required>

                              @if ($errors->has('file'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('file') }}</strong>
                                  </span>
                              @endif
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary">Ganti Photo</button>
                        </div>
                      </form>

                    </div>
                  </div>
                  
                </div>
              </div>

            </div>
          </div>
          <div class="col-xl-8 col-lg-7">
            <div class="card">

              @if (count($errors) > 0)
                  <br><br>
                  <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">
                          <i class="ace-icon fa fa-times"></i>
                      </button>
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif

              @if(session('status_profile'))
                  <br><br>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">
                          <i class="ace-icon fa fa-times"></i>
                      </button>
                      <h6 class="block">Success</h6>
                      <p> {{ session('status_profile') }}</p>
                  </div>
                  
              @endif

              <div class="card-header">
                <div class="card-title">Edit Profile</div>
              </div>

              <div class="panel panel-primary">
                <div class="tab-menu-heading">
                  <div class="tabs-menu ">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                      <li class="">
                        <a href="#tab1" class="active" data-toggle="tab">Biodata</a>
                      </li>
                      <li>
                        <a href="#tab2" data-toggle="tab">Perusahaan / Instansi</a>
                      </li>
                      <li>
                        <a href="#tab3" data-toggle="tab">Keamanan</a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="panel-body tabs-menu-body">
                  <div class="tab-content">
                    <div class="tab-pane active " id="tab1">
                      
                      <h3 class="text-center">Form Biodata</h3>

                      <form method="post" action="{{ route('members_profile.change_profile') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                          <input type="hidden" name="id_users_desc" value="{{ $users_desc->id }}">
                          <div class="row">
                            

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                <label class="form-label">Nama Depan</label>
                                <input type="text" class="form-control" value="{{ $users_desc->nama_depan }}" name="nama_depan" placeholder="Nama Depan">
                              </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                <label class="form-label">Nama Belakang</label>
                                <input type="text" class="form-control" value="{{ $users_desc->nama_belakang }}" name="nama_belakang" placeholder="Nama Belakang">
                              </div>
                            </div>

                            

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" value="{{ $users_desc->tempat_lahir }}" name="tempat_lahir" placeholder="Tempat Lahir...">
                              </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" value="{{ $users_desc->tanggal_lahir }}" name="tanggal_lahir">
                              </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>                            
                                <div class="radio">
                                  <label><input type="radio" id="pria" name="jenis_kelamin" value="pria" 
                                    
                                    {{ $users_desc->jenis_kelamin =='pria' ? 'checked' : '' }}
                                    > &nbsp; &nbsp; Pria</label>
                                </div>
                                <div class="radio">
                                  <label><input type="radio" id="wanita" name="jenis_kelamin" value="wanita"
                                    {{ $users_desc->jenis_kelamin =='wanita' ? 'checked' : '' }}
                                    > &nbsp; &nbsp; Wanita</label>
                                </div>

                              </div>
                            </div>

                            

                            <div class="col-sm-6 col-md-6">
                              <div class="form-group">
                                <label class="form-label">Phone / Whatsapp</label>
                                <input type="text" class="form-control" value="{{ $users_desc->phone }}" name="phone" placeholder="Nomor Telp / Whatspp yang dapat dihubungi oleh team INB Logistik">
                              </div>
                            </div>

                            

                            <hr>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label class="form-label">Alamat Rumah</label>
                                <textarea class="form-control" name="alamat_rumah">{{ $users_desc->alamat_rumah }}</textarea>
                              </div>
                            </div>
                            



                    
                            
                          </div>
                          
                        </div>
                        <div class="card-footer text-right">
                          <button type="submit" class="btn btn-lg btn-primary">Update</button>
                          <button type="reset" class="btn btn-lg btn-danger">Reset</button>
                        </div>
                      </form>

                    </div>
                    <div class="tab-pane  " id="tab2">
                      <h3 class="text-center">Form Perusahaan / Instansi</h3>
                      <form method="post" action="{{ route('members_profile.change_instansi') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="card-body">
                          <input type="hidden" name="id_users_desc" value="{{ $users_desc->id }}">
                          <div class="row">
                              <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                  <label class="form-label">Nama Perusahaan / Instansi</label>
                                  <input type="text" class="form-control" value="{{ $users_desc->nama_instansi }}" name="nama_instansi">
                                </div>
                              </div>
                              <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                  <label class="form-label">Phone Perusahaan / Instansi</label>
                                  <input type="text" class="form-control" value="{{ $users_desc->telp_instansi }}" name="telp_instansi">
                                </div>
                              </div>
                              <div class="col-sm-4 col-md-4">
                                <div class="form-group">
                                  <label class="form-label">Email Perusahaan / Instansi</label>
                                  <input type="text" class="form-control" value="{{ $users_desc->email_instansi }}" name="email_instansi">
                                </div>
                              </div>

                              <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                  <label class="form-label">Alamat Perusahaan / Instansi</label>
                                  <textarea class="form-control" name="alamat_instansi">{{ $users_desc->alamat_instansi }}</textarea>
                                </div>
                              </div>
                          </div>
                        </div>

                        <div class="card-footer text-right">
                          <button type="submit" class="btn btn-lg btn-primary">Update</button>
                          <button type="reset" class="btn btn-lg btn-danger">Reset</button>
                        </div>

                      </form>

                    </div>

                    <div class="tab-pane  " id="tab3">
                      <h3 class="text-center">Keamanan</h3>
                      @if(session('status'))
                          <br><br>
                          <div class="row alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">
                                  <i class="ace-icon fa fa-times"></i>
                              </button>
                              <h6 class="block">Success</h6>
                              <p> {{ session('status') }}</p>
                          </div>
                      @endif

                      @if(session('error'))
                          <br><br>
                          <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert">
                                  <i class="ace-icon fa fa-times"></i>
                              </button>
                              <h4 class="block">Error</h4>
                              <p> {{ session('error') }}</p>
                          </div>

                      @endif
                      <form method="post" action="{{ route('members_profile.change_password') }}">
                        {{ csrf_field() }}
                        <div class="card-header">
                          <div class="card-title">Edit Password</div>
                        </div>
                        <div class="card-body">
                          <div class="form-group">
                            <label class="form-label">Password Lama</label>
                            <input type="password" class="form-control" name="current_password" placeholder="******">
                          </div>
                          <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" name="password" placeholder="******">
                          </div>
                          <div class="form-group">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="******">
                          </div>
                        </div>
                        <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <button type="reset" class="btn btn-danger">Reset</button>
                        </div>
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>



              
            </div>
          </div>
        </div>

    </div>
</div><!-- end app-content-->

@endsection
