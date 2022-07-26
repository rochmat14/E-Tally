@extends('layouts.template.app')
@section('sidebarActive', $controller)
@section('web_title', $title)
@section('page_header', $title)

@section('vendor_css')
@endsection

@section('css_scripts')
@endsection

@section('vendor_js')
@endsection

@section('js_scripts')
<script>
$(document).ready(function() {
});
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
      <li class="breadcrumb-item"><a href="#">Level Otorisasi</a></li>
      <li class="breadcrumb-item" aria-current="page"><a href="{{ route('roles.index') }}">{{ $title }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit {{ $title }}</li>
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
        
        {!! Form::open(['route' => [$controller.'.update', $role->id], 'method'=>'PUT']) !!}
            <div class="form-body">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }} ">
                            {!! Form::label('name', 'Name'); !!}
                            {!! Form::text('name', $role->name, ['required', 'class'=>'form-control'.( $errors->has('name') ? ' form-control-danger' : '' ) ]); !!}
                            @if ($errors->has('name')) <small class="form-control-feedback"> {{ $errors->first('name') }} </small>@endif
                        </div>

                        

                        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }} ">
                            {!! Form::label('deskripsi', 'Deskription'); !!}
                            {!! Form::text('deskripsi', $role->deskripsi, ['required', 'class'=>'form-control'.( $errors->has('deskripsi') ? ' form-control-danger' : '' ) ]); !!}
                            @if ($errors->has('deskripsi')) <small class="form-control-feedback"> {{ $errors->first('deskripsi') }} </small>@endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                <a href="{{ route($controller.'.index') }}" class="btn btn-inverse">Cancel</a>
            </div>
        {!! Form::close() !!}


      </div>
    </div>
    <!--/div-->

    
    
  </div>
</div>

@endsection
