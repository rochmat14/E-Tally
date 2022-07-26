@section('sidebarActive', $controller)
@extends('layouts.template.app')

@section('vendor_css')


@endsection

@section('css_scripts')
@endsection


@php 
$assets = asset('template_assets');
$user = Auth::user();
@endphp


@section('vendor_js')

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
        
      	
        @if (isset($errors) && $errors->any())
            @foreach ($errors->all() as $error)
                <p class="alert alert-danger">{{ $error }}</p>
            @endforeach
        @endif


        <div class="panel panel-primary">
            <div class="tab-menu-heading">
                <div class="tabs-menu ">
                    <!-- Tabs -->
                    <ul class="nav panel-tabs">
                        <li class=""><a href="#tab_content_general" class="active" data-toggle="tab">General</a></li>
                        <li><a href="#tab_content_data" data-toggle="tab">Data</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel-body tabs-menu-body">
                <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <div class="tab-content">
                    
                    <div class="tab-pane active " id="tab_content_general">
                        
                        <div class="tab-menu-heading">
                            <div class="tabs-menu ">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs">
                                    <?php $x=0 ?>
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                    <li class="">
                                        <a href="#tab_content_lang_{!! $localeCode !!}" class="{!! $x == 0 ? 'active' : '' !!}" data-toggle="tab">
                                            <img alt="" src="/backend/img/flags/{{$localeCode}}.png">
                                            {{ $properties['name'] }}
                                        </a>
                                    </li>
                                        <?php $x++ ?>
                                    @endforeach
                                    
                                </ul>

                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">

                                <?php $x=0 ?>
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div class="tab-pane {!! $x == 0 ? 'active' : '' !!}" id="tab_content_lang_{!! $localeCode !!}">
                                        
                                        <div class="form-group">
                                            <label for="title_{!! $localeCode !!}"  class="control-label col-lg-2">{{ __('main.title') }} <span class="required">*</span></label>
                                            <div class="col-lg-10">
                                                <input type="text" class="form-control" id="title_{!! $localeCode !!}" name="title[{!! $localeCode !!}]" value="{{ $descriptions[$localeCode]->title }}" required="" maxlength="255">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="description_{!! $localeCode !!}"  class="control-label col-lg-2">{{ __('main.description') }} <span class="required">*</span></label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" id="description_{!! $localeCode !!}" name="description[{!! $localeCode !!}]">{!! $descriptions[$localeCode]->description !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $x++ ?>
                                @endforeach

                                
                               
                            </div>
                        </div>



                    </div>

                    <div class="tab-pane  " id="tab_content_data">
                        
                        <div class="form-group{{ $errors->has('published_on') ? ' has-error' : '' }}">
                            <label for="published_on"  class="control-label col-md-2">{{ __('main.published_on') }} <span class="required" aria-required="true"> * </span> </label>
                            <div class="col-md-4">
                                <input type="text" class="date-picker form-control" id="published_on" name="published_on" value="{{ $row->published_on !== Null ? date('d-m-Y H:i:s', strtotime($row->published_on)) : date('d-m-Y H:i:s') }}" required="">
                                @if ($errors->has('published_on'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('published_on') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label for="slug"  class="control-label col-md-2">SEO URL / Slug <span class="required">*</span> </label>
                            <div class="col-md-10">
                                <input type="text" class="form-control text-lowercase" id="slug" name="slug" value="{{ $row->slug }}" required="" maxlength="255">
                                @if ($errors->has('slug'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('slug') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('meta_keyword') ? ' has-error' : '' }}">
                            <label for="meta_keyword"  class="control-label col-md-2">Meta Keyword <span class="required">*</span> </label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="meta_keyword" placeholder="Meta Keyword">{{ $row->meta_keyword }}</textarea>
                                @if ($errors->has('meta_keyword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meta_keyword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('meta_description') ? ' has-error' : '' }}">
                            <label for="meta_description"  class="control-label col-md-2">Meta Description <span class="required">*</span> </label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="meta_description" placeholder="Meta description">{{ $row->meta_description }}</textarea>
                                @if ($errors->has('meta_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('meta_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="category"  class="control-label col-md-2">Category<span class="required">*</span> </label>
                            <div class="col-md-10">
                                <select name="category" class="form-control" required>
                                    <option value="">-- Select Category --</option>
                                    @foreach($category as $key => $value)        
                                        <option value="{{$value->id}}" {!! $value->id == $row->id_category ? 'selected' : '' !!}>{{ $value->name }}</option>
                                    @endforeach

                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('post_tags') ? ' has-error' : '' }}">
                            <label for="post_tags"  class="control-label col-md-2">Tags<span class="required">*</span> </label>
                            <div class="col-md-10">
                                
                                <select class="form-control select2" data-placeholder="Choose Browser" name="post_tags[]" multiple required style="width:100%;">

                                    

                                    @foreach($tags as $key => $value)
                                        @php
                                        if($data_tags){
                                            $data_select = in_array($value->name,$data_tags);
                                            if($data_select){
                                                $select ='selected';
                                            }else{
                                                $select ='';
                                            }
                                        }else{
                                            $select ='';
                                        }
                                        @endphp
                                        <option value="{{ $value->name }}" {{$select}}>
                                            {{ $value->name }}
                                        </option>
                                    @endforeach
                                    
                                    
                                </select>
                                @if ($errors->has('post_tags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('post_tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Upload Foto</label>
                            <div class="col-lg-10">
                                @if ($row->image != '')
                                    <img src="{{ URL::asset('/images/news/')}}/{{ $row->id }}/{{ $row->image }}" style="margin-bottom: 10px;" width="100">
                                @endif
                                <input type="file" name="image" class="btn btn-primary"><br>
                                
                                <p>{{ __('main.info_image_blog') }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-md-2 control-label">{{ __('main.status') }} <span class="required" aria-required="true"> * </span></label>

                            <div class="col-md-10">
                                <div class="mt-radio-inline">
                                    @foreach (arrStatusActive() as $k => $v)
                                        <label class="mt-radio">
                                            <input type="radio" name="status" id="status" value="{{ $k }}" {{ $k == $row->status ? 'checked' : '' }}> {{ $v }}
                                            <span></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>


                    </div>
                    <div style="padding-top: 20px;">
                        <button type="submit" class="btn btn-success">{{ __('main.submit') }}</button>
                        <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller )) }}" class="btn btn-white btn-default">{{ __('main.cancel') }}</a>
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
