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

@section('js_scripts')
<script>
var table="";

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
        table = $('#table-BL').DataTable({
        processing: true,
        serverSide: true,
        order: [[ 2, 'asc' ]],
        ajax: {
            "url": "{!! route('BL.getDataByManifest',$id_manifest) !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            { data: 'kode_bill_of_lading', name: 'kode_bill_of_lading' },
            { data: 'date_of_bill', name: 'date_of_bill' },
            { data: 'telly_man', name: 'telly_man' },
            { data: 'total_product_process', name: 'total_product_process' },
            { data: 'total_product_finish', name: 'total_product_finish' },
            { data: null }
        ],

        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            },
            {
                "targets": [ 6 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var barcode = row['barcode'];
                    return `
                            <img src="${barcode}">
                    `;  
                    
                }
            }, 
            {
                "targets": [ 7 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var editUrl = row['editUrl'];
                    var deleteUrl = row['deleteUrl'];
                    var viewUrl = row['viewUrl'];

                    return `

                        <a href='${editUrl}' class="btn btn-info" title="Edit">
                            <i class="fa fa-edit"></i> Edit
                        </a>

                        <a href="${viewUrl}" class="btn btn-warning" title="View">
                                <i class="fa fa-eye"></i> Views
                        </a>

                        
                    `;  
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

    @if(auth()->user()->can($controller.'-create'))
        $("div.custom-toolbar").html('<button class="btn btn-success waves-effect waves-light" onclick="add()"><i class="glyphicon glyphicon-plus"></i>Create {{ $title }}</button> <button class="btn waves-effect waves-light btn-secondary" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
    @endif
    
    $('body').on('click', '[data-action="delete-record"]', function(event) {
        event.preventDefault();
        if (confirm('Apakah anda serius akan menghapus data ini?')) {
            $(this).parents('form').submit();
        }
    });
});


function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}







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
        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/><path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/></svg>
        <span class="breadcrumb-icon"> Home</span></a>
      </li>
      <li class="breadcrumb-item active" aria-current="page">{{ $title }} : {{ $data->kode_manifest }}</li>
    </ol>
  </div>
</div>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Detail {{ $title }} : {{ $data->kode_manifest }}</div>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <table class="display nowrap table table-hover table-striped table-bordered">
                    <tr>
                        <th>Kode Manifest</th>
                        <td>{{$data->kode_manifest}}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{$data->country}}</td>
                    </tr>
                    <tr>
                        <th>Date Of</th>
                        <td>{{$data->date_of}}</td>
                    </tr>
                    <tr>
                        <th>Port Name</th>
                        <td>{{$data->port_name}}</td>
                    </tr>
                    
                </table>
            </div>
            <div class="col-md-4">
                <table class="display nowrap table table-hover table-striped table-bordered">
                    <tr>
                        <th>Stevedore</th>
                        <td>{{$data->customer_name}}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{$data->customer_phone}}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{$data->customer_email}}</td>
                    </tr>
                    <tr>
                        <th>Total Bill Of Lading</th>
                        <td>{{ $total_bl }} BL</td>
                    </tr>
                    
                </table>
            </div>
            
            <div class="col-md-4">
                <table class="display nowrap table table-hover table-striped table-bordered">
                    <tr>
                        <th>Kapal</th>
                        <td>MV Jaya 01</td>
                    </tr>
                    <tr>
                        <th>GT</th>
                        <td>50000</td>
                    </tr>
                    <tr>
                        <th>LOA</th>
                        <td>300</td>
                    </tr>
                    <tr>
                        <th>ETA</th>
                        <td>12/03/22</td>
                    </tr>
                    <tr>
                        <th>ETD</th>
                        <td>14/03/22</td>
                    </tr>
                    
                </table>
            </div>

            
        </div>

        <div class="table-responsive">

        
            
            <hr>
            
         
            <h3>
                Listing Bill Of Lading
            </h3>

            <a href="/dashboard/manifest/bill-of-lading/{{ $id_manifest }}/create" class="btn btn-success">Add Bill Of Leading</a>
            
            <table id="table-BL" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode BL</th>
                        <th>Date of BL</th>
                        <th>Telly man</th>
                        <th>Total Product Proccess</th>
                        <th>Total Product Finish</th>
                        <th>Barcode BL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
      </div>
    </div>
    <!--/div-->
  </div>
</div>




{{-- Form  --}}



@endsection
