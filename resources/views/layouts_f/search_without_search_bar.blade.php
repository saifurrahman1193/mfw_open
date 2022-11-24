{{-- NOT USED --}}
@section('search_without_search_bar_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

<!--search-->
<div class="container logo-bar">

    <div class="col-md-3 logo-name text-center">
        <a href="index-2.html"><img src="{{ asset('frontend/img/logo.png')}}" alt="Medicine For World (MFW)" class="img-responsive" /></a>
    </div>
    <div class="col-md-6 search">
        {{-- <input type="text" name="search" placeholder="Search by product name" />
        <select>
            <option>All Categories</option>
            <option>Men</option>
            <option>Women</option>
            <option>Electronics</option>
            <option>Smart Phones</option>
        </select>
        <div class="round search-round"><a href="#"><i class="flaticon-search"></i></a></div> --}}
    </div>
    <div class="col-md-3 shopping-cart">
        <div class="icon-round">
            <div class="round-icon">
                {{-- <a href="#"><i class="flaticon-video-camera"></i></a> --}}
                <a href="#"><i class="flaticon-refresh"></i></a>
                <a href="#"><i class="flaticon-heart"></i></a>
            </div>
        
         <div class="cart-item">
                <div class="cart-mail"><a href="#"><i class="flaticon-shopping-bag"></i></a></div>
                <p class="cart-price"><span>My cart</span><br /><b>$950.80</b></p>
                            
                            <div class="cart-item-hover">
                                <div class="cart-item-list">
                                    <img src="{{ asset('/image/getImage?url='.'frontend/img/index/cart-item-1.jpg') }}" alt="" />
                                    <a href="#"><h3>Beats Classic Headphone</h3></a>
                                    <b><a href="#">X</a></b>
                                    <p>$88.00 <del>$120.00</del></p>
                                </div>
                                <div class="cart-item-list">
                                    <img src="{{ asset('/image/getImage?url='.'frontend/img/index/cart-item-2.jpg') }}" alt="" />
                                    <a href="#"><h3>Samsung Classic Tablet</h3></a>
                                    <b><a href="#">X</a></b>
                                    <p>$90.00 <del>$122.00</del></p>
                                </div>
                                <div class="border"></div>
                                <div class="cart-total">
                                    <h6>Total Price</h6> <p>$178.00</p><div class="clearfix"></div>
                                    <a href="#" class="cart-view">View all</a>
                                    <a href="check-out.html" class="cart-checkout">Check out</a>
                                </div>
                            </div>
                            
            </div>
        </div>
       
    </div>
    <div class="clearfix"></div>
    
    <div class="col-md-12 main-nav">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <h3>MENU</h3>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>   
            
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="index.html">Home <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <div class="nav-mega-menu">
                            <div class="nav-main-menu">
                                <span>
                                        <a href="index.html">Home</a>
                                        <a href="index-2.html">Home-Furniture</a>
                                        <a href="index-3.html">Home-Beauty</a>
                                        <a href="index-3-new.html">Home-Beauty V1</a>
                                </span>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Collection <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <div class="nav-mega-menu">
                            <div class="nav-main-menu">
                                <span>
                                        <a href="about-us.html">About</a>
                                        <a href="blog.html">Blog</a>
                                        <a href="blog-detail.html">Blog-Detail</a>
                                        <a href="cart.html">Cart</a>
                                        <a href="cart-1.html">Cart V1</a>
                                        <a href="check-out.html">Check-Out</a>
                                        <a href="404.html">404</a>
                                </span>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Furniture <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <div class="nav-mega-menu">
                            <div class="nav-main-menu">
                                <span>
                                        <a href="product-list.html">Product-List</a>
                                        <a href="product-grid.html">Product-Grid</a>
                                        <a href="product-detail.html">Product-Detail</a>
                                </span>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Chair</a></li>
                    <li><a href="#">Accessories</a></li>
                    <li><a href="#">Pages <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <div class="nav-mega-menu">
                            <div class="nav-main-menu">
                                <span>
                                        <a href="about-us.html">About</a>
                                        <a href="blog.html">Blog</a>
                                        <a href="blog-detail.html">Blog-Detail</a>
                                        <a href="cart.html">Cart</a>
                                        <a href="cart-1.html">Cart V1</a>
                                        <a href="check-out.html">Check-Out</a>
                                        <a href="404.html">404</a>
                                </span>
                            </div>
                        </div>
                    </li>
                    <li><a href="contact.html">Contact <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <div class="nav-mega-menu">
                            <div class="nav-main-menu">
                                <span>
                                        <a href="contact.html">Contact</a>
                                        <a href="contact-1.html">Contact V1</a>
                                </span>
                            </div>
                        </div>
                    </li>
              </ul>
              
            </div><!-- /.navbar-collapse -->
        </nav>
    </div>
    
</div>
@endsection