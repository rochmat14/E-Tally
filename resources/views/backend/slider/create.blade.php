@section('sidebarActive', $controller)
@extends('layouts.template.app')
@section('vendor_css')
<link rel="stylesheet" href="{{ asset('/izitoast/css/iziToast.min.css') }}">
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
         <li class="breadcrumb-item">
            <a href="{{ route('dashboard.index') }}" class="d-flex">
               <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24">
                  <path d="M0 0h24v24H0V0z" fill="none"/>
                  <path d="M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3zm5 15h-2v-6H9v6H7v-7.81l5-4.5 5 4.5V18z"/>
                  <path d="M7 10.19V18h2v-6h6v6h2v-7.81l-5-4.5z" opacity=".3"/>
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
            <div class="card-title">{{ $title }}</div>
         </div>
         <div class="card-body">
            <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
               {{ csrf_field() }}
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
                           <li class=""><a href="#tab_general" class="active" data-toggle="tab">General</a></li>
                           <li><a href="#tab_data" data-toggle="tab">Data</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="panel-body tabs-menu-body">
                     <div class="tab-content">
                        <div class="tab-pane active " id="tab_general">
                           <div class="" role="tabpanellang">
                              <div class="panel panel-primary">
                                 <div class="tab-menu-heading">
                                    <div class="tabs-menu ">
                                       <!-- Tabs -->
                                       <ul id="myTabLang" class="nav panel-tabs" role="tablist">
                                          <?php $x=0 ?>
                                          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                          <li  class=""><a {!! $x == 0 ? 'active' : '' !!} href="#tab_content_lang_{!! $localeCode !!}" id="lang-{!! $localeCode !!}-tab" role="tab" data-toggle="tab" aria-expanded="true"> <img alt="" src="/backend/img/flags/{{$localeCode}}.png"> {{ $properties['name'] }}</a></li>
                                          <?php $x++ ?>
                                          @endforeach
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="panel-body tabs-menu-body">
                                    <div class="tab-content">
                                       <div id="myTabLangContent" class="tab-content">
                                          <?php $x=0 ?>
                                          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                          <div role="tabpanellang" class="tab-pane fade {!! $x == 0 ? 'active in' : '' !!}" id="tab_content_lang_{!! $localeCode !!}" aria-labelledby="lang-{!! $localeCode !!}-tab">
                                             <div class="form-group">
                                                <label for="title_{!! $localeCode !!}"  class="control-label col-lg-2">{{ __('main.title') }} <span class="required"></span></label>
                                                <div class="col-lg-10">
                                                   <input type="text" class="form-control" id="title_{!! $localeCode !!}" name="title[{!! $localeCode !!}]" value="{{ old('title.'.$localeCode) }}"> 
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <label for="subtitle_{!! $localeCode !!}"  class="control-label col-lg-2">{{ __('main.subtitle') }} </label>
                                                <div class="col-lg-10">
                                                   <input type="text" class="form-control" id="subtitle_{!! $localeCode !!}" name="subtitle[{!! $localeCode !!}]" value="{{ old('subtitle.'.$localeCode) }}" maxlength="150"> 
                                                </div>
                                             </div>
                                             <div class="form-group">
                                                <label for="button_text_{!! $localeCode !!}"  class="control-label col-lg-2">{{ __('main.button_text') }} <span class="required"></span></label>
                                                <div class="col-lg-10">
                                                   <input type="text" class="form-control" id="button_text_{!! $localeCode !!}" name="button_text[{!! $localeCode !!}]" value="{{ old('button_text.'.$localeCode) }}"> 
                                                </div>
                                             </div>
                                          </div>
                                          <?php $x++ ?>
                                          @endforeach
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <br>
                           </div>
                        </div>
                        <div class="tab-pane  " id="tab_data">
                           <div class="form-group">
                              <label class="control-label col-lg-2">Upload Foto</label>
                              <div class="col-lg-10">
                                 <input type="file" name="image" class="btn btn-primary">
                                 <p>{{ __('main.info_image_slideshow') }}</p>
                              </div>
                           </div>
                           <div class="form-group{{ $errors->has('sort_order') ? ' has-error' : '' }}">
                              <label for="sort_order"  class="control-label col-md-2">{{ __('main.sort_order') }} <span class="required">*</span> </label>
                              <div class="col-md-10">
                                 <input type="text" class="form-control" id="sort_order" name="sort_order" value="{{ old('sort_order') }}" required="">
                                 @if ($errors->has('sort_order'))
                                 <span class="help-block">
                                 <strong>{{ $errors->first('sort_order') }}</strong>
                                 </span>
                                 @endif
                              </div>
                           </div>
                           <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                              <label for="url"  class="control-label col-md-2">URL <span class="required">*</span> </label>
                              <div class="col-md-10">
                                 <input type="text" class="form-control" id="url" name="url" value="{{ old('url') }}" required="">
                                 @if ($errors->has('url'))
                                 <span class="help-block">
                                 <strong>{{ $errors->first('url') }}</strong>
                                 </span>
                                 @endif
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="target" class="col-md-2 control-label">Target <span class="required" aria-required="true"> * </span></label>
                              <div class="col-md-10">
                                 <div class="mt-radio-inline">
                                    <?php
                                       $targetActive = old('target') !== false ? '1' : old('target');
                                       ?>
                                    @foreach (arrTarget() as $k => $v)
                                    <label class="mt-radio">
                                    <input type="radio" name="target" id="target" value="{{ $k }}" {{ $k == $targetActive ? 'checked' : '' }}> {{ $v }}
                                    <span></span>
                                    </label>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <label for="status" class="col-md-2 control-label">{{ __('main.status') }} <span class="required" aria-required="true"> * </span></label>
                              <div class="col-md-10">
                                 <div class="mt-radio-inline">
                                    <?php
                                       $statusActive = old('status') !== false ? '1' : old('status');
                                       ?>
                                    @foreach (arrStatusActive() as $k => $v)
                                    <label class="mt-radio">
                                    <input type="radio" name="status" id="status" value="{{ $k }}" {{ $k == $statusActive ? 'checked' : '' }}> {{ $v }}
                                    <span></span>
                                    </label>
                                    @endforeach
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-actions">
                        <div class="row">
                           <div class="col-md-offset-2 col-md-10">
                              <button type="submit" class="btn btn-success">{{ __('main.submit') }}</button>
                              <a href="{{ LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to( 'dashboard/'.$controller )) }}" class="btn btn-white btn-default">{{ __('main.cancel') }}</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!--/div-->
   </div>
</div>
{{-- Form  --}}
@endsection