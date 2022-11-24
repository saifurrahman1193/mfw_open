@section('search_content')


{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

<style>
.ui-state-active h5,
.ui-state-active h5:visited {
    color: #26004d ;
}

.ui-menu-item{
    height: 70px;
    border: 0px solid #ececf9;
}
.ui-widget-content .ui-state-active {
    background-color: white !important;
    border: none !important;
}
.list_item_container {
    /* width:740px; */
    height: 70px;
    float: left;
    /* margin-left: 20px; */
}
.ui-widget-content .ui-state-active .list_item_container {
    background-color: #f5f5f5;
    height: 70px;
}

.image {
    width: 15%;
    float: left;
    /* padding: 10px; */
    padding-left: 5px;
}
.image img{
    width: 70px;
    height : 70px;
}
.label{
    width: 85%;
    /* float:right; */
    white-space: nowrap;
    overflow: hidden;
    color: #656565;
    text-align: left;

}
input:focus{
    background-color: #f5f5f5;
}

.main-nav ul.navbar-nav li a{
    text-align: left;
}
</style>
<!--search-->
<div class="container logo-bar">

    <div class="col-md-3 col-xs-12 logo-name text-center" >
        <a href="{{ route('home_f', app()->getLocale())  }}"><img data-src="{{ asset('/image/getImage?url=/uploads/frontend/logo-logo.png')}}"  alt="image" class="img-responsive lozad" id="main-logo"/></a>
    </div>
    <div class="col-md-5  col-xs-12 col-sm-8 col-md-offset-1 col-xs-offset-0 search" id="searchInputContainer">

        {{-- ==================  ================ search portion ========================= =========== --}}
        <input id="searchInput" type="text" name="searchInput"    placeholder="{{ __('header.searchbyproductname') }}"  />
        {{-- ==================  ================ search portion ========================= =========== --}}

        <div  class="select-wrapper">
            <select id="search-category-id" name="search-category-id" onfocus='this.size=8;' onblur='this.size=1;' onchange='this.size=1; this.blur();' style="z-index: 500; ">

                <option data-categoryid="0" value="0"  style="padding: 10px 0px"> {{ __('header.allcategories') }} </option>

                @foreach ($categoryData->sortBy('category') as $category)
                    <option data-categoryid="{{ $category->categoryId }}" value="{{ $category->categoryId }}" style="padding: 10px 0px">
                        @if (app()->getLocale()=='en')    {{ $category->category }}
                        @elseif (app()->getLocale()=='ru')  {{ $category->categoryRU }}  
                        @elseif (app()->getLocale()=='cn')  {{ $category->categoryCN }}  
                        @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div class="round search-round">
            <a href="{{-- {{ '/productDetailsPage/' }} --}}" id="search-link">
                <i class="flaticon-search"></i>
            </a>
        </div>

    </div>
    <div class="col-md-3 col-sm-4 col-xs-12 shopping-cart">
        <div class="icon-round">



            <div class="round-icon">
                {{-- <a href="#"><i class="flaticon-video-camera"></i></a> --}}
                @if (Auth::check())

                  <a href="{{ route('compare_f', app()->getLocale())  }}" ><i id="compare-round-icon" class="fa fa-columns tooltipster " title="Compare" data-count="{{ $compareData->where('comparerId', Auth::user()->id)->count('comparerId') }}"></i></a>

                  <a href="{{ route('wishlistPage', app()->getLocale()) }}"><i id="wishlist-round-icon" class="flaticon-heart tooltipster  " title="Wishlist" data-count="{{ $wishlistData->where('wisherId', Auth::user()->id)->count('wisherId') }}"></i></a>

                  <a href="{{ route('goToCartPage', app()->getLocale())  }}">
                    <i  class="flaticon-shopping-bag tooltipster addtocart-round-icon" title="Cart List" 
                            data-count="{{ DB::table('cartdetails')
                                      ->where('customerId', Auth::user()->id)
                                      ->where('cartId', null)
                                      ->sum('qty') }}">
                                                                
                    </i>
                  </a>

                @endif
            </div>


        </div>
       
    </div>
    <div class="clearfix padd-30"></div>

    {{-- <div id="navbar_main_duplicate" style=" background-color:rgb(33, 157, 32); width:2000px; height: 50px; margin-left: -12vw; display: none; position: fixed; top: 0px;"></div> --}}
    <div class=" col-md-12 col-sm-12 col-lg-12 col-xs-12 main-nav " id="navbar_main" style="margin-top: 20px;" >
    {{-- <div class=" col-md-12 col-sm-12 col-lg-12 col-xs-12 main-nav " id="desktop_view_category" style="margin-top: 20px;" > --}}
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                {{-- <h3><a href="{{ app()->getLocale() ?  action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}">
                  <img data-src="{{ asset('/uploads/frontend/logo_mini.png')}}"  alt="image" class="img-responsive lozad"  style="height: 50px; padding-top: 10px;"/>
                </a></h3> --}}
                {{-- @include('layouts_f.profile') --}}
            
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
                {{-- <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> --}}
    
                <span class="sr-only"><i class="fa fa-ellipsis-v " style="color: white"></i></span>
                <span class=""><i class="fa fa-ellipsis-v " style="color: white"></i></span>
              </button>
            </div>   
    
            <div id="scroll_logo" class="col-md-2">
                {{-- <a href="{{ app()->getLocale() ?  action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}">
                  <img data-src="{{ asset('/uploads/frontend/logo.png')}}"  alt="image" class="img-responsive lozad"  style="height: 58px;"/>
                </a> --}}
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse col-xs-8" id="main-navbar-collapse">
    
                <ul class="nav navbar-nav d " id="navs">
                    
                    @foreach ($menu_categories_f_Data->where('categoryId', '!=', null) as $menu_categories_f)
                        <li {{--  class="active" --}}>
                            <a href="{{ route('productlistPage', [app()->getLocale(),'diseaseCategoryId' => -1 ,'categoryId'=>$menu_categories_f->categoryId]) }}" >
                                
                                @if (app()->getLocale()=='en')    
                                  {{ $categoryData->where('categoryId', $menu_categories_f->categoryId)->pluck('category')->first() }} 
                                @elseif (app()->getLocale()=='ru')    
                                  {{ $categoryData->where('categoryId', $menu_categories_f->categoryId)->pluck('categoryRU')->first() }} 
                                @elseif (app()->getLocale()=='cn')    
                                  {{ $categoryData->where('categoryId', $menu_categories_f->categoryId)->pluck('categoryCN')->first() }} 
                                @endif
    
                                @if ( ($diseasecategoryData->where('categoryId', $menu_categories_f->categoryId))->count() > 0 )
                                  <i class="fa fa-angle-down" aria-hidden="true"></i>
                                @endif
                            </a>
    
                            <div class="dropdown-content main-nav-scroll row col-md-12" style="padding: 20px;" >
                              {{-- <div class="header"> <h2>Common Types</h2></div> --}}
                              <div class="row">
                                    @foreach ( ($diseasecategoryData->where('categoryId', $menu_categories_f->categoryId))->sortBy('diseaseCategory') as $diseasecategory)
                                      <div class="col col-md-4">
                                          <a 
                                          {{-- href="{{ route('productlistPage', $diseasecategory->diseaseCategoryId) }}" --}}
                                          href="{{ 
    
                                            route('productlistPage', [app()->getLocale(),'diseaseCategoryId'=> $diseasecategory->diseaseCategoryId, 'categoryId' => ''])
                                              
                                            }}"
                                          > 
                                              @if (app()->getLocale()=='en')    {{ $diseasecategory->diseaseCategory }}
                                              @elseif (app()->getLocale()=='ru')    {{ $diseasecategory->diseaseCategoryRU }}
                                              @elseif (app()->getLocale()=='cn')    {{ $diseasecategory->diseaseCategoryCN }}
                                              @endif
                                          </a>
                                      </div>
                                    @endforeach
                              </div>
                            </div>
                        </li>
                    @endforeach 
                </ul>
            </div><!-- /.navbar-collapse -->    
            @include('layouts_f.profile')  
        </nav>
    </div>
    
    
    <div class="btn-group dropdown" id="mobile_view_category" style="display: none;">
        <button type="button" class="btn btn-dark dropdown-toggle" style="background-color: green;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bars" style="color: white" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu" style="width: 200px">
            <ul class="nav navbar-nav d " id="navs">
                
                @foreach ($menu_categories_f_Data->where('categoryId', '!=', null) as $menu_categories_f)
                    <li {{--  class="active" --}} style="margin-left:23px ">
                        <a href="{{ route('productlistPage', [app()->getLocale(),'diseaseCategoryId' => -1 ,'categoryId'=>$menu_categories_f->categoryId]) }}" >
                            
                            @if (app()->getLocale()=='en')    
                              {{ $categoryData->where('categoryId', $menu_categories_f->categoryId)->pluck('category')->first() }} 
                            @elseif (app()->getLocale()=='ru')    
                              {{ $categoryData->where('categoryId', $menu_categories_f->categoryId)->pluck('categoryRU')->first() }} 
                            @elseif (app()->getLocale()=='cn')    
                              {{ $categoryData->where('categoryId', $menu_categories_f->categoryId)->pluck('categoryCN')->first() }} 
                            @endif

                            {{-- @if ( ($diseasecategoryData->where('categoryId', $menu_categories_f->categoryId))->count() > 0 )
                              <i class="fa fa-angle-down" aria-hidden="true"></i>
                            @endif --}}
                        </a>                        
                    </li>
                @endforeach               
            </ul>
        </div>
    </div>
    <br><br><br>
        

    
