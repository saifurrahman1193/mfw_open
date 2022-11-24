{{-- NOT USED --}}
@section('featured_product_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
<div class="container featured-sec featured-product-sec padd-60">
    <div class="col-md-12 heading">
        <h1>Featured</h1>
        <h2>Product</h2>
    </div> 
    <div class="clearfix"></div>
    
    <div class="col-md-8 pt-60">
        <div class="col-md-6 featured-product-img"><img src="{{ asset('frontend/img/index-2/feature-1.jpg') }}" alt="" class="img-responsive"></div>
        <div class="col-md-6 product-detail">
            <h2>Folding Chair Home Garden Outdoor </h2>
            <h3>599.00$</h3>
            <h4>$720.20</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum porttitor risus consectetur id. </p>
            <div id="timer-2" class="text-center">
                    <h5>Hurry up! Offer ends in:</h5>
                    <div class="col-sm-3 col-xs-6">
                        <div id="days">282<span></span></div>
                        <p>Days</p>
                  </div>
                  <div class="col-sm-3 col-xs-6">
                        <div id="hours">11<span></span></div>
                        <p>Hours</p>
                  </div>
                  <div class="col-sm-3 col-xs-6">
                        <div id="minutes">18<span></span></div>
                        <p>Minutes</p>
                  </div>
                  <div class="col-sm-3 col-xs-6">
                        <div id="seconds">17<span></span></div>
                        <p>Seconds</p>
                  </div>
                  <div class="clearfix"></div>
           </div>
           
          <div class="product-hover">
             <div class="add-cart-hover"><a href="#"><h6>Add to cart</h6> <i class="flaticon-3-signs" aria-hidden="true"></i></a></div>
             <div class="heart quick-view">
                <a href="#"><i class="flaticon-heart" aria-hidden="true"></i></a>
             </div>
             <div class="quick-view">
                <a href="#" data-toggle="modal" data-target="#quick-modal"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
             </div>
             
          </div>    
           
        </div>
    </div>
    <div class="col-md-4 pt-60 featured-product-body">
    
        <div class="col-md-12 featured-product-content product-detail">
            <img src="{{ asset('frontend/img/index-2/feature-2.jpg')}}" alt="" class="img-responsive">
            <a href="#"><h2>Unique-wooden-chair</h2></a>
            <h3>750.00$</h3>
            <h4>$899.20</h4>
        </div>
        
        <div class="col-md-12 featured-product-content product-detail mt-20">
            <img src="{{ asset('frontend/img/index-2/feature-3.jpg')}}" alt="" class="img-responsive">
            <a href="#"><h2>Wicker Patio Sofa Outdoor Furniture </h2></a>
            <h3>599.00$</h3>
            <h4>$650.55</h4>
        </div>
        
        
        <div class="col-md-12 featured-product-content  product-detail mt-20">
            <img src="{{ asset('frontend/img/index-2/feature-4.jpg')}}" alt="" class="img-responsive">
            <a href="#"><h2>Jaipur Strips Single Seater Chair</h2></a>
            <h3>366.00$</h3>
            <h4>$450.59</h4>
        </div>
       
        
    </div>
    <div class="clearfix"></div>
    
</div>
@endsection
