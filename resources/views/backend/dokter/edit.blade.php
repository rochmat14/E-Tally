@section('sidebarActive', $controller)
@extends('layouts.template.app')

@php 
$assets = asset('template_assets');
$plugin_assets = asset('js');
$user = Auth::user();
@endphp

@section('vendor_css')

    

@endsection



@section('vendor_js')
    

    <script type="text/javascript">


        
    </script>

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
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('dashboard/dokter') }}">{{ $title }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Update {{ $title }}</li>
    </ol>
  </div>
</div>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Update  {{ $title }}</div>
      </div>
      <div class="card-body">
        <div class="panel panel-primary">
            
            <div class="panel-body tabs-menu-body">
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="tab-content">
                        
                        
                            <div class="form-group">
                                <label for="title"  class="control-label col-lg-2">Nama Dokter<span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" required="" name="nama_dokter" value="{{ $dokter->nama_dokter }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="spesialis_id"  class="control-label col-lg-2">Spesialis<span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <select name="spesialis_id" class="form-control" required>
                                        <option value="">--Pilih Spesialis--</option>
                                        @foreach($data_spesialis AS $key => $value)
                                        
                                            <option value="{{$value->id}}" {!! $value->id == $dokter->spesialis_id ? 'selected' : '' !!}>{{ $value->nama_spesialis }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            

                            <div class="form-group">
                                <label for="description"  class="control-label col-lg-2">{{ __('main.description') }} <span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <textarea class="form-control" id="description_id" name="description">{{ $dokter->description }}</textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-lg-2">
                                    Old Images
                                </label>
                                @if ($dokter->photo != '')
                                    <img src="{{ URL::asset('/images/dokter/')}}/{{ $dokter->photo }}" style="margin-bottom: 10px;" width="100">
                                @endif
                            </div>
                            <div class="form-group">

                                

                                <label for="photo"  class="control-label col-lg-2">{{ __('main.photo') }} <span class="required">*</span></label>
                                
                                


                                <div class="col-lg-12">
                                    <input type="file" class="form-control" name="photo">
                                </div>
                            </div>
                        <div class="form-group">
          
                          <input type="submit" class="btn btn-info" value="Update">

                          <a href="{{ route('dokter.index') }}" class="btn btn-secondary">Back</a>
                        </div>
                       
                    </div>
                </form>
            </div>
        </div>
        
      
      </div>
    </div>
    <!--/div-->
  </div>
</div>

@endsection