</div>


<script type="text/javascript">
    
     var  nav = document.getElementById('navbar_main');
     var  scroll_logo = document.getElementById('scroll_logo');

    //  var  scroll_hide = document.getElementById('scroll_hide');
     var  scroll_hide = document.getElementsByClassName('scroll_hide');
     var  navs = document.getElementById('navs');

     console.log(scroll_logo)
     console.log(scroll_hide)
     scroll_logo.style.display = 'none';

    //  scroll_hide.style.display = 'none';
     $('.scroll_hide').css('display' , 'none');

     // console.log(nav);
      
      window.onscroll = function(e){

          console.log(document.documentElement.clientWidth)

         if (window.pageYOffset >200 ) 
         {

             nav.style.backgroundColor  = "#219d20ba";
             nav.style.position   = "fixed";
             nav.style.top = '0';
             nav.style.marginTop = '0';


             scroll_logo.style.display = 'block';
             if (document.documentElement.clientWidth>=768) {
                $('.scroll_hide').css('display' , 'block');
                document.getElementById("navbar_main").style.marginLeft = "-5vw"; 
                $('#navbar_main_duplicate').css('display' , 'block');

             }
             else if (document.documentElement.clientWidth>=320 && document.documentElement.clientWidth<=400) {
                document.getElementById("navbar_main").style.marginLeft = "-5vw"; 
                $('.scroll_hide').css('display' , 'none');
                
                $('#navbar_main_duplicate').css('display' , 'none');

             }
             else{
                document.getElementById("navbar_main").style.marginLeft = "0vw"; 
                $('.scroll_hide').css('display' , 'none');
                $('#navbar_main_duplicate').css('display' , 'none');
             }
            //  scroll_hide.style.display = 'block';

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
            $('.scroll_hide').css('display' , 'none');
            // scroll_hide.style.display = 'none';
            document.getElementById("navbar_main").style.marginLeft = "0vw";
            $('#navbar_main_duplicate').css('display' , 'none');

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



{{-- main search code --}}
{{-- main search code --}}

<script type="text/javascript">

    var  categoryId = 0;
    var firstSearchedObject = {};

    $(document).ready(function() {
        $('select[name="search-category-id"]').on('change', function(){

            $('#searchInput').val('');
            this.categoryId = $('select#search-category-id').find(':selected').data('categoryid');
            console.log('====================categoryId=============', this.categoryId)

            if (this.categoryId == 0 ) {
                $("#searchInput").autocomplete({
                    source: "{{ url('/'.app()->getLocale().'/search/autocompleteajax') }}",
                    focus: function( event, ui ) {
                            
                        //$( "#search" ).val( ui.item.title ); // uncomment this line if you want to select value to search box  
                        return false;
                    },
                    minLength: 2,
                    select: function( event, ui ) {
                        window.location.href = ui.item.url;
                    }
                }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                    searchFirstDataHandler(item);
                    
                    var inner_html = '<a href="' +item.url+ '" ><div class="list_item_container"><div class="image"><img src="/image/imageResize?url=' + item.image + '&sizeX=75&sizeY=75" ></div><div class="label" style="padding-left:40px;"><h5><b>' + item.title + '</b></h5><span class="search-2ndline">' + item.genericcompany + ' | {{__('productdetails.generic')}}' +' '+item.genericname + '</span></div></div></a>';
                    return $( "<li class='list-group-item ' style='padding:0px; margin:0px;'></li>" )
                            .data( "item.autocomplete", item )
                            .append(inner_html)
                            .appendTo( ul );
                            
                            
                    

                };
            }
            else if (this.categoryId>0) 
            {
    
                // console.log('categoryId')
    
                $("#searchInput").autocomplete({
                    source: "{{ url('/'.app()->getLocale().'/search/autocompleteajax2') }}"+"?categoryId="+this.categoryId,
                    focus: function( event, ui ) {
                        //$( "#search" ).val( ui.item.title ); // uncomment this line if you want to select value to search box  
                        return false;
                    },
                    minLength: 2,
                    select: function( event, ui ) {
                        window.location.href = ui.item.url;
                    }
                }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                    searchFirstDataHandler(item);

                    var inner_html = '<a href="' +item.url+ '" ><div class="list_item_container"><div class="image"><img  src="/image/imageResize?url=' + item.image + '&sizeX=75&sizeY=75" ></div><div class="label" style="padding-left:40px;"><h5><b>' + item.title + '</b></h5><span class="search-2ndline">' + item.genericcompany + ' | {{__('productdetails.generic')}}' +' '+item.genericname+ '</span></div></div></a>';
                    return $( "<li class='list-group-item ' style='padding:0px; margin:0px;'></li>" )
                            .data( "item.autocomplete", item )
                            .append(inner_html)
                            .appendTo( ul );
                            
                    

                };
            
            }
        });


  
        $("#searchInput").autocomplete({
            source: "{{ url('/'.app()->getLocale().'/search/autocompleteajax') }}",
            focus: function( event, ui ) {
                //$( "#search" ).val( ui.item.title ); // uncomment this line if you want to select value to search box  
                return false;
            },
            minLength: 2,
            select: function( event, ui ) {
                window.location.href = ui.item.url;
            }
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
            
            searchFirstDataHandler(item);
            var inner_html = '<a href="' +item.url+ '" ><div class="list_item_container"><div class="image"><img src="/image/imageResize?url=' + item.image + '&sizeX=75&sizeY=75" ></div><div class="label" style="padding-left:40px;"><h5><b>' + item.title + '</b></h5><span class="search-2ndline">' + item.genericcompany + ' | {{__('productdetails.generic')}}' +' '+item.genericname + '</span></div></div></a>';
            return $( "<li class='list-group-item ' style='padding:0px; margin:0px;'></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
                    
            
        };

        function paginationHandler(){
            console.log('===============paginationHandler===============called=================')
        }

        function searchFirstDataHandler(obj={}){
            if(obj.serial==1){
                firstSearchedObject = obj
                document.getElementById("search-link").href=firstSearchedObject.url
            }
        }

        $(document).ready(function() {

            $('#searchInput').on('keydown', function(){
                var searchtag=document.getElementById("search-link").href; 
                
                console.log(searchtag)

                if((searchtag || '').length>10){

                    var wage = document.getElementById("searchInput");
                   
                    wage.addEventListener("keydown", function (e) {
                        if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                            var searchtag=document.getElementById("search-link").href; 

                            window.location = searchtag;
                        }
                    });
                }

            });
            
        });



    });

    
</script> 
{{-- main search code --}}
{{-- main search code --}}






{{-- select scrollbar --}}
{{-- select scrollbar --}}



<script type="text/javascript">
  $(document).ready(function() {
      $('select#search-category-id').on('focus', function(){
          $("#search-category-id").height('220');
          $('#search-category-id').css("margin-top", "180px");
          console.log('focus')

      });

      $('select#search-category-id').on('blur', function(){
          $("#search-category-id").height('25');
        $('#search-category-id').css("margin-top", "0px");
          console.log('blur')
      });

      $('select#search-category-id').on('change', function(){
          $("#search-category-id").height('25');
          $('#search-category-id').css("margin-top", "0px");
          console.log('change')
      });


  });
</script>



{{-- select scrollbar --}}
{{-- select scrollbar --}}




<style>
	@media (max-width: 575px) { 
		#main-logo {
			max-height: 100px;
		}
	}

	/* // Small devices (landscape phones, 576px and up) */
	@media (min-width: 576px) { 
		#main-logo {
			max-height: 100px;
		}
	 }

	/* // Medium devices (tablets, 768px and up) */
	@media (min-width: 768px) { 
		#main-logo {
			max-height: 120px;
		}
        #searchInput, #searchInputContainer {
            width: 100% !important;
        }
        .floating-right-nav{
            padding-right: 5vw;
        }
	 }

	/* // Large devices (desktops, 992px and up) */
	@media (min-width: 992px) { 
		#main-logo {
			max-height: 120px;
		}
         #searchInputContainer {
            width: 41.66666667% !important;
        }
        .floating-right-nav{
            padding-right: 10vw;
        }
	 }

	/* // Extra large devices (large desktops, 1200px and up) */
	@media (min-width: 1200px) { 
		#main-logo {
			
		}
        .floating-right-nav{
            padding-right: 15vw;
        }
	 }
     /* // Extra large devices (large desktops, 1200px and up) */
	@media (min-width: 1500px) { 
		#main-logo {
			
		}
        .floating-right-nav{
            padding-right: 20vw;
        }
	 }
