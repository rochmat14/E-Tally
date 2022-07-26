@section('sidebarActive', $controller)
@extends('layouts.template.app')

@php 
$assets = asset('template_assets');
$plugin_assets = asset('js');
$user = Auth::user();
@endphp

@section('vendor_css')

    
        <!-- File Uploads css -->
        {{-- <link href="{{ $assets }}/plugins/fancyuploder/fancy_fileupload.css" rel="stylesheet" /> --}}

        <!-- File Uploads css-->
        {{-- <link href="{{ $assets }}/plugins/fileupload/css/fileupload.css" rel="stylesheet" type="text/css" /> --}}
        <style type="text/css">
            .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: normal;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-image: none;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        /*Also */
        .btn-success {
            border: 1px solid #c5dbec;
            background: #D0E5F5;
            font-weight: bold;
            color: #2e6e9e;
        }
        /* This is copied from https://github.com/blueimp/jQuery-File-Upload/blob/master/css/jquery.fileupload.css */
        .fileinput-button {
            position: relative;
            overflow: hidden;
        }

            .fileinput-button input {
                position: absolute;
                top: 0;
                right: 0;
                margin: 0;
                opacity: 0;
                -ms-filter: 'alpha(opacity=0)';
                font-size: 200px;
                direction: ltr;
                cursor: pointer;
            }

        .thumb {
            height: 80px;
            width: 100px;
            border: 1px solid #000;
        }

        ul.thumb-Images li {
            width: 120px;
            float: left;
            display: inline-block;
            vertical-align: top;
            height: 120px;
        }

        .img-wrap {
            position: relative;
            display: inline-block;
            font-size: 0;
        }

            .img-wrap .close {
                position: absolute;
                top: 2px;
                right: 2px;
                z-index: 100;
                background-color: #D0E5F5;
                padding: 5px 2px 2px;
                color: #000;
                font-weight: bolder;
                cursor: pointer;
                opacity: .5;
                font-size: 23px;
                line-height: 10px;
                border-radius: 50%;
            }

            .img-wrap:hover .close {
                opacity: 1;
                background-color: #ff0000;
            }

        .FileNameCaptionStyle {
            font-size: 12px;
        }
        </style>

@endsection



