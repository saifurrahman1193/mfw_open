@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Product List')



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
        <li class="breadcrumb-item"><a href="{{ route('home_f', app()->getLocale())  }}">{{ __('header.Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            
            @if( request('diseaseCategoryId')==-1 && request('categoryId')>0 )
                @if (app()->getLocale()=='en')   {{ $specific_category->category }} 
                @elseif (app()->getLocale()=='ru')   {{ $specific_category->categoryRU }} 
                @elseif (app()->getLocale()=='cn')   {{ $specific_category->categoryCN }} 
                @endif
            @elseif(  request('diseaseCategoryId')!==null && request('diseaseCategoryId')==0)
                {{__('header.allproducts')}}
            @elseif(   request('diseaseCategoryId')>0 )
                @if (app()->getLocale()=='en')   {{ $specific_category->diseaseCategory }} 
                @elseif (app()->getLocale()=='ru')   {{ $specific_category->diseaseCategoryRU }} 
                @elseif (app()->getLocale()=='cn')   {{ $specific_category->diseaseCategoryCN }} 
                @endif
            @elseif( strpos(Route::current()->uri, 'productlistPage_new_sliderwithpaginate') !== false )
                {{ __('slidernewproducts.newproduct') }}
            @elseif( strpos(Route::current()->uri, 'productlistPage_best_sliderwithpaginate') !== false )
                {{ __('slidernewproducts.bestsellingproducts') }}
            @else
                {{__('header.allproducts')}}
            @endif
        
        </li>
      </ol>
    </nav>

</div>

<div class="container latest-product padd-30">

    <div class="col-md-12 sec-head text-center">
        <h3  id="category-section-header" >
            {{--  {{dd(Route::current()->uri)}}  --}}
            {{--  {{ dd(Route::current()->uri) }}  --}}
            @if( request('diseaseCategoryId')==-1 && request('categoryId')>0 )
                @if (app()->getLocale()=='en')   {{ $specific_category->category }} 
                @elseif (app()->getLocale()=='ru')   {{ $specific_category->categoryRU }} 
                @elseif (app()->getLocale()=='cn')   {{ $specific_category->categoryCN }} 
                @endif
            @elseif(  request('diseaseCategoryId')!==null && request('diseaseCategoryId')==0)
                {{__('header.allproducts')}}
            @elseif(   request('diseaseCategoryId')>0 )
                @if (app()->getLocale()=='en')   {{ $specific_category->diseaseCategory }} 
                @elseif (app()->getLocale()=='ru')   {{ $specific_category->diseaseCategoryRU }} 
                @elseif (app()->getLocale()=='cn')   {{ $specific_category->diseaseCategoryCN }} 
                @endif
            @elseif( strpos(Route::current()->uri, 'productlistPage_new_sliderwithpaginate') !== false )
                {{ __('slidernewproducts.newproduct') }}
            @elseif( strpos(Route::current()->uri, 'productlistPage_best_sliderwithpaginate') !== false )
                {{ __('slidernewproducts.bestsellingproducts') }}
            @else
                {{__('header.allproducts')}}
            @endif
        </h3>
        <br>

        <div class="row" style="margin-bottom: 20px;">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                                              
                <select class="form-control m-bot15"  name="sortby" id="sortby">
                     <option value="3">--{{__('productlist.sortby')}} {{__('productlist.default')}}--</option>
                     
                     <option value="1">{{__('productlist.sortby')}} {{__('productlist.genericname')}} {{__('productlist.ascending')}}</option>
                     <option value="2">{{__('productlist.sortby')}} {{__('productlist.genericname')}} {{__('productlist.descending')}}</option>

                     <option value="3">{{__('productlist.sortby')}} {{__('productlist.brandname')}} {{__('productlist.ascending')}}</option>
                     <option value="4">{{__('productlist.sortby')}} {{__('productlist.brandname')}} {{__('productlist.descending')}}</option>
                     
                     <option value="5">{{__('productlist.sortby')}} {{__('productlist.companyname')}} {{__('productlist.ascending')}}</option>
                     <option value="6">{{__('productlist.sortby')}} {{__('productlist.companyname')}} {{__('productlist.descending')}}</option>

                     <option value="7">{{__('productlist.sortby')}} {{__('productlist.review')}} {{__('productlist.ascending')}}</option>
                     <option value="8">{{__('productlist.sortby')}} {{__('productlist.review')}} {{__('productlist.descending')}}</option>

                     <option value="9">{{__('productlist.sortby')}} {{__('productlist.rating')}} {{__('productlist.ascending')}}</option>
                     <option value="10">{{__('productlist.sortby')}} {{__('productlist.rating')}} {{__('productlist.descending')}}</option>
                </select>
            </div>
        </div>
        {{-- <h2>Find your random parts</h2> --}}

        {{-- loader --}}
        <i class="fa fa-refresh fa-spin text-success hidden" id="product-loader"  aria-hidden="true" style="font-size:50px;" ></i>
        {{-- loader --}}


        <span></span><br>
        

        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor egestas orci, vitae ullamcorper risus consectetur id. </p> --}}
    </div>
    <div class="clearfix"></div>

    



    
    {{-- Categories nav section start--}}
    {{-- Categories nav section start--}}

    <div class="col-md-3 col-sm-12 category mt-30">

        <div class="category-col">
        
        <nav class="navbar navbar-default " >
            
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-category-sub-category-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <h2>{{ __('productlist.categories') }} <hr></h2>
            </div>   
            
            
            <div class="collapse navbar-collapse" id="bs-category-sub-category-navbar-collapse"  style="overflow-y: scroll !important; max-height: 480px; " >
                  <ul class="nav navbar-nav " style="margin-left: 0px;">


                    {{-- all category --}}
                    <li data-toggle="collapse"   data-categoryid="0" data-category="{{__('header.allproducts')}}" data-categoryru="{{__('header.allproducts')}}" data-categorycn="{{__('header.allproducts')}}" class="category-subcategory">
                        <a href="javascript:void(0)"> {{ __('productlist.all') }} 
                            {{ '('.$genericbrandData->count('genericBrandId').')' }}
                            <i class="flaticon-1-right-arrow" aria-hidden="true"></i>
                        </a>
                    </li>
                    {{-- all category --}}



                    @foreach ($categoryData->sortBy('category') as $category)
                        <li data-toggle="collapse"  href="#collapseCat-{{ $category->categoryId }}" data-categoryid="{{ $category->categoryId }}" data-category="{{ $category->category }}" data-categoryru="{{ $category->categoryRU }}" data-categorycn="{{ $category->categoryCN }}" class="category-subcategory">
                            <a href="javascript:void(0)">
                                @if (app()->getLocale()=='en')   {{ $category->category }} 
                                @elseif (app()->getLocale()=='ru')   {{ $category->categoryRU }} 
                                @elseif (app()->getLocale()=='cn')   {{ $category->categoryCN }} 
                                @endif

                                {{ '('.$genericbrandcategoryData->where('categoryId', $category->categoryId)->count('genericBrandId').')' }}
                                 
                                <i class="flaticon-1-right-arrow" aria-hidden="true"></i>
                            </a>
                            <ul class="collapse" id="collapseCat-{{ $category->categoryId }}" >
                                @foreach ( ($diseasecategoryData->where('categoryId', $category->categoryId))->sortBy('diseaseCategory') as $diseasecategory)
                                    <li  data-diseasecategoryid="{{ $diseasecategory->diseaseCategoryId }}" data-diseasecategory="{{ $diseasecategory->diseaseCategory }}" data-diseasecategorycn="{{ $diseasecategory->diseaseCategoryCN }}" data-diseasecategoryru="{{ $diseasecategory->diseaseCategoryRU }}" class="category-subcategory">
                                        <a href="javascript:void(0)">
                                            
                                            @if (app()->getLocale()=='en')    {{ $diseasecategory->diseaseCategory }}
                                            @elseif (app()->getLocale()=='ru')    {{ $diseasecategory->diseaseCategoryRU }}
                                            @elseif (app()->getLocale()=='cn')    {{ $diseasecategory->diseaseCategoryCN }}
                                            @endif

                                            {{--  {{ '('.$genericbrandcategoryData->where('diseaseCategoryId', $diseasecategory->diseaseCategoryId)->count('genericBrandId').')' }}  --}}
                                            {{ '('.$genericbranddieseasecateprodData->where('diseaseCategoryId', $diseasecategory->diseaseCategoryId)->count('genericBrandId').')' }}

                                           {{-- <i class="flaticon-1-right-arrow" aria-hidden="true"></i> --}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endforeach

         
                   

                  </ul>
              
            </div>
        </nav>
        
    </div>

    
    <div class="clearfix"></div>



    {{-- new products portion start --}}
    {{-- new products portion start --}}
    <div class=" category mt-30 max_width_992px" >
        <table class="col-md-12 new_best_selling_products">
             <h3>{{ __('slidernewproducts.newproduct') }}<hr></h3>
             <tbody >
                @foreach ( DB::table('slider_new_selling_products_view')->take(3)->inRandomOrder()->get() as $slider_new_selling_product)
                     <tr style="height: 90px;">

                        <td class="col-md-4">
                            <a href="{{ app()->getLocale()?action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) }}" class="product-href">
                                <img class="lozad" data-src="{{ asset('/image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $slider_new_selling_product->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=75&sizeY=75" alt="image" class="img-responsive"   style="max-width: 75px; max-height: 75px;"/>
                            </a>
                        </td>
                        <td  class="col-md-8">
                            @if (  (round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first()))>0 )

                                    <p>
                                        @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                            <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                        @endfor

                                        @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                            <i class="fa fa-star" style="color: #ddd !important;"></i>
                                        @endfor
                                    </p>
                            @endif

                            
                            <p style="font-size: 15px;">
                                                    

                                @if (app()->getLocale()=='en')    
                                    <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $slider_new_selling_product->genericBrandId ] ) }}">
                                        {{ $slider_new_selling_product->genericBrand }}
                                        {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrength')->first() }}
                                        
                                    </a>
                                @elseif (app()->getLocale()=='ru')    
                                    <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $slider_new_selling_product->genericBrandId ] ) }}">
                                        {{ $slider_new_selling_product->genericBrandRU }}
                                        {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                    </a>
                                @elseif (app()->getLocale()=='cn')  
                                    <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $slider_new_selling_product->genericBrandId ] ) }}">
                                        {{ $slider_new_selling_product->genericBrandCN }}
                                        {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrengthCN')->first() }}

                                    </a>
                                @endif
                            </p>

                            <h5><strong>
                                @if (app()->getLocale()=='en')    
                                    {{ $slider_new_selling_product->genericName }}
                                @elseif (app()->getLocale()=='ru')   
                                    {{ $slider_new_selling_product->genericNameRU }}
                                @elseif (app()->getLocale()=='cn')   
                                    {{ $slider_new_selling_product->genericNameCN }}
                                @endif
                            </strong></h5>
                            <h5>
                                
                                @if (app()->getLocale()=='en')    
                                    {{ $slider_new_selling_product->genericCompany }}
                                @elseif (app()->getLocale()=='ru')   
                                    {{ $slider_new_selling_product->genericCompanyRU }}
                                @elseif (app()->getLocale()=='cn')   
                                    {{ $slider_new_selling_product->genericCompanyCN }}
                                @endif
                            </h5>


                        </td>
                         
                             
                         
                     </tr>
                @endforeach
             </tbody>
         </table> 
    </div>
    {{-- new products portion end --}}
    {{-- new products portion end --}}



    <div class="clearfix"></div>


    {{-- new products portion start --}}
    {{-- new products portion start --}}
    <div class=" category max_width_992px" style="margin-top: 30px;">
        <table class="col-md-12 new_best_selling_products">
             <h3>{{ __('slidernewproducts.bestsellingproducts') }}<hr></h3>
             <tbody >
                @foreach ( DB::table('slider_best_selling_products_view')->take(3)->inRandomOrder()->get() as $slider_best_selling_product)
                     <tr style="height: 90px;">

                        <td class="col-md-4">
                            <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $slider_best_selling_product->genericBrandId ] )  }}" class="product-href">
                                <img class="lozad" data-src="{{ asset('/image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $slider_best_selling_product->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=75&sizeY=75" alt="image" class="img-responsive"   style="max-width: 75px; max-height: 75px;"/>
                            </a>
                        </td>
                        <td  class="col-md-8">

                            @if ( (round($reviewData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('rating')->first())) > 0 )
                                <p>
                                    @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                        <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                    @endfor

                                    @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                        <i class="fa fa-star" style="color: #ddd !important;"></i>
                                    @endfor
                                </p>
                            @endif


                            <p  style="font-size: 15px;">
                                                    

                                @if (app()->getLocale()=='en')    
                                    <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $slider_best_selling_product->genericBrandId ] )  }}">
                                        {{ $slider_best_selling_product->genericBrand }}
                                        {{ $genericstrengthCompactData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('genericStrength')->first() }}
                                        
                                    </a>
                                @elseif (app()->getLocale()=='ru')    
                                    <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $slider_best_selling_product->genericBrandId ] ) }}">
                                        {{ $slider_best_selling_product->genericBrandRU }}
                                        {{ $genericstrengthCompactData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                    </a>
                                @elseif (app()->getLocale()=='cn')  
                                    <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $slider_best_selling_product->genericBrandId ] ) }}">
                                        {{ $slider_best_selling_product->genericBrandCN }}
                                        {{ $genericstrengthCompactData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('genericStrengthCN')->first() }}

                                    </a>
                                @endif
                            </p>

                            <h5><strong>
                                @if (app()->getLocale()=='en')    
                                    {{ $slider_best_selling_product->genericName }}
                                @elseif (app()->getLocale()=='ru')   
                                    {{ $slider_best_selling_product->genericNameRU }}
                                @elseif (app()->getLocale()=='cn')   
                                    {{ $slider_best_selling_product->genericNameCN }}
                                @endif
                            </strong></h5>
                            <h5>
                                
                                @if (app()->getLocale()=='en')    
                                    {{ $slider_best_selling_product->genericCompany }}
                                @elseif (app()->getLocale()=='ru')   
                                    {{ $slider_best_selling_product->genericCompanyRU }}
                                @elseif (app()->getLocale()=='cn')   
                                    {{ $slider_best_selling_product->genericCompanyCN }}
                                @endif
                            </h5>


                        </td>
                         
                             
                         
                     </tr>
                @endforeach
             </tbody>
         </table> 
    </div>
    {{-- new products portion end --}}
    {{-- new products portion end --}}

        
       



        <div class="clearfix"></div>
    </div>


    {{-- Categories nav section end--}}
    {{-- Categories nav section end--}}


    



















    
    
    <div class="col-md-9 col-sm-12 mt-30">

        
    

        <div class="row" id="category-subcat-products">
            

            {{-- products --}}
            {{-- products --}}
            {{-- products --}}

            @foreach ( $genericbranddiseasecategoryproductsData as $genericbrandcategory)
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-left single-product">
                    <div class="product">
                            <div class="product-img">
                                <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $genericbrandcategory->genericBrandId ] ) }}" class="product-href"></a>
                                    <img  data-src="{{ asset('/image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $genericbrandcategory->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=200&sizeY=200" alt="image" class="lozad img-responsive"   style="max-height: 235px; min-height: 235px"/>
                            </div>
                            <div class="product-body" style="max-height: 155px; min-height: 155px">
                                @if ( (round($reviewData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('rating')->first())) > 0)
                                    <p>
                                        @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                            <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                        @endfor

                                        @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                            <i class="fa fa-star" style="color: #ddd !important;"></i>
                                        @endfor
                                    </p>
                                @endif

                                <p>
                                    <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $genericbrandcategory->genericBrandId ] ) }}">
                                        @if (app()->getLocale()=='en')    
                                            {{ $genericbrandcategory->genericBrand }}
                                            {{ $genericstrengthCompactData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericStrength')->first() }}
                                        @elseif (app()->getLocale()=='ru')  
                                            {{ $genericbrandcategory->genericBrandRU }}
                                            {{ $genericstrengthCompactData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                        @elseif (app()->getLocale()=='cn')    
                                            {{ $genericbrandcategory->genericBrandCN }}
                                            {{ $genericstrengthCompactData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericStrengthCN')->first() }}
                                        @endif
                                    </a>
                                </p>

                                

                                <h5><strong>
                                    @if (app()->getLocale()=='en')  
                                        {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericName')->first() ) }}  
                                    @elseif (app()->getLocale()=='ru')    
                                        {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericNameRU')->first() ) }}
                                    @elseif (app()->getLocale()=='cn')   
                                        {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericNameCN')->first() ) }} 
                                    @endif
                                    
                                </strong></h5>
                                <h5>
                                    
                                    @if (app()->getLocale()=='en')    
                                        {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericCompany')->first() ) }}
                                    @elseif (app()->getLocale()=='ru')    
                                        {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericCompanyRU')->first() ) }}
                                    @elseif (app()->getLocale()=='cn')    
                                        {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericCompanyCN')->first() ) }}
                                    @endif
                                </h5>
                            </div>
                    </div>
                </div>
            @endforeach


            
            
        </div>



        <div id="pagination" class="text-center">
            <ul class="pagination ">
                {{-- {{dd($genericbranddiseasecategoryproductsData)}} --}}

                @if ($genericbranddiseasecategoryproductsData->lastPage()>1)
                    @if (request('genericCompanyId')>0)
                        @for ($i = 1; $i <= $genericbranddiseasecategoryproductsData->lastPage(); $i++)
                            <li class="page-link {{$genericbranddiseasecategoryproductsData->currentPage()==$i?'active':''}}" ><a class="page-item " style="cursor: pointer;" href="#" onclick="return productGetter('/{{ app()->getLocale() }}/home/homecategorysection/productlistPageTopBrandsProductsWithPaginate/{{request('genericCompanyId')}}?page={{$i}}')"  >{{$i}}</a></li>
                        @endfor
                    @elseif (request('diseaseCategoryId')==0)
                        @for ($i = 1; $i <= $genericbranddiseasecategoryproductsData->lastPage(); $i++)
                            <li class="page-link {{$genericbranddiseasecategoryproductsData->currentPage()==$i?'active':''}}" ><a class="page-item " style="cursor: pointer;" href="#" onclick="return productGetter('/{{ app()->getLocale() }}/home/homecategorysection/getHomeDiseaseCategoryProductsWithPaginate/0?page={{$i}}')"  >{{$i}}</a></li>
                        @endfor
                    @elseif( request('diseaseCategoryId')==-1 && request('categoryId')>0)
                        @for ($i = 1; $i <= $genericbranddiseasecategoryproductsData->lastPage(); $i++)
                            <li class="page-link {{$genericbranddiseasecategoryproductsData->currentPage()==$i?'active':''}}" ><a class="page-item " style="cursor: pointer;" href="#" onclick="return productGetter('/{{ app()->getLocale() }}/home/homecategorysection/getHomeCategoryProductsWithPaginate/{{request('categoryId')}}?page={{$i}}')"  >{{$i}}</a></li>
                        @endfor
                    @else
                        @for ($i = 1; $i <= $genericbranddiseasecategoryproductsData->lastPage(); $i++)
                            <li class="page-link {{$genericbranddiseasecategoryproductsData->currentPage()==$i?'active':''}}" ><a class="page-item " style="cursor: pointer;" href="#" onclick="return productGetter('/{{ app()->getLocale() }}/home/homecategorysection/getHomeDiseaseCategoryProductsWithPaginate/{{request('diseaseCategoryId')}}?page={{$i}}')"  >{{$i}}</a></li>
                        @endfor
                    @endif
                @endif


            </ul>
        </div>


    </div>
    <div class="clearfix"></div>
    
</div>




<script type="text/javascript">
    $(document).ready(function() {
        $('ul > li > ul > li').on('click', function(e) { e.stopPropagation(); });
    });
</script>



<style type="text/css">
    .product p {

        color: #5d5d5d;
        font-weight: 600;
        margin-bottom: 0px !important;

    }
</style>





<script type="text/javascript">
    $(document).ready(function() 
    {
        $('.category-subcategory').on('click', function(e) 
        { 
            $("#product-loader").removeClass("hidden");

              var categoryId = $(this).data('categoryid');
              var category = $(this).data('category');
              var categoryRU = $(this).data('categoryru');
              var categoryCN = $(this).data('categorycn');
              // console.log(categoryId)  

              var diseaseCategoryId = $(this).data('diseasecategoryid');
              var diseaseCategory = $(this).data('diseasecategory');
              var diseaseCategoryRU = $(this).data('diseasecategoryru');
              var diseaseCategoryCN = $(this).data('diseasecategorycn');
              // console.log(diseaseCategoryId)  

              $(".noproductsfound").remove();

              if (categoryId>=0) 
              {

                @if (app()->getLocale()=='en')    
                    $('#category-section-header').text(category);
                @elseif (app()->getLocale()=='ru')    
                    $('#category-section-header').text(categoryRU);
                    console.log('categoryRU = '+ categoryRU)
                @elseif (app()->getLocale()=='cn')    
                    $('#category-section-header').text(categoryCN);
                @endif


                $(".single-product").remove();
                
                let url = '/{{ app()->getLocale() }}/home/homecategorysection/getHomeCategoryProductsWithPaginate/'+categoryId;

                productGetter(url)

              }
              else if (diseaseCategoryId>0) 
              {

                @if (app()->getLocale()=='en')    
                    $('#category-section-header').text(diseaseCategory);
                @elseif (app()->getLocale()=='ru')    
                    $('#category-section-header').text(diseaseCategoryRU);
                @elseif (app()->getLocale()=='cn')    
                    $('#category-section-header').text(diseaseCategoryCN);
                @endif



                $(".single-product").remove();

                let url = '/{{ app()->getLocale() }}/home/homecategorysection/getHomeDiseaseCategoryProductsWithPaginate/'+diseaseCategoryId;
                productGetter(url)


              }

         });

         
    });

    
 



    function productGetter(url) {

        $(".noproductsfound").remove();
        $("#product-loader").removeClass("hidden");
        console.log(url)
        
        {{--  url = '{{ app()->getLocale() }}'+url  --}}
        {{--  var locale = '{{ app()->getLocale() }}';
        var urlgenerator = '/'+locale+url

        console.log(locale)
        console.log(urlgenerator)
        console.log(url)  --}}

        $.ajax({
                    url: url,
                    type:"GET",
                    dataType:"json",

                    success:function(data) {

                        $(".single-product").remove();

                        $("#product-loader").addClass(" hidden");

                        // console.log(response);
                        // console.log(response.data.data);
                        // console.log(data);
                        console.log(data.data);
                        console.log(data.data.data);
                        // console.log(data.data.length);


                        if (data.data.data.length==0) 
                        {
                            @if (app()->getLocale()=='en')   
                                $("#category-subcat-products").append('<h1 class="noproductsfound" style="text-align: center;">No Products Found !</h1>'); 
                            @elseif (app()->getLocale()=='ru')   
                                $("#category-subcat-products").append('<h1 class="noproductsfound" style="text-align: center;">Продукты не найдены!</h1>'); 
                            @elseif (app()->getLocale()=='cn')   
                                $("#category-subcat-products").append('<h1 class="noproductsfound" style="text-align: center;">找不到产品！</h1>'); 
                            @endif
                        }

                        
                        $(data.data.data).each(function(index, el) {

                            // console.log('genericBrandId = '+el.genericBrandId+ ', genericBrand = '+el.genericBrand+', category = '+el.category);

                            @if (app()->getLocale()=='en')    
                                var genericBrandVar = el.genericBrand;
                                var genericStrengthVar = el.genericStrength;
                                var genericNameVar = el.genericName;
                                var genericCompanyVar = el.genericCompany;
                    
                            @elseif (app()->getLocale()=='ru')   
                                var genericBrandVar = el.genericBrandRU;
                                var genericStrengthVar = el.genericStrengthRU;
                                var genericNameVar = el.genericNameRU;
                                var genericCompanyVar = el.genericCompanyRU; 
                            
                            @elseif (app()->getLocale()=='cn')  
                                var genericBrandVar = el.genericBrandCN;
                                var genericStrengthVar = el.genericStrengthCN;
                                var genericNameVar = el.genericNameCN;
                                var genericCompanyVar = el.genericCompanyCN;  
                            
                            @endif

                            var totalRatings = '';

                            var ratings =parseInt(el.rating); 
                            if (ratings>=1) {
                                var nonratings =5-ratings; 
                                for (let i = 1; i <= ratings; i++) {
                                    totalRatings =  totalRatings +  '<i class="fa fa-star" style="color: #eec627 !important;"></i>'                             
                                }
                                for (let i = 1; i <= nonratings; i++) {
                                    totalRatings =  totalRatings +  '<i class="fa fa-star" style="color: #ddd !important;"></i>'                             
                                }
                                totalRatings = '<p>'+  totalRatings +'</p>';
                            }

                            
                            $("#category-subcat-products").append(
                        

                                            '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-left single-product"> '
                                                +' <div class="product"> '
                                                    +'<div class="product-img"> '
                                                        +'<a href="'
                                                            +'/{{ app()->getLocale() }}/productDetailsPageCaller/'+el.genericBrandId
                                                        +'" class="product-href"></a>'
                                                        +'<img data-src="/image/imageResize?url='+el.picPath+'&sizeX=200&sizeY=200" alt="image" class="img-responsive lozad"   style="max-height: 235px; min-height: 235px"/>'
                                                    +'</div> '
                                                    +'<div class="product-body" style="max-height: 155px; min-height: 155px"> '

                                                        +totalRatings


                                                        +'<a href="'
                                                            +'/{{ app()->getLocale() }}/productDetailsPageCaller/'+el.genericBrandId
                                                        +'" >'
                                                            +'<p>'
                                                                +genericBrandVar
                                                                    +' '
                                                                +genericStrengthVar
                                                            +'</p>'
                                                        +'</a>'

                                                        +'<h5>'
                                                            +'<strong>'
                                                                +genericNameVar
                                                            +'</strong>'
                                                        +'</h5>'
                                                        +'<h5>'
                                                            +genericCompanyVar
                                                        +'</h5>'

                                                    +'</div>'
                                                +'</div>'
                                            +'</div>' 

                            );

                             // image lazy loading   
                            const observer = lozad();
                            observer.observe();
                             // image lazy loading  


                             

                        });

                        // pagination section of categories



                        $(".pagination").remove()

                        if (data.data.last_page>1) {

                            let paginationList = '';
                            let isActive = '';

                            for (let i = 1; i <= data.data.last_page; i++) {
                                isActive = data.data.current_page == i ? 'active': '';
                                paginationList = paginationList + ' <li class="'+isActive+' page-link" ><a class="page-item " style="cursor: pointer;" href="#"  onclick="return productGetter(\''+data.data.path+'?page='+i+'\')">'+i+'</a></li> '
                            }
                            $("#pagination").append(' <ul class="pagination">'+'<li class="page-item"><a class="page-link"  style="cursor: pointer;" href="#" onclick="return productGetter(\''+data.data.prev_page_url+'\')" ><<</a></li>'+
                            paginationList+
                            '<li class="page-item"><a class="page-link" style="cursor: pointer;"  onclick="return productGetter(\''+data.data.next_page_url+'\')"  href="#"  >>></a></li>'+' </ul>')
                            
                        }

                        


                    },
                    failure: function(){
                        $("#product-loader").addClass(" hidden");
                        // console.log('Failure')
                    },
                    complete: function(){
                        $("#product-loader").addClass(" hidden");
                        // console.log('Complete')

                    }
                });
    }

    

    
</script>





<style type="text/css">
    .single-product  a {

        float: none;
        padding: 0px;

    }
    
    /* new_best_selling_products color */
        .new_best_selling_products p  {
            color: black;
        }

        .new_best_selling_products p:hover  {
            color: #25bb2b;
        }
    /* new_best_selling_products color */

</style>


<style>
    @media (max-width:992px) {
        .max_width_992px {
            display:none;
        }
    }
</style>

<style>
    .pagination>li>a,
    .pagination>li>span {
        border: 1px solid #25bb2b;
        color: #25bb2b;
    }
    .pagination>li.active>a {
        background: #25bb2b;
        color: #fff;
    }
</style>



{{-- dynamic dependent based on generic to generic brand --}}
<script type="text/javascript">
    $(document).ready(function() {
  
        $('select[name="sortby"]').on('change', function(){
            //   var genericCompany =  $('select#genericBrandId').find(':selected').data('genericcompany');
            var sortId =  $('select#sortby').val();
            console.log('sortby = '+ sortId)

            $(".single-product").remove();
            $('#category-section-header').text("{{ __('header.allproducts') }}");
                
            let url = '/{{ app()->getLocale() }}/home/homecategorysection/getHomeProductsWithPaginateWithSort/'+sortId;
            productGetter(url)

        });

    });
</script>


@endsection
