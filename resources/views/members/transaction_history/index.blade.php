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

        


    </div>
</div><!-- end app-content-->

@endsection
