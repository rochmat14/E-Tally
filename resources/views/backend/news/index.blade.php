@section('sidebarActive', $controller)
@extends('layouts.template.app')

@section('vendor_css')
<link rel="stylesheet" href="{{ asset('/izitoast/css/iziToast.min.css') }}">
@endsection

@section('css_scripts')
@endsection


@php 
$assets = asset('template_assets');
$user = Auth::user();
@endphp


@section('vendor_js')
<!-- This is data table -->
<script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<!-- ============================================================== -->
{{-- IziToast --}}
<script src="{{ asset('/izitoast/js/iziToast.min.js') }}"></script>
{{-- datatables --}}
<!-- Data tables -->
<script src="{{ $assets }}/plugins/datatable/js/jquery.dataTables.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/dataTables.bootstrap4.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/dataTables.buttons.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/buttons.bootstrap4.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/jszip.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/pdfmake.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/vfs_fonts.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/buttons.html5.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/buttons.print.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/js/buttons.colVis.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="{{ $assets }}/plugins/datatable/responsive.bootstrap4.min.js"></script>
<script src="{{ $assets }}/js/datatables.js"></script>


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

        <div class="table-toolbar">
            <div class="row">
                <div class="col-md-6">
                    <div class="btn-group">
                        @if ($user->can('news-create'))
                        <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/create' )) }}" class="btn btn-success"> {{ __('main.add_new') }}
                            <i class="fa fa-plus"></i>
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="pull-right">
                        <form>
                            <div><label>{{ __('main.search') }}: <input type="search" name="q" value="{{ $q }}" class="form-control" placeholder="" aria-controls="sample_1"></label></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        

        @if ($rows->isEmpty())
            <div class="alert alert-danger ">{{ __('main.no_data_found') }}</div>
        @else
        
        <div class="table-wrap mt-40">
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th>{{ __('main.no') }}</th>
                    <th>Fiture Image</th>
                    <th>{{ __('main.title') }}</th>
                    <th>{{ __('main.published_on') }}</th>
                    <th>{{ __('main.status') }}</th>
                    <th>{{ __('main.actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $no = ($rows->currentPage() - 1) * $rows->perPage(); ?>
                    @foreach($rows as $row)
                    <?php
                    $no++;
                    $desc = $row->description()->first();
                    ?>
                  <tr>
                    <tr>
                        <td>{!! $no !!}</td>
                        <td><img src="{{ URL::asset('/images/news/')}}/{{ $row->id }}/thumb-{{ $row->image }}" width="100"></td>
                        <td>{!! $desc->title !!}</td>
                        <td>{!! date('d-m-Y H:i', strtotime($row->published_on)) !!}</td>
                        <td><span class="label label-sm label-{{ $row->status == 1 ? 'success' : 'danger' }}"> {!! arrStatusActive()[$row->status] !!} </span></td>
                        <td>
                            @if ($user->can('news-update'))
                            <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/'.$row->id.'/edit' )) }}" class="btn btn-primary btn-circle btn-sm purple" title="{{ __('main.edit') }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endif

                            
                            <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller.'/'.$row->id.'/show' )) }}" class="btn btn-default btn-circle dark btn-sm blue" title="{{ __('main.view') }}">
                                <i class="fa fa-eye"></i>
                            </a>
                            
                        </td>
                    </tr>
                  </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
        </div>

        @endif


      </div>
    </div>
    <!--/div-->
  </div>
</div>




{{-- Form  --}}



@endsection
