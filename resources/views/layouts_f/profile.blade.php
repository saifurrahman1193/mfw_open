{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
@if (Auth::check())

{{-- SCROLL PORTION --}}
                <ul class="nav navbar-nav navbar-right floating-right-nav" style="padding-top: 10px; ">
                    {{-- CART SHOWCASE --}}
                    <li class="nav-item">
                        <div class="scroll_hide  "  style=" color: white; font-size: 20px;" >
                            <div class="round-icon">
                                {{-- <a href="#"><i class="flaticon-video-camera"></i></a> --}}           
                                  <a href="{{route('goToCartPage', ['lang'=>app()->getLocale()] )  }}">
                                    <i  class="flaticon-shopping-bag tooltipster addtocart-round-icon" title="Cart List" 
                                            data-count="{{ DB::table('cartdetails')
                                                      ->where('customerId', Auth::user()->id)
                                                      ->where('cartId', null)
                                                      ->sum('qty') }}">
                                    </i>
                                  </a>
                            </div>
                        </div>
                    </li>
                    {{-- CART SHOWCASE --}}
                    
                    {{-- PROFILE SECTION --}}
                    <li class="nav-item" style="margin-right: 10px; padding-top: 9px !important;" > 
                        <div   class=" dropdown scroll_hide "  {{--style="padding-top: 10px; padding-right: 100px; float: right;" --}}>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="background: none">
                                @if ( strlen($userData->photoPath)==0 )
                                    <i class="fa fa-user"  class="rounded-full shadow-md cursor-pointer block" width="40" height="40"></i>
                                @else
                                    <img style="border-radius: 50%;"  data-src="{{ asset('/image/getImage?url='.$userData->photoPath) }}"  class="rounded-circle lozad" width="30" height="30">
                                @endif        
        
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" style="margin-left: -100px;">
                                {{-- <li><a href="">Profile</a></li> --}}
        
                                <li ><a style="color: dimgrey" href="{{ route('profileUpdate', [ app()->getLocale() ]) }}">{{ __('header.profile') }}</a></li>
                                <li role="separator" class="divider"></li>
        
        
                                <li ><a style="color: dimgrey" href="{{ route('customerOrderHistory', [ app()->getLocale() ]) }}">{{ __('orderhistory.orderhistory') }}</a></li>
                                <li role="separator" class="divider"></li>
        
        
                                <li ><a style="color: dimgrey" href="{{ route('customerPrescriptions', [ app()->getLocale() ]) }}">{{ __('prescription.prescription') }}</a></li>
                                <li role="separator" class="divider"></li>
        
                                <li ><a style="color: dimgrey" href="{{ route('customerNotifications', [ app()->getLocale() ]) }}">{{ __('header.notifications') }}</a></li>
                                <li role="separator" class="divider"></li>

                                <li ><a style="color: dimgrey" href="{{ 
                                    route('dynamicPageFront', [  app()->getLocale(), 12])
                                
                                }}">{{ __('header.how_to_order') }}</a></li>
                                <li role="separator" class="divider"></li>
        
        
                                <li>
                                    <a style="color: dimgrey" href="{{ route('customerLogout', app()->getLocale() ) }}" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();" >
                                        <form id="logout-form" action="{{ route('customerLogout', app()->getLocale() ) }}" method="POST" {{-- style="display: none;" --}}  >
                                        {{ csrf_field() }}
                                        </form>{{ __('header.Logout') }}                               
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{-- PROFILE SECTION --}}
                    
                </ul> 
                {{-- SCROLL PORTION --}}
                
            @endif