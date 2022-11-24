@section('header_content')


{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

{{-- <link rel="stylesheet" href="{{ asset('frontend/css/mdb.min.css') }}"> --}}

{{-- style="max-height: 51px !important;" --}}
<header class="border safari-header-issue-container" >
<div class="container safari-header-issue-container" >
	<div class="header-sec safari-header-issue-container" id="header_sec">
        <!--Navbar -->
            <nav class="navbar navbar-default safari-header-issue-container" style="background:  rgba(192,254,195,.9) !important">
              <div class="container-fluid safari-header-issue-container dropdown-menu-safari-issue">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header safari-header-issue-container  safari-mt-neg4">
                  
                  <ul class="nav navbar-nav navbar-right safari-header-issue-container " style="display: inline-flex" >
                    {{--  @include('layouts_f.rightnavbar_top')  --}}
                  </ul>

                  {{-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button> --}}
                  {{-- <a class="navbar-brand" href="#">Web</a> --}}
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                {{--  <div class="collapse navbar-collapse safari-header-issue-container " id="header-navbar-collapse">  --}}
                <div id="android_margin_top_reduced">
                  
                  {{-- HOME | CONTACT | SITEMAP --}}
                  <ul class="nav navbar-nav safari-header-issue-container" id="hcs_container_d">
                    <li {{ ( (Request::route()!=null? Request::route()->getName():'error') )=='home_f'? 'class=active' :  '' }}> <a class="nav-link safari-header-issue-container"   
                      href="{{ route('home_f', app()->getLocale()) }}"> {{ __('header.Home') }} </a></li>
                      
                    <li {{ ( (Request::route()!=null? Request::route()->getName():'error') )=='contact_f'? 'class=active' :  '' }}> <a class="nav-link safari-header-issue-container" href="{{ route('contact_f', app()->getLocale()) }}"> {{ __('header.Contact') }} </a></li>

                    <li {{ ( (Request::route()!=null? Request::route()->getName():'error') )=='sitemap_f'? 'class=active' :  '' }}> <a class="nav-link safari-header-issue-container"  href="{{ route('sitemap_f', app()->getLocale()) }}">  {{ __('header.Sitemap') }} </a></li>
                  </ul>
                  
                  <ul class="nav navbar-nav navbar-right" id="lcnp_container">
                  {{-- HOME | CONTACT | SITEMAP --}}
                  

                    
                    @include('layouts_f.rightnavbar')
                    

                    {{-- <ul class="nav navbar-nav" id="hcs_container_m">
                      <li {{ ( (Request::route()!=null? Request::route()->getName():'error') )=='home_f'? 'class=active' :  '' }}> <a class="nav-link"   
                        href="{{ route('home_f', app()->getLocale()) }}"> {{ __('header.Home') }} </a></li>
                      <li {{ ( (Request::route()!=null? Request::route()->getName():'error') )=='contact_f'? 'class=active' :  '' }}> <a class="nav-link" href="{{ route('contact_f', app()->getLocale()) }}"> {{ __('header.Contact') }} </a></li>
                      <li {{ ( (Request::route()!=null? Request::route()->getName():'error') )=='sitemap_f'? 'class=active' :  '' }}> <a class="nav-link"  href="{{ route('sitemap_f', app()->getLocale()) }}">  {{ __('header.Sitemap') }} </a></li>
                    </ul> --}}


                  </ul>



                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
        <!--/.Navbar -->
        
    </div>
</div>




    

</header>


<script type="text/javascript">
    $(document).ready(function() {
        $(function(){
            $('.selectpicker').selectpicker();
        });
    });
</script>



<style type="text/css">
    #language-bar .btn-default, #currency-bar .btn-default{
        background-color: transparent;
        border-color: transparent;
    }
</style>





<script type="text/javascript">
    $(document).ready(function() {
        $('#user-profile-area').on('click ', function(event) {
            $('#con-vs-dropdown--menu').css('display', 'block');
            $('#con-vs-dropdown--menu').css('position', 'fixed');
        }); 


        // $('#user-profile-area').on('click  ', function(event) {
        //     $('#con-vs-dropdown--menu').css('display', 'none');
        // }); 
        $(document).on('click','body',function(e){
            if( !($(e.target).closest("#user-profile-area").length > 0) ) {
                $('#con-vs-dropdown--menu').css('display', 'none');
            }
        });

        

    });
</script>



<script type="text/javascript">
    jQuery(document).ready(function($) {
         $('select[id="language"]').on('change', function(){
            var language = $(this).val();

              location.href = '/frontendSetLanguage/'+language;

        });
    });

    jQuery(document).ready(function($) {
         $('select[id="currency"]').on('change', function(){
            var currency = $(this).val();

              location.href = '/{{ app()->getLocale() }}/frontendSetCurrency/'+currency;

        });
    });
</script>




