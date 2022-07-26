@section('sidebarActive', $controller)
@extends('layouts.template.app')

@section('vendor_css')


@endsection

@section('css_scripts')
@endsection


@php 
$assets = asset('template_assets');
$user = Auth::user();
@endphp


@section('vendor_js')


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
        
      	
        @if(session('status'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <h4 class="block">{{ __('main.success') }}</h4>
                <p> {{ session('status') }}</p>
            </div>
        @endif


        
        @if ($user->can('pages-create'))
        <div class="clearfix">
            <div class="pull-left tableTools-container">
                <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/create' )) }}" class="btn btn-success"> {{ __('main.add_new') }}
                    <i class="fa fa-plus"></i>
                </a>
            </div>
        </div>
        @endif

        <br>
        {!! $content_children !!}


      </div>
    </div>
    <!--/div-->
  </div>
</div>




@endsection
