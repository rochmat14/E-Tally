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
var table_system="";

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
        table = $('#table-{{ $controller }}').DataTable({
        processing: true,
        serverSide: true,
        order: [[ 0, 'asc' ]],
        ajax: {
            "url": "{!! route($controller.'.getData') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            // { data: 'id', name: 'id' },
            { data: 'name', name: 'name'},
            { data: 'value', name: 'value'},
            { data: 'description', name: 'description'},
            { data: null }
        ],

        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            },
            {
                "targets": [ 4 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var editUrl = row['editUrl'];
                    var data_value = row['data_value'];

                    if(data_value != 'area_code'){

                      return `
                          @if (auth()->user()->can($controller.'-update'))
                              <a href='javascript:void(0)' class="btn btn-info" onclick=edited("${editUrl}") title="Edit">
                                  <i class="fa fa-edit"></i> Edit
                              </a>
                          @endif
                      `;
                    }else{
                      return `no edit`;
                    }
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

  
        $("div.custom-toolbar").html('<button class="btn waves-effect waves-light btn-secondary" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
  
    
    $('body').on('click', '[data-action="delete-record"]', function(event) {
        event.preventDefault();
        if (confirm('Apakah anda serius akan menghapus data ini?')) {
            $(this).parents('form').submit();
        }
    });
});



$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
        table_system = $('#table_system-{{ $controller }}').DataTable({
        processing: true,
        serverSide: true,
        order: [[ 0, 'asc' ]],
        ajax: {
            "url": "{!! route($controller.'.getDataSystem') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            // { data: 'id', name: 'id' },
            { data: 'name', name: 'name'},
            { data: 'value', name: 'value'},
            { data: 'description', name: 'description'},
            { data: null }
        ],

        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            },
            {
                "targets": [ 4 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var editUrl = row['editUrl'];
                    var data_value = row['data_value'];

                    return `

                        @if (auth()->user()->can($controller.'-update'))
                            <a href='${editUrl}' class="btn btn-info" title="Edit">
                                <i class="fa fa-edit"></i> Edit 
                            </a>
                        @endif
                        
                    `;  
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

  
        $("div.custom-toolbar").html('<button class="btn waves-effect waves-light btn-secondary" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
  
    
    $('body').on('click', '[data-action="delete-record"]', function(event) {
        event.preventDefault();
        if (confirm('Apakah anda serius akan menghapus data ini?')) {
            $(this).parents('form').submit();
        }
    });
});


function reload_table() {
    table.ajax.reload(null, false); //reload datatable ajax 
    table_system.ajax.reload(null, false); //reload datatable ajax 
}


//edited
function edited(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#photo-preview').show(); 
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
            $('[name="value"]').val(result.data.value);
            $('[name="description"]').val(result.data.description);
            $('#modal_form').modal('show');
            $('.modal-title').text('Setting General Edit'); 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}


//saving
function save(){
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    event.preventDefault();
    var url;
    var pesan;

    if(save_method == 'add') {
        url ="{{url('dashboard/'.$controller.'/save')}}";
        pesan ='Success Add Data';
        // console.log(url);
    } else {
        url ="{{url('dashboard/'.$controller.'/update')}}";
        pesan ='Success Update Data';

    }
    // ajax adding data to database
    var formData = new FormData($('#form')[0]);

    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
          if(data.status) //if success close modal and reload ajax table
          {
              $('#modal_form').modal('hide');
              iziToast.success({
                  title: 'OK',
                  position: 'center',
                  message: pesan,
              });
              reload_table();
              // location.reload();

          }
          else
          {
              for (var i = 0; i < data.inputerror.length; i++) 
              {
                  $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                  $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
              }
          }
          $('#btnSave').text('save'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
        },
        error: function (data)
        {   
          console.log(data.responseJSON.message);
          var error_message="";
          error_message +="<ul>";
          $.each( data.responseJSON.errors, function( key, value ) {
             error_message +="<li>"+value+"</li>";
          });

          error_message +="</ul>";
          iziToast.error({
               title: 'ERROR !',
               message: error_message,
               position: 'topRight'
          });
          $('#btnSave').text('save'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable 
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
      <li class="breadcrumb-item"><a href="#">Pengaturan System</a></li>
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
        

        <div class="modal fade col-md-12" id="modal_form" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title"></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input type="hidden" value="" name="id" id="id" />
                                <label for="name" class="control-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" readonly placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="hidden" value="" name="id" id="id" />
                                <label for="name" class="control-label">Value:</label>
                                <input type="text" class="form-control" id="value" name="value" placeholder=" Value Name">
                            </div>

                            <div class="form-group">
                                <input type="hidden" value="" name="id" id="id" />
                                <label for="name" class="control-label">Description:</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </form>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <ul class="nav nav-tabs" id="myTab" role="tablist">

          <li class="nav-item">
            <a class="nav-link active" id="setting_system-tab" data-toggle="tab" href="#setting_system" role="tab" aria-controls="setting_system" aria-selected="false">Setting System</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="setting_general-tab" data-toggle="tab" href="#setting_general" role="tab" aria-controls="setting_general" aria-selected="true">Setting General</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">

          @if(session('status'))
                <br><br>
                
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <h6 class="block">Success</h6>
                  <strong>{{ session('status') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

            @endif

          <div class="tab-pane fade show active" id="setting_system" role="tabpanel" aria-labelledby="setting_system-tab">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                      <p></p>
                      <h4>Setting System</h4>

                      <hr>
                      <div class="table-responsive">
                        <table id="table_system-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th width="10">No</th>
                                      <th width="20">Name</th>
                                      <th>Value</th>
                                      <th>Description</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody></tbody>
                          </table>
                      </div>
                </div>
            </div>
          </div>

          <div class="tab-pane fade" id="setting_general" role="tabpanel" aria-labelledby="setting_general-tab">
            
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                      <p></p>
                      <h4>Setting General</h4>

                      <hr>
                    
                      <div class="table-responsive">
                        <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                              <thead>
                                  <tr>
                                      <th width="10">No</th>
                                      <th width="20">Name</th>
                                      <th>Value</th>
                                      <th>Description</th>
                                      <th>Action</th>
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
    <!--/div-->

    
    
  </div>
</div>






@endsection
