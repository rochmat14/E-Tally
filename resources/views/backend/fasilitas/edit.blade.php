@section('sidebarActive', $controller)
@extends('layouts.template.app')

@php 
$assets = asset('template_assets');
$plugin_assets = asset('js');
$user = Auth::user();
@endphp

@section('vendor_css')

<link rel="stylesheet" href="{{ asset('/izitoast/css/iziToast.min.css') }}">


@endsection

@php 
$assets = asset('template_assets');
@endphp

@section('vendor_js')
    

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
    
    <script type="text/javascript">
        var table="";
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
                table = $('#table-fasilitas_gallery').DataTable({
                processing: true,
                serverSide: true,
                order: [[ 2, 'asc' ]],
                ajax: {
                    "url": "{{ route('fasilitas_gallery.getData', [ 'id_fasilitas'=> $data_fasilitas->id ]) }}",
                    "type": "POST"
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: null }
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
                            var fasilitas_gallery = row['fasilitas_gallery'];
                            return `
                                    <img src="{{ asset('/images/fasilitas_gallery/') }}/${fasilitas_gallery}">
                            `;  
                        }
                    },  
                    {
                        "targets": [ 2 ],
                        "className": 'col-center',
                        "searchable": false,
                        "sortable": false,
                        "render": function ( data, type, row ) {
                            var deleteUrl = row['deleteUrl'];

                            return `
                                @if (auth()->user()->can($controller.'-delete'))

                                    <a href='javascript:void(0)' class="btn btn-danger" onclick=removed("${deleteUrl}") title="Delete">
                                        <i class="fa fa-edit"></i> Delete Images
                                    </a>
                                @endif
                                
                            `;  
                        }
                    },               
                ],

                "dom": '<"custom-toolbar">frtip',
            });

            @if(auth()->user()->can($controller.'-create'))
                $("div.custom-toolbar").html('<a class="btn btn-success waves-effect waves-light" onclick="add()"><i class="glyphicon glyphicon-plus"></i>Upload Fasilitas Gallery</a>');
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


        // add 
        function add() {
            // document.getElementById("btnSave").disabled = true;
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('#photo-preview').hide();
            $('.modal-title').text('Add Fasilitas Gallery');
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
                url ="{{url('dashboard/fasilitas_gallery/save')}}";
                pesan ='Success Add Data';
                // console.log(url);
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
                var url ="{{url('dashboard/fasilitas_gallery/delete')}}";
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
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('dashboard/dokter') }}">{{ $title }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit {{ $title }}</li>
    </ol>
  </div>
</div>


<div class="modal" id="modal_form" role="document" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
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
                        <input type="hidden" value="{{ $data_fasilitas->id }}" name="id_fasilitas" id="id_fasilitas" />
                        <label for="fasilitas_gallery" class="control-label">Image Gallery:</label>
                        <input type="file" class="form-control" id="fasilitas_gallery" name="fasilitas_gallery" placeholder="fasilitas gallery">
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary">Upload</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Edit {{ $title }}</div>
      </div>
      <div class="card-body">
        <div class="panel panel-primary">
            
            <div class="panel-body tabs-menu-body">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
                    <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                </div>
                @endif
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="tab-content">
                        
                            <div class="form-group">
                                <label for="title"  class="control-label col-lg-2">Kategori<span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <select name="category" class="form-control" required>
                                        <option value="fasilitas" {!! $data_fasilitas->category == 'fasilitas' ? 'selected' : '' !!}>Fasilitas</option>
                                        <option value="layanan" {!! $data_fasilitas->category == 'layanan' ? 'selected' : '' !!}>Layanan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title"  class="control-label col-lg-2">Nama Fasilitas / Pelayanan<span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <input type="hidden" value="{{ $data_fasilitas->id }}" name="id">
                                    <input type="text" class="form-control" value="{{ $data_fasilitas->nama_fasilitas }}" required="" name="nama_fasilitas" placeholder="Nama Fasilitas / Pelayanan">
                                </div>
                            </div>

                            
                            

                            <div class="form-group">
                                <label for="description"  class="control-label col-lg-2">{{ __('main.description') }} <span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <textarea class="form-control" id="description_id" name="description">
                                        {{ $data_fasilitas->description }}
                                    </textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo"  class="control-label col-lg-12">Old Images <span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <img src="{{ url('images/fasilitas') }}/{{ $data_fasilitas->file_image }}" style="width: 200px;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo"  class="control-label col-lg-12">Change File Thumbnail Images <span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <input type="file" class="form-control" name="file_image">
                                </div>
                            </div>

                            <hr>

                            

                            <table id="table-fasilitas_gallery" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="10">No</th>
                                        <th>File Images</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>


                            <hr>
                            <div class="form-group">
                              <input type="submit" class="btn btn-info" value="Update Fasilitas">

                              <a href="{{ route('fasilitas.index') }}" class="btn btn-secondary">Back</a>
                            </div>
                       
                    </div>
                </form>
            </div>
        </div>
        
      
      </div>
    </div>
    <!--/div-->
  </div>
</div>

@endsection
