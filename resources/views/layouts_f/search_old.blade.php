
{{-- NOT USED --}}
@section('search_content')

<!--search-->
<div class="container logo-bar">

    <div class="col-md-3 logo-name text-center">
        <a href="{{ route('home_f') }}"><img data-src="{{ asset('frontend/img/logo-full.jpg')}}" alt="" class="img-responsive lozad" /></a>
    </div>
    <div class="col-md-5 col-md-offset-1 search">

      
      {{-- ==================  ================ search portion ========================= =========== --}}
      <input id="searchInput" type="text" name="searchInput" placeholder="Search by product name"  />
      {{-- ==================  ================ search portion ========================= =========== --}}




        <select id="search-category-id" name="search-category-id">
            <option data-categoryid="0" value="0">All Categories</option>
            @foreach ($categoryData->sortBy('category') as $category)
                <option data-categoryid="{{ $category->categoryId }}" value="{{ $category->categoryId }}">{{ $category->category }}</option>
            @endforeach
        </select>
        <div class="round search-round">
            <a href="{{ '/productDetailsPage/' }}" id="search-link">
                <i class="flaticon-search"></i>
            </a>
        </div>
    </div>
    <div class="col-md-3 shopping-cart">
        <div class="icon-round">



            <div class="round-icon">
                {{-- <a href="#"><i class="flaticon-video-camera"></i></a> --}}
                @if (Auth::check())

                  <a href="#" ><i id="compare-round-icon" class="fa fa-columns tooltipster " title="Compare" data-count="{{ $compareData->where('comparerId', Auth::user()->id)->count('comparerId') }}"></i></a>

                  <a href="#"><i id="wishlist-round-icon" class="flaticon-heart tooltipster  " title="Wishlist" data-count="{{ $wishlistData->where('wisherId', Auth::user()->id)->count('wisherId') }}"></i></a>

                  <a href="{{ route('goToCartPage') }}">
                    <i id="addtocart-round-icon" class="flaticon-shopping-bag tooltipster" title="Cart List" 
                            data-count="{{ DB::table('cartdetails')
                                      ->where('customerId', Auth::user()->id)
                                      ->where('cartId', null)
                                      ->sum('qty') }}">
                                                                
                    </i>
                  </a>

                @endif
            </div>



        
           {{-- <div class="cart-item ">
                <div class="cart-mail"><a href="#"><i class="flaticon-shopping-bag" title="Cart List" data-count="{{ $wishlistData->where('wisherId', Auth::user()->id)->count('wisherId') }}"></i></a></div>
                <p class="cart-price"><span>My cart</span><br /><b>$950.80</b></p>
                            
                            <div class="cart-item-hover">
                                <div class="cart-item-list">
                                    <img src="{{ asset('frontend/img/index/cart-item-1.jpg') }}" alt="" />
                                    <a href="#"><h3>Beats Classic Headphone</h3></a>
                                    <b><a href="#">X</a></b>
                                    <p>$88.00 <del>$120.00</del></p>
                                </div>
                                <div class="cart-item-list">
                                    <img src="{{ asset('frontend/img/index/cart-item-2.jpg') }}" alt="" />
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
                            
            </div> --}}
        </div>
       
    </div>
    <div class="clearfix"></div>
    
    <div class=" col-md-12 col-sm-12 col-lg-12 col-xs-12 main-nav " id="navbar_main" >
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

            <div id="scroll_logo" class="col-md-2">
                <a href="{{ route('home_f') }}">
                  <img data-src="{{ asset('frontend/img/logo.png')}}" alt="" class="img-responsive lozad"  style="height: 58px;"/>
                </a>
            </div>
            





            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse " id="bs-example-navbar-collapse ">


                <ul class="nav navbar-nav d " id="navs">
                    
                    @foreach ($menu_categories_f_Data as $menu_categories_f)
                        <li {{--  class="active" --}}>
                            <a href="javascript:void(0)" >
                                {{ $categoryData->where('categoryId', $menu_categories_f->categoryId)->pluck('category')->first() }} 
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>

                            <div class="dropdown-content">
                              {{-- <div class="header"> <h2>Common Types</h2></div> --}}
                              <div class="row">
                                    @foreach ( ($diseasecategoryData->where('categoryId', $menu_categories_f->categoryId))->sortBy('diseaseCategory') as $diseasecategory)
                                      <div class="col col-md-4">
                                          <a href="{{ route('productlistPage', $diseasecategory->diseaseCategoryId) }}"> {{ $diseasecategory->diseaseCategory }}</a>
                                      </div>
                                    @endforeach
                              </div>
                            </div>
                        </li>
                    @endforeach
                   
                </ul>
              
            </div><!-- /.navbar-collapse -->


        </nav>
    </div>


    
