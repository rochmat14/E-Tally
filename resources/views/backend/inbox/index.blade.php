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
    
        table = $('#table-{{ $controller }}').DataTable({
        processing: true,
        serverSide: true,
        order: [[ 5, 'desc' ],[ 6, 'desc' ]],
        ajax: {
            "url": "{!! route($controller.'.getData') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'subject', name: 'subject' },
            { data: 'date_contact', name: 'date_contact' },
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
                "searchable": true,
                "sortable": true,
                "render": function ( data, type, row ) {
                    var statusRead = row['statusRead'];
                   

                    return `
                        ${statusRead}
                    `;  
                    
                }
            },  
            {
                "targets": [ 7 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var showUrl = row['showUrl'];
                   

                    return `
                        @if (auth()->user()->can($controller.'-show'))
                            <a href='javascript:void(0)' class="btn btn-info" onclick=show("${showUrl}") title="Edit">
                                <i class="fa fa-edit"></i> Views
                            </a>
                        @endif
                        
                    `;  
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

    $("div.custom-toolbar").html('<button class="btn waves-effect waves-light btn-secondary" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');

});


function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
}


//edited
function show(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
     
    //Ajax Load data from ajax
    $.ajax({
        url : "{{url('dashboard/'.$controller.'/get_data/id')}}",
        type: "GET",
        dataType: "JSON",
        data: {"id":id},
        async: true,
        success: function(result)
        {
            //agent data
            
            $('[name="id"]').val(result.data.id);
            $('[name="name"]').val(result.data.name);
            $('[name="email"]').val(result.data.email);
            $('[name="phone"]').val(result.data.phone);
            $('[name="subject"]').val(result.data.subject);
            $('[name="message"]').val(result.data.message);
            $('[name="date_contact"]').val(result.data.date_contact);
            $('[name="id_address"]').val(result.data.id_address);
            $('#modal_form').modal('show');
            $('.modal-title').text('Show Inbox'); 

            reload_table();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
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

        
            {{-- Form --}}

            <div class="modal fade" id="modal_form" role="document" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-demo">
                        <div class="modal-header">
                            <h3 class="modal-title"></h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="form" method="post" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="hidden" value="" name="id" id="id" />
                                    <label for="name" class="control-label">Name :</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">Email :</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="email" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="control-label">Phone :</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="control-label">Subject :</label>
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="subject" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="text" class="control-label">Message :</label>
                                    <textarea class="form-control" name="message" id="message" placeholder="message"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="date_contact" class="control-label">date contact :</label>
                                    <input type="text" class="form-control" id="date_contact" name="date_contact" placeholder="date_contact" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="id_address" class="control-label">ip address :</label>
                                    <input type="text" class="form-control" id="id_address" name="id_address" placeholder="id_address" disabled>
                                </div>

                            </form>
                        </div>
                        
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
         
           

            <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Time Contact</th>
                        <th>Status Read</th>
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
