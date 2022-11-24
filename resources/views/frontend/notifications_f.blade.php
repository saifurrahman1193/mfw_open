@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Notifications')


{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@section('page_content')

<div class="clearfix"></div>

 <div class="container text-success" id="path-section" style="padding-top: 50px; font-weight: bold;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ app()->getLocale()?action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}">{{ __('header.Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('header.notifications') }}</li>
      </ol>
    </nav>

</div>

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-30">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            
            {{-- <div class="card-title">Register</div> --}}
            
            <div class="content-wrapper" style="min-height: 0px;" id="prescriptiontable">
                <form  method="post" action="{{ route('readatspecificcustomersallnotifications', [app()->getLocale(), auth()->user()->id]) }}"  onsubmit="return confirm('Do you really want to proceed?');">
                    {{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">
                      <a>
                        <button type="submit" value="PUT" class="btn btn-link text-success" >
                          {{--  <i class="fa fa-check text-success fa-lg tooltipster"  title="{{ __('header.markallasread') }}?"></i>  --}}
                          {{ __('header.markallasread') }}
                        </button>
                      </a>
                </form>

                <h3 class="card-title padd-30" style="text-align: center; font-weight: bold;">{{ __('header.notifications') }}</h3>
                <div class="card">
                    <div class="card-body">


                       <ul class="list-group">
                            @foreach ( $allnotificationData->sortByDesc('created_at')  as $notification)
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
                                    
                                    @endif" class="list-group-item list-group-item-action" style="padding-left: 2%; padding-right: 2%;">
                              
                                        <div class="row">
                                          <div class="col-8" id="notification-left-side" style="display: inline-block;">
                                              {{$notification->message}}
                                          </div>
                                          <div class="col-4" id="notification-right-side" style="display: inline-block; float: right;">
                                              <span class="badge badge-primary badge-pill" style=" color:  #0b0a0ab5; background-color: #7770; font-size: 17px; font-weight: 400;">{{YmdTodmYPm($notification->created_at)}}</span>
                                          </div>
                                        </div>
                                    </a>
                            @endforeach
                        
                      </ul> 

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<style>
    @media (max-width: 550px) {
        #notification-left-side{
            padding-left: 12px !important;
            padding-right: 5px !important;
        }
        #notification-right-side{
            padding-right: 5px !important;
        }
        #notification-right-side>span{
            font-size: 14px !important;
        }
    }
</style>

@endsection
