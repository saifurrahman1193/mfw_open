<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">
    {{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

<!-- Mirrored from theme.innovatory.in/Loyal_shop/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Aug 2019 05:28:20 GMT -->
<head>

    {{-- All social media --}}
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=60719fd3a784de0012cc7bc7&product=sop' async='async'></script>
    {{-- All social media --}}

    <!-- Yandex.Metrika counter -->
        <script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        
            ym(71197447, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true,
                webvisor:true
            });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/71197447" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
 <!-- /Yandex.Metrika counter -->



 {{-- Yandex webmaster tools --}}


 {{-- Yandex webmaster tools --}}


 <!-- Global site tag (gtag.js) - Google Analytics -->
 <script async src="https://www.googletagmanager.com/gtag/js?id=G-BRZ7SXEEVM"></script>
 <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());
     
     gtag('config', 'G-BRZ7SXEEVM');
     </script>
 <!-- Global site tag (gtag.js) - Google Analytics -->

    <meta name="google-site-verification" content="oz-54cAtNY2NXTrstX8qreMxwiLNgndxyOw2rxuAHYU" />
    
    <meta name="google-site-verification" content="fjfr1rwZY5FuBsOeyKJ9TX1-u7Kzwb5I4p4KpRXvaKc" />


    {{-- public static function is(  $pattern,  $value); --}}
    {{-- {{dd(  Illuminate\Support\Str::is( '*mfwpharmacy.com*', url('/'))    ) }} --}}

    {{--  @if (Illuminate\Support\Str::is( '*mfwpharmacy.com*', url('/')) )
        <meta http-equiv="refresh" content="1;URL='{{ url('/').'/en' }}'" >
    @endif

    @if (Illuminate\Support\Str::is( '*medicineforworld.cn*', url('/')) )
        <meta http-equiv="refresh" content="1;URL='{{ url('/').'/cn' }}'" >
    @endif

    @if (Illuminate\Support\Str::is( '*medicinefor.world*', url('/')) )
        <meta http-equiv="refresh" content="1;URL='{{ url('/').'/ru' }}'" >
    @endif  --}}

