@section('sidebarActive', $controller)

@extends('layouts.template.app')

@section('content')

@php 

  $assets = asset('template_assets');

@endphp


<!--Page header-->
<div class="page-header">
  <div class="page-leftheader">
    <h4 class="page-title">Dashboard Application</h4>
  </div>
  <div class="page-rightheader ml-auto d-lg-flex d-none">
    <div class="ml-5 mb-0">
      
    </div>
  </div>
</div>
<!--End Page header-->


<!--End row-->
@endsection
