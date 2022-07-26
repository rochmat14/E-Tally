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

    <form method="POST" action="/dashboard/vassel/{{ $vassel->id }}" enctype="multipart/form-data" id="form-vassel">
        <div class="card card-custom">
            <div class="card-header">
                <span class="font-weight-bold">Vassel</span>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Nama Kapal</label>
                            <input type="text" value="{{ $vassel->nama_kapal }}" name="nama_kapal"
                                class="form-control nama-kapal-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">GT</label>
                            <input type="number" value="{{ $vassel->gt }}" name="gt" class="form-control gt-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">LOA</label>
                            <input type="number" value="{{ $vassel->loa }}" name="loa" class="form-control loa-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Photo</label>
                            <input type="hidden" value="{{ $vassel->photo }}" name="photo_value"
                                class="form-control photo-input">
                            <input type="file" name="photo" class="form-control photo-input">
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
