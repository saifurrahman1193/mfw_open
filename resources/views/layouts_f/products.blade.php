@section('product_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
<div id="top" class="container top-sec padd-60 special-offer">
    
    <div class="col-md-12 heading">
        <h1>Our</h1>
        <h2>Product</h2>
    </div>
    <div class="clearfix"></div>

    
    <div class="col-md-12 tab-structure tab-role tab mt-30">
      <!-- Nav tabs -->
      <div class="tab-product">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#newProducts" aria-controls="newProducts" role="tab" data-toggle="tab" aria-expanded="true">New Products</a></li>
            <li role="presentation"><a href="#bestSellingProducts" aria-controls="bestSellingProducts" role="tab" data-toggle="tab" aria-expanded="false">Best Selling Products</a></li>
        </ul>
      </div>
          
      <!-- Tab panes -->
      <div class="tab-content">
      
        <div role="tabpanel" class="tab-pane fade in active" id="newProducts">
        

            @foreach ( ( $genericbrandData->sortByDesc('created_at') )->take(6) as $genericbrand)
                <div class="col-sm-4 col-md-4">
                    <div class="product">
                        <div class="product-img">
                            <a href="#" class="product-href"></a>
                            {{-- <img src="{{ asset('/image/getImage?url='.'frontend/img/index-2/img-1.jpg') }}" alt="" class="img-responsive img-overlay" /> --}}
                            <img src="{{ asset('/image/getImage?url='.$genericbrandpicData->where('genericBrandId', $genericbrand->genericBrandId )->pluck('picPath')->first() ) }}" alt="" class="img-responsive" style="{{ strlen($genericbrand->genericBrand)>20 ? 'max-height: 200px;' :  'max-height: 250px;' }}" />
                            {{-- <div class="offer-discount">-25%</div> --}}
                            <div class="sale-heart-hover"><a href="#"><i class="flaticon-heart"></i></a></div>
                        </div>
                        <div class="product-body">

                                <h4>{{ $genericbrand->genericBrand }}</h4>

                                <p><a href="#">{{ $genericbrand->genericName }}</a></p>
                            <div class="product-hover">
                                <div class="add-cart-hover">
                                    <a href="#"><h6>Add to cart</h6> <i class="flaticon-3-signs" aria-hidden="true"></i></a>
                                </div>
                                <div class="quick-view">
                                    <a href="#" data-toggle="modal" data-target="#quick-modal"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    
                </div>

            @endforeach


            
            
            
            <div class="clearfix"></div>
        
        </div>
        
        <div role="tabpanel" class="tab-pane fade" id="bestSellingProducts">
        
            
            
            
            
            <div class="clearfix"></div>
            
        </div>
        
      
        
        
        
        
        
        
    
      </div>

    </div>
    <div class="clearfix"></div>
    
    <div class="col-md-12 text-center mt-30">
        <a href="#" class="def-btn bor-btn">View All</a>
    </div>
    <div class="clearfix"></div>
    
</div>



<!--modal-->
<div class="modal fade quick-modal in" id="quick-modal" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <div class="col-md-5 detail-left text-center">
                            <ul class="color-var">
                                <li><a href="#"><i class="fa fa-check"></i></a></li>
                                <li><a href="#" class="active"><i class="fa fa-check"></i></a></li>
                                <li><a href="#"><i class="fa fa-check"></i></a></li>
                                <li><a href="#"><i class="fa fa-check"></i></a></li>
                                <li><a href="#"><i class="fa fa-check"></i></a></li>
                            </ul>
                            <div id="carousel" class="carousel slide" data-ride="carousel">
                              <div class="carousel-inner">
                                <div class="item active" data-thumb="0"> <img src="image/getImage?url=img/index/quick-img-1.jpg" alt=""> </div>
                                <div class="item" data-thumb="1"> <img src="{{ asset('/image/getImage?url='.'frontend/img/index/quick-img-2.jpg') }}" alt=""> </div>
                                <div class="item" data-thumb="2"> <img src="{{ asset('/image/getImage?url='.'frontend/img/index/quick-img-3.jpg') }}" alt=""> </div>
                                <div class="item" data-thumb="3"> <img src="{{ asset('/image/getImage?url='.'frontend/img/index/quick-img-4.jpg') }}" alt=""> </div>
                                <div class="item" data-thumb="4"> <img src="{{ asset('/image/getImage?url='.'frontend/img/index/quick-img-1.jpg') }}" alt=""> </div>
                                <div class="item" data-thumb="5"> <img src="{{ asset('/image/getImage?url='.'frontend/img/index/quick-img-2.jpg') }}" alt=""> </div>
                                <div class="item" data-thumb="6"> <img src="{{ asset('/image/getImage?url='.'frontend/img/index/quick-img-3.jpg') }}" alt=""> </div>
                                <div class="item" data-thumb="7"> <img src="{{ asset('/image/getImage?url='.'frontend/img/index/quick-img-4.jpg') }}" alt=""> </div>
                              </div>
                            </div>
                            <div id="thumbcarousel" class="carousel thumbcarousel slide" data-interval="false">
                              <div class="carousel-inner">
                                <div class="item active">
                                  <div data-target="#carousel" data-slide-to="0" class="thumb"><img src="{{ asset('/image/getImage?url='.'frontend/img/index/thumb-img-1.jpg') }}" alt=""></div>
                                  <div data-target="#carousel" data-slide-to="1" class="thumb"><img src="{{ asset('/image/getImage?url='.'frontend/img/index/thumb-img-2.jpg') }}" alt=""></div>
                                  <div data-target="#carousel" data-slide-to="2" class="thumb"><img src="{{ asset('/image/getImage?url='.'frontend/img/index/thumb-img-3.jpg') }}" alt=""></div>
                                  <div data-target="#carousel" data-slide-to="3" class="thumb"><img src="{{ asset('/image/getImage?url='.'frontend/img/index/thumb-img-4.jpg') }}" alt=""></div>
                                </div>
                                <!-- /item -->
                                <div class="item">
                                  <div data-target="#carousel" data-slide-to="4" class="thumb"><img src="{{ asset('/image/getImage?url='.'frontend/img/index/thumb-img-1.jpg') }}" alt=""></div>
                                  <div data-target="#carousel" data-slide-to="5" class="thumb"><img src="{{ asset('/image/getImage?url='.'frontend/img/index/thumb-img-2.jpg') }}" alt=""></div>
                                  <div data-target="#carousel" data-slide-to="6" class="thumb"><img src="{{ asset('/image/getImage?url='.'frontend/img/index/thumb-img-3.jpg') }}" alt=""></div>
                                  <div data-target="#carousel" data-slide-to="7" class="thumb"><img src="{{ asset('/image/getImage?url='.'frontend/img/index/thumb-img-4.jpg') }}" alt=""></div>
                                </div>
                                <!-- /item --> 
                              </div>
                              <!-- /carousel-inner --> 
                              <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev"> <span class="fa fa-angle-left"></span> </a> <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next"> <span class="fa fa-angle-right"></span> </a> </div>
                        <div class="clearfix"></div>
                        </div>
    
                         <div class="col-md-7 detail-right">
                                <div class="detail-top">
                                    <h1>iPhone 7 128GB Rose Gold </h1>
                                    <div class="rating">
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        <span>( 12 reviews )</span>
                                        <a href="#">Write a review</a>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="rate">
                                        <h2>495.50$ <del>$520.20</del></h2>
                                        <label class="offer-label">-15%</label>
                                        <span><i class="fa fa-check-circle"></i> In stock</span>
                                        <div class="clearfix"></div>
                                    </div>            
                                </div>
                                <div class="detail">
                                        <div class="sub-menu"><a class="main-a" href="javascript:void(0)">Description <div class="icon-plus"><i class="fa flaticon-3-signs"></i></div></a>
                                        
                                            <div class="toggle-ul">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestib porttitor egestas orci, vitae ullamcorper risus  dolor sit amet, consectetur adium porttitor egestas orci, vitae ullamcorper risus consectetur id. </p>
                                            </div>
                                        
                                        </div>
                                </div>
                                <div class="detail feature">
                                        <div class="sub-menu"><a class="main-a" href="javascript:void(0)">Features <div class="icon-plus"><i class="fa flaticon-3-signs"></i></div></a>
                                        <div class="toggle-ul">
                                            <ul>
                                                <li><i class="fa fa-caret-right" aria-hidden="true"></i>12MP primary camera </li>
                                                <li><i class="fa fa-caret-right" aria-hidden="true"></i>Quad-LED True Tone flash</li>
                                                <li><i class="fa fa-caret-right" aria-hidden="true"></i>7MP front facing HD camera </li>
                                                <li><i class="fa fa-caret-right" aria-hidden="true"></i>4.7-inch (diagonal) Retina HD</li>
                                            </ul>
                                            <ul>
                                                <li><i class="fa fa-caret-right" aria-hidden="true"></i>128GB internal memoryVestib</li>
                                                <li><i class="fa fa-caret-right" aria-hidden="true"></i>single Nano-SIM </li>
                                                <li><i class="fa fa-caret-right" aria-hidden="true"></i>Li-Ion 1960 mAh battery</li>
                                                <li><i class="fa fa-caret-right" aria-hidden="true"></i>1 year manufacturer warranty</li>
                                            </ul>
                                            <div class="clearfix"></div>
                                        <div class="toggle-ul">
                                        </div>
                                </div>
                                <div class="detail-btm">
                                    <div class="detail-row">
                                        <p class="text-uppercase">Size</p>
                                        <ul class="size">
                                            <li><a href="#">32 GB</a></li>
                                            <li><a href="#">64 GB</a></li>
                                            <li class="active"><a href="#">128 GB</a></li>
                                        </ul>
                                    </div>
                                    <div class="detail-row quantity-box">
                                        <p class="text-uppercase">Quantity</p><div class="clearfix"></div>
                                        <div id="field1" class="input--filled">
                                          <button type="button" id="sub" class="sub"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                          <input type="text" id="1" value="1" class="field">
                                          <button type="button" id="add" class="add"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                          <div class="clearfix"></div>
                                        </div>
                                        <a class="coupon" href="#">Add to cart</a>
                                        <div class="action-icon pull-right">
                                            <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i>Wish list</a>
                                            <a href="#"><i class="flaticon-refresh"></i>Compare</a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="detail-row"><p><span>SKU:</span> N/A</p></div>
                                    <div class="detail-row"><p><span>Categories:</span> All, Featured, Shoes</p></div>
                                    <div class="detail-row"><p><span>Tags:</span> Black, Brown, Red, Shoes, £0.00 - £150.00</p></div>
                                    <div class="detail-row">
                                        <p><span>Share:</span></p>
                                        <div class="soc-icon">
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook"><i class="fa fa-facebook-f"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Instagram"><i class="fa fa-instagram"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dribble"><i class="fa fa-dribbble"></i></a>
                                            <a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest"><i class="fa fa-pinterest-p"></i></a>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                        <div class="clearfix"></div>
                  </div>
                </div>     
                </div>
</div>
@endsection