{{-- main meta tags --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="author" content="Medicine For World (MFW)">
<meta http-equiv="refresh" content="1800;URL='{{ Request::fullUrl() }}'" >
{{-- main meta tags --}}


{{-- Canonical Tags --}}
<link rel="canonical" href="https://www.medicineforworld.com.bd">
{{-- Canonical Tags --}}


{{-- <link rel="alternate" hreflang="en"   href='https://www.medicineforworld.com.bd/' /> --}}
<link rel="alternate" href="{{ url('/') }}" hreflang="x-default"/> 

{{-- Choose Language --}}
@if (app()->getLocale()=='en' ) 
{{-- <link rel="alternate" hreflang="en"  href='https://www.medicineforworld.com.bd' /> --}}
{{--  <link rel="alternate" href="{{ url('/') }}/en" hreflang="en"/>   --}}
    <link rel="alternate" href="{{ url('/') }}/en" hreflang="en-us"/> 
@elseif (app()->getLocale()=='cn' )
    <link rel="alternate" hreflang="cn"  href='{{ url('/') }}/cn' />
@elseif (app()->getLocale()=='ru' )
    <link rel="alternate" hreflang="ru"  href='{{ url('/') }}/ru' />
@endif
{{-- Choose Language --}}

<?php 
    $seodefault = Cache::rememberForever('seodefaultdata', function () {
        return DB::table('seodefault')->first();
    });
?>

{{-- View meta description --}}
@if(View::hasSection('meta_description'))
    <meta name="description"   content="@yield('meta_description')" />
    <meta property="og:description"   content="@yield('meta_description')" />
    <meta name="twitter:description" content="@yield('meta_description')">
@else
    @if (app()->getLocale()=='en' ) 
        <meta name="description"   content="{{$seodefault->meta_description }}" />
        <meta property="og:description"   content="{{$seodefault->meta_description }}" />
        <meta name="twitter:description" content="{{$seodefault->meta_description }}">
    @elseif (app()->getLocale()=='cn' )
        <meta name="description"   content="{{$seodefault->meta_descriptionCN }}" />
        <meta property="og:description"   content="{{$seodefault->meta_descriptionCN }}" />
        <meta name="twitter:description" content="{{$seodefault->meta_descriptionCN }}">
    @elseif (app()->getLocale()=='ru' )
        <meta name="description"   content="{{$seodefault->meta_descriptionRU }}" />
        <meta property="og:description"   content="{{$seodefault->meta_descriptionRU }}" />
        <meta name="twitter:description" content="{{$seodefault->meta_descriptionRU }}"> 
    @endif
    
@endif
{{-- View meta description --}}



{{-- View meta keywords --}}
@if(View::hasSection('meta_keywords'))
<meta name="keywords" content="@yield('meta_keywords')">
<title>@yield('pageTitle')</title>
@else
@if (app()->getLocale()=='en' ) 
        <meta name="keywords" content="{{ $seodefault->meta_keywords }}">
        <title>{{ $seodefault->pageTitle }}</title>
    @elseif (app()->getLocale()=='cn' ) 
        <meta name="keywords" content="{{ $seodefault->meta_keywordsCN }}">
        <title>{{ $seodefault->pageTitleCN }}</title>
    @elseif (app()->getLocale()=='ru' ) 
        <meta name="keywords" content="{{ $seodefault->meta_keywordsRU }}">
        <title>{{ $seodefault->pageTitleRU }}</title>
    @endif
@endif
{{-- View meta keywords --}}

{{-- META TAG OG SECTION --}}
@if (strlen(trim($__env->yieldContent('og_url')))>5)
    <meta property="og:url"  content=@yield('og_url') />
    {{-- <link rel="canonical" href=@yield('og_url')> --}}
@else
    <meta property="og:url"  content={{url('/')}} />
    {{-- <link rel="canonical" href={{url('/')}}> --}}
@endif

@if(View::hasSection('og_title'))
    <meta property="og:title"  content="@yield('og_title')" />
    <meta name="twitter:title" content="@yield('og_title')">
@else
    <meta property="og:title"  content="Medicine For World (MFW)"/>
    <meta property="twitter:title"  content="Medicine For World (MFW)"/>
@endif

@if (strlen(trim($__env->yieldContent('og_image')))>5)
    <meta property="og:image"  content=@yield('og_image') />
    <meta name="twitter:image:src" content=@yield('og_image')>
@else
    <meta property="og:image"  content={{ asset('frontend/img/logo.png') }} />
    <meta property="twitter:image:src"  content={{ asset('frontend/img/logo.png') }} />
@endif
{{-- META TAG OG SECTION --}}


{{-- main meta tags --}}
{{-- main meta tags --}}

    {{-- meta tags --}}
    {{-- meta tags --}}
    {{-- <meta property="og:image"         content=@yield('og_image') /> --}}
    {{-- <meta property="og:url"           content="{{ route('home_f') }}" /> --}}
    {{-- <meta property="og:title"         content="Medicine For World" /> --}}
    {{-- meta tags --}}
    {{-- meta tags --}}

    {{-- twitter --}}
    {{-- twitter --}}
    {{-- <link rel="canonical" href=@yield('og_url')> --}}
    {{-- <meta name="twitter:widgets:new-embed-design" content="on"> --}}
    {{-- <meta name="twitter:widgets:csp" content="on"> --}}
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="1193saifur">
    <meta name="twitter:creator" content="1193saifur">
    {{-- <meta name="twitter:description" content="Medicine For World (MFW) is an online based life-saving prescription medicine supplying service from Bangladesh."> --}}
    {{-- <meta name="twitter:image:src" content=@yield('og_image')> --}}
    {{-- twitter --}}
    {{-- twitter --}}


{{-- <meta name="robots" content="noindex"> --}}

{{-- <meta name="robots" content="noindex,nofollow"> --}}
<meta name="robots" content="noodp,nodir,noydir">

<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>
{{-- <link href='https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto+Slab:400,700' rel='stylesheet' type='text/css'> --}}

<style type="text/css" media="screen">
    * { 
         font-family: 'Roboto', sans-serif;
         /* font-family: 'Poppins', sans-serif; */
    }
</style>
<link rel="icon" href="{{ asset('frontend/img/favicon-icon.png') }}" sizes="16x16">
<!--css-->
<link href="{{ asset('frontend/css/style-2.css') }}" rel="stylesheet" type="text/css">
<!--BOOTSTRAP-->
<link href="{{ asset('frontend/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('frontend/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('css/tooltipster.bundle.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<!--fonts-->
<link href="https://fonts.googleapis.com/css?family=Karla:400,700" rel="stylesheet">
<link rel="stylesheet"  href="{{ asset('frontend/css/fileinput.min.css') }}"/>
<link rel="stylesheet"  href="{{ asset('frontend/css/fileinput_theme.min.css') }}"/>

<link href="{{ asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('frontend/fonts/font/flaticon.css') }}" rel="stylesheet" type="text/css">

{{-- flags --}}
{{-- <link rel="stylesheet"  href="{{ asset('frontend/css/flag-icon.min.css') }}"/> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.3.1/css/flag-icon.min.css" rel="stylesheet"/>

<!--slider-->
<link href="{{ asset('frontend/css/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/theme.css') }}" rel="stylesheet">

<!--thumbnail-slider-->
<link rel="stylesheet"  href="{{ asset('frontend/css/lightslider.css') }}"/>

<link rel="stylesheet"  href="{{ asset('frontend/css/jquery-ui.min.css') }}"/>


<!--animation-->
<link href="{{ asset('frontend/css/slider-animation.css') }}" rel="stylesheet">
<!--Revolution-->

{{-- <script src="{{ asset('frontend/../../ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js') }}"></script> --}}

<script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script>

<script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>

<script src="{{ asset('js/tooltipster.bundle.min.js') }}"></script>

<link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/settings.css') }}">
<script src="{{ asset('frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>








<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" >

<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" >
<link rel="stylesheet"  type="text/css"  href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">



<style>
    .dataTables_wrapper:hover .dataTables_paginate:hover .paginate_button:hover, .dataTables_wrapper:focus .dataTables_paginate:focus .paginate_button:focus{
            padding: 5px 9px;
            font-weight: bold;
            background: #03a9f3 !important;
            border: 1px solid #ddd;
            color: white !important;
            cursor: pointer;
            border-radius: 20px;
            margin: 0px 3px;
        }


        .dataTables_wrapper .dataTables_paginate .paginate_button {
            text-decoration: none;
            padding: 3px 7px;
            background: white;
            border-color: #03a9f3;
            color: black;
        }

        div.dataTables_wrapper div.dataTables_filter input{

            border: 1px solid #00B4CC;
            padding: 5px;
            height: 20px;
            border-radius: 3px;
            outline: none;
            width: 30vw;
            padding: 13px;

        }
        .current{
            padding: 3px 7px;
            font-weight: bold;
            background: #03a9f3 !important;
            border: 1px solid #ddd;
            color: white !important;
            cursor: pointer;
            border-radius: 20px;
        }

        #tdtableaction
        {
          /* padding: 0px 20px; */
          padding:  0px;
          font-size: 25px;
          text-align: center;
        }

        div.dataTables_wrapper div.dataTables_length select {
            border: 1px solid #00000026;
            padding: 7px;
            margin: 0px 7px;
        }

</style>



<style type="text/css" media="screen">
    .form-group.required .control-label:after {
      content:"*";
      color:red;
    }
</style>


<style type="text/css">
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        margin-top: 6px;
        height: 20px;
    }
</style>


<style>
    
    [data-f-id="pbf"] {
        color: #fff0 !important;
        font-size: 0px !important;
        width: 0px !important;
        height: 0px !important;
        padding: 0px !important;
        margin: 0px !important;
    }
</style>



<style type="text/css">
  .tranding .owl-prev, .tranding .owl-next {
    background-color: rgb(104, 204, 103) !important;
  }
  .tranding .owl-prev i, .tranding .owl-next i{
    color: #fff !important;
  }
  .category-col .navbar-default .navbar-nav > li > a i{
    color: #14f227;
  }

  .trendy-sec .tranding .owl-next i, .trendy-sec .tranding .owl-prev i {
        color: rgba(255, 255, 255, .9) !important;
    }

    .blog-sec .tranding .owl-next i, .blog-sec .tranding .owl-prev i {
        color: rgba(255, 255, 255, .9) !important;
    }

    

  

</style>




<style type="text/css" media="screen">
    .breadcrumb a:hover{
        text-decoration: underline !important;
    }
</style>


<style type="text/css" media="screen">
    input[type='number'] {
        -moz-appearance:textfield;
    }
</style>

<style type="text/css" media="screen">
    .control-label{
        text-align: left !important;
    }
</style>


{{-- ratings --}}
{{-- ratings --}}
<style type="text/css" media="screen">
    .rating2 {
    display: inline-block;
}

.rating2:not(:checked) > input {
    display:none;
}

.rating2:not(:checked) > label {
    float: right;
    width: 28px;
    padding: 0 4px;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 200%;
    line-height: 1.2;
    color: #ddd;
    filter: saturate(0);
    -webkit-filter: saturate(0);
    -moz-filter: saturate(0);
    -o-filter: saturate(0);
    
}

.rating2:not(:checked) > label:before {
    content: url("{{ asset('images/star.png') }}") ' ';
}

.rating2 > input:checked ~ label {
    filter: saturate(1);
    -webkit-filter: saturate(1);
    -moz-filter: saturate(1);
    -o-filter: saturate(1);
}

.rating2:not(:checked) > label:hover,
.rating2:not(:checked) > label:hover ~ label {
    filter: hue-rotate(-50deg);
    -webkit-filter: hue-rotate(-50deg);
    -moz-filter: hue-rotate(-50deg);
    -o-filter:hue-rotate(-50deg);
    
}

.rating2 > input:checked + label:hover,
.rating2 > input:checked + label:hover ~ label,
.rating2 > input:checked ~ label:hover,
.rating2 > input:checked ~ label:hover ~ label,
.rating2 > label:hover ~ input:checked ~ label {
    filter: hue-rotate(-50deg);
    -webkit-filter: hue-rotate(-50deg);
    -moz-filter: hue-rotate(-50deg);
    -o-filter:hue-rotate(-50deg);
    
}
</style>
{{-- ratings --}}
{{-- ratings --}}


<style type="text/css" media="screen">
    .borderless tr td {
        border: none !important;
        padding: 0px !important;
    }
</style>

<style>
    .btn-file span{
        display: none;
    }
    .fileinput-upload-button{
        display: none;
    }

    .fileinput-remove-button span{
        display: none;
    }
    .file-upload-indicator{
        display: none;
    }
    .file-caption-name::placeholder{
        color: transparent;
    }
</style>

</head>

<body>

{{-- <a href="javascript:" id="return-to-top"><i class="fa fa-angle-up"></i></a> --}}

<!--header-->
@yield('header_content')

{{-- search content --}}
@yield('search_content')
@yield('search_without_search_bar_content')

<!--page content-->
@yield('page_content')

<!--Slider-->
@yield('slider_content')

<!--Product-->
@yield('product_content')

<!--slider_new_selling_products_content-->
@yield('slider_new_selling_products_content')

<!--slider_best_selling_products_content-->
@yield('slider_best_selling_products_content')

<!--Slider-->
{{-- <div class="container-fluid slider-sec">
    <div class="container">
        
        <div class="slider-inner">
            <div id="carousel-example-generic" class="carousel slide">
    
             
              <div class="carousel-inner" role="listbox">
        
                
                <div class="item active">
        
                  <div class="carousel-caption">
                  
                    <div class="col-sm-6 col-md-6" data-animation="animated bounceInLeft">
                    <div class="img-info">
                        <h5>Bedroom</h5>
                        <span></span>
                        <h2>Simplicity beats complexity.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ves tibulum port titor egestas orci, vitae ullamcorper.</p>
                        <h4>Start at <b>$149.00</b></h4>
                        <a href="#" class="def-btn bg">Shop now</a>
                        <img src="{{ asset('frontend/img/index-2/bed-icon.png')}}" class="img-responsive" alt="" />
                    </div>
                    </div>
                    
                    <div class="col-md-offset-4 col-md-8" data-animation="animated bounceInRight"><img src="{{ asset('frontend/img/index-2/slide-1-img.jpg')}}" alt="" class="img-responsive" /></div>
                    <div class="clearfix"></div>
                  </div>
                  
                </div> 
                
              
                <div class="item">
        
                  <div class="carousel-caption">
                  
                    <div class="col-sm-6 col-md-6" data-animation="animated bounceInLeft">
                    <div class="img-info">
                        <h5>Bedroom</h5>
                        <span></span>
                        <h2>Simplicity beats complexity.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ves tibulum port titor egestas orci, vitae ullamcorper.</p>
                        <h4>Start at <b>$149.00</b></h4>
                        <a href="#" class="def-btn bg">Shop now</a>
                        <img src="{{ asset('frontend/img/index-2/bed-icon.png')}}" alt="" class="img-responsive" />
                    </div>
                    </div>
                    
                    <div class="col-md-offset-4 col-md-8" data-animation="animated bounceInRight"><img src="{{ asset('frontend/img/index-2/slide-1-img.jpg')}}" alt="" class="img-responsive" /></div>
                    <div class="clearfix"></div>
                  </div>
                  
                </div> 
        
              </div>
        
              
              <a class="left carousel-control def-btn" href="#carousel-example-generic" role="button" data-slide="prev">
                <span><i class="flaticon-2-left-arrow"></i> Prev</span>
              </a>
              <a class="right carousel-control def-btn" href="#carousel-example-generic" role="button" data-slide="next">
                <span>Next <i class="flaticon-1-right-arrow"></i></span>
              </a>
            </div>
        </div>
        
        <div class="banner-sec">
            
            <div class="col-sm-6 banner-left">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="img-hover">
                        <img src="{{ asset('frontend/img/index-2/banner-1.jpg')}}" alt="" class="img-responsive" />
                            <div class="banner-link">
                            <h2><a href="#">Reclaimed Steel Chair Trends</a></h2>
                            <a href="#" class="shop-btn">Shop now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="img-hover">
                        <img src="{{ asset('frontend/img/index-2/banner-2.jpg')}}" alt="" class="img-responsive" />
                            <div class="banner-link">
                            <h2><a href="#">Reclaimed Wood Sofa Trends</a></h2>
                            <a href="#" class="shop-btn">Shop now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            </div>
                    </div>
                    </div>
                    <div class="col-sm-12">
                    <div class="img-hover">
                        <img src="{{ asset('frontend/img/index-2/banner-3.jpg')}}" alt="" class="img-responsive" />
                        <div class="banner-link">
                            <h2><a href="#">Reclaimed Wooden Table Trends</a></h2>
                            <a href="#" class="shop-btn">Shop now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 banner-right">
            <div class="img-hover">
                <img src="{{ asset('frontend/img/index-2/banner-4.jpg')}}" alt="" class="img-responsive" />
                <div class="banner-link">
                            <h2><a href="#">Reclaimed black Wood Table Trends</a></h2>
                            <a href="#" class="shop-btn">Shop now <i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>            </div>
            </div>
       
        </div>
        
    </div>
    
</div> --}}

<!--Featured-product-->
@yield('featured_product_content')


<!--Trendy products-->
@yield('trendy_products_content')

@yield('genericforallproduct_content')

<!--Testimonial-->
@yield('testimonials_content')

@yield('topbrands_content')

@yield('banner_content')




<!--call-action-->
{{-- <div class="container-fluid call-action-sec padd-60">
<div class="container text-center">
	
    <h2>Transforming spaces. Transforming Lives.</h2>
    <a href="#" class="def-btn">Shop now</a>
    
</div>
</div> --}}

<!--Blog-->
{{-- @yield('blog_content') --}}

<!--newsletter-->
{{-- <div class="container-fluid news-letter">
<div class="container padd-40">
	<div class="col-sm-6 col-md-4 letter">
    	<i class="flaticon-newsletter"></i>
    	<p>Sign up to</p><br>
        <h2>Newsletter</h2>
    </div>
    <div class="col-sm-6 col-md-3 sign-news">
    	<p>Sign up our newslettter and receive $20 coupon for first shopping</p>
    </div>
    <div class="col-sm-12 col-md-5 email-address">
    	<input type="email" name="email" placeholder="Enter your email address" />
        <div class="round">
        <a href="#"><i class="flaticon-paper-plane"></i></a>
        </div>
    </div>
</div>
</div> --}}

@yield('footer_content')






<!--Model Popup starts-->
<div class="modal fade" id="socialDetailModal" tabindex="-1" role="dialog" aria-labelledby="socialDetailModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="min-height: 250px;">
      <div class="modal-header">
        <h3 class="modal-title col-md-11">{{ __('footer.information') }}</h3>
        <button type="button" class="close col-md-1" data-dismiss="modal" aria-label=""><span>×</span></button>
      </div>
      <div class="modal-body" >
             
        
                         
       <div class="row">

            <div class="col-md-6">
              <p id="info" class="mt-5" style="margin: 46px 33px; color: black;"></p>
            </div>

            <div class="col-md-6">
              <img id="picPath" src="" alt="" class="img-fluid img-thumbnail">
            </div>

       </div>

                          


      </div>
    </div>
  </div>
</div>
<!--Model Popup ends-->



<script type="text/javascript">
    $(window).on('load',function(){

            $('#socialDetailModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var socialMediaId = button.data('socialmediaid') ;
              var socialMedia = button.data('socialmedia') ;
              var iconclass = button.data('iconclass') ;
              var iconsrc = button.data('iconsrc') ;
              var link = button.data('link') ;
              var info = button.data('info') ;
              var picPath = button.data('picpath') ;

              var modal = $(this);

              modal.find('.modal-body #socialMediaId').val(socialMediaId);
              modal.find('.modal-body #socialMedia').val(socialMedia);
              modal.find('.modal-body #iconclass').val(iconclass);
              modal.find('.modal-body #iconsrc').val(iconsrc);
              modal.find('.modal-body #link').val(link);
              modal.find('.modal-body #info').text(info);
              modal.find('.modal-body #picPath').attr("src", picPath);

        });

    });
</script>





<!--js-->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/fileinput.min.js') }}"></script>
<script src="{{ asset('frontend/js/file_input_theme.min.js') }}"></script>

<script src="{{ asset('frontend/js/slider-animation.js') }}"></script>
<!-- JS Global-slider -->    
<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('frontend/js/theme.js') }}"></script>
<!--custom-->
<script src="{{ asset('frontend/js/custom.js') }}"></script>
<!--countdown-->
<script src="{{ asset('frontend/js/countdown.js') }}"></script>
<!--slider-->
<script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>

