@section('footer_content')




{{-- <script type="text/javascript">

    $(function(){
        $('#customerToAdminContact-Modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget) ;


            var modal = $(this);
            
        });

    });
<!--Modal Popup ends--> --}}



{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
<!--footer-->
<div class="container-fluid footer-sec" style="background-color: #05fd0e14; padding: 30px 50px;">
	
    <div class="clearfix"></div>
    <div class="row" {{-- style="margin-top: 10px;" --}}>
            {{-- BEST TRADING PRODUCT --}}
            {{-- top of portion 1 === best selling products--}}
            {{-- top of portion 1 === best selling products--}}
            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="">
                        <table class="col-md-12 new_best_selling_products table table-hover borderless">
                             <h3>{{ __('slidernewproducts.bestsellingproducts') }}<hr></h3>
                             <tbody >
                                @foreach ( $footer_slider_best_selling_product as $slider_best_selling_product)
                                     <tr style="height: 90px;">
                                        <td class="col-md-4 col-xs-4 col-sm-4">
                                            <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $slider_best_selling_product->genericBrandId ] ) }}" class="product-href">
                                                <img class="lozad" data-src="{{ asset('image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $slider_best_selling_product->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=75&sizeY=75"  alt="image" class="img-responsive"   style="max-width: 75px; max-height: 75px;"/>
                                            </a>
                                        </td>
                                        <td  class="col-md-8" style="padding-left: 10px !important">
                                            <a href="{{route('productDetailsPageCaller', [app()->getLocale(), $slider_best_selling_product->genericBrandId] ) }}" class="product-href">
                                                @if ( (round($reviewData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('rating')->first()))>0 )
                                                    <p style="margin:0px; ">
                                                        @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                                            <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                                        @endfor

                                                        @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                                            <i class="fa fa-star" style="color: #ddd !important;"></i>
                                                        @endfor
                                                    </p>
                                                @endif
                                                <p style="font-size: 15px; color: #0000009e; font-weight: bold;">
                                                    @if (app()->getLocale()=='en')    
                                                            {{ $slider_best_selling_product->genericBrand }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('genericStrength')->first() }}
                                                            
                                                    @elseif (app()->getLocale()=='ru')    
                                                            {{ $slider_best_selling_product->genericBrandRU }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                                    @elseif (app()->getLocale()=='cn')  
                                                            {{ $slider_best_selling_product->genericBrandCN }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('genericStrengthCN')->first() }}
                                                    @endif
                                                </p>
                                                <h5 style="font-weight: 400;">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $slider_best_selling_product->genericName }}
                                                    @elseif (app()->getLocale()=='ru')   
                                                        {{ $slider_best_selling_product->genericNameRU }}
                                                    @elseif (app()->getLocale()=='cn')   
                                                        {{ $slider_best_selling_product->genericNameCN }}
                                                    @endif
                                                </h5>
                                                <h5 style="font-weight: 400;">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $slider_best_selling_product->genericCompany }}
                                                    @elseif (app()->getLocale()=='ru')   
                                                        {{ $slider_best_selling_product->genericCompanyRU }}
                                                    @elseif (app()->getLocale()=='cn')   
                                                        {{ $slider_best_selling_product->genericCompanyCN }}
                                                    @endif
                                                </h5>
                                            </a>
                                        </td>
                                     </tr>
                                @endforeach
                             </tbody>
                         </table> 
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- top of portion 1 === best selling products--}}
            {{-- top of portion 1 === best selling products--}}
            {{-- BEST TRADING PRODUCT --}}


            {{-- NEW PRODUCTS --}}
            {{-- top of portion 2=== new selling products--}}
            {{-- top of portion 2=== new selling products--}}
            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="">

                        <table class="col-md-12 new_best_selling_products table table-hover borderless">
                             <h3>{{ __('slidernewproducts.newproduct') }}<hr></h3>
                             <tbody >
                                @foreach ( $footer_slider_new_selling_product as $slider_new_selling_product)
                                     <tr style="height: 90px;">

                                        <td class="col-md-4 col-xs-4 col-sm-4">
                                            <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $slider_new_selling_product->genericBrandId ] ) }}" class="product-href">
                                                <img class="lozad" data-src="{{ asset('image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $slider_new_selling_product->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=75&sizeY=75"  alt="image"  class="img-responsive"   style="max-width: 75px; max-height: 75px;"/>
                                            </a>
                                        </td>
                                        <td  class="col-md-8"  style="padding-left: 10px !important">
                                            <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $slider_new_selling_product->genericBrandId ] )}}">

                                                @if ( (round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first()))>0 )
                                                <p style="margin:0px; ">
                                                    @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                                        <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                                    @endfor

                                                    @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                                        <i class="fa fa-star" style="color: #ddd !important;"></i>
                                                    @endfor
                                                </p>
                                                @endif
                                                <p style="font-size: 15px; color: #0000009e; font-weight: bold;">
                                                    @if (app()->getLocale()=='en')    
                                                            {{ $slider_new_selling_product->genericBrand }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrength')->first() }}
                                                    @elseif (app()->getLocale()=='ru')    
                                                            {{ $slider_new_selling_product->genericBrandRU }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                                    @elseif (app()->getLocale()=='cn')  
                                                            {{ $slider_new_selling_product->genericBrandCN }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrengthCN')->first() }}
                                                    @endif
                                                </p>
                                                <h5 style="font-weight: 400;">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $slider_new_selling_product->genericName }}
                                                    @elseif (app()->getLocale()=='ru')   
                                                        {{ $slider_new_selling_product->genericNameRU }}
                                                    @elseif (app()->getLocale()=='cn')   
                                                        {{ $slider_new_selling_product->genericNameCN }}
                                                    @endif
                                                </h5>
                                                <h5 style="font-weight: 400;">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $slider_new_selling_product->genericCompany }}
                                                    @elseif (app()->getLocale()=='ru')   
                                                        {{ $slider_new_selling_product->genericCompanyRU }}
                                                    @elseif (app()->getLocale()=='cn')   
                                                        {{ $slider_new_selling_product->genericCompanyCN }}
                                                    @endif
                                                </h5>
                                            </a>
                                        </td>
                                     </tr>
                                @endforeach
                             </tbody>
                         </table> 

                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- top of portion 2=== new selling products--}}
            {{-- top of portion 2=== new selling products--}}
            {{-- NEW PRODUCTS --}}

            {{-- Featured Products --}}
            {{-- top of footer portion 3=== Categories --}}
            {{-- top of footer portion 3=== Categories --}}
            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="">

                        <table class="col-md-12 new_best_selling_products table table-hover borderless">
                             <h3>{{ __('slidernewproducts.featuredproducts') }}<hr></h3>
                             <tbody >
                                @foreach ( $topoffooter3rdportion_category_products_data as $slider_new_selling_product)
                                     <tr style="height: 90px;">
                                        <td class="col-md-4 col-xs-4 col-sm-4">
                                            <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $slider_new_selling_product->genericBrandId]) }}" class="product-href">
                                                <img class="lozad" data-src="{{ asset('image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $slider_new_selling_product->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=75&sizeY=75"  alt="image"  class="img-responsive"   style="max-width: 75px; max-height: 75px;"/>
                                            </a>
                                        </td>
                                        <td  class="col-md-8"  style="padding-left: 10px !important">
                                            <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $slider_new_selling_product->genericBrandId ] ) }}">
                                                @if ( (round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first()))>0 )
                                                    <p style="margin:0px; ">
                                                        @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                                            <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                                        @endfor

                                                        @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                                            <i class="fa fa-star" style="color: #ddd !important;"></i>
                                                        @endfor
                                                    </p>
                                                @endif
                                                <p style="font-size: 15px; color: #0000009e; font-weight: bold;">
                                                    @if (app()->getLocale()=='en')    
                                                            {{ $slider_new_selling_product->genericBrand }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrength')->first() }}
                                                    @elseif (app()->getLocale()=='ru')    
                                                            {{ $slider_new_selling_product->genericBrandRU }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                                    @elseif (app()->getLocale()=='cn')  
                                                            {{ $slider_new_selling_product->genericBrandCN }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrengthCN')->first() }}
                                                    @endif
                                                </p>
                                                <h5 style="font-weight: 400;">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $slider_new_selling_product->genericName }}
                                                    @elseif (app()->getLocale()=='ru')   
                                                        {{ $slider_new_selling_product->genericNameRU }}
                                                    @elseif (app()->getLocale()=='cn')   
                                                        {{ $slider_new_selling_product->genericNameCN }}
                                                    @endif
                                                </h5>
                                                <h5 style="font-weight: 400;">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $slider_new_selling_product->genericCompany }}
                                                    @elseif (app()->getLocale()=='ru')   
                                                        {{ $slider_new_selling_product->genericCompanyRU }}
                                                    @elseif (app()->getLocale()=='cn')   
                                                        {{ $slider_new_selling_product->genericCompanyCN }}
                                                    @endif
                                                </h5>
                                            </a>
                                        </td>
                                     </tr>
                                @endforeach
                             </tbody>
                         </table> 


                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- top of footer portion 3=== Categories --}}
            {{-- top of footer portion 3=== Categories --}}
            {{-- Featured Products --}}

            {{-- Top Rated Products --}}
            {{-- top of footer portion 4=== Categories --}}
            {{-- top of footer portion 4=== Categories --}}
            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="">

                        <table class="col-md-12 new_best_selling_products table table-hover borderless">
                             <h3>{{ __('slidernewproducts.topratedproducts') }}<hr></h3>
                             <tbody >
                                @foreach ( $topoffooter4thportion_category_products_data as $slider_new_selling_product)
                                     <tr style="height: 90px;">
                                        <td class="col-md-4 col-xs-4 col-sm-4">
                                            <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $slider_new_selling_product->genericBrandId ] ) }}" class="product-href">
                                                <img class="lozad" data-src="{{ asset('image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $slider_new_selling_product->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=75&sizeY=75"  alt="image"  class="img-responsive"   style="max-width: 75px; max-height: 75px;"/>
                                            </a>
                                        </td>
                                        <td  class="col-md-8"  style="padding-left: 10px !important">
                                            <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $slider_new_selling_product->genericBrandId ] ) }}">
                                                @if ( (round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())) >0 )
                                                <p style="margin:0px; ">
                                                    @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                                        <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                                    @endfor

                                                    @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                                        <i class="fa fa-star" style="color: #ddd !important;"></i>
                                                    @endfor
                                                </p>
                                                @endif
                                                <p style="font-size: 15px; color: #0000009e; font-weight: bold;">
                                                    @if (app()->getLocale()=='en')    
                                                            {{ $slider_new_selling_product->genericBrand }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrength')->first() }}
                                                    @elseif (app()->getLocale()=='ru')    
                                                            {{ $slider_new_selling_product->genericBrandRU }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                                    @elseif (app()->getLocale()=='cn')  
                                                            {{ $slider_new_selling_product->genericBrandCN }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrengthCN')->first() }}
                                                    @endif
                                                </p>
                                                <h5 style="font-weight: 400;">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $slider_new_selling_product->genericName }}
                                                    @elseif (app()->getLocale()=='ru')   
                                                        {{ $slider_new_selling_product->genericNameRU }}
                                                    @elseif (app()->getLocale()=='cn')   
                                                        {{ $slider_new_selling_product->genericNameCN }}
                                                    @endif
                                                </h5>
                                                <h5 style="font-weight: 400;">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $slider_new_selling_product->genericCompany }}
                                                    @elseif (app()->getLocale()=='ru')   
                                                        {{ $slider_new_selling_product->genericCompanyRU }}
                                                    @elseif (app()->getLocale()=='cn')   
                                                        {{ $slider_new_selling_product->genericCompanyCN }}
                                                    @endif
                                                </h5>
                                            </a>
                                        </td>
                                     </tr>
                                @endforeach
                             </tbody>
                         </table> 

                

                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- top of footer portion 4=== Categories --}}
            {{-- top of footer portion 4=== Categories --}}
            {{-- Top Rated Products --}}

    </div>

    <div class="clearfix"></div>


