
@section('banner_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
    
    <section class="banner-area " style="background-color: rgba(240, 240, 240, 0.3);">
            <div class="container" >
                {{-- <div class="section-title without-bg">
                    <h2><span class="dot"></span> best Products</h2>
                </div> --}}

                <div class="container">
                    
                    {{-- <div class="slider-head">
                        <h2>{{ __('banner.banner') }}</h2>
                    </div> --}}
                    <div class="clearfix"></div>

                    <div class="tranding mt-30">
                        <div class="owl-carousel special-offer" id="banner" >
                    
                          @foreach ( $banner_data  as $banner)
                                <div class="thumbnail no-border no-padding "  >
                                    <a {{-- href="{{ app()->getLocale() ?  action('ProductController_F@productlistPageTopBrands', array($banner->genericCompanyId ) ) : action('ProductController_F@productlistPageTopBrands', array($banner->genericCompanyId ) ) }}" --}} class="product-href">
                                       <div style="position: absolute; z-index: 5000000000000000000; padding-left: 20px;">
                                            <h3 style="white-space: normal;">  
                                                @if (app()->getLocale()=='en') {!! $banner->title !!} 
                                                @elseif (app()->getLocale()=='cn') {!! $banner->titleCN !!}  
                                                @elseif (app()->getLocale()=='ru') {!! $banner->titleRU !!} 
                                                @endif
                                           </h3>
                                           <h4 style="white-space: normal;">  
                                                @if (app()->getLocale()=='en') {!! $banner->desc !!} 
                                                @elseif (app()->getLocale()=='cn') {!! $banner->descCN !!}  
                                                @elseif (app()->getLocale()=='ru') {!! $banner->descRU !!} 
                                                @endif
                                           </h4>
                                       </div> 
                                            <img data-src="{{ asset('/image/getImage?url='.$banner->picPath ) }}" alt="image" class="img-responsive lozad"   style="max-height: 150px;  min-height: 150px; "/>
                                    </a>

                                    
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

             
                    
                    


                </div>                
                

            </div>
        </section>




<script type="text/javascript">
    

    $(document).ready(function () {

        console.log('working')
        console.log("$('#banner').owlCarousel.length = "+ $('#banner').owlCarousel.length)

        if($('#banner').owlCarousel.length>1)
        {
            var owl = $('#banner');
             owl.owlCarousel({
                 items:1,
                 loop: true,
                 margin:10,
                 autoplay:true,
                 autoplayTimeout:3000,
                 autoplayHoverPause:true,
                 nav: false,
                 // navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
             });
        }
        else
        {
            var owl = $('#banner');
             owl.owlCarousel({
                 items:1,
                 loop: false,
                 margin:10,
                 autoplay:true,
                 autoplayTimeout:3000,
                 autoplayHoverPause:true,
                 nav: false,
                 // navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
             });
        }



            $('.play').on('click',function(){
                owl.trigger('play.owl.autoplay',[1000])
            })
            $('.stop').on('click',function(){
                owl.trigger('stop.owl.autoplay')
            })
});
</script>



<style scoped>
    @media screen and  (max-width:767px)
    {
        h3{
            font-size: 18px !important;
            white-space: normal !important;
             text-justify: inter-word;
        }
        h4{
            font-size: 16px !important;
            white-space: normal !important;
             text-justify: inter-word;
        }
    }
</style>


@endsection
