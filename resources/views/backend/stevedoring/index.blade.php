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


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ $title }}</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

    <a href="/dashboard/stevedoring/create" class="btn btn-success">Create Stevendoring</a>

    <table class="display nowrap table table-hover table-striped table-bordered" cellspacing="0">
        <thead>
            <tr>
                <th>Nama Perusahaan</th>
                <th>Telp</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>
                </th>
            </tr>
        </thead>

        <tbody>
            @foreach ($stevedoring as $item)
                @if ($item->status != 0)
                    <tr>
                        <td>{{ $item->nama_perusahaan }}</td>
                        <td>{{ $item->telp }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href="/dashboard/stevedoring/{{ $item->id }}/edit" class="btn btn-info float-left">Edit</a>

                            <form method="POST" action="/dashboard/stevedoring/{{ $item->id }}">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" name="submit" class="btn btn-danger float-right">
                                    <span class="fa fa-trash"></span> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    </div>
    </div>
    </div>
    <!--/div-->
    </div>
    </div>

@endsection



@section('content')
