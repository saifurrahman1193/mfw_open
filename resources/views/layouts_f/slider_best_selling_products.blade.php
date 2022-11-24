
@section('slider_best_selling_products_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

    <section class="best-selling-products-sellers-area pb-60 padd-60" style="background-color: rgba(240, 240, 240, 0.3);">
            <div class="container" >
                {{-- <div class="section-title without-bg">
                    <h2><span class="dot"></span> best Products</h2>
                </div> --}}

                <div class="container">
                    
                    <div class="slider-head">
                        <h2>{{ __('slidernewproducts.bestsellingproducts') }}</h2>
                    </div>

                    <div class="tranding mt-30">
                        <div class="owl-carousel special-offer" id="Todays-Deals">
                    
                          @foreach ( $slider_best_selling_products_data as $slider_best_selling_product)
                        
                              <div class="thumbnail no-border no-padding">
                                    <div class="product">
                                        
                                            <div class="product-img">
                                                <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_best_selling_product->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_best_selling_product->genericBrandId ) ) }}" class="product-href"></a>
                                                <img src="{{ asset('image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $slider_best_selling_product->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=200&sizeY=200" alt="image" class="img-responsive"   style="max-height: 235px; min-height: 235px"/>
                                            </div>
                                            <div class="product-body" style="max-height: 155px; min-height: 155px">
                                                @if ( (round($reviewData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('rating')->first()))>0)
                                                    <p>
                                                        @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                                            <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                                        @endfor

                                                        @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                                            <i class="fa fa-star" style="color: #ddd !important;"></i>
                                                        @endfor
                                                    </p>
                                                @endif
                                                
                                                <p>
                                                    @if (app()->getLocale()=='en')   
                                                        <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_best_selling_product->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_best_selling_product->genericBrandId ) ) }}">
                                                            {{ $slider_best_selling_product->genericBrand }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('genericStrength')->first() }}
                                                        </a>
                                                    @elseif (app()->getLocale()=='ru') 
                                                        <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_best_selling_product->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_best_selling_product->genericBrandId ) ) }}">
                                                            {{ $slider_best_selling_product->genericBrandRU }}
                                                            {{ $genericstrengthCompactData->where('genericBrandId', $slider_best_selling_product->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                                        </a>
                                                    @elseif (app()->getLocale()=='cn')  
                                                        <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_best_selling_product->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_best_selling_product->genericBrandId ) ) }}">
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
                                               
                                            </div>
                                   </div>
                              </div>
                              @endforeach

                              {{-- <div class="thumbnail no-border no-padding">
                                    <div class="product">
                                        
                                            <div class="product-img">
                                                <a href="{{ route('productlistPage.best_slider') }}" class="product-href">
                                                    <i class="fa fa-plus" style="margin: 37%; font-size: 80px; color: green;"></i>
                                                </a>
                                                <img class="lozad" data-src="" alt="image" class="img-responsive"   style="max-height: 235px; min-height: 235px"/>
                                            </div>
                                            <div class="product-body" style="max-height: 155px; min-height: 155px">
                                                <h5><strong> <h3 style="margin-left: 37%;">More</h3> </strong></h5>
                                            </div>
                                        </div>
                                </div> --}}  
                          
                        </div>
                    </div>

                    <div style="float: right; " >
                        <a   href="{{ app()->getLocale() ?  action('ProductController_F@productlistPage_best_sliderwithpaginate', array('lang'=>app()->getLocale() ) ) : action('ProductController_F@productlistPage_best_sliderwithpaginate', array('lang'=>app()->getLocale() ) ) }}" class="more-button">
                            {{ __('slidernewproducts.more') }} >>
                        </a>
                    </div> 

                </div>   

            </div>
        </section>

<script type="text/javascript">    

    $(document).ready(function () {
        (function ($) {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                items:4,
                loop:true,
                // margin:10,
                autoplay:true,
                autoplayTimeout:1000,
                autoplayHoverPause:true,
                navigation : true,
                nav: true,
                navText: [&#x27;next&#x27;,&#x27;prev&#x27;],
                dots: true,
                responsive:true
                // navClass: ['owl-prev', 'owl-next']
            });
        })(jQuery);
    });
</script>

@endsection
