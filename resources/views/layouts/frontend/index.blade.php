<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title === "" ? config('meta_title') : $title }}</title>

    <meta name="keywords" content="{{ $meta_keywords === "" ? config('meta_keywords') : $meta_keywords }}" />
    <meta name="description" content="{{ $meta_description === "" ? config('meta_description') : $meta_description }}" />

    <meta property="fb:app_id" content="rsbh"/>
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $title === "" ? config('meta_title') : $title }}"/>
    <meta property="og:description" content="{{ $meta_description === "" ? config('meta_description') : $meta_description }}" />
    {{-- <meta property="og:url" content="{{ $url }}"/> --}}
    {{-- <meta property="og:image" content="{{ $url_future_image }}" /> --}}



    <link rel="icon" href="{{ url('/images/logo') }}/{{ AppLogo() }}" type="image/x-icon"/>

    <!-- plugins styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo+2:400,500,600,700,800%7CLato:100,300,400,700,900%7COpen+Sans:300,400,600,700,800%7CRoboto:300,400,500,700,900%7CRubik:300,400,500,700,900&display=swap">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/animate.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/hover-min.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/swiper.min.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/oberlin-icons.css">

    <!-- template styles -->
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/style.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/responsive.css">
    <link rel="stylesheet" href="{{ asset('rsbh' )}}/css/swiper.min.css">



    @yield('css_scripts')
    

    <style type="text/css">
        .footer-cert{
            padding-top: 70px;
        }

        .footer-cert-main{
            background-color: #24262b;
            padding-top : 70px;
            padding-bottom : 70px;
            position: relative;
        }
    </style>


    
