@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', $genericforallproduct->metaTitle)



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

@if (app()->getLocale()=='en' ) @section('pageTitle', $genericforallproduct->metaTitle)
@elseif (app()->getLocale()=='cn' ) @section('pageTitle', $genericforallproduct->metaTitle)
@elseif (app()->getLocale()=='ru' ) @section('pageTitle', $genericforallproduct->metaTitle)
@endif

@if (app()->getLocale()=='en' ) @section('meta_keywords', $genericforallproduct->metaKeywords)
@elseif (app()->getLocale()=='cn' ) @section('meta_keywords', $genericforallproduct->metaKeywordsCN)
@elseif (app()->getLocale()=='ru' ) @section('meta_keywords', $genericforallproduct->metaKeywordsRU)
@endif

@if (app()->getLocale()=='en' ) @section('meta_description', $genericforallproduct->metaDesc)
@elseif (app()->getLocale()=='cn' ) @section('meta_description', $genericforallproduct->metaDescCN)
@elseif (app()->getLocale()=='ru' ) @section('meta_description', $genericforallproduct->metaDescRU)
@endif

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@section('page_content')

<div class="clearfix"></div>
<!-- <div class="clearfix"></div> -->

 <div class="container text-success" id="path-section" style="padding-top: 50px; font-weight: bold;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home_f', app()->getLocale())  }}">{{ __('header.Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">            
            
            {{__('header.show_product_by_generic')}}
        
        </li>
      </ol>
    </nav>

</div>

 

<div class="row">
    <div class="col-md-3 col-sm-12 category mt-30 mb-30">

        <div class="category-col" style="margin-left: 30%;">
    
            <nav class="navbar navbar-default " >
                
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-category-sub-category-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <h2>{{ __('header.show_product_by_generic') }} <hr></h2>
                </div>   
                
                {{-- @php
                    dd($genericforallproducts);
                @endphp --}}
                {{-- <div class="collapse navbar-collapse" id="bs-category-sub-category-navbar-collapse"  style="overflow-y: scroll !important; max-height: 480px;" > --}}
                <div class="collapse navbar-collapse" id="bs-category-sub-category-navbar-collapse" >                    
                    <ul   style="overflow-y: scroll !important; max-height: 280px; margin-left: 0px; list-style: none;" id="desktop_view_generic">
                        @foreach ($genericforallproducts->where('isViewable', 1)->sortBy('genericName') as $item)
                            <li >
                                <a href="{{route('generic_medicine', [app()->getLocale(), Illuminate\Support\Str::slug($item->metaTitle), $item->genericId])}} ">    
                                    @if (app()->getLocale()=='en')    <div style="width: 200px"> {{$item->genericName}} </div>
                                    @elseif (app()->getLocale()=='cn')  <div style="width: 200px"> {{$item->genericNameCN}} <div>
                                    @elseif (app()->getLocale()=='ru')   <div style="width: 200px"> {{$item->genericNameRU}} <div>
                                    @endif
                                    {{-- <i class="flaticon-1-right-arrow" aria-hidden="true"></i> --}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <ul style="overflow-y: scroll !important; max-height: 280px; margin-left: 0px; list-style: none;" id="mobile_view_generic">
                        @foreach ($genericforallproducts->where('isViewable', 1)->sortBy('genericName') as $item)
                            <li>
                                <a href="{{route('generic_medicine', [app()->getLocale(), Illuminate\Support\Str::slug($item->metaTitle), $item->genericId])}}">    
                                    @if (app()->getLocale()=='en')    {{$item->genericName}}
                                    @elseif (app()->getLocale()=='cn')    {{$item->genericNameCN}}
                                    @elseif (app()->getLocale()=='ru')    {{$item->genericNameRU}}
                                    @endif
                                    {{-- <i class="flaticon-1-right-arrow" aria-hidden="true"></i> --}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
    
        </div>
    </div>
    
    
    <div class="col-md-9  padd-30">
            <h1 id="category-section-header-bg" style="text-align: center;">
                @if (app()->getLocale()=='en')    
                    {!! $genericforallproduct->metaTitle !!}
                @elseif (app()->getLocale()=='ru')    
                    {!! $genericforallproduct->metaTitleRU !!}
                @elseif (app()->getLocale()=='cn')    
                    {!! $genericforallproduct->metaTitleCN !!}
                @endif
            </h1>
        <div class="col-md-12 text-center heading">
            {{-- <h1>Trendy</h1> --}}
            {{-- <h1 id="category-section-header-bg" >{{ ($categoryData->sortBy('category'))->pluck('category')->first() }}</h1> --}}
            <!-- <h1 id="category-section-header-bg"  >
                @if (app()->getLocale()=='en')    
                    {{ $genericforallproduct->metaTitle }}
                @elseif (app()->getLocale()=='ru')    
                    {{ $genericforallproduct->metaTitleRU }}
                @elseif (app()->getLocale()=='cn')    
                    {{ $genericforallproduct->metaTitleCN }}
                @endif
            </h1> -->
            <!-- <br> -->
            <!-- <br>
            <br>
            <br> -->
            <h4  >
                @if (app()->getLocale()=='en')
                    @if ($genericforallproduct->description)    
                        {!! $genericforallproduct->description !!}
                    @endif
                @elseif (app()->getLocale()=='ru')  
                    @if ($genericforallproduct->description)    
                        {!! $genericforallproduct->descriptionRU !!}
                    @endif  
                @elseif (app()->getLocale()=='cn')  
                    @if ($genericforallproduct->description)    
                        {!! $genericforallproduct->descriptionCN !!}
                    @endif  
                @endif
            </h4>
        </div>
        <div class="clearfix"></div>
        
        <div class="tranding mt-30">
    
    
                    <div class="row" id="category-subcat-products" >
            
    
                        {{-- products --}}
                        {{-- products --}}
                        {{-- products --}}
    
            
                        @foreach ( $genericbrands->where('genericId', $genericId) as $item)
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-left single-product">
                                <div class="product">
                                        <div class="product-img">
                                            <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $item->genericBrandId ] ) }}" class="product-href"></a>
                                                <img  data-src="{{ asset('/image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $item->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=200&sizeY=200" alt="image" class="lozad img-responsive"   style="max-height: 235px; min-height: 235px"/>
                                        </div>
                                        <div class="product-body" style="max-height: 155px; min-height: 155px">
                                            @if ( (round($reviewData->where('genericBrandId', $item->genericBrandId)->pluck('rating')->first())) > 0)
                                                <p>
                                                    @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $item->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                                        <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                                    @endfor
            
                                                    @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $item->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                                        <i class="fa fa-star" style="color: #ddd !important;"></i>
                                                    @endfor
                                                </p>
                                            @endif
                                                    
                                            <p>
                                                <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $item->genericBrandId ] ) }}">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $item->genericBrand }}
                                                        {{ $item->genericStrength }}
                                                    @elseif (app()->getLocale()=='ru')  
                                                        {{ $item->genericBrandRU }}
                                                        {{ $item->genericStrengthRU }}
                                                    @elseif (app()->getLocale()=='cn')    
                                                        {{ $item->genericBrandCN }}
                                                        {{ $item->genericStrengthCN }}
                                                    @endif
                                                </a>
                                            </p>
            
                                            
            
                                            <h5><strong>
                                                @if (app()->getLocale()=='en')  
                                                    {{ $item->genericName }}  
                                                @elseif (app()->getLocale()=='ru')    
                                                    {{ $item->genericNameRU }}
                                                @elseif (app()->getLocale()=='cn')   
                                                    {{ $item->genericNameCN }} 
                                                @endif
                                                
                                            </strong></h5>
                                            <h5>
                                                
                                                @if (app()->getLocale()=='en')    
                                                    {{ $item->genericCompany }}
                                                @elseif (app()->getLocale()=='ru')    
                                                    {{ $item->genericCompanyRU }}
                                                @elseif (app()->getLocale()=='cn')    
                                                    {{ $item->genericCompanyCN }}
                                                @endif
                                            </h5>
                                        </div>
                                </div>
                            </div>
                        @endforeach
            
            
                        
                        
                    </div>

                    <div id="tag_responsive" class="row">                        
                        @if (app()->getLocale()=='en') 
                            @if (($genericforallproduct->metaKeywords))   
                                {{ tagGenerators($genericforallproduct->metaKeywords) }}
                            @endif
                        @elseif (app()->getLocale()=='ru') 
                            @if (($genericforallproduct->metaKeywordsRU))   
                                {{ tagGenerators($genericforallproduct->metaKeywordsRU) }}
                            @endif 
                        @elseif (app()->getLocale()=='cn') 
                            @if ($genericforallproduct->metaKeywordsCN) 
                                {{ tagGenerators($genericforallproduct->metaKeywordsCN) }}
                            @endif   
                        @endif
                    </div>

                    {{-- @php
                        dd($genericforallproduct);
                    @endphp --}}
        
          </div>
    
        
        
    </div>
</div>


<div class="clearfix"></div>


<style type="text/css">
    .single-product  a {
        float: none;
        padding: 0px;
    }

    @media (max-width: 500px) {
        #tag_responsive{
            margin-left:5%;
            margin-right: 5%;
        }
        #desktop_view_generic{
            display: none;
        }
        #mobile_view_generic{
            display: block;
        }
        
    }

    @media (min-width: 500px) {        
        #desktop_view_generic{
            display: block;
        }
        #mobile_view_generic{
            display: none;
        }
        
    }


</style>



@endsection
