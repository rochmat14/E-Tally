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
            { data: 'waktu_senin', name: 'waktu_senin'},
            { data: 'waktu_selasa', name: 'waktu_selasa'},
            { data: 'waktu_rabu', name: 'waktu_rabu'},
            { data: 'waktu_kamis', name: 'waktu_kamis'},
            { data: 'waktu_jumat', name: 'waktu_jumat'},
            { data: 'waktu_sabtu', name: 'waktu_sabtu'},
            { data: 'waktu_minggu', name: 'waktu_minggu'},
            { data: null }
        ],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "searchable": false,
                "sortable": false,
            },
            {
                "targets": [ 10 ],
                "className": 'col-center',
                "searchable": false,
                "sortable": false,
                "render": function ( data, type, row ) {
                    var editUrl = row['editUrl'];
                    var deleteUrl = row['deleteUrl'];
                    return `
                        @if (auth()->user()->can($controller.'-update'))
                            <a href='javascript:void(0)' class="btn btn-info" onclick=update("${editUrl}") title="Delete">
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
        $("div.custom-toolbar").html('<button class="btn btn-success waves-effect waves-light" onclick="add()"><i class="glyphicon glyphicon-plus"></i>Tambah Jadwal</button> <button class="btn waves-effect waves-light btn-secondary" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>');
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


$(function() {
  $('.selectpicker').selectpicker();
});


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



// add 
function add() {
    // document.getElementById("btnSave").disabled = true;
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('#photo-preview').hide();
    $('.modal-title').text('Set Jadwal Dokter');
    // event.preventDefault();
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


function update(id){
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
            $('[name="id"]').val(result.data.id);
            $('[name="dokter_id"]').val(result.data.dokter_id);
            $('[name="waktu_senin"]').val(result.data.waktu_senin);
            $('[name="waktu_selasa"]').val(result.data.waktu_selasa);
            $('[name="waktu_rabu"]').val(result.data.waktu_rabu);
            $('[name="waktu_kamis"]').val(result.data.waktu_kamis);
            $('[name="waktu_jumat"]').val(result.data.waktu_jumat);
            $('[name="waktu_sabtu"]').val(result.data.waktu_sabtu);
            $('[name="waktu_minggu"]').val(result.data.waktu_minggu);
            $('#modal_form').modal('show');
            $('.modal-title').text('Edit Jadwal Dokter'); 
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


        
        <div class="modal" id="modal_form" role="document" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
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
                                <label for="name" class="control-label">Pilih Dokter :</label>
                                <select class="form-control selectpicker" name="dokter_id" data-live-search="true">
                                    <option value="">Pilih Dokter</option>
                                    @foreach($dokter AS $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->nama_dokter }} | Spesialis {{ $value->nama_spesialis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row row-sm">
                                
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="name" class="control-label">Waktu Senin :</label>
                                    <input class="form-control mb-4" placeholder="08:00-16:00" type="text" name="waktu_senin">
                                    <i>Kosongkan Jika Tidak Ada Jadwal</i>
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="name" class="control-label">Waktu Selasa :</label>
                                    <input class="form-control mb-4" placeholder="08:00-16:00" type="text" name="waktu_selasa">
                                    <i>Kosongkan Jika Tidak Ada Jadwal</i>
                                </div>

                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="name" class="control-label">Waktu Rabu :</label>
                                    <input class="form-control mb-4" placeholder="08:00-16:00" type="text" name="waktu_rabu">
                                    <i>Kosongkan Jika Tidak Ada Jadwal</i>
                                </div>
                                
                            </div>

                            <hr>
                            <div class="row row-sm">
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="name" class="control-label">Waktu Kamis :</label>
                                    <input class="form-control mb-4" placeholder="08:00-16:00" type="text" name="waktu_kamis">
                                    <i>Kosongkan Jika Tidak Ada Jadwal</i>
                                </div>
                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="name" class="control-label">Waktu Jum'at :</label>
                                    <input class="form-control mb-4" placeholder="08:00-16:00" type="text" name="waktu_jumat">
                                    <i>Kosongkan Jika Tidak Ada Jadwal</i>
                                </div>

                                <div class="col-lg mg-t-10 mg-lg-t-0">
                                    <label for="name" class="control-label">Waktu Sabtu :</label>
                                    <input class="form-control mb-4" placeholder="08:00-16:00" type="text" name="waktu_sabtu">
                                    <i>Kosongkan Jika Tidak Ada Jadwal</i>
                                </div>
                                
                            </div>

                            <hr>
                            <div class="row row-sm">
                                <div class="col-lg mg-t-4 mg-lg-t-0">
                                    <label for="name" class="control-label">Waktu Minggu :</label>
                                    <input class="form-control mb-2" placeholder="08:00-16:00" type="text" name="waktu_minggu">
                                    <i>Kosongkan Jika Tidak Ada Jadwal</i>
                                </div>
                                
                                
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



        <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th rowspan="2" class="text-center">No</th>
                <th colspan="2">Information Dokter & Spesialis </th>
                <th colspan="8" class="text-center">Jadwal Dokter</th>
                {{-- <th rowspan="2">Action</th> --}}
            </tr>
            <tr>

                <th>Dokter</th>
                <th>Spesialis</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jum'at</th>
                <th>Sabtu</th>
                <th>Minggu</th>
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
