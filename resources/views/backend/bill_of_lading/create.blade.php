@section('sidebarActive', $controller)
@extends('layouts.template.app')

@section('vendor_css')
    <link rel="stylesheet" href="{{ asset('/izitoast/css/iziToast.min.css') }}">
@endsection

@section('css_scripts')
@endsection


@php
$assets = asset('template_assets');
@endphp


@section('vendor_js')
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
@endsection

@section('js_scripts')
    <script type="text/javascript">
        // validasi form admin
        $('form#form-bill-of-lading').on('submit', function(event) {
            //Add validation rule for dynamically generated name fields

            $('.kode-bill-of-lading-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Kode Bill Of Lading harus di isi",
                    }
                });
            });

            $('.customer-id-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Customer Id harus di isi",
                    }
                });
            });

            $('.transfer-to-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Transfer Of harus di isi",
                    }
                });
            });

            $('.ship-name-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Ship Name harus di isi",
                    }
                });
            });

            $('.country-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Country harus di isi",
                    }
                });
            });

            $('.date-of-bill-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Date Of Bill harus di isi",
                    }
                });
            });

            $('.telly-man-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Telly Man harus di isi",
                    }
                });
            });
        });
        $("#form-bill-of-lading").validate();
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
                        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                            width="24">
                            <path d="M0 0h24v24H0V0z" fill="none" />
                            <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z" />
                            <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3" />
                        </svg>
                        <span class="breadcrumb-icon"> Home</span></a>
                </li>
                <li class="breadcrumb-item"><a href="#">Level Otorisasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
            </ol>
        </div>
    </div>

    <form method="POST" action="/dashboard/bill-of-lading" id="form-bill-of-lading">
        <div class="card card-custom">
            <div class="card-header">
                <span class="font-weight-bold">Bill Of Lading</span>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="">Id Manfest</label>
                        <input type="text" readonly name="id_manfest" value="{{ $id_manifest }}" class="form-control id-manifest-input">
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Kode Bill Of Lading</label>
                            <input type="text" name="kode_bill_of_lading" class="form-control kode-bill-of-lading-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Customer Id</label>
                            <select name="customer_id" class="form-control customer-id-input">
                                <option value="">Choose Customer</option>
                                @foreach($customer as $item)
                                    <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Transfer To</label>
                            <input type="text" name="transfer_to" class="form-control transfer-to-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Ship Name</label>
                            <input type="text" name="ship_name" class="form-control ship-name-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" name="country" class="form-control country-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Date Of Bill</label>
                            <input type="date" name="date_of_bill" class="form-control date-of-bill-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Telly Man</label>
                            <input type="text" name="telly_man" class="form-control telly-man-input">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            @csrf
                            <input type="hidden" name="_method" value="POST">
                            <button type="submit" class="btn btn-success mb-2 btn-block">
                                <span class="fa fa-save"></span> Save
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ url('/dashboard/manifest/' . $id_manifest) }}" class="btn btn-danger btn-block">
                                <span class="fa fa-window-close"></span> Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </form>

    </div>
    </div>
    </div>
    <!--/div-->
    </div>
    </div>

@endsection



@section('content')