</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div><!-- /.preloader -->

    <div class="page-wrapper">

        <header class="site-header-three">
            <a href="{{ url('/') }}" class="site-header-three__logo">
                <img src="{{ url('/images/logo') }}/{{ AppLogo() }}" class="site-header-three__main-logo" alt="" style="width: 100px;">
                <img src="{{ asset('images' )}}/logo/logo-mobile.png" width="219" class="site-header-three__mobile-logo" alt="">
                <span class="side-menu__toggler"><i class="fa fa-bars"></i></span>
            </a>
            <div class="topbar-two">
                <div class="container-fluid">
                    <div class="topbar-two__social">
                        <a href="{{ config('facebook_link')}}" style="background-color:#3b5998"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ config('instagram_link')}}" style="background-color:#C13584"><i class="fab fa-instagram"></i></a>
                        <a href="{{ config('youtube_link')}}" style="background-color:#FF0000"><i class="fab fa-youtube"></i></a>
                        {{-- <a href="#"><i class="fa fa-rss"></i></a> --}}
                    </div><!-- /.topbar-two__social -->
                    <p>
                        {!! config('app_desc') !!}
                    </p>
                    <div class="topbar-two__right">
                        <a href="{{ config('whatsapp_link') }}" class="main-nav-one__cta">
                            <i class="oberlin-icon-whatsapp"></i>
                            <span>On Whatsapp</span>
                            
                        </a><!-- /.main-nav-one__cta -->
                    </div><!-- /.topbar-two__right -->
                </div><!-- /.container-fluid -->
            </div><!-- /.topbar-two -->
            <nav class="main-nav-one main-nav-one__home-three stricky">
                <div class="container-fluid">
                    <div class="inner-container">
                        <div class="main-nav__main-navigation">
                            <ul class="main-nav__navigation-box">
                                <li class="#">
                                    <a href="{{ url('/') }}">Home</a>
                                    
                                </li>
                               
                            </ul><!-- /.main-nav__navigation-box -->
                        </div><!-- /.main-nav__main-navigation -->
                    </div><!-- /.inner-container -->
                </div><!-- /.container -->
            </nav><!-- /.main-nav-one -->

        </header><!-- /.site-header-three -->

        


        @yield('content')

        


        <footer class="site-footer">
            
            <div class="site-footer__main">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-md-5">
                            <div class="footer-widget footer-widget__about">
                                <a href="#"><img src="{{ url('/images/logo') }}/{{ AppLogo() }}" width="120" alt=""></a>
                                <h3 class="footer-widget__title">{!! config('app_name') !!}</h3><!-- /.footer-widget__title -->
                                <p>
                                    {!! config('app_desc') !!}
                                </p>
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-xl-4 col-lg-6 col-md-5 -->
                        <div class="col-xl-2 col-lg-6 col-md-5">
                            <div class="footer-widget footer-widget__links">
                                <h3 class="footer-widget__title">Menu Cepat</h3><!-- /.footer-widget__title -->
                                <ul class="list-unstyled footer-widget__links-list">
                                    <li><a href="{{ url('news') }}">Berita Terbaru</a></li>
                                    <li><a href="{{ url('contact-us') }}">Kontak Kami</a></li>
                                </ul><!-- /.list-unstyled footer-widget__links-list -->
                            </div><!-- /.footer-widget footer-widget__links -->
                        </div><!-- /.col-xl-2 col-lg-6 col-md-5 -->
                        <div class="col-xl-3 col-lg-6 col-md-5">
                            <div class="footer-widget footer-widget__post">
                                <h3 class="footer-widget__title">Berita Terbaru</h3><!-- /.footer-widget__title -->
                                <div class="footer-widget__post-wrap">

                                    

                                </div><!-- /.footer-widget__post-wrap -->
                            </div><!-- /.footer-widget footer-widget__post -->
                        </div><!-- /.col-xl-3 col-lg-6 col-md-5 -->

                        <div class="col-xl-3 col-lg-6 col-md-5">
                            <div class="footer-widget footer-widget__contact">
                                <h3 class="footer-widget__title">Alamat Kami</h3><!-- /.footer-widget__title -->
                                <p>
                                    {!! config('office_address') !!}
                                </p>
                                <p><a href="tel:{{ config('phone_link') }}">{{ config('phone_link') }}</a></p>
                                <p><a href="mailto:{{ config('email_link') }}">{{ config('email_link') }}</a></p>
                            </div><!-- /.footer-widget footer-widget__contact -->
                        </div><!-- /.col-xl-3 col-lg-6 col-md-5 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.site-footer__main -->
            <div class="site-footer__bottom">
                <div class="container">
                    <p>{!! config('footer_text') !!}</p>

                    <ul class="list-unstyled site-footer__menu">
                        <li><a href="{{ url('pages/term-of-service') }}">Terms of Service</a></li>
                        <li><a href="{{ url('pages/privacy-policy') }}">Privacy Policy</a></li>
                    </ul><!-- /.site-footer__menu -->
                </div><!-- /.container -->
            </div><!-- /.site-footer__bottom -->
        </footer><!-- /.site-footer -->


    </div><!-- /.page-wrapper -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>

    <div class="side-menu__block">

        <a href="#" class="side-menu__toggler side-menu__close-btn"><i class="fa fa-times"></i>
            <!-- /.fa fa-close --></a>

        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.side-menu__block-overlay -->
        <div class="side-menu__block-inner ">

            <a href="{{ url('/') }}" class="side-menu__logo"><img src="{{ asset('images' )}}/logo/logo-mobile-light.png" alt=""
                    width="190"></a>
            <nav class="mobile-nav__container">
                <!-- content is loading via js -->
            </nav>
            <p class="side-menu__block__copy">{!! config('footer_text') !!}</p>
            <div class="side-menu__social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-google-plus"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-pinterest-p"></i></a>
            </div>
        </div><!-- /.side-menu__block-inner -->
    </div><!-- /.side-menu__block -->

    <!-- template scripts -->
    <script src="{{ asset('rsbh' )}}/js/jquery.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/isotope.js"></script>
    <script src="{{ asset('rsbh' )}}/js/jquery.ajaxchimp.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/jquery.circleType.js"></script>
    <script src="{{ asset('rsbh' )}}/js/waypoints.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/jquery.lettering.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/jquery.validate.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/TweenMax.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/wow.min.js"></script>
    <script src="{{ asset('rsbh' )}}/js/theme.js"></script>
    <script src="{{ asset('rsbh' )}}/js/swiper.min.js"></script>

    @yield('js_scripts')
    
</body>

</html>