{{-- <script src="{{ asset('frontend/revolution/js/extensions/revolution.extension.video.min.js') }}"></script> --}}


<script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>


<script src="{{ asset('js/select2.min.js') }}" type="text/javascript" charset="utf-8"></script>
<!--Revolution-->	
<script>
var revapi4,
	tpj=jQuery;
			
tpj(document).ready(function() {
	if(tpj("#rev_slider_4_1").revolution == undefined){
		revslider_showDoubleJqueryError("#rev_slider_4_1");
	}else{
		revapi4 = tpj("#rev_slider_4_1").show().revolution({
			sliderType:"standard",
			jsFileLocation:"//localhost/shreekar/wp-content/plugins/revslider/public/assets/js/",
			sliderLayout:"fullwidth",
			dottedOverlay:"none",
			delay:9000,
			navigation: {
				keyboardNavigation:"off",
				keyboard_direction: "horizontal",
				mouseScrollNavigation:"off",
 							mouseScrollReverse:"default",
				onHoverStop:"off",
				touch:{
					touchenabled:"on",
					touchOnDesktop:"off",
					swipe_threshold: 75,
					swipe_min_touches: 50,
					swipe_direction: "horizontal",
					drag_block_vertical: false
				}
				,
				bullets: {
					enable:true,
					hide_onmobile:true,
					hide_under:300,
					style:"uranus",
					hide_onleave:false,
					direction:"vertical",
					h_align:"right",
					v_align:"center",
					h_offset:30,
					v_offset:0,
					space:15,
					tmp:'<span class="tp-bullet-inner"></span>'
				}
			},
			responsiveLevels:[1240,1024,778,480],
			visibilityLevels:[1240,1024,778,480],
			gridwidth:[1500,1024,778,480],
			gridheight:[610,610,500,500],
			lazyType:"none",
			parallax: {
				type:"mouse",
				origo:"slidercenter",
				speed:2000,
				speedbg:0,
				speedls:0,
				levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
			},
			shadow:0,
			spinner:"off",
			stopLoop:"off",
			stopAfterLoops:-1,
			stopAtSlide:-1,
			shuffle:"off",
			autoHeight:"off",
			disableProgressBar:"on",
			hideThumbsOnMobile:"on",
			hideSliderAtLimit:0,
			hideCaptionAtLimit:0,
			hideAllCaptionAtLilmit:0,
			debugMode:false,
			fallbacks: {
				simplifyAll:"off",
				nextSlideOnWindowFocus:"off",
				disableFocusListener:false,
			}
		});
	}
	
});
</script>
<script language=JavaScript>

