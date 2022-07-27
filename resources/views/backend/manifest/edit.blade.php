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
        $('form#form-manifest').on('submit', function(event) {
            //Add validation rule for dynamically generated name fields
            $('.kode-manifest-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Kode Manifest harus di isi",
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

            $('.id-customer-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Id Customer harus di isi",
                    }
                });
            });

            $('.date-of-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Date Of harus di isi",
                    }
                });
            });

            $('.port-name-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Port Name harus di isi",
                    }
                });
            });

            $('.vassel-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Vassel harus di isi",
                    }
                });
            });

            $('.ship-agent-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Ship Agent harus di isi",
                    }
                });
            });

            $('.stevedoring-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Stevedoring harus di isi",
                    }
                });
            });

            $('.voy-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Voy harus di isi",
                    }
                });
            });

            $('.berth-no-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Berth No harus di isi",
                    }
                });
            });

            $('.berthed-on-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Berthed On harus di isi",
                    }
                });
            });

            $('.berthed-on-hours-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Berthed On Hours harus di isi",
                    }
                });
            });

            $('.departed-on-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Departed On harus di isi",
                    }
                });
            });

            $('.departed-on-hours-input').each(function() {
                $(this).rules("add", {
                    required: true,
                    messages: {
                        required: "Departed On Hours harus di isi",
                    }
                });
            });
        });
        $("#form-manifest").validate();
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

    <form method="POST" action="/dashboard/manifest/{{ $manifest->id }}" id="form-manifest">
        <div class="card card-custom">
            <div class="card-header">
                <span class="font-weight-bold">{{ $title }}</span>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="">Kode Manifest</label>
                        <input type="text" value="{{ $manifest->kode_manifest }}" name="kode_manifest"
                            class="form-control kode-manifest-input">
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Country</label>
                            <input type="text" value="{{ $manifest->country }}" name="country"
                                class="form-control country-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Id Customor</label>
                            <select name="id_customer" class="form-control id-customer-input">
                                <option value="">Choose Customer</option>
                                @foreach($customer as $item)
                                    <option value="{{ $item->id }}"  @if ($item->id == $manifest->id_customer) {{ 'selected' }} @endif>{{ $item->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Date Of</label>
                            <input type="date" value="{{ $manifest->date_of }}" name="date_of"
                                class="form-control date-of-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Port Name</label>
                            <input type="text" value="{{ $manifest->port_name }}" name="port_name"
                                class="form-control port-name-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Vassel</label>
                            <select {{ $manifest->id }} name="vassel_id" id="" class="form-control vassel-input">
                                <option value="">Choose Vassel</option>
                                @foreach ($vassel as $item)
                                    <option value="{{ $item->id }}"
                                        @if ($item->id == $manifest->vassel_id) {{ 'selected' }} @endif>
                                        {{ $item->nama_kapal }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Ship Agent</label>
                            <select {{ $manifest->id }} name="ship_agent_id" id=""
                                class="form-control about-img ship-agent-input">
                                <option value="">Choose Ship Agent</option>
                                {{ $manifest->ship_agent_id }}
                                @foreach ($ship_agent as $item)
                                    <option value="{{ $item->id }}"
                                        @if ($item->id == $manifest->ship_agent_id) {{ 'selected' }} @endif>
                                        {{ $item->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Stevedoring</label>
                            <select {{ $manifest->id }} name="stevedoring_id" id=""
                                class="form-control stevedoring-input">
                                <option value="">Choose Stevedoring</option>
                                @foreach ($stevedoring as $item)
                                    <option value="{{ $item->id }}"
                                        @if ($item->id == $manifest->stevedoring_id) {{ 'selected' }} @endif>
                                        {{ $item->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Voy</label>
                            <input type="text" value="{{ $manifest->voy }}" name="voy"
                                class="form-control voy-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Berth No</label>
                            <input type="text" value="{{ $manifest->berth_no }}" name="berth_no"
                                class="form-control berth-no-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Berthed On</label>
                            <input type="text" value="{{ $manifest->berthed_on }}" name="berthed_on"
                                class="form-control berthed-on-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Berthed On Hours</label>
                            <input type="time" value="{{ $manifest->berthed_on_hours }}" name="berthed_on_hours"
                                class="form-control berthed-on-hours-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Departed On</label>
                            <input type="date" value="{{ $manifest->departed_on }}" name="departed_on"
                                class="form-control departed-on-input">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Departed On Hours</label>
                            <input type="time" value="{{ $manifest->departed_on_hours }}" name="departed_on_hours"
                                class="form-control departed-on-hours-input">
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
                            <a href="{{ url('/dashboard/manifest') }}" class="btn btn-danger btn-block">
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
