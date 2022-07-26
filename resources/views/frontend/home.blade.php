@extends('layouts.frontend.index')
@section('bodyClass', 'front preload')
@section('navActive', '')
@section('content')

<?php
$home_url = LaravelLocalization::getLocalizedURL(LaravelLocalization::getCurrentLocale(),URL::to('/'));

?>

@section('js_scripts')

<script type="text/javascript">

    @if($infobox->status =='on')
        $ (window).ready (function () {
            setTimeout (function () {
                $ ('#modal-subscribe').modal ("show")
            }, 3000)
        })
    @endif
    
</script>

@endsection


<section class="page-header" style="background-image: url({{ url('images/pages/'.$page->image) }});">
    <div class="container">
        <h2>{!!$pageDescription->name!!}</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ url('/') }}">{{ __('main.home') }}</a></li>
            <li><span>{{$pageDescription->name}}</span></li>
        </ul><!-- /.list-unstyled -->
    </div><!-- /.container -->
</section><!-- /.page-header -->

<section class="career-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="career-one__block">
                    <div class="block-title text-center">
                        <h3>{{$pageDescription->name}}</h3>
                    </div><!-- /.block-title -->
                    
                    {!! $pageDescription->description !!}
                    
                </div><!-- /.career-one__block -->
            </div>
            
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.career-one -->



<div class="modal fade" id="modal-subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">SKIP</span></button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            
            <div class="col-lg-12 col-md-12">
                <div class="blog-one__single" style="margin: -10px;">
                    <div class="blog-one__image">
                        <img src="{{ asset('images/infobox')}}/{{$infobox->image}}" alt="{{ $infobox->title }}">
                        <a href="{{ $infobox->link }}"><i class="fal fa-plus"></i></a>
                    </div><!-- /.blog-one__image -->
                    <div class="blog-one__content">
                        <h3><a href="{{ $infobox->link }}">{{ $infobox->title }}</a>
                        </h3>
                        <a href="{{ $infobox->link }}" class="btn btn-info" style="bottom:7.5px">
                            More Info<i class="far fa-long-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
                
            
        </div>
    </div>
</div>


@endsection