<hr>


    <div class="clearfix"></div>
    <div class="row" {{-- style="margin-top: 10px;" --}}>

            {{-- COMPANY DETAILS --}}
            {{-- portion 1 === about--}}
            {{-- portion 1 === about--}}
            <hr class="hr-hide-show">
            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="">
                        <p class="mb-0" style="color: #0000008a; font-weight: bold;">
                            @if (app()->getLocale()=='en')
                                {{ $footerportion1Data->portion1Title }}
                            @elseif (app()->getLocale()=='cn')
                                {{ $footerportion1Data->portion1TitleCN }}
                            @elseif (app()->getLocale()=='ru')
                                {{ $footerportion1Data->portion1TitleRU }}
                            @endif
                        </p>
                        <p style="color: #0000008a !important;">
                            @if (app()->getLocale()=='en')
                                {!! $footerportion1Data->portion1Desc !!}
                            @elseif (app()->getLocale()=='cn')
                                {!! $footerportion1Data->portion1DescCN !!}
                            @elseif (app()->getLocale()=='ru')
                                {!! $footerportion1Data->portion1DescRU !!}
                            @endif
                        </p>

                        {{-- SOCIAL LINKS  --}}
                        <div style="display: flex; flex-direction:row">
                            <ul class="list-inline">
                                @foreach ($footerportion1socialsData as $footerportion1social)
                                    <li class="footerportion1-social-icons" 
                                        style="
                                            border: 1px solid;
                                            border-radius: 50%;
                                        " 
                                    >
                                        <a href="{{ $footerportion1social->link }}" target="_blank">
                                            @if ($footerportion1social->iconclass != null)
                                                <i class="{{ $footerportion1social->iconclass }}"></i>
                                            @else
                                                <img src="{{ $footerportion1social->iconsrc }}"  alt="image"  style="max-height: 14px; max-width: 14px;">
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- SOCIAL LINKS  --}}


                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- portion 1 === about--}}
            {{-- portion 1 === about--}}
            {{-- COMPANY DETAILS --}}


            {{-- portion 2=== dynamic pages--}}
            {{-- portion 2=== dynamic pages--}}
            <hr class="hr-hide-show">
            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="">

                        <p class="mb-0" style="color: #0000008a; font-weight: bold;">
                            {{ __('footer.needtoknow') }}
                        </p>

                        <ul class="" style="padding: 0px;">
                            @foreach ($footerportion2pagesData as $footerportion2page)
                                <li class="footerportion2pages" >
                                    <a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),$footerportion2page->pageId ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),$footerportion2page->pageId ) ) }}" target="_blank">

                                        @if (app()->getLocale()=='en')
                                            {{ $footerportion2page->pageTitle }}
                                        @elseif (app()->getLocale()=='cn')
                                            {{ $footerportion2page->pageTitleCN }}
                                        @elseif (app()->getLocale()=='ru')
                                            {{ $footerportion2page->pageTitleRU }}
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- portion 2=== dynamic pages--}}
            {{-- portion 2=== dynamic pages--}}






            {{-- portion 3=== Categories --}}
            {{-- portion 3=== Categories --}}
            <hr class="hr-hide-show">
            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center justify-content-md-center">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="">

                        <p class="mb-0" style="color: #0000008a; font-weight: bold;">
                            {{ __('footer.categories') }}
                        </p>
                            <ul class=""  style="padding: 0px;">
                                @foreach ($footerportion3categoriesData->take(6) as $footerportion3category)
                                    <li class="footerportion2pages" >
                                        <a href="{{ route('productlistPage', [app()->getLocale(),'diseaseCategoryId' => -1 ,'categoryId'=>$footerportion3category->categoryId]) }}">

                                            @if (app()->getLocale()=='en')
                                                {{ $footerportion3category->category }}
                                            @elseif (app()->getLocale()=='cn')
                                                {{ $footerportion3category->categoryCN }}
                                            @elseif (app()->getLocale()=='ru')
                                                {{ $footerportion3category->categoryRU }}
                                            @endif
                                        </a>
                                    </li>
                                @endforeach

                                <li class="footerportion2pages" >
                                    <a href="{{ route('productlistPage', [app()->getLocale(),'diseaseCategoryId' => 0 ,'categoryId'=>''])  }}">

                                        {{__('header.allcategories')}}
                                    </a>
                                </li> 
                                
                                <li class="footerportion2pages" >
                                    <a href="{{ route('blog_f', [app()->getLocale()])  }}">

                                        {{__('blog.blog')}}
                                    </a>
                                </li>  
                            </ul>

                        

                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- portion 3=== Categories --}}
            {{-- portion 3=== Categories --}}


            {{-- portion 4 === address info --}}
            {{-- portion 4 === address info --}}
            <hr class="hr-hide-show">
            <div class="col-lg-3 col-md-6 col-sm-6 d-flex flex-column mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center ">
                      {{-- <i class="mdi mdi-basket icon-lg text-success"></i> --}}
                      <div class="">
                        <p class="mb-0" style="color: #0000008a; font-weight: bold;">
                            @if (app()->getLocale()=='en')
                                {{ $footerportion4Data->portion4Title }}
                            @elseif (app()->getLocale()=='cn')
                                {{ $footerportion4Data->portion4TitleCN }}
                            @elseif (app()->getLocale()=='ru')
                                {{ $footerportion4Data->portion4TitleRU }}
                            @endif
                        </p>
                        <p style="color: #0000008a !important; ">
                            {{--  text-align: justify;  --}}
                            @if (app()->getLocale()=='en')
                                {!! $footerportion4Data->portion4Desc !!}
                            @elseif (app()->getLocale()=='cn')
                                {!! $footerportion4Data->portion4DescCN !!}
                            @elseif (app()->getLocale()=='ru')
                                {!! $footerportion4Data->portion4DescRU !!}
                            @endif
                        </p>
                        <div style="display: flex; flex-direction:row">
                            <ul class="list-inline">
                                @foreach ($footerportion4socialsData as $footerportion4social)
                                    <li class="footerportion1-social-icons" 
                                        style="
                                            border: 1px solid;
                                            border-radius: 50%;
                                        " 
                                    >
                                        <a role="button" href="#"   data-toggle="modal" data-target="#socialDetailModal"
                                            data-socialmediaid='{{ $footerportion4social->socialMediaId }}' 
                                            data-socialmedia='{{ $footerportion4social->socialMedia }}' 
                                            data-iconclass='{{ $footerportion4social->iconclass }}' 
                                            data-iconsrc='{{ $footerportion4social->iconsrc }}' 
                                            data-link='{{ $footerportion4social->link }}' 
                                            data-info='{{ $footerportion4social->info }}' 
                                            data-picpath='{{ $footerportion4social->picPath }}' 
                                        >
                                            @if ($footerportion4social->iconclass != null)
                                                <i class="{{ $footerportion4social->iconclass }}"></i>
                                            @else
                                                <img src="{{ $footerportion4social->iconsrc }}"  alt="image"  style="max-height: 14px; max-width: 14px;">
                                            @endif
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
            </div>
            {{-- portion 4 === address info --}}
            {{-- portion 4 === address info --}}





            
    </div>

    <div class="clearfix"></div>




    <a 
    style="position: fixed;  bottom: 15px; right: 73px; background: #25bb2b; width: 50px; height: 50px; text-decoration: none; -webkit-border-radius: 35px; -moz-border-radius: 35px;    border-radius: 35px;      -webkit-transition: all .3s linear;   -moz-transition: all .3s ease;   -ms-transition: all .3s ease;    -o-transition: all .3s ease;
    transition: all .3s ease;    z-index: 52; width: 57px !important; height: 57px !important; " 
    href="#" data-toggle="modal" data-target="#customerToAdminContact-Modal" >
        <i class="fa fa-envelope" style="color: #fff;  margin: 0; position: relative; left: 11px;  top: 8px;  font-size: 36px;
        -webkit-transition: all .3s ease;      -moz-transition: all .3s ease;     -ms-transition: all .3s ease;      -o-transition: all .3s ease;        transition: all .3s ease;" ></i>
    </a>


    <a target="_blank"
    style="position: fixed;  bottom: 15px; right: 10px; background: #25bb2b; width: 50px; height: 50px; text-decoration: none; -webkit-border-radius: 35px; -moz-border-radius: 35px;    border-radius: 35px;      -webkit-transition: all .3s linear;   -moz-transition: all .3s ease;   -ms-transition: all .3s ease;    -o-transition: all .3s ease;
    transition: all .3s ease;    z-index: 52; width: 57px !important; height: 57px !important; " 
    href="https://wa.me/8801916942634/?text=Hi, Whatsup">
        <i class="fa fa-whatsapp" style="color: #fff;  margin: 0; position: relative; left: 16px;  top: 8px;  font-size: 36px;
        -webkit-transition: all .3s ease;      -moz-transition: all .3s ease;     -ms-transition: all .3s ease;      -o-transition: all .3s ease;        transition: all .3s ease;" ></i>
    </a>




    {{-- <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v7.0'
        });
      };

      (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat"
      attribution=setup_tool
      page_id="309954389668536"
        theme_color="#67b868"
        size="standard"
        >

    </div> --}}

    <style>
        .fb_customer_chat_bubble_animated_no_badge {
            margin-right: 77px;
            margin-bottom: -10px;
        }

        #fb-root iframe {
            margin-right: 57px !important;
            margin-bottom: -10px !important;
        }

        #fb-root svg {
            width: 50px !important;
            height: 50px !important;
        }
    </style>


    
    


 
    