</div>


<script type="text/javascript">
    
     var  nav = document.getElementById('navbar_main');
     var  scroll_logo = document.getElementById('scroll_logo');
     var  navs = document.getElementById('navs');

     scroll_logo.style.display = 'none';

     // console.log(nav);
      
      window.onscroll = function(e){

         if (window.pageYOffset >200) 
         {

             nav.style.backgroundColor  = "#219d20ba";
             nav.style.position   = "fixed";
             nav.style.top = '0';
             nav.style.marginTop = '0';


             scroll_logo.style.display = 'block';

             // navs.style.marginTop = '1vw';

             if( !($(e.target).closest("#user-profile-area").length > 0) ) {
                    $('#con-vs-dropdown--menu').css('display', 'none');
                }


             // nav.style.boxShadow = "0px 4px 2px blue";

         }
         else{
             nav.style.backgroundColor  = "#219d20";
             nav.style.position   = "relative";
             nav.style.marginTop = '25';

             scroll_logo.style.display = 'none';
             navs.style.marginTop = '0vw';
             // nav.style.boxShadow = "none";
         }
      }



</script>


<style>
    #navs .navbar-nav
    {
      overflow: hidden;
    }
    .dropdown-content 
    {
      overflow: hidden;
    }

    .dropdown-content 
    {
      display: none;
      position: absolute;
      background-color: rgba(255, 255, 255, .9);
      width: 90%;
      left: 0;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 100;
    }

    .dropdown-content .header 
    {
        color: #5d5d5d;
        /* float: left; */
        /* margin-left: 2%; */
    }

    .navbar-nav li:hover .dropdown-content {
      display: block;
      position: fixed;
    }

    /* #navs  a
    {
      color: #5d5d5d; 
    } */

    .row a
    {
      color: #5d5d5d !important; 
      float: left;
      padding: 10px;
    }

    .row a:hover
    {
      color: #25bb2b !important; 
    }


</style>



<script type="text/javascript">
     $(document).ready(function() {

      // console.log('fired')
      $('#searchInput').val('');

      

        $(function(){

              var genericBrandData = {!! (($genericbrandData->pluck('genericBrand'))->unique())->sortBy('genericBrand') !!};

              // console.log(genericBrandData)

              $('#searchInput').autocomplete({
                   source : genericBrandData
              });
         });

        $('select[name="search-category-id"]').on('change', function(){

              $('#searchInput').val('');

              var  categoryId = $('select#search-category-id').find(':selected').data('categoryid');
              // console.log(categoryId)

              if (categoryId==0) {
                  var genericBrandData = {!! (($genericbrandData->pluck('genericBrand'))->unique())->sortBy('genericBrand') !!};

                  // console.log(genericBrandData)

                  $('#searchInput').autocomplete({
                       source : genericBrandData
                  });
              }
              else if (categoryId>0) 
              {

                    $.ajax({
                          // url: '/inventory/states/get/'+genericId,
                          url: '/home/homecategorysection/getHomeCategoryProducts/'+categoryId,
                          type:"GET",
                          dataType:"json",

                        success:function(data) {
                          // console.log(data);
                          // console.log(data.data);
                          var genericBrandData = [];

                          $(data.data).each(function(index, el) {

                                  // console.log('genericBrandId = '+el.genericBrandId+ ', genericBrand = '+el.genericBrand+', category = '+el.category);

                                  genericBrandData.push(el.genericBrand);

                          });

                          $('#searchInput').autocomplete({
                               source : genericBrandData
                          });


                        },
                        complete: function(){
                           
                        }
                          

                           
                    });
                
              }

                     


          });


          


     });


     $(document).ready(function() {
         $('#searchInput').on('keyup keypress blur change click mouseover leave input keyup', function(e) 
            {
                var searchInputValue =  $('#searchInput')[0].value;
                console.log(searchInputValue)
                $("#search-link").attr("href", '/productDetailsPage/'+searchInputValue);
                    
            });
     });
</script>







@endsection