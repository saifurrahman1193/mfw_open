


@section('slider_new_selling_products_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
    
    <section class="new-products-area pb-60 padd-60" style="background-color: rgba(0, 255, 0, 0.28);">
            <div class="container" >
                {{-- <div class="section-title without-bg">
                    <h2><span class="dot"></span> New Products</h2>
                </div> --}}


                <div class="container">
                    
                    <div class="slider-head">
                        <h2> {{ __('slidernewproducts.newproduct') }}  </h2>
                    </div>
                    
                    <div class="tranding mt-30">
                        <div class="owl-carousel " id="best">

                            @foreach ( $slider_new_selling_products_data as $slider_new_selling_product)
                    
                            <div class="thumbnail no-border no-padding">
                                <div class="product">
                                    
                                        <div class="product-img">
                                            <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) }}" class="product-href"></a>
                                            {{-- <img src="img/grid/img-4.jpg" alt="" class="img-responsive img-overlay" /> --}}
                                            <img class="lozad" data-src="{{ asset('/image/getImage?url='.$genericbrandpicData->where('genericBrandId', $slider_new_selling_product->genericBrandId )->pluck('picPath')->first() ) }}" alt="image" class="img-responsive"   style="max-height: 235px; min-height: 235px"/>
                                            {{-- <div class="offer-discount">-25%</div> --}}
                                            {{-- <div class="sale-heart-hover"><a href="#"><i class="flaticon-heart"></i></a></div> --}}
                                        </div>
                                        <div class="product-body" style="max-height: 155px; min-height: 155px">
                                            {{-- <p><a href="#">{{ $slider_new_selling_product->genericBrand }}</a></p> --}}

                                            @if ( (round( $reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first() )) > 0 )
                                                <p>
                                                    @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                                        <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                                    @endfor

                                                    @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                                        <i class="fa fa-star" style="color: #ddd !important;"></i>
                                                    @endfor
                                                </p>
                                            @endif

                                            
                                            <p>
                                                

                                                @if (app()->getLocale()=='en')    
                                                    <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) }}">
                                                        {{ $slider_new_selling_product->genericBrand }}
                                                        {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrength')->first() }}
                                                        
                                                    </a>
                                                @elseif (app()->getLocale()=='ru')    
                                                    <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) }}">
                                                        {{ $slider_new_selling_product->genericBrandRU }}
                                                        {{ $genericstrengthCompactData->where('genericBrandId', $slider_new_selling_product->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                                    </a>
                                                @elseif (app()->getLocale()=='cn')  
                                                    <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $slider_new_selling_product->genericBrandId ) ) }}">
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
                                            {{-- <h4>595.50$</h4> --}}
                                            {{-- <div class="product-hover">
                                                <div class="add-cart-hover"><a href="#"><h6>Add to cart</h6> <i class="flaticon-3-signs" aria-hidden="true"></i></a></div>
                                                <div class="quick-view"><a href="#" data-toggle="modal" data-target="#quick-modal"><i class="fa fa-search-plus" aria-hidden="true"></i></a></div>
                                            </div> --}}
                                        </div>
                                </div>
                            </div>
                            @endforeach


                        {{-- <div class="thumbnail no-border no-padding">
                            <div class="product">
                                <div class="product-img">
                                    <a href="{{ route('productlistPage.new_slider') }}" class="product-href">
                                        <i class="fa fa-plus" style="margin: 37%; font-size: 80px; color: green;"></i>
                                    </a>
                                    <img class="lozad" data-src="" alt="" class="img-responsive"   style="max-height: 235px; min-height: 235px"/>
                                </div>
                                <div class="product-body" style="max-height: 155px; min-height: 155px">
                                    <h5><strong> <h3 style="margin-left: 37%;">More</h3> </strong></h5>
                                </div>
                            </div>
                        </div> --}}






                            
                            
                            
                        </div>
                              
                    </div>



                    <div style="float: right; " >
                        <a   href="{{ app()->getLocale() ?  action('ProductController_F@productlistPage_new_sliderwithpaginate', array('lang'=>app()->getLocale() ) ) : action('ProductController_F@productlistPage_new_sliderwithpaginate', array('lang'=>app()->getLocale() ) ) }}" class="more-button">
                            {{ __('slidernewproducts.more') }} >>
                        </a>
                    </div>


                </div>                
                

            </div>
        </section>



{{-- <script type="text/javascript">
	

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
</script> --}}


<style type="text/css" media="screen">
    .more-button:hover{
       text-decoration: underline;
       font-weight: bold;
    }

     .more-button{
       color: #25bb2b;
    }
</style>

@endsection