</div>

<div class="container-fluid copy-right" style="background-color: #05fd0e40;">
	<div class="">
    	<div class="col-md-6 col-sm-6 copy-text">
                {{-- <p>© 2019 <a href="#">{{ __('footer.medicineforworld') }}</a>. {{ __('footer.allrightreserved') }}</p> --}}

                @if (app()->getLocale()=='en')
                  {!! $bottomfooter_data->pluck('bottomfooter')->first() !!}
                @elseif (app()->getLocale()=='cn')
                  {!! $bottomfooter_data->pluck('bottomfooterCN')->first() !!}
                @elseif (app()->getLocale()=='ru')
                  {!! $bottomfooter_data->pluck('bottomfooterRU')->first() !!}
                @endif

        </div>
        <div class="col-md-6 col-sm-6 copy-image text-right">
        	{{-- <a href="javascript:void(0)"><img data-src="{{ asset('frontend/img/Payment/pay-1.png') }}"  alt="image"  class="lozad img-responsive" /></a>
            <a href="javascript:void(0)"><img data-src="{{ asset('frontend/img/Payment/pay-2.png') }}"  alt="image"  class="lozad img-responsive" /></a>
            <a href="javascript:void(0)"><img data-src="{{ asset('frontend/img/Payment/pay-3.png') }}"  alt="image"  class="lozad img-responsive" /></a>
            <a href="javascript:void(0)"><img data-src="{{ asset('frontend/img/Payment/pay-4.png') }}"  alt="image"  class="lozad img-responsive" /></a>
            <a href="javascript:void(0)"><img data-src="{{ asset('frontend/img/Payment/pay-5.png') }}"  alt="image"  class="lozad img-responsive" /></a> --}}
        </div>
    </div>
</div>

<style type="text/css" media="screen">
    .footerportion1-social-icons:hover{
        background-color: #24c1449c;
    }
    .footerportion1-social-icons:hover i{
        color: white;
    }

    /* footerportion2pages */
    .footerportion2pages{
        list-style: none;
        line-height: 30px;
    }
    .footerportion2pages a{
        float: none;
    }
    /* footerportion2pages */
</style>





<style type="text/css" media="screen" scoped>
  .new_best_selling_products a {
    padding :  0px !important;
    float :  none !important;
  }
  .new_best_selling_products tr:hover {
    background-color: #5d5d5d0f !important;
  }
</style>


<script type="text/javascript">
  $(document).ready(function() {
    if ($(window).width() < 768) 
    {
         $('.hr-hide-show').show();
         console.log('show')
    }
    else  
    {
         $('.hr-hide-show').hide();
         console.log('hide')
    }
  });
</script>


@include('includes.customer_to_admin_contact')


@endsection