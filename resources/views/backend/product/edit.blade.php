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
    <script src="{{ asset('/js/jquery.validate.min.js') }}"></script>q
    <script src="{{ asset('/js/sweetalert.min.js') }}"></script>
@endsection

@section('js_scripts')
    <script type="text/javascript">
        // validasi form admin
        $('form#form-product').on('submit', function(event) {
            //Add validation rule for dynamically generated name fields

            $('.product-code-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Porduct Code harus di isi",
                    }
                });
            });

            $('.product-name-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Product Name harus di isi",
                    }
                });
            });

            $('.bill-of-lading-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Bill Of Lading Id  harus di isi",
                    }
                });
            });

            $('.product-satuan-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Product Satuan harus di isi",
                    }
                });
            });

            $('.product-category-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Product Category harus di isi",
                    }
                });
            });

            $('.product-categor-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Product Category harus di isi",
                    }
                });
            });

            $('.total-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Total harus di isi",
                    }
                });
            });

            $('.status-product-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Status Product harus di isi",
                    }
                });
            });

            $('.from-moving-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "From Moving harus di isi",
                    }
                });
            });

            $('.to-moving-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "To Moving harus di isi",
                    }
                });
            });

            $('.description-moving-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Description Moving harus di isi",
                    }
                });
            });
        });

        $("#form-product").validate();
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
                <li class="breadcrumb-item active" aria-current="page">{{ $controller }}</li>
            </ol>
        </div>
    </div>

    <form method="POST" action="/Dashboard/product/{{ $product->id }}" enctype="multipart/form-data" id="form-product">
        <div class="card card-custom">
            <div class="card-header">
                <span class="font-weight-bold">{{ $title }}</span>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="">Porduct Code</label>
                        <input type="text" name="product_code" value="{{ $product->product_code }}" class="form-control product-code-input">
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Product Name</label>
                            <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control product-name-input">
                        </div>
                    </div>

                    <div class="col-sm-6" hidden>
                        <div class="form-group">
                            <label for="">Bill Of Lading Id</label>
                            <input type="text" name="bill_of_lading_id" value="{{ $product->bill_of_lading_id }}" class="form-control product-satuan-input">
                        </div>
                    </div>
                    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Product Satuan</label>
                            <input type="text" name="product_satuan" value="{{ $product->product_satuan }}" class="form-control product-satuan-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Product Category</label>
                            <select name="product_category" class="form-control product-category-input">
                                <option value="">Choose Product Category</option>
                                @foreach($product_category as $item)
                                    <option value="{{ $item->id }}" @if($product->product_category == $item->id) {{ 'selected' }} @endif>{{ $item->category_product }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">total</label>
                            <input type="text" name="total" value="{{ $product->total }}" class="form-control total-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Status Product</label>
                            <select name="status_product" class="form-control status-product-input">
                                <option value="">Choose Status Category</option>
                                <option value="watlist" @if($product->status_product == "watlist") {{ 'selected' }} @endif>Watlist</option>
                                <option value="proses" @if($product->status_product == "proses") {{ 'selected' }} @endif>Proses</option>
                                <option value="finish" @if($product->status_product == "finish") {{ 'selected' }} @endif>Finish</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">From Moving</label>
                            <input type="text" name="from_moving" value="{{ $product->from_moving }}" class="form-control from-moving-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">To Moving</label>
                            <input type="text" name="to_moving" value="{{ $product->to_moving }}" class="form-control to-moving-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Description Moving</label>
                            <input type="text" name="description_moving" value="{{ $product->description_moving }}" class="form-control description-moving-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Image Moving</label>
                            <input hidden type="text" name="image_value" value="{{ $product->image_moving }}" class="form-control image-moving-input">
                            <input type="file" name="image_moving" class="form-control image-moving-input">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="btn btn-success mb-2 btn-block">
                                <span class="fa fa-save"></span> Save
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ url('/dashboard/bill_of_lading/'.$product->bill_of_lading_id) }}" class="btn btn-danger btn-block">
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
