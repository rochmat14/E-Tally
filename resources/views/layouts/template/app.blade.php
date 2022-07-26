<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>

		<!-- Meta data -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Idetechno" name="description">
		<meta content="Idetechno" name="author">
		<meta name="keywords" content="Idetechno"/>

		<!-- Title -->
  		<title>{{ AppName() }}</title>
		

		@php 

			$assets = asset('template_assets');

		@endphp

		@if(AppThemeBoxes() == 'y')
		{{-- Bokex --}}
		<link href="{{ $assets }}/css/boxed.css" rel="stylesheet" />
		@endif
		<!--Favicon -->
		<link rel="icon" href="{{ url('/images/logo') }}/{{ AppLogo() }}" type="image/x-icon"/>

		<!-- Bootstrap css -->
		<link href="{{ $assets }}/plugins/bootstrap/css/bootstrap.css" rel="stylesheet" />

		<!-- Style css -->
		<link href="{{ $assets }}/css/style.css" rel="stylesheet" />

		<!-- Dark css -->
		<link href="{{ $assets }}/css/dark.css" rel="stylesheet" />

		<!-- Skins css -->
		<link href="{{ $assets }}/css/skins.css" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{ $assets }}/css/animated.css" rel="stylesheet" />

		<!--Sidemenu css -->
        <link id="theme" href="{{ $assets }}/css/closed-sidemenu.css" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="{{ $assets }}/plugins/p-scrollbar/p-scrollbar.css" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ $assets }}/plugins/web-fonts/icons.css" rel="stylesheet" />
		<link href="{{ $assets }}/plugins/web-fonts/font-awesome/font-awesome.min.css" rel="stylesheet">
		<link href="{{ $assets }}/plugins/web-fonts/plugin.css" rel="stylesheet" />

		<!-- simplebar CSS -->
		<link rel="stylesheet" href="{{ $assets }}/plugins/simplebar/css/simplebar.css">

		<!--Daterangepicker css-->
		<link href="{{ $assets }}/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />

		{{-- datatables --}}
		<link href="{{ $assets }}/plugins/datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="{{ $assets }}/plugins/datatable/css/buttons.bootstrap4.min.css"  rel="stylesheet">
		<link href="{{ $assets }}/plugins/datatable/responsive.bootstrap4.min.css" rel="stylesheet" />

		<!-- Select2 css -->
		<link href="{{ $assets }}/plugins/select2/select2.min.css" rel="stylesheet" />


		@yield('vendor_css')

 		@yield('css_scripts')
  		@section('sidebarActive', $controller)


  		<style type="text/css">
  			.ui-datepicker{
  				z-index : 1000 !important;
  			}
  		</style>
  		
	</head>

	<body class="app sidebar-mini {{ AppThemeDashboard() }} {{ AppThemeSidebar() }}">

		<!---Global-loader-->
		<div id="global-loader" >
			<img src="{{ $assets }}/images/svgs/loader.svg" alt="loader">
		</div>

		<div class="page">
			<div class="page-main">
				<!--aside open-->
				{{-- sidebar --}}

        		@include('layouts.template.sidebar')

				<!--aside closed-->

				<div class="app-content main-content">
					<div class="side-app">

						<!--app header-->
        				@include('layouts.template.header')
						<!--/app header-->



						{{-- content --}}
						@yield('content')

						

					</div>
				</div><!-- end app-content-->
			</div>

			<!--Footer-->
			@include('layouts.template.footer')
			<!-- End Footer-->

		</div>

		<!-- Back to top -->
		<a href="#top" id="back-to-top">
			<svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M4 12l1.41 1.41L11 7.83V20h2V7.83l5.58 5.59L20 12l-8-8-8 8z"/></svg>
		</a>

		<!-- Jquery js-->
		<script src="{{ $assets }}/js/vendors/jquery-3.5.1.min.js"></script>

		<!-- Bootstrap4 js-->
		<script src="{{ $assets }}/plugins/bootstrap/popper.min.js"></script>
		<script src="{{ $assets }}/plugins/bootstrap/js/bootstrap.min.js"></script>

		<!--Othercharts js-->
		<script src="{{ $assets }}/plugins/othercharts/jquery.sparkline.min.js"></script>

		<!-- Circle-progress js-->
		<script src="{{ $assets }}/js/vendors/circle-progress.min.js"></script>

		<!-- Jquery-rating js-->
		<script src="{{ $assets }}/plugins/rating/jquery.rating-stars.js"></script>

		<!--Sidemenu js-->
		<script src="{{ $assets }}/plugins/sidemenu/sidemenu.js"></script>

		<!-- P-scroll js-->
		<script src="{{ $assets }}/plugins/p-scrollbar/p-scrollbar.js"></script>
		<script src="{{ $assets }}/plugins/p-scrollbar/p-scroll1.js"></script>

		<!--Moment js-->
		<script src="{{ $assets }}/plugins/moment/moment.js"></script>

		<!-- Daterangepicker js-->
		<script src="{{ $assets }}/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="{{ $assets }}/js/daterange.js"></script>

		<!-- ECharts js -->
		<script src="{{ $assets }}/plugins/echarts/echarts.js"></script>

		<!-- Chartjs js -->
		<script src="{{ $assets }}/plugins/chart/chart.bundle.js"></script>
		<script src="{{ $assets }}/plugins/chart/utils.js"></script>

		<!--Morris Charts js-->
		<script src="{{ $assets }}/plugins/morris/raphael-min.js"></script>
		<script src="{{ $assets }}/plugins/morris/morris.js"></script>

		<!-- simplebar JS -->
		<script src="{{ $assets }}/plugins/simplebar/js/simplebar.min.js"></script>

		<!-- Index js-->
		<script src="{{ $assets }}/js/index3.js"></script>


		<!--Select2 js -->
		<script src="{{ $assets }}/plugins/select2/select2.full.min.js"></script>
		<script src="{{ $assets }}/js/select2.js"></script>

		<!-- Custom js-->
		<script src="{{ $assets }}/js/custom.js"></script>

		{{-- Swal alert --}}


		<script type="text/javascript">
			$(document).ready(function() {
	            $("ul").sortable({
	                update : function () {
	                    var parent_id = $(this).attr('parent');
	                    var order = $(this).sortable('serialize');
	                    $.ajax({url: "{{url('/') }}/{{ LaravelLocalization::getCurrentLocale() }}/dashboard/pages/reorder/"+parent_id+'?'+order});
	                }
	            });
	        });


	        (function(a){
	            a.treeMely=function(eEl, eUrl, eTarget, eId, eLevel, eCookie){
	                a.eEl = eEl;
	                a.treeMely.initialize=function(){
	                    if (a.treeMely.isExpanded($(eTarget))){
	                        $(eTarget).children('ul').hide();

	                        eEl.attr('src', '{{ url('/') }}/backend/img/expand.png');
	                        $(eTarget).removeClass('children-visible').addClass('children-hidden');
	                        a.treeMely.removeExpandedCookie();
	                    } else{
	                        eEl.attr('src', '{{ url('/') }}/backend/img/collapse.png');
	                        $(eTarget).removeClass('children-hidden').addClass('children-visible');

	                        if ($(eTarget).children('ul').length > 0){
	                            $(eTarget).children('ul').show();
	                        } else{
	                            a.treeMely.ajax(eId, eLevel);
	                        }
	                    }
	                };
	                a.treeMely.isExpanded=function(row){
	                    return row.hasClass('children-visible');
	                };
	                a.treeMely.hasChildren=function(){
	                    return !a.row.hasClass('no-children');
	                };
	                a.treeMely.ajax=function(){
	                    $('#busy-'+eId).show();
	                    $.ajax({url: eUrl+'/'+eId+'/'+eLevel, success: function(msg){
	                        if(parseInt(msg)!=0)
	                        {
	                            $(eTarget).append(msg);
	                            $('#busy-'+eId).hide();
	                            a.treeMely.saveExpandedCookie();

	                            $(".container ul").sortable({
	                                /*handle : '.handle_reorder',*/
	                                update : function () {
	                                    var parent_id = $(this).attr('parent');
	                                    var order = $(this).sortable('serialize');
	                                    $.ajax({url: "{{ url('/') }}/{{ LaravelLocalization::getCurrentLocale() }}/dashboard/form-builder/reorder/"+parent_id+'?'+order});
	                                }
	                            });
	                        }
	                    }
	                    });

	                };
	                a.treeMely.saveExpandedCookie=function(){
	                    $.cookie(eCookie);
	                    var newCookie;
	                    if ($.cookie(eCookie) != null) {
	                        newCookie = $.cookie(eCookie) + ',' + eId;
	                    }
	                    else {
	                        newCookie = eId.toString();
	                    }

	                    $.cookie(eCookie, a.treeMely.unique(newCookie.split(',')).join(","));
	                };
	                a.treeMely.removeExpandedCookie=function(){
	                    var arrCookie = $.cookie(eCookie).split(',');
	                    var arrCookieLength = arrCookie.length;

	                    var newCookie = '';
	                    if (arrCookieLength > 0){
	                        for (var x=0; x<arrCookieLength; x++){
	                            if (arrCookie[x] != eId){
	                                newCookie += arrCookie[x];

	                                if (x < arrCookieLength-1) newCookie += ',';
	                            }
	                        }
	                    }

	                    $.cookie(eCookie, newCookie);
	                };
	                a.treeMely.unique=function(arrayName)
	                {
	                    var newArray=new Array();
	                    label:for(var i=0; i<arrayName.length;i++ )
	                    {
	                        for(var j=0; j<newArray.length;j++ )
	                        {
	                            if(newArray[j]==arrayName[i])
	                                continue label;
	                        }
	                        newArray[newArray.length] = arrayName[i];
	                    }
	                    return newArray;
	                }

	                a.treeMely.initialize();
	            };

	        })(jQuery);
		</script>

		<script src="{{ URL::asset('js/ckeditor/ckeditor.js') }}"></script>
	    <script src="{{ URL::asset('js/jquery-ui/jquery-ui.min.js') }}"></script>
	    <script src="{{ URL::asset('js/jquery-ui/jquery-ui-timepicker-addon.js') }}"></script>
	    <script>
	        $(document).ready(function() {
	            $('.date-picker').datetimepicker({
	                dateFormat: 'dd-mm-yy',
	                timeFormat: 'HH:mm:ss'
	            });

	            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
	                CKEDITOR.replace( 'description_{!! $localeCode !!}' , {
	                extraPlugins: 'uploadimage,html5audio,pagebreak,youtube',
	                height: 500,

	                // Upload images to a CKFinder connector (note that the response type is set to JSON).
	                uploadUrl: '{{ URL::asset('') }}js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',

	                // Configure your file manager integration. This example uses CKFinder 3 for PHP.
	                filebrowserBrowseUrl: '{{ URL::asset('') }}js/ckfinder/ckfinder.html',
	                filebrowserImageBrowseUrl: '{{ URL::asset('') }}js/ckfinder/ckfinder.html?type=Images',
	                filebrowserUploadUrl: '{{ URL::asset('') }}js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
	                filebrowserImageUploadUrl: '{{ URL::asset('') }}js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

	                // The following options are not necessary and are used here for presentation purposes only.
	                // They configure the Styles drop-down list and widgets to use classes.

	                stylesSet: [
	                    { name: 'Narrow image', type: 'widget', widget: 'image', attributes: { 'class': 'image-narrow' } },
	                    { name: 'Wide image', type: 'widget', widget: 'image', attributes: { 'class': 'image-wide' } }
	                ],
	                

	                // Configure the Enhanced Image plugin to use classes instead of styles and to disable the
	                // resizer (because image size is controlled by widget styles or the image takes maximum
	                // 100% of the editor width).
	                image2_alignClasses: [ 'image-align-left', 'image-align-center', 'image-align-right' ],
	                image2_disableResizer: true
	            } );
	            @endforeach
	        });



	        


	    </script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
		@yield('vendor_js')
    	@yield('js_scripts')
	</body>
</html>