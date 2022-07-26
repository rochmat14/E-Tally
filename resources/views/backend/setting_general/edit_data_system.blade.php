@section('sidebarActive', $controller)
@extends('layouts.template.app')

@section('vendor_css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('/izitoast/css/iziToast.min.css') }}">


<style type="text/css">
  .help-block{
    color: red;
  }
</style>
@endsection

@section('css_scripts')
@endsection

@section('vendor_js')
<!-- This is data table -->
<script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<!-- ============================================================== -->
{{-- IziToast --}}
<script src="{{ asset('/izitoast/js/iziToast.min.js') }}"></script>
  {{-- sweetalert --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endsection

@section('js_scripts')

@endsection

@section('content')


<div class="page-header">
  <div class="page-leftheader">
    <h4 class="page-title">{{ $title }}</h4>
  </div>
  <div class="page-rightheader ml-auto d-lg-flex d-none">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}" class="d-flex">
        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg>
        <span class="breadcrumb-icon"> Home</span></a>
      </li>
      <li class="breadcrumb-item"><a href="#">Pengaturan System</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
    </ol>
  </div>
</div>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title">{{ $title }}</div>
      </div>
      <div class="card-body">
        
        <form method="post" action="{{ route('setting_general.act_update') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
        <input type="hidden" class="form-control" name="id" value="{{ $row_data->id }}">

        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="name" readonly value="{{ $row_data->name }}">
        </div>


        @if($row_data->name == 'logo' || $row_data->name =='future_image')

          <div class="form-group">
            <label>Value</label>
            <input type="file" class="form-control" name="value" value="{{ $row_data->value }}">
          </div>

          @if ($errors->has('value'))
              <span class="help-block">
                  <strong>{{ $errors->first('value') }}</strong>
              </span>
          @endif

        @elseif( $row_data->name == 'dashboard_mode' )

        <div class="form-group">
          <label>Value</label>
          <select name="value" class="form-control">
            <option value="dark-mode">Dark Mode</option>
            <option value="light-mode">Light Mode</option>
          </select>
        </div>

        @elseif( $row_data->name == 'sidebar_mode' )

        <div class="form-group">
          <label>Value</label>
          <select name="value" class="form-control">
            <option value="dark-sidebar">Dark Sidebar</option>
            <option value="default-sidebar">Light Sidebar</option>
          </select>
        </div>

        @elseif( $row_data->name == 'dashboard_boxed' )

        <div class="form-group">
          <label>Versi Boxes (Minimalis)</label>
          <select name="value" class="form-control">
            <option value="y">Mini</option>
            <option value="n">Full</option>
          </select>
        </div>



        @elseif(  $row_data->name == 'date_cut_off_pass' || 
                  $row_data->name == 'lost_ticket_mobil' ||
                  $row_data->name == 'lost_ticket_motor' 
              )

          <div class="form-group">
            <label>Value</label>
            <input type="number" class="form-control" name="value" value="{{ $row_data->value }}">
          </div>
        @else
          <div class="form-group">
            <label>Value</label>
            <input type="text" class="form-control" name="value" value="{{ $row_data->value }}">
          </div>

        @endif


        <div class="form-group">
          <label>Deskripsi</label>
          <input type="text" class="form-control" name="description" value="{{ $row_data->description }}">
        </div>
              
        <div class="form-group">
          
          <input type="submit" class="btn btn-info" value="Update">

          <a href="{{ route('setting_general.index') }}" class="btn btn-secondary">Back</a>
        </div>
        </form>
        

          

          
      </div>    
      </div>
    </div>
    <!--/div-->
  </div>
</div>







@endsection
