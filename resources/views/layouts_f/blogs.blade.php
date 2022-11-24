{{-- NOT USED  --}}
@section('blog_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
<div class="container-fluid blog-sec">
	
    <div class="col-md-9 padd-60">
    	<div class="col-md-12 text-center heading">
            <h1>Our</h1>
            <h2>Blog</h2>
        </div>
        <div class="clearfix"></div>
        
        <div class="tranding mt-30">
        	<div class="owl-carousel special-offer" id="Bathroom">
        
              <div class="thumbnail no-border no-padding">
                <div class="product">
                    <a href="#"><img src="{{ asset('frontend/img/index-2/blog-1.jpg') }}" alt="image" class="img-responsive" /></a>
                    <div class="product-body">
                        <p><a href="#">Dining Table in swish</a></p>
                        <span>12th October 2017</span>
                        <h6>Lorem ipsum dolor consectetur adipiscing elit. Vestibulum port titor egestas orci, vitae ullamc risus consectetur id. </h6>
                        <a href="#" class="shop-btn">Learn more <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>
              </div>
              
              <div class="thumbnail no-border no-padding">
                <div class="product">
                    <a href="#"><img src="{{ asset('frontend/img/index-2/blog-2.jpg') }}" alt="image" class="img-responsive" /></a>
                    <div class="product-body">
                        <p><a href="#">Unique-wooden-chair</a></p>
                        <span>13th October 2017</span>
                        <h6>Lorem ipsum dolor consectetur adipiscing elit. Vestibulum port egestas orci, vitae ullamc orper risus consectetur id. </h6>
                        <a href="#" class="shop-btn">Learn more <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>
              </div>
              
              <div class="thumbnail no-border no-padding">
                <div class="product">
                    <a href="#"><img src="{{ asset('frontend/img/index-2/blog-3.jpg') }}" alt="image" class="img-responsive" /></a>
                    <div class="product-body">
                        <p><a href="#">Unique-wooden-wall clock</a></p>
                        <span>15th October 2017</span>
                        <h6>Lorem ipsum dolor consectetur adipiscing elit. Vestibulum port titor egestas orci, vitae ullamc orper consectetur id. </h6>
                        <a href="#" class="shop-btn">Learn more <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>
              </div>
              
              <div class="thumbnail no-border no-padding">
                <div class="product">
                    <a href="#"><img src="{{ asset('frontend/img/index-2/blog-1.jpg') }}" alt="image" class="img-responsive" /></a>
                    <div class="product-body">
                        <p><a href="#">Dining Table in swish</a></p>
                        <span>12th October 2017</span>
                        <h6>Lorem ipsum dolor consectetur adipiscing elit. Vestibulum port titor egestas orci, vitae ullamc risus consectetur id. </h6>
                        <a href="#" class="shop-btn">Learn more <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>
              </div>
              
              <div class="thumbnail no-border no-padding">
                <div class="product">
                    <a href="#"><img src="{{ asset('frontend/img/index-2/blog-2.jpg') }}" alt="image" class="img-responsive" /></a>
                    <div class="product-body">
                        <p><a href="#">Unique-wooden-chair</a></p>
                        <span>13th October 2017</span>
                        <h6>Lorem ipsum dolor consectetur adipiscing elit. Vestibulum port egestas orci, vitae ullamc orper risus consectetur id. </h6>
                        <a href="#" class="shop-btn">Learn more <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>
              </div>
              
              <div class="thumbnail no-border no-padding">
                <div class="product">
                    <a href="#"><img src="{{ asset('frontend/img/index-2/blog-3.jpg') }}" alt="image" class="img-responsive" /></a>
                    <div class="product-body">
                        <p><a href="#">Unique-wooden-wall clock</a></p>
                        <span>15th October 2017</span>
                        <h6>Lorem ipsum dolor consectetur adipiscing elit. Vestibulum port titor egestas orci, vitae ullamc orper consectetur id. </h6>
                        <a href="#" class="shop-btn">Learn more <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </div>
                    
                </div>
              </div>
              
            </div>
      	</div>
        
        <div class="col-md-12 text-center heading"><a href="#" class="def-btn">View all</a></div>
        <div class="clearfix"></div>
        
    </div>
    
    <div class="col-md-3 advertise-sec"></div>
    
    <div class="clearfix"></div>
    
</div>
@endsection