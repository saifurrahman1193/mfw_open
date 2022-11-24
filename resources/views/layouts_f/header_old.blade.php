{{-- NOT USED --}}
@section('header_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

<style type="text/css">
    #top-menu li
    {
        margin-right: 20px;    
    }    

    #top-menu li:hover
    {
        color: #25bb2b;    
    }  

    #header_sec
    {
        display: flex;
        align-items: center; 
    }


</style>


<header class="border">
<div class="container">
	<div class="header-sec" id="header_sec">

        <div class="col-md-6   header">
            <div class="header-left">
        		{{-- <div class="top-bar-list phone">
                    <i class="flaticon-phone-call"></i>
                    <p>+880 1916 942 634</p>
                </div>
                <div class="top-bar-list">
                    <i class="flaticon-e-mail-envelope"></i>
                    <p>medicineforworld@gmail.com</p>
                </div> --}}
                <ul class="nav navbar-nav d" id="top-menu">

                  <li><a  href="{{ route('home_f') }}">
                    @if (app()->getLocale()=='en')   Home
                    @elseif (app()->getLocale()=='ru')   Главная 
                    @elseif (app()->getLocale()=='cn')    家
                    @endif
                  </a></li>
                  <li><a  href="#">
                    @if (app()->getLocale()=='en')   Contact
                    @elseif (app()->getLocale()=='ru')   контакт 
                    @elseif (app()->getLocale()=='cn')    联系
                    @endif
                  </a></li>
                  <li><a  href="#">
                    @if (app()->getLocale()=='en')   Sitemap
                    @elseif (app()->getLocale()=='ru')   Карта сайта 
                    @elseif (app()->getLocale()=='cn')    网站地图
                    @endif
                  </a></li>
                  <li><a  href="#">
                    @if (app()->getLocale()=='en')   Sitemap
                    @elseif (app()->getLocale()=='ru')   Блог
                    @elseif (app()->getLocale()=='cn')    博客
                    @endif
                  </a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-6  header">
        	<div class="header-right">
            	{{-- <div class="top-bar-list">
                <i class="flaticon-placeholder"></i>
                <a href="#"><p>Store locator</p></a>
                </div> --}}
                {{-- <div class="top-bar-list">
                <i class="flaticon-delivery"></i>
                <a href="#"><p>Track order</p></a>
                </div> --}}

                <div class="top-bar-list" id="language-bar" >
                    {{-- <select name="language" class="form-control">
                        <option value="english"><a class="main-a" href="">English<i class="fa fa-angle-down" aria-hidden="true"></i></a></option>
                        <option value="russian"><a href="">Russian<i></i></a></option>
                        <option value="chinese"><a href="">Chinese<i></i></a></option>
                    </select> --}}

                  {{--   <select  class="selectpicker" data-width="fit">
                        <option data-content='<span class="flag-icon flag-icon-us"></span> English'>English</option>
                        <option data-content='<span class="flag-icon flag-icon-ru"></span> Russian' >Russian</option>
                        <option data-content='<span class="flag-icon flag-icon-cn"></span> Chinese'>Chinese</option>
                    </select> --}}

                    <select  class="selectpicker" data-width="fit" id="language">
                        <option data-content='<span class="flag-icon flag-icon-us"></span> English' value="en" {{ app()->getLocale()=='en'? "selected":'' }}>English</option>
                        <option  data-content='<span class="flag-icon flag-icon-ru"></span> русский' value="ru" {{ app()->getLocale()=='ru'? "selected":'' }}>русский</option>
                        <option data-content='<span class="flag-icon flag-icon-cn"></span> 中文' value="cn" {{ app()->getLocale()=='cn'? "selected":'' }}>中文</option>
                    </select>
                </div>



                <div class="top-bar-list" id="login-bar"  >
                    @if (!(Auth::check())) <i class="flaticon-login" ></i> @endif
                <p>

                    @if (Auth::check())
                            


                            <div class="the-navbar__user-meta flex items-center" id="user-profile-area">
                                    {{-- <div class="text-right leading-tight hidden sm:block">
                                        <p class="font-semibold">amir</p>
                                        <small>Available</small>
                                    </div> --}}
                                    <button type="button" class="vs-con-dropdown parent-dropdown cursor-pointer">
                                        <div class="con-img ml-3">
                                            @if ( strlen($userData->photoPath)==0 )
                                                <i class="fa fa-user"  class="rounded-full shadow-md cursor-pointer block" width="40" height="40"></i>

                                            @else
                                                <img  data-src="{{ asset($userData->photoPath) }}" alt="user-img" class="rounded-full shadow-md cursor-pointer block lozad" width="40" height="40">

                                            @endif



                                        </div>
                                    </button>
                            </div>



                            <div class="con-vs-dropdown--menu vs-dropdown-menu vx-navbar-dropdown rightx" style="margin-left: 57px; top: 42.4px;" id="con-vs-dropdown--menu">
                               <div class="vs-dropdown--custom vs-dropdown--menu">
                                  <ul style="min-width: 9rem;">
                                    
                                     <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                                        <span class="ml-2">Profile</span>
                                     </li>

                                     <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                                        <a href="{{ route('customerPrescriptions') }}">
                                            <span class="ml-2">Prescriptions</span>
                                        </a>
                                     </li>

                                     <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white mt-0">
                                        <span class="ml-2 mr-2">
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();" >
                                               <form id="logout-form" action="{{ route('logout') }}" method="POST" {{-- style="display: none;" --}}  >
                                                  {{ csrf_field() }}
                                               </form>Log Out                               
                                            </a>
                                        </span>

                                     </li>

                                     {{-- <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                                        <span class="feather-icon select-none relative">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail w-4 h-4">
                                              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                              <polyline points="22,6 12,13 2,6"></polyline>
                                           </svg>
                                        </span>
                                        <span class="ml-2">Inbox</span>
                                     </li>
                                     <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                                        <span class="feather-icon select-none relative">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4">
                                              <polyline points="9 11 12 14 22 4"></polyline>
                                              <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                           </svg>
                                        </span>
                                        <span class="ml-2">Tasks</span>
                                     </li>
                                     <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                                        <span class="feather-icon select-none relative">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square w-4 h-4">
                                              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                           </svg>
                                        </span>
                                        <span class="ml-2">Chat</span>
                                     </li>
                                     <li class="flex py-2 px-4 cursor-pointer hover:bg-primary hover:text-white">
                                        <span class="feather-icon select-none relative">
                                           <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart w-4 h-4">
                                              <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                           </svg>
                                        </span>
                                        <span class="ml-2">Wish List</span>
                                     </li> --}}
                                     {{-- <div class="vs-component vs-divider m-1">
                                        <span class="vs-divider-border after" style="width: 100%; border-top: 1px solid rgba(0, 0, 0, 0.1);"></span>
                                        <!----><span class="vs-divider-border before" style="width: 100%; border-top: 1px solid rgba(0, 0, 0, 0.1);"></span>
                                     </div> --}}
                                     
                                  </ul>
                               </div>
                               <div class="vs-dropdown--menu--after" style="top: 10px;"></div>
                            </div>





                    @else
                        <b><a href="{{ route('customerregistration') }}">
                            @if (app()->getLocale()=='en')    Register
                            @elseif (app()->getLocale()=='ru')   регистр 
                            @elseif (app()->getLocale()=='cn')    寄存器
                            @endif
                        </a></b> 
                        or 
                        <b><a href="{{ route('customerLogin') }}">
                            @if (app()->getLocale()=='en')    Log In
                            @elseif (app()->getLocale()=='ru')   авторизоваться 
                            @elseif (app()->getLocale()=='cn')   登录
                            @endif
                            
                        </a></b>
                    @endif
                    {{-- | 
                    <b><a href="{{ route('login') }}" >Admin</a></b> --}}
                </p>
                </div>
        	</div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>




    

</header>


<script type="text/javascript">
    $(document).ready(function() {
        $(function(){
            $('.selectpicker').selectpicker();
        });

        // $('select[name=selValue]').val(2);
        // $('.selectpicker').selectpicker('refresh');
    });
</script>



<style type="text/css">
    #language-bar .btn-default{
        background-color: transparent;
        border-color: transparent;
    }