</style>


<style>
    @media (min-width:100px) and  (max-width:399px) {
       
       .search select {
           display: none !important
       }
    }
    @media (min-width:400px) and (max-width:480px) {
       
        .search select {
            display: block !important
        }
    }
    
</style>

<style>

    @media  (max-width:400px) {
       .shopping-cart {
           text-align: center !important
       }
    }

</style>


<style>
    @media (max-width: 1150px) { 
        
        #navbar_main{
            display:none;
        }
        #mobile_view_category{
            display:inline !important;
            /* position:fixed; */
            z-index: 100;
            
        }
        #navs{
            /* width: 500px !important; */
            height: 200px !important;
            overflow: scroll !important;
        }
        
        .list_item_container  {
            width: 80vw;
            height: 40px;
        }

        .list_item_container .image {
            margin-top: 15px;
        }

        .label{
            margin-left: 100px !important;
            flex-wrap: wrap;
        }

        .list_item_container h5{
            font-size: 12px;
        }

        .image img{
            width: 65px !important;
        }
        .image {
            width: 20%;
        }

        .label{
            width: 90%;
        }

        .main-nav-scroll{
            overflow-y: scroll !important; 
            max-height: 350px !important; 
            margin-top: -90px !important;
        }

        .search-2ndline{
            // padding-left: 25px;
            white-space: normal;

        }
        
    }

	/* // Small devices (landscape phones, 576px and up) */
	@media (min-width: 451px) { 
		.ui-autocomplete .list_item_container  {
			width: 550px;
        }
        
     }

    @media (max-width: 500px) { 
        #search-category-id{
            display: none;
        }
        .image img{
            width: 45px !important;
            height: 45px !important;
            padding-left: 1px;
        }
        .image {
            width: 20%;
        }

    }


    
    {{-- search scroll bar apply --}}
    {{-- search scroll bar apply --}}
    .ui-autocomplete{
        overflow-y: scroll !important; 
        max-height: 350px !important; 
    }
    {{-- search scroll bar apply --}}
    {{-- search scroll bar apply --}}



</style>

@endsection

{{--  search problem solving  --}}
{{--  ui-menu ui-widget ui-widget-content ui-autocomplete ui-front  --}}
