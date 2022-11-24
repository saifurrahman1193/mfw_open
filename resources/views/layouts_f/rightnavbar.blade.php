{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

<?php 
    $languagesettingsdata = Cache::rememberForever('languagesettingsdata', function () {
        return DB::table('languagesettings')->where('isOn', 1)->get();
    });
?>


<li class="nav-item " style="padding-top: 9px; z-index: 500000000000000000000000;">
    <div class="top-bar-list  safari-header-issue" id="language-bar" >

        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                @if (app()->getLocale()=='en' ) <img src="{{ asset('/images/flags/us.svg') }}" alt="en" style="max-width: 24px;"> English
                @elseif (app()->getLocale()=='cn' ) <img src="{{ asset('/images/flags/cn.svg') }}" alt="cn" style="max-width: 24px;"> 中文
                @elseif (app()->getLocale()=='ru' ) <img src="{{ asset('/images/flags/ru.svg') }}" alt="ru" style="max-width: 24px;"> русский
                @endif
                <span class="caret"></span>
            </button>
            
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                @foreach ($languagesettingsdata as $language)
                    <li>
                        <a href="{{ route('home_f', $language->language_locale_short) }}"><img src="{{ asset('/images/flags/'.$language->icon) }}" alt="en" style="max-width: 24px;"> {{ $language->language_locale }}</a>
                    </li>
                @endforeach

            </ul>
        </div>

    </div>
</li>

<li class="nav-item  dropdown-menu-safari-issue" style="padding-top: 9px; z-index: 500000000000000000000000;" >
    <div class="top-bar-list  safari-header-issue" id="currency-bar">
        <select  class=" safari-header-issue selectpicker" data-width="fit" id="currency">
            @foreach ($countryData->where('currency' , '!=', null)->sortBy('currency') as $currency)
                <option data-content='{{ $currency->hexcode }} {{ $currency->currency }}' value="{{ $currency->currency }}" {{ session('currency')==$currency->currency ? "selected":'' }}>
                    {{ $currency->currency }}
                </option>
            @endforeach
        </select>
    </div>
</li>  

@if (Auth::check())

        <li class="safari-header-issue  nav-item dropdown round-icon2 toggle-responsive safari-header-issue dropdown-menu-safari-issue" style="z-index: 500000000000000000000000;  background: transparent !important;">
            <a id="notification-container" href="#" class="safari-header-issue dropdown-toggle  safari-header-issue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                @if ( $notificationData->count() )
                    <i class="safari-header-issue fa fa-bell " style="color: #ee7171;"  data-count="{{ $notificationData->count() }}"></i>
                    <span class="safari-header-issue caret"></span></a>
                @else
                    <i class="safari-header-issue fa fa-bell " style="color: #ee7171;"  ></i>
                @endif
            <ul class="safari-header-issue dropdown-menu" id="notification-container-dorpdown">
                <li ><a href="javascript:void(0)">You have total {{ (($notificationData->where('read_at', null)->sortByDesc('created_at')))->count() }} notifications</a></li>
                @foreach ( ($notificationData->where('read_at', null)->sortByDesc('created_at'))->take(5) as $notification)
                    <li role="separator" class="safari-header-issue divider"></li>
                    <li id="safari-height-notification">
                        <a href="@if (isset($notification->contact_with_product_reviewer_request) || isset($notification->cont_with_prod_rev_req_s_mail_to_reqester))
                            {{ route('productDetailsPageCaller', [app()->getLocale(), 'genericBrandId'=>$notification->genericBrandId]) }}
                        @elseif (isset($notification->testimonialAdminToClientContactRequest))
                            {{ route('home_f', [app()->getLocale(), 'testimonialClientContactRequest'=>1] )  }}
                        @elseif (isset($notification->testimonialClientContactRequest))
                                {{ route('home_f', [app()->getLocale(), 'testimonialClientContactRequest'=>1] )  }}
                        @elseif (isset($notification->reviewId) )
                            {{ route('productDetailsPageCaller', [app()->getLocale(), 'genericBrandId'=>$notification->genericBrandId, 'reviewId'=>$notification->reviewId ]) }}
                        @elseif (isset($notification->isProfileUpdate) and $notification->isProfileUpdate=1)
                            {{ route('profileUpdateNotificationsForCustomer', [app()->getLocale(),'notificationId'=>$notification->notificationId ]) }}

                        @elseif (isset($notification->genericBrandId))
                            {{ route('productDetailsPageCaller', [app()->getLocale(),'genericBrandId'=>$notification->genericBrandId ]) }}

                        @elseif (isset($notification->isCartDeleted) and $notification->isCartDeleted==1)
                            {{ route('customerOrderHistoryAndCart', [ app()->getLocale(), 'cartId'=>-1,'notificationId'=>$notification->notificationId ]) }}

                        @elseif (isset($notification->cartId))
                            {{  route('customerOrderHistoryAndCart', [ app()->getLocale(), 'cartId'=>$notification->cartId,  'notificationId'=>$notification->notificationId ]) }}
                        @elseif (!isset($notification->cartId))
                            {{ route('customerOrderHistoryAndCart', [ app()->getLocale(), 'cartId'=>-1,'notificationId'=>$notification->notificationId  ]) }}
                        
                        @endif"><div id="safari-width-notification">{{$notification->message}}</div><span><u> Click Here</u></span>                                
                        </a>
                    
                    </li>
                    <br>
                @endforeach

                <li role="separator" class="dropdown-menu-safari-issue-divider divider safari-header-issue"></li><br>
                <li class="text-center safari-header-issue"><a href="{{ route('customerNotifications', [ app()->getLocale() ]) }}" class="font-weight-bold text-success text-capitalize safari-header-issue">See All</a></li>
            </ul>
        </li> 

    <li class="dropdown toggle-responsive nav-item "  style="z-index: 500000000000000000000000;">
        <a href="#" class="dropdown-toggle  safari-header-issue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            @if ( strlen($userData->photoPath)==0 )
                <i class="fa fa-user rounded-full shadow-md cursor-pointer block safari-header-issue" width="40" height="40"></i>
            @else
                <img style="border-radius: 50%;"  data-src="{{ asset('/image/getImage?url='.$userData->photoPath) }}"  class="rounded-circle lozad safari-header-issue" width="30" height="30">
            @endif

            <span class="caret safari-header-issue"></span></a>
        <ul class="dropdown-menu safari-header-issue-profile dropdown-menu-safari-issue" id="profile-container-dorpdown">

            <li class="dropdown-menu-safari-issue-divider"><a href="{{ route('profileUpdate', [ app()->getLocale() ]) }}">{{ __('header.profile') }}</a></li>
            <li role="separator" class="dropdown-menu-safari-issue-divider divider safari-header-issue"></li>

            <li class="dropdown-menu-safari-issue-divider"><a href="{{ route('customerOrderHistory', [ app()->getLocale() ]) }}">{{ __('orderhistory.orderhistory') }}</a></li>
            <li role="separator" class="dropdown-menu-safari-issue-divider divider safari-header-issue"></li>


            <li class="dropdown-menu-safari-issue-divider"><a href="{{ route('customerPrescriptions', [ app()->getLocale() ]) }}">{{ __('prescription.prescription') }}</a></li>
            <li role="separator" class="dropdown-menu-safari-issue-divider divider safari-header-issue"></li>

            <li class="dropdown-menu-safari-issue-divider"><a href="{{ route('customerNotifications', [ app()->getLocale() ]) }}">{{ __('header.notifications') }}</a></li>
            <li role="separator" class="dropdown-menu-safari-issue-divider divider safari-header-issue"></li>

            <li class="dropdown-menu-safari-issue-divider"><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),12 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),12 ) ) }}">{{ __('header.how_to_order') }}</a></li>
            <li role="separator" class="dropdown-menu-safari-issue-divider divider safari-header-issue"></li>

            <li>
                <a href="{{ route('customerLogout', app()->getLocale() ) }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" >
                    <form id="logout-form" action="{{ route('customerLogout', app()->getLocale() ) }}" method="POST" {{-- style="display: none;" --}}  >
                    {{ csrf_field() }}
                    </form>{{ __('header.Logout') }}                               
                </a>
            </li>
        </ul>
    </li>
@else
    <li class="nav-item ">
        <a href="{{ app()->getLocale()?action('UserController_F@customerregistration', array('lang'=>app()->getLocale() ) ) : action('UserController_F@customerregistration', array('lang'=>app()->getLocale() ) ) }}"> {{ __('header.Register') }} </a>
    </li>
    <li class="nav-item ">
        <a href="{{ app()->getLocale()?action('UserController_F@customerLogin', array('lang'=>app()->getLocale() ) ) : action('UserController_F@customerLogin', array('lang'=>app()->getLocale() ) ) }}">{{ __('header.Login') }}</a>
    </li>
@endif

<style>    
    
    /* language-bar */
    @media (max-width: 767px) {
        .r-nav-item{
            display: none !important;
    
        }

        #safari-width-notification{
            text-overflow: ellipsis; /* will make [...] at the end */
            width: 300px; /* change to your preferences */
            white-space: normal; /* paragraph to one line */
            overflow:hidden; /* older browsers */
            /* height: 20px; */
            display: inline-block;
        }
        
      
    }
    
</style>