@section('vendor_js')
    
    <!--File-Uploads Js-->
    {{-- <script src="{{ $assets }}/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="{{ $assets }}/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="{{ $assets }}/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script src="{{ $assets }}/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
    <script src="{{ $assets }}/plugins/fancyuploder/fancy-uploader.js"></script> --}}
    <!-- File uploads js -->
   {{--  <script src="{{ $assets }}/plugins/fileupload/js/dropify.js"></script>
    <script src="{{ $assets }}/js/filupload.js"></script> --}}
    <script type="text/javascript">

         //I added event handler for the file upload control to access the files properties.
        document.addEventListener("DOMContentLoaded", init, false);

        //To save an array of attachments 
        var AttachmentArray = [];

        //counter for attachment array
        var arrCounter = 0;

        //to make sure the error message for number of files will be shown only one time.
        var filesCounterAlertStatus = false;

        //un ordered list to keep attachments thumbnails
        var ul = document.createElement('ul');
        ul.className = ("thumb-Images");
        ul.id = "imgList";

        function init() {
            //add javascript handlers for the file upload event
            document.querySelector('#files').addEventListener('change', handleFileSelect, false);
        }

        //the handler for file upload event
        function handleFileSelect(e) {
            //to make sure the user select file/files
            if (!e.target.files) return;

            //To obtaine a File reference
            var files = e.target.files;

            // Loop through the FileList and then to render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

                //instantiate a FileReader object to read its contents into memory
                var fileReader = new FileReader();

                // Closure to capture the file information and apply validation.
                fileReader.onload = (function (readerEvt) {
                    return function (e) {
                        
                        //Apply the validation rules for attachments upload
                        ApplyFileValidationRules(readerEvt)

                        //Render attachments thumbnails.
                        RenderThumbnail(e, readerEvt);

                        //Fill the array of attachment
                        FillAttachmentArray(e, readerEvt)
                    };
                })(f);

                // Read in the image file as a data URL.
                // readAsDataURL: The result property will contain the file/blob's data encoded as a data URL.
                // More info about Data URI scheme https://en.wikipedia.org/wiki/Data_URI_scheme
                fileReader.readAsDataURL(f);
            }
            document.getElementById('files').addEventListener('change', handleFileSelect, false);
        }

        //To remove attachment once user click on x button
        jQuery(function ($) {
            $('div').on('click', '.img-wrap .close', function () {
                var id = $(this).closest('.img-wrap').find('img').data('id');

                //to remove the deleted item from array
                var elementPos = AttachmentArray.map(function (x) { return x.FileName; }).indexOf(id);
                if (elementPos !== -1) {
                    AttachmentArray.splice(elementPos, 1);
                }

                //to remove image tag
                $(this).parent().find('img').not().remove();

                //to remove div tag that contain the image
                $(this).parent().find('div').not().remove();

                //to remove div tag that contain caption name
                $(this).parent().parent().find('div').not().remove();

                //to remove li tag
                var lis = document.querySelectorAll('#imgList li');
                for (var i = 0; li = lis[i]; i++) {
                    if (li.innerHTML == "") {
                        li.parentNode.removeChild(li);
                    }
                }

            });
        }
        )

        //Apply the validation rules for attachments upload
        function ApplyFileValidationRules(readerEvt)
        {
            //To check file type according to upload conditions
            if (CheckFileType(readerEvt.type) == false) {
                alert("The file (" + readerEvt.name + ") does not match the upload conditions, You can only upload jpg/png/gif files");
                e.preventDefault();
                return;
            }

            //To check file Size according to upload conditions
            if (CheckFileSize(readerEvt.size) == false) {
                alert("The file (" + readerEvt.name + ") does not match the upload conditions, The maximum file size for uploads should not exceed 30 MB");
                e.preventDefault();
                return;
            }

            //To check files count according to upload conditions
            if (CheckFilesCount(AttachmentArray) == false) {
                if (!filesCounterAlertStatus) {
                    filesCounterAlertStatus = true;
                    alert("You have added more than 10 files. According to upload conditions you can upload 10 files maximum");
                }
                e.preventDefault();
                return;
            }
        }

        //To check file type according to upload conditions
        function CheckFileType(fileType) {
            if (fileType == "image/jpeg") {
                return true;
            }
            else if (fileType == "image/png") {
                return true;
            }
            else if (fileType == "image/gif") {
                return true;
            }
            else {
                return false;
            }
            return true;
        }

        //To check file Size according to upload conditions
        function CheckFileSize(fileSize) {
            if (fileSize < 30000000) {
                return true;
            }
            else {
                return false;
            }
            return true;
        }

        //To check files count according to upload conditions
        function CheckFilesCount(AttachmentArray) {
            //Since AttachmentArray.length return the next available index in the array, 
            //I have used the loop to get the real length
            var len = 0;
            for (var i = 0; i < AttachmentArray.length; i++) {
                if (AttachmentArray[i] !== undefined) {
                    len++;
                }
            }
            //To check the length does not exceed 10 files maximum
            if (len > 9) {
                return false;
            }
            else
            {
                return true;
            }
        }

        //Render attachments thumbnails.
        function RenderThumbnail(e, readerEvt)
        {
            var li = document.createElement('li');
            ul.appendChild(li);
            li.innerHTML = ['<div class="img-wrap"> <span class="close">&times;</span>' +
                '<img class="thumb" src="', e.target.result, '" title="', escape(readerEvt.name), '" data-id="',
                readerEvt.name, '"/>' + '</div>'].join('');

            var div = document.createElement('div');
            div.className = "FileNameCaptionStyle";
            li.appendChild(div);
            div.innerHTML = [readerEvt.name].join('');
            document.getElementById('Filelist').insertBefore(ul, null);
        }

        //Fill the array of attachment
        function FillAttachmentArray(e, readerEvt)
        {
            AttachmentArray[arrCounter] =
            {
                AttachmentType: 1,
                ObjectType: 1,
                FileName: readerEvt.name,
                FileDescription: "Attachment",
                NoteText: "",
                MimeType: readerEvt.type,
                Content: e.target.result.split("base64,")[1],
                FileSizeInBytes: readerEvt.size,
            };
            arrCounter = arrCounter + 1;
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
      <li class="breadcrumb-item active" aria-current="page">Create New {{ $title }}</li>
    </ol>
  </div>
</div>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="card-title">Create New  {{ $title }}</div>
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
                                <label for="title"  class="control-label col-lg-2">Nama Fasilitas / Pelayanan<span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" required="" name="nama_fasilitas" placeholder="Nama Fasilitas / Pelayanan">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title"  class="control-label col-lg-2">Kategori<span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <select name="category" class="form-control" required>
                                        <option value="fasilitas">Fasilitas</option>
                                        <option value="layanan">Layanan</option>
                                    </select>
                                </div>
                            </div>

                            

                            

                            <div class="form-group">
                                <label for="description"  class="control-label col-lg-2">{{ __('main.description') }} <span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <textarea class="form-control" id="description_id" name="description">{{ old('description') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo"  class="control-label col-lg-2">File Thumbnail Images <span class="required">*</span></label>
                                <div class="col-lg-12">
                                    <input type="file" class="form-control" name="file_image">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group">
                                <label for="fasilitas_gallery"  class="control-label col-lg-2"><span>Gallery Fasilitas Images</span></label>
                                <br>
                                <label for="fasilitas_gallery"  class="control-label col-lg-12"><span><i>Mohon Blok File Images Untuk Upload Lebih Dari 1 Images</i></span></label>

                                
                                <div class="col-lg-12">
                                   {{--  <div class="form-group mb-0">
                                        <input id="fasilitas_gallery" type="file" name="fasilitas_gallery[]" accept=".jpg, .png, image/jpeg, image/png" multiple>
                                    </div> --}}

                                    <span class="btn btn-success fileinput-button">
                                        <span>Select Attachment</span>
                                        <input type="file" name="fasilitas_gallery[]" id="files" multiple accept="image/jpeg, image/png, image/gif,">
                                        <br />
                                    </span>
                                    <output id="Filelist"></output>



                                </div>
                            </div>


                            <hr>
                            <div class="form-group">
                              <input type="submit" class="btn btn-info" value="Create">

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