</style>


<style type="text/css">

    
    @if (Auth::check() and (\Request::route()->getName())=='home_f' )
        #language-bar{
            padding-top: 0px;
        }
        #login-bar{
            margin-top: 5px;
        }
    @elseif (Auth::check())
        #language-bar{
            padding-top: 17px;
        }
    @elseif(!(Auth::check()))
        #login-bar{
            padding-top: 6px;
        }
    @endif
</style>

{{-- user profile dropdown menu --}}
<style type="text/css">
    #con-vs-dropdown--menu{
        display: none;
        width: 130px;
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

<style type="text/css">
    .items-center {
    -webkit-box-align: center !important;
    -ms-flex-align: center !important;
    align-items: center !important;
    }
    .flex {
        display: -webkit-box !important;
        display: -ms-flexbox !important;
        display: flex !important;
    }

    .sm\:block {
        display: block !important;
    }
    .text-right {
        text-align: right !important;
    }
    .leading-tight {
        line-height: 1.25 !important;
    }
    .hidden {
        display: none !important;
    }

    .cursor-pointer {
        cursor: pointer !important;
    }
    .vs-con-dropdown {
        color: inherit;
    }
    .vs-con-dropdown {
        font-size: 1rem;
    }
    .vs-con-dropdown {
        position: relative;
        display: inline-block;
        border: 0;
        background: transparent;
    }

    .ml-3 {
        margin-left: .75rem !important;
    }

    .vs-con-dropdown * {
        pointer-events: none;
    }

    .cursor-pointer {
        cursor: pointer !important;
    }
    .vs-con-dropdown {
        color: inherit;
    }

    .shadow-md {
        -webkit-box-shadow: 0 4px 8px 0 rgba(0,0,0,.12),0 2px 4px 0 rgba(0,0,0,.08) !important;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,.12),0 2px 4px 0 rgba(0,0,0,.08) !important;
    }
    .block {
        display: block !important;
    }
    .cursor-pointer {
        cursor: pointer !important;
    }
    .rounded-full {
        border-radius: 9999px !important;
    }
    .vs-con-dropdown * {
        pointer-events: none;
    }

    .vs-con-dropdown {
        color: inherit;
    }
    .vs-con-dropdown {
        font-size: 1rem;
    }

    .con-vs-dropdown--menu {
        z-index: 42000;
    }
    .con-vs-dropdown--menu {
        padding-top: 10px;
        position: absolute;
        height: auto;
        width: auto;
        z-index: 40000;
        -webkit-transform: translate(-100%);
        transform: translate(-100%);
        -webkit-transition: opacity .25s,width .3s ease,-webkit-transform .25s;
        transition: opacity .25s,width .3s ease,-webkit-transform .25s;
        transition: opacity .25s,transform .25s,width .3s ease;
        transition: opacity .25s,transform .25s,width .3s ease,-webkit-transform .25s;
    }

    .vs-dropdown--custom {
        padding: 5px !important;
            padding-top: 5px;
        padding-top: 8px !important;
    }
    .vs-dropdown--menu {
        background: #fff;
        padding-left: 0 !important;
        border-radius: 5px;
        -webkit-box-shadow: 0 5px 25px 0 rgba(0,0,0,.1);
        box-shadow: 0 5px 25px 0 rgba(0,0,0,.1);
        border: 1px solid rgba(0,0,0,.1);
        padding-top: 5px;
        padding-bottom: 5px;
        position: relative;
        margin: 0;
    }

    #login-bar ol, #login-bar  ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    .px-4 {

        padding-left: 1rem !important;
        padding-right: 1rem !important;

    }
    .py-2 {

        padding-top: .5rem !important;
        padding-bottom: .5rem !important;

    }
    .flex {

        display: -webkit-box !important;
        display: -ms-flexbox !important;
        display: flex !important;

    }


    .select-none {

        -webkit-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;

    }
    .relative {

        position: relative !important;

    }
    .feather-icon {

        display: -webkit-inline-box;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;

    }

    .cursor-pointer {

        cursor: pointer !important;

    }


    .feather {

        font-family: feather !important;
        speak: none;
        font-style: normal;
        font-weight: 400;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;

    }
    .w-4 {

        width: 2rem !important;
        color: green;

    }
    .h-4 {

        height: 1rem !important;

    }

    .cursor-pointer {

        cursor: pointer !important;

    }


    feather {

        font-family: feather !important;
        font-style: normal;
        font-weight: 400;
        font-variant: normal;
        text-transform: none;
        line-height: 1;

    }




    .feather {

        font-family: feather !important;
        font-style: normal;
        font-weight: 400;
        font-variant: normal;
        text-transform: none;
        line-height: 1;

    }
    .cursor-pointer {

        cursor: pointer !important;

    }
    #login-bar ol, #login-bar  ul {

        list-style-type: none;

    }

    .vs-dropdown--menu--after {

        right: 10px;

    }
    .vs-dropdown--menu--after, .vs-dropdown-right--menu--after {

        position: absolute;
        width: 10px;
        height: 10px;
        display: block;
        background: #fff;
        -webkit-transform: rotate(45deg) translate(-7px);
        transform: rotate(45deg) translate(-7px);
        border-top: 1px solid rgba(0,0,0,.1);
        border-left: 1px solid rgba(0,0,0,.1);
        z-index: 10;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;

    }


</style>


<script type="text/javascript">
    jQuery(document).ready(function($) {
         $('select[id="language"]').on('change', function(){
            var language = $(this).val();

              location.href = '/frontendSetLanguage/'+language;

        });
    });
</script>

@endsection