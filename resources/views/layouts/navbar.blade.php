
<style>
  .round-icon2 a i[data-count]:after {
        position: absolute;
        margin-top: -15px;
        margin-left: -5px;
        content: attr(data-count);
        font-size: 63%;
        padding: .4em;
        border-radius: 30%;
        color: white;
        background: red;
        text-align: center;
        min-width: 1em; 
    }
</style>


@section('navbar_content')

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

        <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

      {{-- <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center"> --}}
        {{-- <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a> --}}
        {{-- <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a> --}}
      {{-- </div> --}}


      <div class="navbar-menu-wrapper  col-lg-12 d-flex align-items-center">

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>

        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>

        






        <ul class="navbar-nav navbar-nav-right ">

          <li class="nav-item" id="remove_cache_desktop">
            <a href="{{route('cacheRemove')}}" target="_blank" >
              <button type="button" class="btn btn-danger">Remove Cache</button>
            </a>
          </li>
          <li class="nav-item" id="remove_cache_mobile">
            <a href="{{route('cacheRemove')}}" target="_blank" >
              <button type="button" class="btn btn-xs btn-danger">
                <i class="fa fa-archive" aria-hidden="true"></i>
              </button>
            </a>
          </li>

          <li class="nav-item" id="frontend_desktop">
            <a href="/" target="_blank" >
              <button type="button" class="btn btn-light">
                <i class="fa fa-refresh" aria-hidden="true"></i>
                FrontEnd
              </button>
            </a>
          </li>
          <li class="nav-item" id="frontend_mobile">
            <a href="/" target="_blank" >
              <button type="button" class="btn btn-xs btn-light">
                <i class="fa fa-refresh" aria-hidden="true"></i>
              </button>
            </a>
          </li>

          <style>
            @media (max-width: 767px) {
            
            #frontend_mobile{
              display: block;
              width: 15px !important;
            }
            #remove_cache_mobile{
              display: block;
              width: 15px !important;
            }
            #frontend_desktop{
              display: none;

}
            #remove_cache_desktop{
              display: none;
            }
            
            }
            @media (min-width: 767px) {
            #frontend_desktop{
              display: block;

            }
            #remove_cache_desktop{
              display: block;
            }
            #frontend_mobile{
              display: none;
            }
            #remove_cache_mobile{
              display: none;
            }
            
          </style>

        

          {{-- notifications --}}
          <li class="nav-item dropdown  round-icon2">
            <a class="nav-link  dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"  data-count="{{ DB::table('notifications_admin')->where('read_at', null)->count() }}"></i>
              <span class="count"></span>
              
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown" style="overflow:scroll; overflow-x: hidden; height:400px;">
              {{-- <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have {{ DB::table('notifications_admin')->whereNull('read_at')->pluck('inquirerId')->unique()->count() }} new notifications
                </p> --}}
                {{-- <span class="badge badge-pill badge-warning float-right">View all</span> --}}
              {{-- </a> --}}

              <a class="dropdown-item preview-item" href="{{ route('adminNotifications') }}">
                You have total 
                {{ DB::table('notifications_admin')->where('read_at', null)->count() }} 
                new notofications
              </a>
              <div class="dropdown-divider"></div>


              @foreach (DB::table('notifications_admin')->where('read_at', null)->orderBy('created_at', 'DESC')->get()->take(5) as $notification)
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item" href="@if(isset($notification->customer_to_admin_contact) && $notification->customer_to_admin_contact != null )
                  {{ route('customer_to_admin_contacts', ['customer_to_admin_contact'=>1, 'customer_to_admin_contactRequesterId'=>$notification->customer_to_admin_contactRequesterId]) }}
                
                @elseif($notification->contact_with_product_reviewer_request != null && $notification->contact_with_product_reviewer_requesterId != null && $notification->reviewId != null   )
                  {{ route('contact_with_product_reviewer_requests', ['contact_with_product_reviewer_request'=>1, 'contact_with_product_reviewer_requesterId'=>$notification->contact_with_product_reviewer_requesterId, 'reviewId'=>$notification->reviewId]) }}
                  
                @elseif($notification->testimonialAdminToClientContactRequest != null && $notification->testimonialClientContactRequesterId != null && $notification->testimonialId != null   )
                  {{ route('testimonial_client_contact_request', ['testimonialAdminToClientContactRequest'=>1, 'testimonialClientContactRequesterId'=>$notification->testimonialClientContactRequesterId, 'testimonialId'=>$notification->testimonialId]) }}

                @elseif($notification->testimonialClientContactRequest != null && $notification->testimonialClientContactRequesterId != null && $notification->testimonialId != null   )
                  {{ route('testimonial_client_contact_request', ['testimonialClientContactRequest'=>1, 'testimonialClientContactRequesterId'=>$notification->testimonialClientContactRequesterId, 'testimonialId'=>$notification->testimonialId]) }}

                @elseif($notification->loginLimitCrosserId != null  )
                  {{ route('customers.customers', ['customerId'=>$notification->loginLimitCrosserId, 'loginLimitCrosser'=>1]) }}
                
                @elseif($notification->passwordChagerId != null  )
                  {{ route('customers.customers', ['customerId'=>$notification->passwordChagerId, 'passwordChagerId'=>$notification->passwordChagerId]) }}
                
                @elseif($notification->profileDeleterId != null  )
                  {{ route('customers.customers', ['customerId'=>$notification->profileDeleterId, 'profileDeleterId'=>$notification->profileDeleterId]) }}

                @elseif($notification->reviewId != null  )
                  {{ route('customerReviews',['reviewId'=>$notification->reviewId]) }}
                @elseif ($notification->inquirerId != null )
                  {{ route('notifications.productPricesForUsers.assign', $notification->inquirerId) }}
                @elseif($notification->cartId != null )
                  {{ route('notifications.CartCreatedByCustomer', $notification->cartId) }}
                  
                @elseif($notification->registerUserId != null  )
                  {{ route('customers.customers', ['customerId'=>$notification->registerUserId, 'registerUser'=>1]) }}
                @elseif($notification->priceAddUpdateDeletedForUserId != null  )
                  {{ route('admin.notifications.productPricesForUsers.assign', $notification->priceAddUpdateDeletedForUserId) }}

                @elseif($notification->profileUpdaterId != null  )
                  {{ route('profileUpdateNotificationsForAdmin', $notification->profileUpdaterId) }}

                @elseif($notification->documentAdderId != null  )
                  {{ route('documentAddedNotificationsForAdmin', $notification->documentAdderId) }}

                @endif">
                  {{-- <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="icon-info mx-0"></i>
                    </div>
                  </div> --}}
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-medium">{{ $notification->message }}</h6>
                    <p class="font-weight-light small-text">
                      {{   \Carbon\Carbon::parse($notification->created_at)->format('d-M-Y g:i A') }}
                    </p>
                  </div>
                </a>
              @endforeach

              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item" href="{{ route('adminNotifications') }}">
                Show all
              </a>

              

            </div>
          </li>



          {{-- notifications --}}
          <li class="nav-item dropdown d-none d-lg-flex d-md-flex d-sm-flex d-flex">

            @guest

              <li class="nav-item dropdown d-none d-lg-flex d-md-flex d-sm-flex d-flex"><a href="{{ route('login') }}" class="text-light .col-lg-5" >
                <i class="icon-login  "></i>
              Login</a></li>
              {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}

            @else


              <a class="nav-link dropdown-toggle nav-btn " id="actionDropdown" href="#" data-toggle="dropdown" >
                {{-- <span class="btn"></span> --}}
                {{-- <i class="fas fa-cog"></i> --}}
                <i class="fa fa-cog " aria-hidden="true" style="font-size:30px;"></i>
              </a>
            @endguest

            

            <div class="dropdown-menu navbar-dropdown " aria-labelledby="actionDropdown">
              <a  href="javascript:void()" class="dropdown-item"><i class="icon-user"></i>{{ Auth::user()->name }}</a>
              <a class="dropdown-item" href="{{ route('adminNotifications') }}"><i class="icon-bell text-primary"></i>Notifications</a>
              {{-- <a class="dropdown-item" href="#">
                <i class="icon-user text-primary"></i>
                User Account
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">
                <i class="icon-user-following text-warning"></i>
                Admin User
              </a> --}}
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
               <form id="logout-form" action="{{ route('logout') }}" method="POST" {{-- style="display: none;" --}}>
                  {{ csrf_field() }}
              </form>
                <i class="icon-logout text-warning"></i>
                Log Out
              </a>
            </div>


          </li>
        </ul>

        {{-- <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a> --}}


        {{-- <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-lg-flex">
            <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
              <i class="flag-icon flag-icon-gb"></i>
              English
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-fr"></i>
                French
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-es"></i>
                Espanol
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-lt"></i>
                Latin
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item font-weight-medium" href="#">
                <i class="flag-icon flag-icon-ae"></i>
                Arabic
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
                </p>
                <span class="badge badge-pill badge-warning float-right">View all</span>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="icon-info mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Application Error</h6>
                  <p class="font-weight-light small-text">
                    Just now
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="icon-speech mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">Settings</h6>
                  <p class="font-weight-light small-text">
                    Private message
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="icon-envelope mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-medium">New user registration</h6>
                  <p class="font-weight-light small-text">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="icon-envelope mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">You have 7 unread mails
                </p>
                <span class="badge badge-info badge-pill float-right">View all</span>
              </div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">David Grey
                    <span class="float-right font-weight-light small-text">1 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium">Tim Cook
                    <span class="float-right font-weight-light small-text">15 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    New product launch
                  </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                    <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium"> Johnson
                    <span class="float-right font-weight-light small-text">18 Minutes ago</span>
                  </h6>
                  <p class="font-weight-light small-text">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="icon-grid"></i>
            </a>
          </li>
        </ul> --}}




        
        
      </div>
    </nav>






@endsection