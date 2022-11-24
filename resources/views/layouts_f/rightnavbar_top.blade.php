
<?php 
    $languagesettingsdata = Cache::rememberForever('languagesettingsdata2', function () {
        return DB::table('languagesettings')->where('isOn', 1)->get();
    });
?>

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
<li class="nav-item r-t-nav-item   safari-header-issue" style="padding-top: 9px; z-index: 500000000000000000000000;">
    <div class="top-bar-list   safari-header-issue" id="language-bar" >

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

  <li class="nav-item r-t-nav-item  safari-header-issue dropdown-menu-safari-issue" style="padding-top: 9px; z-index: 500000000000000000000000;" >
    <div class="top-bar-list   safari-header-issue" id="currency-bar" >
        <select  class="selectpicker" data-width="fit" id="currency">
            @foreach ($countryData->where('currency' , '!=', null)->sortBy('currency') as $currency)
                <option 
                      data-content='{{ $currency->hexcode }} {{ $currency->currency }}' value="{{ $currency->currency }}" {{ session('currency')==$currency->currency ? "selected":'' }}>
                       {{ $currency->currency }}
                </option>
            @endforeach
        </select>
    </div>
  </li>

  

@if (Auth::check())

        <li class="dropdown toggle-responsive nav-item r-t-nav-item   safari-header-issue dropdown-menu-safari-issue" style="z-index: 500000000000000000000000;" >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                @if ( strlen($userData->photoPath)==0 )
                    <i class="fa fa-user"  class="rounded-full shadow-md cursor-pointer block" width="40" height="40"></i>
                @else
                    <img style="border-radius: 50%;"  data-src="{{ asset('/image/getImage?url='.$userData->photoPath) }}"  class="rounded-circle lozad" width="30" height="30">
                @endif


                <span class="caret"></span></a>
            <ul class="dropdown-menu " id="profile-container-dorpdown">
                {{-- <li><a href="">Profile</a></li> --}}

                <li><a href="{{ route('profileUpdate', [ app()->getLocale() ]) }}">{{ __('header.profile') }}</a></li>
                <li role="separator" class="divider dropdown-menu-safari-issue-divider"></li>


                <li><a href="{{ route('customerOrderHistory', [ app()->getLocale() ]) }}">{{ __('orderhistory.orderhistory') }}</a></li>
                <li role="separator" class="divider dropdown-menu-safari-issue-divider"></li>


                <li><a href="{{ route('customerPrescriptions', [ app()->getLocale() ]) }}">{{ __('prescription.prescription') }}</a></li>
                <li role="separator" class="divider dropdown-menu-safari-issue-divider"></li>

                <li><a href="{{ route('customerNotifications', [ app()->getLocale() ]) }}">{{ __('header.notifications') }}</a></li>
                <li role="separator" class="divider dropdown-menu-safari-issue-divider"></li>

                <li><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),12 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),12 ) ) }}">{{ __('header.how_to_order') }}</a></li>
                <li role="separator" class="divider dropdown-menu-safari-issue-divider"></li>


                <li>
                    <a href="{{ route('customerLogout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" >
                        <form id="logout-form" action="{{ route('customerLogout') }}" method="POST" {{-- style="display: none;" --}}  >
                        {{ csrf_field() }}
                        </form>{{ __('header.Logout') }}                               
                    </a>
                </li>
            </ul>
        </li>

        <li class=" nav-item r-t-nav-item dropdown round-icon2 toggle-responsive dropdown-menu-safari-issue" style="z-index: 500000000000000000000000; background: transparent !important;">
            <a id="notification-container" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{-- Notifications --}}

                @if ( $notificationData->count() )
                <i class="fa fa-bell " style="color: #ee7171;"  data-count="{{ $notificationData->count() }}"></i>
                <span class="caret"></span>
                @else
                <i class="fa fa-bell " style="color: #ee7171;"  ></i>
                @endif
            </a>
            <ul class="dropdown-menu" id="notification-container-dorpdown">

                <li ><a href="javascript:void(0)">You have total {{ (($notificationData->where('read_at', null)->sortByDesc('created_at')))->count() }} notifications</a></li>

                @foreach ( ($notificationData->where('read_at', null)->sortByDesc('created_at'))->take(5) as $notification)

                    <li role="separator" class="divider dropdown-menu-safari-issue-divider"></li>
                    <li  style="overflow-wrap: break-word">
                    <a class=" flex-column" style="overflow-wrap: break-word; white-space: normal;" href="@if (isset($notification->contact_with_product_reviewer_request) || isset($notification->cont_with_prod_rev_req_s_mail_to_reqester))
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
                    
                    @endif">
                    <p  style="overflow-wrap: break-word">
                        {{$notification->message}}
                        <u>Click Here</u> 
                    </p>
                    </a>
                    
                    </li>
                @endforeach

                    {{-- more notifications --}}
                    {{-- @if ( (($notificationData->sortByDesc('created_at'))->unique('message'))->count() > 5) --}}
                        <li role="separator" class="divider dropdown-menu-safari-issue-divider"></li>
                        <li class="text-center "><a href="{{ route('customerNotifications', [ app()->getLocale() ]) }}" class="font-weight-bold text-success text-capitalize">See All</a></li>
                    {{-- @endif --}}
                    {{-- more notifications --}}
            </ul>            
        </li> 

        


    
@else
    <li class="nav-item r-t-nav-item" >
        <a href="{{ app()->getLocale()?action('UserController_F@customerregistration', array('lang'=>app()->getLocale() ) ) : action('UserController_F@customerregistration', array('lang'=>app()->getLocale() ) ) }}"> {{ __('header.Register') }} </a>
    </li>
    <li class="nav-item r-t-nav-item" style="margin-top: 10px; height: 30px; width: 1px;">
        <img src="{{ asset('/image/getImage?url='.'images/vertical_plumb.gif') }}" alt="image">
    </li>
    <li class="nav-item r-t-nav-item">
        <a href="{{ app()->getLocale()?action('UserController_F@customerLogin', array('lang'=>app()->getLocale() ) ) : action('UserController_F@customerLogin', array('lang'=>app()->getLocale() ) ) }}">{{ __('header.Login') }}</a>
    </li>
@endif



<style>
    @media (min-width: 768px) {
        .r-t-nav-item{
            display: none !important;
    
        }

        
    }
    
</style>