@extends('layouts.members.app')
@php 
    $assets = asset('template_assets');
@endphp

@section('vendor_css')
<link rel="stylesheet" href="{{ asset('/izitoast/css/iziToast.min.css') }}">
@endsection

@section('vendor_js')
<!-- This is data table -->
<!-- ============================================================== -->
{{-- IziToast --}}
<script src="{{ asset('/izitoast/js/iziToast.min.js') }}"></script>
{{-- datatables --}}
<!-- Data tables -->
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

var table_transaction_booking="";

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
        table_transaction_booking = $('#table_transaction_booking').DataTable({
        processing: true,
        serverSide: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        // responsive: true,
        order: [[ 4, 'desc' ]],
        ajax: {
            "url": "{!! route('members.getDataTransactionBooking') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'booking_code', name: 'booking_code'},
            { data: 'distrik_from', name: 'distrik_from'},
            { data: 'distrik_to', name: 'distrik_to'},
            { data: 'status_transaction', name: 'status_transaction'},
            { data: 'created_at', name: 'created_at'},

            
        ],

        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            },
            {
                "targets": [ 1 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var booking_code = row['booking_code'];
                   
                    return `
                        ${booking_code}
                    `;
                    
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

  
        $("div.custom-toolbar").html('<button class="btn waves-effect waves-light btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
  
    
    $('body').on('click', '[data-action="delete-record"]', function(event) {
        event.preventDefault();
        if (confirm('Apakah anda serius akan menghapus data ini?')) {
            $(this).parents('form').submit();
        }
    });
});


var table_transaction_close;
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
        table_transaction_close = $('#table_transaction_close').DataTable({
        processing: true,
        serverSide: true,
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        // responsive: true,
        order: [[ 4, 'desc' ]],
        ajax: {
            "url": "{!! route('members.getDataTransactionBookingClose') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'booking_code', name: 'booking_code'},
            { data: 'distrik_from', name: 'distrik_from'},
            { data: 'distrik_to', name: 'distrik_to'},
            { data: 'status_transaction', name: 'status_transaction'},
            { data: 'created_at', name: 'created_at'},

            
        ],

        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            },
            {
                "targets": [ 1 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var booking_code = row['booking_code'];
                   
                    return `
                        ${booking_code}
                    `;
                    
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

  
        $("div.custom-toolbar").html('<button class="btn waves-effect waves-light btn-info" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
  
    
    $('body').on('click', '[data-action="delete-record"]', function(event) {
        event.preventDefault();
        if (confirm('Apakah anda serius akan menghapus data ini?')) {
            $(this).parents('form').submit();
        }
    });
});

function reload_table() {
    table_transaction_booking.ajax.reload(null, false);
    table_transaction_close.ajax.reload(null, false);
    // table_transaction_proses.ajax.reload(null, false);
    // table_transaction_finish.ajax.reload(null, false);
    // table_transaction_cancel.ajax.reload(null, false);

}



</script>
@endsection

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


        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="card-title">{{ $title }} Transaction</div>
              </div>
              <div class="card-body">
                    
                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                          <li class="nav-item">
                            <a class="nav-link active" id="booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="booking" aria-selected="false">Transaction Booking</a>
                          </li>


                          <li class="nav-item">
                            <a class="nav-link" id="close-tab" data-toggle="tab" href="#close" role="tab" aria-controls="close" aria-selected="true">Transaction Close</a>
                          </li>
                          
                         
                        </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="booking" role="tabpanel" aria-labelledby="booking-tab">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                  <p></p>
                                  <h4>Transaction Booking List Data</h4>

                                  <hr>
                                  <div class="table-responsive">
                                        <table id="table_transaction_booking" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                          <thead>
                                              <tr>
                                                  <th width="10">No</th>
                                                  <th>Booking Code</th>
                                                  <th>Pengiriman Dari</th>
                                                  <th>Tujuan</th>
                                                  <th>Status Orders</th>
                                                  <th>Date Request</th>
                                                  {{-- <th>Action</th> --}}
                                              </tr>
                                          </thead>
                                          <tbody></tbody>
                                        </table>

                                  </div>
                                </div>
                            </div>
                        </div>

                        

                        

                        <div class="tab-pane fade" id="close" role="tabpanel" aria-labelledby="close-tab">
                        
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12">
                                      <p></p>
                                      <h4>Transaction Booking Close</h4>

                                      <hr>
                                    
                                      <div class="table-responsive">
                                             <table id="table_transaction_close" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                              <thead>
                                                  <tr>
                                                      <th width="10">No</th>
                                                      <th>Booking Code</th>
                                                      <th>Pengiriman Dari</th>
                                                      <th>Tujuan</th>
                                                      <th>Status Orders</th>
                                                      <th>Date Request</th>
                                                      {{-- <th>Action</th> --}}
                                                  </tr>
                                              </thead>
                                              <tbody></tbody>
                                            </table>
                                      </div>
                                </div>
                            </div>
                        </div>

                    </div>


              </div>
            </div>
          </div>
        </div>
    </div>
</div><!-- end app-content-->

@endsection
