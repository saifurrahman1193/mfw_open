@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Wishlist')



<style type="text/css">

      ul li ul li{
        list-style: none;
        font-size: 16px;
        line-height: 35px;
    }

      ul li ul li:hover{
        color : #109510b0;
    }


      ul li ul li a:focus{
        /* color : #cac221; */
        color : #109510b0;

    }

    
</style>


{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@section('page_content')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}"> --}}

<div class="clearfix"></div>

 <div class="container text-success" id="path-section" style="padding-top: 50px; font-weight: bold;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ app()->getLocale()?action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}">{{ __('header.Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('productlist.wishlist') }}</li>
      </ol>
    </nav>

</div>

<div class="container latest-product padd-30">

    <div class="col-md-12 sec-head text-center">
        <h3  id="category-section-header" >
             {{ __('productlist.wishlist') }}
        </h3>
        {{-- <h2>Find your random parts</h2> --}}

        {{-- loader --}}
        <i class="fa fa-refresh fa-spin text-success hidden" id="product-loader"  aria-hidden="true" style="font-size:50px;" ></i>
        {{-- loader --}}


        <span></span><br>
        

        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor egestas orci, vitae ullamcorper risus consectetur id. </p> --}}
    </div>
    <div class="clearfix"></div>


    



    



















    
    
    <div class="col-md-12 mt-30">
    <div class="row" id="category-subcat-products">
        

        @foreach ( $wishlistData as $wishlist)
            <div class=" col-sm-6  col-md-3 col-lg-3 col-xl-3  text-left single-product">
                <div class="product">
                        <div class="product-img">
                            <a href="{{ app()->getLocale()?action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $wishlist->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $wishlist->genericBrandId ) ) }}" class="product-href"></a>
                                <img  data-src="{{ asset($genericbrandpicData->where('genericBrandId', $wishlist->genericBrandId )->pluck('picPath')->first() ) }}" alt="image" class="lozad img-responsive"   style="max-height: 235px; min-height: 235px"/>
                        </div>
                        <div class="product-body" style="max-height: 155px; min-height: 155px">
                            @if ( (round($reviewData->where('genericBrandId', $wishlist->genericBrandId)->pluck('rating')->first())) > 0)
                                <p>
                                    @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $wishlist->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                        <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                    @endfor

                                    @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $wishlist->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                        <i class="fa fa-star" style="color: #ddd !important;"></i>
                                    @endfor
                                </p>
                            @endif

                            <p>
                                <a href="{{ app()->getLocale()?action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $wishlist->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $wishlist->genericBrandId ) ) }}">
                                    @if (app()->getLocale()=='en')    
                                        {{ $wishlist->genericBrand }}
                                        {{ $genericstrengthCompactData->where('genericBrandId', $wishlist->genericBrandId)->pluck('genericStrength')->first() }}
                                    @elseif (app()->getLocale()=='ru')  
                                        {{ $wishlist->genericBrandRU }}
                                        {{ $genericstrengthCompactData->where('genericBrandId', $wishlist->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                    @elseif (app()->getLocale()=='cn')    
                                        {{ $wishlist->genericBrandCN }}
                                        {{ $genericstrengthCompactData->where('genericBrandId', $wishlist->genericBrandId)->pluck('genericStrengthCN')->first() }}
                                    @endif
                                </a>
                            </p>

                            

                            <h5><strong>
                                @if (app()->getLocale()=='en')  
                                    {{ ( $genericbrandData->where('genericBrandId', $wishlist->genericBrandId)->first() )->genericName }}  
                                @elseif (app()->getLocale()=='ru')    
                                    {{ ( $genericbrandData->where('genericBrandId', $wishlist->genericBrandId)->first() )->genericNameRU }}
                                @elseif (app()->getLocale()=='cn')   
                                    {{ ( $genericbrandData->where('genericBrandId', $wishlist->genericBrandId)->first() )->genericNameCN }} 
                                @endif
                                
                            </strong></h5>
                            <h5>
                                
                                @if (app()->getLocale()=='en')    
                                    {{ ( $genericbrandData->where('genericBrandId', $wishlist->genericBrandId)->first() )->genericCompany }}
                                @elseif (app()->getLocale()=='ru')    
                                    {{ ( $genericbrandData->where('genericBrandId', $wishlist->genericBrandId)->first() )->genericCompanyRU }}
                                @elseif (app()->getLocale()=='cn')    
                                    {{ ( $genericbrandData->where('genericBrandId', $wishlist->genericBrandId)->first() )->genericCompanyCN }}
                                @endif
                            </h5>
                        </div>
                </div>
            </div>
        @endforeach
        
        
        
        
        
        {{-- <div class="clearfix"></div> --}}
        
    </div>
    </div>
    <div class="clearfix"></div>
</div>






<style type="text/css">
    .product p {

        color: #5d5d5d;
        font-weight: 600;
        margin-bottom: 0px !important;

    }
</style>






<style type="text/css">
    .single-product  a {

        float: none;
        padding: 0px;

    }


</style>


@endsection
