


@section('topbrands_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
    
    <section class="topbrands-area  " style="background-color: rgba(240, 240, 240, 0.3);">
            <div class="container" >
                {{-- <div class="section-title without-bg">
                    <h2><span class="dot"></span> best Products</h2>
                </div> --}}


                <div class="container">
                    
                    <div class="slider-head">
                        <h2>{{ __('topbrands.topbrands') }}</h2>
                    </div>

                    <div class="tranding mt-30">
                        <div class="owl-carousel special-offer" id="top-brands" >



                    
                          @foreach ( $topbrands_data as $topbrand)
                                <div class="thumbnail no-border no-padding" >
                                    <a href="{{ route('productlistPageTopBrands', [ app()->getLocale(), $topbrand->genericCompanyId ])  }}" class="product-href">
                                            <img data-src="{{ asset('image/imageResize?url='.$topbrand->picPath ) }}&sizeX=155&sizeY=155" alt="image" class="img-responsive lozad"   style="max-height: 150px;  min-height: 150px; "/>
                                    </a>
                                </div>
                          @endforeach


                              {{-- <div class="thumbnail no-border no-padding">
                                    <div class="product">
                                        
                                            <div class="product-img">
                                                <a href="{{ route('productlistPage.best_slider') }}" class="product-href">
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

             
                    
                    


                </div>                
                

            </div>
        </section>




<script type="text/javascript">
    

    $(document).ready(function () {

        console.log('working')

           var owl = $('#top-brands');
            owl.owlCarousel({
                // items:6,
                loop:true,
                margin:10,
                autoplay:true,
                autoplayTimeout:2000,
                autoplayHoverPause:true,
                nav: true,
                responsiveClass:true,
                responsive:{
                            0:{
                                items:1,
                                // nav:true
                            },
                            400:{
                                items:2,
                                // nav:false
                            },
                            800:{
                                items:3,
                                // nav:false
                            },
                            1200:{
                                items:4,
                                // nav:false
                            },
                            1400:{
                                items:5,
                                // nav:true,
                                // loop:false
                            },
                            1600:{
                                items:6,
                                // nav:true,
                                // loop:false
                            }
                        },
                navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            });
            $('.play').on('click',function(){
                owl.trigger('play.owl.autoplay',[1000])
            })
            $('.stop').on('click',function(){
                owl.trigger('stop.owl.autoplay')
            })
});
</script>




@endsection
