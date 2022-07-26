@extends('layouts.app')
@section('sidebarActive', $controller)
@section('web_title', $title)
@section('page_header', $title)

@section('vendor_css')
@endsection

@section('css_scripts')
@endsection

@section('vendor_js')
<!-- This is data table -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- ============================================================== -->

@endsection

@section('js_scripts')
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var table = $('#table-{{ $controller }}').DataTable({
        processing: true,
        serverSide: true,
        order: [[ 1, 'desc' ]],
        ajax: {
            "url": "{!! route($controller.'.getData') !!}",
            "type": "POST"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' }, // 0
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name'},
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
                    var permissionUrl = row['permissionUrl'];
                    var editUrl = row['editUrl'];
                    var deleteUrl = row['deleteUrl'];

                    return `
                        @if (auth()->user()->can($controller.'-update'))
                            <a class=" waves-effect waves-light btn-xs btn-warning" href="${permissionUrl}" title="Edit Permission">
                                <i class="fa fa-edit"></i> Permission
                            </a>
                        @endif

                        @if (auth()->user()->can($controller.'-update'))
                            <a class=" waves-effect waves-light btn-xs btn-info" href="${editUrl}" title="Edit">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                        @endif

                        @if (auth()->user()->can($controller.'-delete'))
                            <form method="POST" action="${deleteUrl}" style="display:inline;">
                                <input name="_method" type="hidden" value="DELETE">
                                {!! Form::token() !!}
                                <button type="submit" class=" waves-effect waves-light btn-xs btn-danger" data-action="delete-record">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        @endif
                    `;  
                    
                }
            },               
        ],

        "dom": '<"custom-toolbar">frtip',
    });

    @if(auth()->user()->can($controller.'-create'))
        $("div.custom-toolbar").html('<a href="{{ route($controller.'.create') }}" class="btn waves-effect waves-light btn-info btn-xs"><i class="fa fa-plus"></i> Tambah Baru</a>');
    @endif
    
    $('body').on('click', '[data-action="delete-record"]', function(event) {
        event.preventDefault();
        if (confirm('Apakah anda serius akan menghapus data ini?')) {
            $(this).parents('form').submit();
        }
    });
});
</script>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
<li class="breadcrumb-item active">{{ $title }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Daftar {{ $title }}</h4>
                    <h6 class="card-subtitle"></h6>
                    <div class="table-responsive m-t-40">
                        <table id="table-{{ $controller }}" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th width="10">No</th>
                                    <th width="20">ID</th>
                                    <th>Name</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
