@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
{{-- @extends('layouts_f.search_without_search_bar') --}}
@extends('layouts_f.slider')
{{-- @extends('layouts_f.products') --}}
@extends('layouts_f.slider_best_selling_products')
@extends('layouts_f.slider_new_selling_products')

{{-- @extends('layouts_f.featured_products') --}}
@extends('layouts_f.testimonials')
@extends('layouts_f.topbrands')
@extends('layouts_f.banner')
@extends('layouts_f.trendyProducts')
@extends('layouts_f.genericforallproduct')
@extends('layouts_f.blogs')
@extends('layouts_f.footer')
{{-- @extends('layouts.navbar') --}}
{{-- @extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()]) --}}



@section('pageTitle', 'Home')

{{--  {{ dd(getLocaleFromUrl(URL::current())) }}  --}}

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

{{--  {{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}  --}}


@section('page_content')






<script type="text/javascript">
	$(window).on('load',function(){

		@if (session('orderId'))
	        $('#orderConfirmModal').modal('show');
		@endif

    });

    $(window).on('load',function(){

        @if (session('signupcomplete'))
            $('#signupcompleteModal').modal('show');
        @endif

    });

    $(window).on('load',function(){

        @if (session('paymentReceiptUploaded'))
            $('#paymentReceiptUploadedModal').modal('show');
        @endif

    });

    $(window).on('load',function(){

        @if (session('customerAddDeliveryInfo'))
            $('#customerAddDeliveryInfoModal').modal('show');
        @endif

    });


</script>

<!--Model Popup starts-->
<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        {{-- <a class="btn btn-primary" data-toggle="modal" href="#orderConfirmModal">open Popup</a> --}}
        <div class="modal fade" id="orderConfirmModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
                     </div>
					
                    <div class="modal-body">
                       
						<div class="thank-you-pop">
							{{-- <img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt=""> --}}
							<h1>{{__('modals.thankyou')}}</h1>
							<p>{{__('modals.orderConfirmModalmsg1')}}</p>
							<h3 class="cupon-pop">{{__('modals.yourorderid')}} <span>@if (session('orderId'))
								{{ '#'.session('orderId').date("my") }}
                            @endif</span></h3>
                            
                            
							
 						</div>
                         
                    </div>
                    <div class="modal-footer mx-auto">
                        <a href="{{ route('customerOrderHistory', app()->getLocale() ) }}" class="btn btn-outline-success btn-lg btn-block"  role="button"  style="border: 2px solid #00800047;  color: #008000b5 !important;">
                            {{__('modals.open')}}
                            &nbsp;
                            <strong>{{__('modals.orderdetails')}}</strong>
                        </a>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        {{-- <a class="btn btn-primary" data-toggle="modal" href="#signupcompleteModal">open Popup</a> --}}
        <div class="modal fade" id="signupcompleteModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="text-center  text-success">{{__('modals.signupcompleteModaltitlemsg')}}</h2>
                    </div>
					
                    <div class="modal-body">
						<div class="thank-you-pop">
							<p>{{__('modals.signupcompleteModalmsg')}}</p>
							<p>{{__('modals.signupcompleteModalmsg2')}}</p>
 						</div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        <div class="modal fade" id="paymentReceiptUploadedModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="text-center  text-success">{{__('modals.paymentReceiptUploadedModaltitlemsg')}}</h2>
                    </div>
					
                    <div class="modal-body">
						<div class="thank-you-pop">
							<p>{{__('modals.paymentReceiptUploadedModalmsg')}}</p>
 						</div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        <div class="modal fade" id="customerAddDeliveryInfoModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="text-center text-success">{{__('modals.customerAddDeliveryInfoModaltitlemsg')}}</h2>
                    </div>
					
                    <div class="modal-body">
						<div class="thank-you-pop">
							<h4 > {{__('modals.customerAddDeliveryInfoModalmsg')}}  </h4>
 						</div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(window).on('load',function(){

        @if (session('cacelOrder'))
            $('#cancelorderModal').modal('show');
        @endif

    });

</script>


<div class="container" style="z-index: 10000000000000000000000">
  <div class="row">
      <div class="modal fade" id="cancelorderModal" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                    <h3 class="modal-title col-md-11">{{ __('modals.cancelorderModalmsgtitle') }}</h3>
                    <button type="button" class="close col-md-1" data-dismiss="modal" aria-label=""><span>×</span></button>
                  </div>
                  <div class="modal-body">
                      <p > {{__('modals.cancelorderModalmsgbodypart1').' '.session('cartNumber').' '.__('modals.cancelorderModalmsgbodypart2')}} </p>
                  </div>
                  
              </div>
          </div>
      </div>
  </div>
</div>




<!--Model Popup ends-->

<link rel="stylesheet" href="{{ asset('frontend/css/thankyou.css') }}">





@endsection