{{-- navbar --}}
<style>
/* #header_sec .navbar-default {
  background-color: #55b3612e;
  border-color: #55b3612e;
} */
/* #header_sec .navbar-default .navbar-brand {
  color: ##111111b3;
}
#header_sec .navbar-default .navbar-brand:hover, #header_sec .navbar-default .navbar-brand:focus {
  color: #e5dbdb;
} */
#header_sec .navbar-default .navbar-text {
  color: ##111111b3;
}
#header_sec .navbar-default .navbar-nav > li > a {
  color: #3d4448;
  padding-left: 20px;
  padding-right: 20px;
}

@media (max-width: 767px) {
  #header_sec .navbar-default .navbar-nav > li > a {
    padding-left: 5px;
    padding-right: 5px;
    margin-top: 5px;
  }
}

#header_sec .navbar-default .navbar-nav > li > a:hover, #header_sec .navbar-default .navbar-nav > li > a:focus {
  color: #3d4448;
  background-color: #55b3612e;
}
#header_sec .navbar-default .navbar-nav > li > .dropdown-menu {
  background-color: #eff9f0;
}
#header_sec .navbar-default .navbar-nav > li > .dropdown-menu > li > a {
  color: ##111111b3;
}
#header_sec .navbar-default .navbar-nav > li > .dropdown-menu > li > a:hover,
#header_sec .navbar-default .navbar-nav > li > .dropdown-menu > li > a:focus {
  color: #403737;
  background-color: #55b3612e;
}
#header_sec .navbar-default .navbar-nav > li > .dropdown-menu > li > .divider {
  background-color: #55b3612e;
}
#header_sec .navbar-default .navbar-nav > .active > a, #header_sec .navbar-default .navbar-nav > .active > a:hover, #header_sec .navbar-default .navbar-nav > .active > a:focus {
  color: #3e3232;
  background-color: #55b3612e;
  font-weight: bold;
}
#header_sec .navbar-default .navbar-nav > .open > a, #header_sec .navbar-default .navbar-nav > .open > a:hover, #header_sec .navbar-default .navbar-nav > .open > a:focus {
  color: #3e3232;
  background-color: #55b3612e;
}
#header_sec .navbar-default .navbar-toggle {
  border-color: #55b3612e;
}
#header_sec .navbar-default .navbar-toggle:hover, #header_sec .navbar-default .navbar-toggle:focus {
  background-color: #55b3612e;
}
#header_sec .navbar-default .navbar-toggle .icon-bar {
  background-color: ##111111b3;
}
#header_sec .navbar-default .navbar-collapse,
#header_sec .navbar-default .navbar-form {
  border-color: ##111111b3;
}
#header_sec .navbar-default .navbar-link {
  color: ##111111b3;
}
#header_sec .navbar-default .navbar-link:hover {
  color: #e5dbdb;
}

@media (max-width: 767px) {
  #header_sec .navbar-default .navbar-nav .open .dropdown-menu > li > a {
    color: #261f1f;
  }
  #header_sec .navbar-default .navbar-nav .open .dropdown-menu > li > a:hover, #header_sec .navbar-default .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #261f1f;
  }
  #header_sec .navbar-default .navbar-nav .open .dropdown-menu > .active > a, #header_sec .navbar-default .navbar-nav .open .dropdown-menu > .active > a:hover, #header_sec .navbar-default .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #000;
    background-color: #55b3612e;
  }

}

.navbar-right li 
{
    background-color: transparent;
}
</style>


<style>
@media (max-width: 767px) {
  #hcs_container_d{
    display: none;
  }

  

  .desktop-none{
    display: none;
  }
  #android_margin_top_reduced{
    margin-top:-15px !important;
  }

}

@media (min-width: 768px) {
  #hcs_container_m{
    display: none;

  }

  .mobile-none{
    display: none;
  }
}

@media (max-width: 767px) {
  #hcs_container_m{
    display: inline-flex;
  }
}


/* lcnp_container */
@media (max-width: 767px) {
  #lcnp_container{
    display: inline-flex;
  }
}

@media (min-width: 768px) {
  #lcnp_container{
    display: block;

  }
}


/* language-bar */
@media (max-width: 767px) {
  #currency-bar {
    /* padding:-100px !important; */
    margin-left: -5px !important;
  }

  #language-bar{
    padding-left: 0px !important;
    max-width: 120px !important;
  }
  #notification-container{
    padding-right: 5px !important;
    padding-left: 5px !important;
  }


  #notification-container-dorpdown{
    margin-left: -198px;
    max-width: 310px !important;
  }

  #notification-container-dorpdown > li > a{
    display: flex;  
    flex-wrap: wrap;
    font-size: 12px;
    max-width: 320px !important;

  }

  #profile-container-dorpdown{
    margin-left: -166px;
  }



  
}


</style>

<script>
  $(document).ready(function(){
    $('.toggle-responsive').click(function() {
        $('#header-navbar-collapse').removeClass('collapsed');
        $('#header-navbar-collapse').addClass('collapse in');
        $("#header-navbar-collapse").attr("aria-expanded","true");
        $("#header-navbar-collapse").removeAttr("style");
    });
  })
</script>

<style scoped>
  @media (max-width: 767px) {
    #header-navbar-collapse{
        display: none;
    }
  }

  
  
</style>

@endsection