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
        $('form#form-vassel').on('submit', function(event) {
            //Add validation rule for dynamically generated name fields
            $('.nama-kapal-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Nama Kapal harus di isi",
                    }
                });
            });

            $('.gt-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    number: true,
                    messages: {
                        required: "GT harus di isi",
                        number: "GT harus berjenis angka",
                    }
                });
            });

            $('.loa-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    number: true,
                    messages: {
                        required: "LOA harus di isi",
                        number: "LOA harus berjenais angka",
                    }
                });
            });
        });
        $("#form-vassel").validate();
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

    <form method="POST" action="/dashboard/vassel" enctype="multipart/form-data" id="form-vassel">
        <div class="card card-custom">
            <div class="card-header">
                <span class="font-weight-bold">Vassel</span>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Nama Kapal</label>
                            <input type="text" name="nama_kapal" class="form-control nama-kapal-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">GT</label>
                            <input type="number" name="gt" class="form-control gt-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">LOA</label>
                            <input type="number" name="loa" class="form-control loa-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Photo</label>
                            <input type="file" name="photo" class="form-control photo-input">
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
                            <a href="{{ url('/dashboard/vassel') }}" class="btn btn-danger btn-block">
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