$(document).keydown(function (event) {
    if (event.keyCode == 123) { // Prevent F12
        return false;
    } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
        return false;
    }
});

$(document).on("contextmenu", function (e) {        
    e.preventDefault();
});

</script>

<!--Light-slider-->
<script src="{{ asset('frontend/js/lightslider.js') }}"></script>
<script>
         $(document).ready(function() {
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:5,
                slideMargin: 0,
                speed:500,
                auto:false,
                loop:true,
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
        });
</script>
<script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>


<script>
        $('.tooltipster').tooltipster({
            theme: 'tooltipster-punk'
        });
       
</script>


<script src="{{ asset('frontend/js/lozad.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        const observer = lozad();
        observer.observe();
    });
</script>




{{-- enable mouse right click --}}
{{-- enable mouse right click --}}
<script type="text/javascript">
    $(document).ready(function(){
        $(document).unbind("contextmenu");
        // OR
        $(document).bind("contextmenu",function(e){
            return true;
        });
    });
</script>
{{-- enable mouse right click --}}
{{-- enable mouse right click --}}


{{-- <script type="{{ asset('frontend/js/bootstrap-rating-input.js') }}"></script> --}}







<script type="text/javascript">
    $(document).ready(function() {
      $('.magnificPopup').magnificPopup({type:'image'});
    });
