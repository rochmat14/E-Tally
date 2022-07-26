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
{{-- <script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script> --}}

<script src="{{ $assets }}/plugins/datatable/js/jquery.dataTables.min.js"></script>

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
        order: [[ 2, 'asc' ]],
        ajax: {
            "url": "{!! route($controller.'.getData') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            { data: 'nama_dokter', name: 'nama_dokter'},
            { data: 'nama_spesialis', name: 'nama_spesialis'},
           
            { data: null }
        ],

        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            },
            {
                "targets": [ 3 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var photo = row['photo'];
                    return `
                            <img src="{{ asset('/images/dokter/') }}/${photo}">
                    `;  
                    
                }
            },  
            {
                "targets": [ 4 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var editUrl = row['editUrl'];
                    var deleteUrl = row['deleteUrl'];

                    return `

                        @if (auth()->user()->can($controller.'-update'))
                            <a href='${editUrl}' class="btn btn-info"  title="Edit">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        @endif

                        @if (auth()->user()->can($controller.'-delete'))

                            <a href='javascript:void(0)' class="btn btn-danger" onclick=removed("${deleteUrl}") title="Delete">
                                <i class="fa fa-edit"></i> Delete
                            </a>
                            
                        @endif

                        
                    `;  
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

    @if(auth()->user()->can($controller.'-create'))
        $("div.custom-toolbar").html('<a href="{{ url('dashboard/dokter/create') }}" class="btn btn-success waves-effect waves-light"><i class="glyphicon glyphicon-plus"></i>Add Dokter</a> <button class="btn waves-effect waves-light btn-secondary" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
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





function removed(id){
    var href = $(this).attr('href');
    var message = $(this).data('confirm');
    swal({
        title: "Are you sure delete this data ?",
        text: message, 
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        // ajax delete data to database
        var url ="{{url('dashboard/'.$controller.'/delete')}}";
        $.ajax({
            url : url,
            type: "POST",
            data: {"id":id},
            dataType: "JSON",
            headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            success: function(result)
            {
                 if(result.data_post.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');

                    iziToast.success({
                        title: 'OK',
                        position: 'center',
                        message: result.data_post['message'],
                    });

                    reload_table();
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log(url);
                alert('Error deleting data');
            }
        });
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
      <li class="breadcrumb-item"><a href="#">Data Dokter</a></li>
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


        
        @if(session('status'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </button>
                <h4 class="block">{{ __('main.success') }}</h4>
                <p> {{ session('status') }}</p>
            </div>
        @endif



        <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="10">No</th>
                    <th>Nama Dokter</th>
                    <th>Spesialis</th>
                    <th>Photo</th>
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





@endsection
