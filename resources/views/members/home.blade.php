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
                </ol>
            </div>
        </div>


        @if($status_profile =='warning')
            <div class="alert alert-danger" role="alert">
                {{-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> --}}
                <strong>Pemberitahuan !</strong> 
                <br>
                Sepertinya Akun Anda Belum Lengkap.  Lengkapi Data Profile Anda Dengan Benar Untuk Mempermudah Mengikuti Proses Sistem di INB Logistik. <br><br>
                <a href="{{ $data['url_profile'] }}" class="alert-link">Klik Untuk Lengkapi Profile Sekarang </a>
            </div>

        @else
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>Yeay !</strong> 
                <br>
                Sepertinya Akun Anda Sudah Lengkap. <br><br>
                <a href="{{ $data['url_profile'] }}" class="alert-link">Klik Untuk Memeriksa Profile Kembali </a>
            </div>

        @endif

        <div class="row">

            


            <div class="col-sm-4 col-md-4 col-xl-4">
                <a href="{{ $data['url_total_orders'] }}">
                    <div class="card bg-info">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h6 class="text-white">My Booking Transaction</h6>
                                    <h2 class="text-white m-0 font-weight-bold">{{ $data['total_booking'] }}</h2>
                                </div>
                                <div class="ml-auto">
                                    <span class="text-white display-6">
                                        <i class="fa fa-shopping-cart fa-2x"></i>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-4 col-xl-4">
                <a href="{{ $data['url_total_orders'] }}">
                    <div class="card bg-success">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h6 class="text-white">My Booking Process</h6>
                                    <h2 class="text-white m-0 font-weight-bold">{{ $data['total_transaction_process'] }}</h2>
                                </div>
                                <div class="ml-auto">
                                    <span class="text-white display-6">
                                        <i class="fa fa-shopping-cart fa-2x"></i>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-4 col-md-4 col-xl-4">
                <a href="{{ $data['url_total_orders'] }}">
                    <div class="card bg-warning">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h6 class="text-white">My Booking Finish</h6>
                                    <h2 class="text-white m-0 font-weight-bold">{{ $data['total_transaction_finish'] }}</h2>
                                </div>
                                <div class="ml-auto">
                                    <span class="text-white display-6">
                                        <i class="fa fa-shopping-cart fa-2x"></i>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
    </div>
</div><!-- end app-content-->

@endsection