</script>


<script type="text/javscript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>





<script>
    // $(document).ready(function() {
    //     $('#datatable1').DataTable();

    // } );

    $(document).ready(function() {

        $('#datatable1,#datatable2,#datatable3,#datatable4,#datatable5,#datatable6,#datatable7,#datatable8').DataTable( {
            "pagingType": "simple_numbers",
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            },
        } );


        // with sxrol-x
        $('#datatable1WScroll, #datatable2WScroll,#datatable3WScroll,#datatable4WScroll,#datatable5WScroll,#datatable6WScroll,#datatable7WScroll,#datatable8WScroll').DataTable( {
            "pagingType": "simple_numbers",
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            },
            "scrollX": true,
            "scrollY": false,
            // "ordering": false,
            "responsive": true,
            "autoWidth": false
        } );
    } );
</script>



<!-- Google Analytics -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-XXXX-Y', 'auto');
    ga('send', 'pageview');
    
</script>
<!-- End Google Analytics -->


<style>
    @media (max-width: 767px) {
        h2{
            font-size: 22px !important;
        }
        h3{
            font-size: 20px !important;
        }
    }
</style>


<style>
    @media not all and (min-resolution:.001dpcm)
    { 
        @supports (-webkit-appearance:none) {
            #skype_skype{
                display: none;
                visibility: hidden;
            }
            #safari-width-notification{
                /* max-width: 80% !important; */
                text-overflow: ellipsis; /* will make [...] at the end */
                width: 300px; /* change to your preferences */
                white-space: normal; /* paragraph to one line */
                overflow:hidden; /* older browsers */
                /* height: 20px; */
                display: inline-block;                
            }

            .main_slider_responsive_container{
                display: none !important;
			    visibility: hidden !important;
            }
            #safari-height-notification{
                /* border-style: solid; */
            }
            .safari-header-issue-container{
                /* max-height: 51px !important; */
                /* margin-top: 3px !important; */
            }
            .dropdown-menu{
                min-width: 100%;
                /* margin-left: 0 auto; */
            }            

            .safari-mt-neg4{
                margin-top: -10px !important;
            }
        
            .safari-header-issue-profile {
                max-height: 1px !important;
                /* height: 0px !important; */
                margin-bottom: 0px !important; 
                padding-bottom: 0px !important; 
                
            }

            .safari-header-issue li, .safari-header-issue button {
                max-height: 37px !important;
            }

            .safari-header-issue .filter-option{
                max-height: 19px !important;
            }

            .dropdown-menu , .dropdown-menu ul, .dropdown-menu ul li, .dropdown-menu ul li a  {
                z-index: 1111111111111111111111 !important;
                
            }

             .dropdown-menu-safari-issue ul, .dropdown-menu-safari-issue ul li, .dropdown-menu-safari-issue ul li a, .dropdown-menu-safari-issue li {
                background:  rgba(192,254,195,.9) !important;
                color: black !important;
                // b5e0b8
            }

            .dropdown-menu-safari-issue-divider {
                margin: 0px 0px !important;
                background:  #eff9f0 !important;
                color: black !important;
            }

            .dropdown-menu-safari-issue li .active {
                background:  green !important;
                color: white !important;
            }
        }
    }
</style>

    



<!--Modal Popup starts-->
<div class="modal fade" id="hugeDataModal" tabindex="-1" role="dialog" aria-labelledby="hugeDataModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="min-height: 250px;">
      <div class="modal-header">
        <h3 class="modal-title col-md-11"  id="hugeDataModal-title"></h3>
        <button type="button" class="close col-md-1" data-dismiss="modal" aria-label=""><span>×</span></button>
      </div>
      <div class="modal-body" >
        <div class="row">
            <p id="hugeDataModal-body" style="word-wrap: break-word; max-width: 100%; padding: 20px; "></p>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(function(){
        $('#hugeDataModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;

            var title = button.data('title') ;
            var body = button.data('body') ;

            var modal = $(this);

            modal.find('.modal-header #hugeDataModal-title').text(title);
            document.getElementById('hugeDataModal-body').innerHTML = body
        });
    });
</script>
<!--Modal Popup ends-->


<style>
    @media (max-width: 400px) {
        #mfw_video {
            margin: 0% !important;
            width: 100% !important;
        }
    }
    
</style>


<style>
    .justify-text{
        text-align: justify;
        text-justify: inter-word;
    }


    @media (max-width: 767px) {
        .mob-font-12px{
            font-size: 12px !important;
        }

        .title-text{
            font-size: 20px !important;
        }

        .card-title-text{
            font-size: 18px !important;
        }

        .card-text{
            font-size: 12px !important;
            line-height: 20px;
        }
    }

    @media (min-width: 768px) {
        .title-text{
            font-size: 35px !important;
        }

        .card-title-text{
            font-size: 24px !important;
        }

        .card-text{
            font-size: 18px !important;
            line-height: 20px;
        }
    }


    

    
</style>

<style >
    .image-hover-cursor-change{
        cursor:zoom-in;
    }
</style>

</body>

</html>
