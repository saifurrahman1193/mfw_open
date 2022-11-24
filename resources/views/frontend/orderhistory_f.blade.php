@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Order History')

{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}

<script src="{{ asset('js/jquery.min.js') }}"></script> 

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@section('page_content')

<script type="text/javascript">
  $(window).on('load',function(){
      @if (request()->has('customerAddDeliveryInfo'))
          $('#customerAddDeliveryInfoModal').modal('show');
      @endif
  });
  
  $(window).on('load',function(){
    @if (request()->has('paymentReceiptUploaded'))
        $('#paymentReceiptUploadedModal').modal('show');
    @endif
  });
</script>

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


<div class="clearfix"></div>

 <div class="container text-success" id="path-section" style="padding-top: 50px; font-weight: bold;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ app()->getLocale()?action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}">{{ __('header.Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('header.orderhistory') }}</li>
      </ol>
    </nav>

</div>


{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-30">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            
            {{-- <div class="card-title">Register</div> --}}
            
            <div class="content-wrapper" style="min-height: 0px;" id="orderhistorytable">

                <h3 class="card-title padd-30" style="text-align: center; font-weight: bold;">{{ __('orderhistory.orderhistory') }}</h3>
                <div class="card">
                    <div class="card-body">


                        <div class="product-tab">

                          <!-- Nav tabs -->
                            <ul class="nav nav-tabs " role="tablist" style="overflow-y: scroll !important; max-height: 5000px;">

                                @foreach ($cartData->sortByDesc('created_at') as $cart)
                                  @if (Request('cartId'))
                                    <li role="presentation" class="{{ $cart->cartId==Request('cartId')  ? 'active' : '' }}" >
                                      <a href="#cart-id-{{ $cart->cartId }}" aria-controls="cart-id-{{ $cart->cartId }}" role="tab" data-toggle="tab">{{ process_order_number($cart->cartId, $cart->created_at) }} </a>
                                    </li>
                                  @else
                                    <li role="presentation" class="{{ $loop->index==0  ? 'active' : '' }}" >
                                      <a href="#cart-id-{{ $cart->cartId }}" aria-controls="cart-id-{{ $cart->cartId }}" role="tab" data-toggle="tab">{{ process_order_number($cart->cartId, $cart->created_at) }} </a>
                                    </li>
                                  @endif
                                @endforeach
                              
                            </ul>
                          <!-- Nav tabs -->

                            <!-- Tab panes -->
                              <div class="tab-content">

                               

                                @foreach ($cartData->sortByDesc('created_at') as $cart)

                                  @if (Request('cartId'))
                                    <div role="tabpanel" class="tab-pane fade {{ $cart->cartId==Request('cartId') ? 'in active' : '' }} " id="cart-id-{{ $cart->cartId }}">
                                  @else
                                      <div role="tabpanel" class="tab-pane fade {{ $loop->index==0 ? 'in active' : '' }} " id="cart-id-{{ $cart->cartId }}">
                                  @endif
                                          {{-- <p>#inv-{{ $cart->cartId }}</p> --}}


                                          {{-- <a href=" {{ route('billReport', $bills->billId) }}"  target="_blank"><i class="fa fa-file-pdf-o fa-xs" style=" color:black; font-size:27px"></i></a> --}}
                                          
                                          <table class="table table-responsive table-borderless" >
                                            {{--  cart approve but payment not confirmed  --}}
                                            @if ($cart->isCartApproved==2 ) 
                                                <tr>
                                                  <td style="border: 0px;">
                                                    @if ($cart->isPaymentConfirm!=1 )
                                                      <a onclick="return confirm('{!!__('productdetails.confirmalert')!!}');" href="{{ route('customerOrderCancel', [app()->getLocale(), $cart->cartId]) }}" title=""  class="cart-tab "><button  type="" class="btn btn-sm btn-danger pull-right " ><i class="fa fa-trash"></i> {{ __('orderhistory.cancelorder') }}</button></a>

                                                      <a href="{{ route('cartQtyUpdate', [app()->getLocale(), Crypt::encrypt($cart->cartId) ]) 
                                                         }}" title=""  class="cart-tab">
                                                        <button type="" style="margin-right: 10px !important;" class="btn btn-sm btn-success pull-right "><i class="fa fa-edit"></i> {{ __('orderhistory.updateorder') }}</button>
                                                      </a>
                                                    @endif

                                                    @if ($cart->isDuplicateInvoiceVisible==1 && $cart->duplicateInvoiceCompanyId!=null)
                                                          <a href="{{ route('fakeInvociePrint', Crypt::encrypt($cart->cartId)) }}" title=""  class="cart-tab "  target="_blank">
                                                            <button  type="" class="btn btn-sm btn-primary pull-right  " style="margin-right: 10px !important;">
                                                              <i class="fa fa-file-pdf-o"></i> 
                                                              {{ __('orderhistory.duplicateinvoice') }}
                                                            </button>
                                                          </a>
                                                      @endif

                                                    @if ($cart->isProformaInvoiceVisible==1)
                                                      <a href="{{ route('customerOrderProformaInvociePrint', [app()->getLocale(), Crypt::encrypt($cart->cartId)]) }}" title=""  class="cart-tab " target="_blank">
                                                        <button  type="" class="btn btn-sm btn-primary pull-right " style="margin-right: 10px !important;">
                                                          <i class="fa fa-file-pdf-o"></i> 
                                                          {{ __('orderhistory.proformainvoice') }}
                                                        </button>
                                                      </a>
                                                    @endif

                                                      @if ($cart->isInvoiceVisible==1 && $cart->paymentConfirmCompanyId!=null)
                                                        <a href="{{ route('customerOrderInvociePrint', [app()->getLocale(), Crypt::encrypt($cart->cartId)]) }}" title=""  class="cart-tab "  target="_blank">
                                                          <button  type="" class="btn btn-sm btn-primary pull-right  " style="margin-right: 10px !important;">
                                                            <i class="fa fa-file-pdf-o"></i> 
                                                            {{ __('orderhistory.invoice') }}
                                                          </button>
                                                        </a>
                                                      @endif
                                                      


                                                    

                                                  </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td style="border: 0px;">
                                                  {{--  <div style="{{ $cart->isCartApproved>1 ? 'margin-top: 60px; line-height: 21px;' : '' }} ">  --}}
                                                    <div >

                                                      @if ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and  $cart->isDeliveryInfoAdded==1)
                                                        <div class="alert alert-success" role="alert">
                                                          {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).', '.__('orderhistory.deliveryinfoadded') }}
                                                        </div>

                                                      @elseif ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and  $cart->isDeliveryConfirmed==1)
                                                        <div class="alert alert-success" role="alert">
                                                          {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).', '.__('orderhistory.complete').'! ' }}
                                                        </div>

                                                      @elseif ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1)
                                                        <div class="alert alert-success" role="alert">
                                                            {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).', '.__('orderhistory.trackingnumberaddedmsg') }}
                                                        </div>
                                                      @elseif ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1)
                                                        <div class="alert alert-success" role="alert">
                                                            {{  __('orderhistory.order_payment_confirm_message1').process_order_number($cart->cartId, $cart->created_at).__('orderhistory.order_payment_confirm_message2') }}
                                                        </div>
                                                      @elseif ($cart->isCartApproved==2  and  $cart->isPaymentReceiptUploaded==1)
                                                        <div class="alert alert-success" role="alert">
                                                            {{ __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).', '.__('orderhistory.isPaymentReceiptUploadedmessage') }}
                                                        </div>
                                                      @elseif ($cart->updateCount>0 && $cart->isCartApproved==1) {{-- updated and pending--}}
                                                        <div class="alert alert-info" role="alert">
                                                            {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).__('orderhistory.order_updated_message') }}
                                                        </div>
                                                      @elseif ($cart->isCartApproved==1) {{-- created and pending --}}
                                                        <div class="alert alert-info" role="alert">
                                                            {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).__('orderhistory.order_created_message') }}
                                                        </div>
                                                      @elseif ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==2) {{-- unconfirmed --}}
                                                        <div class="alert alert-warning" role="alert">
                                                            {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).__('orderhistory.order_unconfirmed_message') }}
                                                        </div>
                                                      @elseif ($cart->isCartApproved==2) {{-- approved --}}
                                                        <div class="alert alert-success" role="alert">
                                                            {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).__('orderhistory.order_approved_message') }}
                                                        </div>
                                                      
                                                      
                                                      @elseif ($cart->isCartApproved==3 ) {{-- rejected --}}

                                                        
                                                        <div class="alert alert-danger" role="alert">
                                                            {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).__('orderhistory.order_rejected_message')  }}
                                                            <br>
                                                            <br>
                                                          {{ __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).__('orderhistory.rejected_reasons') }}
                                                          <ul>
                                                            @foreach ($cartarejectreasonsData->where('cartId', $cart->cartId) as $cartarejectreason)
                                                              <li >
                                                                  @if (app()->getLocale()=='en')
                                                                    {!! $cartarejectreason->reason !!}
                                                                  @elseif(app()->getLocale()=='cn')
                                                                    {!! $cartarejectreason->reasonCN !!}
                                                                  @elseif(app()->getLocale()=='ru')
                                                                    {!! $cartarejectreason->reasonRU !!}
                                                                  @endif
                                                              </li>
                                                            @endforeach
                                                          </ul>
        
                                                          {{ __('orderhistory.Solutions') }} : 
                                                          <ul >
                                                            @foreach ($cartarejectsolutionsData->where('cartId', $cart->cartId) as $cartarejectsolution)
                                                              <li >
                                                                  @if (app()->getLocale()=='en')
                                                                    {!! $cartarejectsolution->solution !!}
                                                                  @elseif(app()->getLocale()=='cn')
                                                                    {!! $cartarejectsolution->solutionCN !!}
                                                                  @elseif(app()->getLocale()=='ru')
                                                                    {!! $cartarejectsolution->solutionRU !!}
                                                                  @endif
                                                              </li>
                                                            @endforeach
                                                          </ul>
                                                        </div>

                                                        <div>
                                                          <a onclick="return confirm('{!!__('productdetails.confirmalert')!!}');" href="{{ route('customerOrderCancel', [app()->getLocale(), $cart->cartId]) }}" title=""  class="cart-tab "><button  type="" class="btn btn-sm btn-danger pull-right " ><i class="fa fa-trash"></i> {{ __('orderhistory.cancelorder') }}</button></a>

                                                          <a href="{{ route('cartQtyUpdate', [app()->getLocale(), Crypt::encrypt($cart->cartId)]) }}" title=""  class="cart-tab">
                                                            <button type="" style="margin-right: 10px !important;" class="btn btn-sm btn-success pull-right "><i class="fa fa-edit"></i> {{ __('orderhistory.updateorder') }}</button>
                                                          </a>
                                                        </div>
        
                                                      @elseif ($cart->isCartApproved==3) {{-- rejected --}}
                                                        <div class="alert alert-danger" role="alert">
                                                            {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).__('orderhistory.order_rejected_message')  }}
                                                            <br>
                                                            <br>
                                                          {{ __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).__('orderhistory.rejected_reasons') }}
                                                          <ul>
                                                            @foreach ($cartarejectreasonsData->where('cartId', $cart->cartId) as $cartarejectreason)
                                                              <li >
                                                                  @if (app()->getLocale()=='en')
                                                                    {{ $cartarejectreason->reason }}
                                                                  @elseif(app()->getLocale()=='cn')
                                                                    {{ $cartarejectreason->reasonCN }}
                                                                  @elseif(app()->getLocale()=='ru')
                                                                    {{ $cartarejectreason->reasonRU }}
                                                                  @endif
                                                              </li>
                                                            @endforeach
                                                          </ul>
                                                          
        
                                                          {{ __('orderhistory.Solutions') }} : 
                                                          <ul >
                                                            @foreach ($cartarejectsolutionsData->where('cartId', $cart->cartId) as $cartarejectsolution)
                                                              <li >
                                                                  @if (app()->getLocale()=='en')
                                                                    {{ $cartarejectsolution->solution }}
                                                                  @elseif(app()->getLocale()=='cn')
                                                                    {{ $cartarejectsolution->solutionCN }}
                                                                  @elseif(app()->getLocale()=='ru')
                                                                    {{ $cartarejectsolution->solutionRU }}
                                                                  @endif
                                                              </li>
                                                            @endforeach
                                                          </ul>
                                                        </div>
                                                    
                                                      @endif
                                                  </div>
                                                </td>
                                            </tr>
                                          </table>
                                         
                                           

                                          <!--Accordion wrapper-->
                                          <div class="accordion md-accordion" id="cart-id-{{ $cart->cartId }}-accordionHeading1" role="tablist" aria-multiselectable="true">
                    

                                            <!-- Accordion card 1 start -->
                                            <div class="card">
                                                <!-- Card header -->
                                                <div class="card-header " style="{{ $cart->isCartApproved==2 ? 'color:green;' : 'color:grey;'}}" role="tab" id="cart-id-{{ $cart->cartId }}-heading1">
                                                  <a class="collapsed" data-toggle="collapse" data-parent="#cart-id-{{ $cart->cartId }}-accordionHeading1" href="#cart-id-{{ $cart->cartId }}-collapseHeading1"
                                                    aria-expanded="false" aria-controls="cart-id-{{ $cart->cartId }}-collapseHeading1">
                                                    <h5 class="mb-0">
                                                      <i class="fa fa-plus-square" ></i>
                                                      {{ __('orderhistory.step1') }} : {{ __('orderhistory.paymentaccountdetails') }} 
                                                      <span style="font-weight: bold; ">
                                                        {{ $cart->isCartApproved==2 ? '(✓)' : ''}}
                                                      </span>
                                                      
                                                    </h5>
                                                    
                                                  </a>
                                                </div>
                                                

                                                <div id="cart-id-{{ $cart->cartId }}-collapseHeading1" class="collapse" role="tabpanel" aria-labelledby="heading1"
                                                  data-parent="#cart-id-{{ $cart->cartId }}-accordionHeading1" >
                                                  <div class="card-body">

                                                      
                                                                                                         
                                                    @if ($cart->isCartApproved==2) {{-- approved --}}

                                                      <fieldset class="cart-tab" style="margin-top: 25px;">
                                                        
                                                        {{--  <legend style="border-bottom: none;">{{ __('checkout.deliverydetails') }}</legend>  --}}
                                                        
                                                        <table class="table table-hover table-responsive ">
                                                          <tbody>
                                                            <tr>
                                                              <th>{{ __('orderhistory.paymentmethod') }}</th>
                                                              <td>

                                                                  @if (app()->getLocale()=='en')
                                                                    {{ $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentMethod')->first() }}
                                                                  @elseif(app()->getLocale()=='cn')
                                                                    {{ $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentMethodCN')->first() }}
                                                                  @elseif(app()->getLocale()=='ru')
                                                                    {{ $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentMethodRU')->first() }}
                                                                  @endif

                                                              </td>
                                                            </tr>
                                                            <tr>
                                                              <th>{{ __('orderhistory.paymentaccountdetails') }}</th>
                                                              <td>

                                                                  @if (app()->getLocale()=='en')
                                                                    {!! $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentAccountDetails')->first() !!}
                                                                  @elseif(app()->getLocale()=='cn')
                                                                    {!! $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentAccountDetailsCN')->first() !!}
                                                                  @elseif(app()->getLocale()=='ru')
                                                                    {!! $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentAccountDetailsRU')->first() !!}
                                                                  @endif


                                                              </td>
                                                            </tr>

                                                            <tr>
                                                              <th>{{ __('orderhistory.paymentimagelink') }}</th>
                                                              <td>
                                                                @if ($cartapprovesData->where('cartId', $cart->cartId)->pluck('picPath')->first())
                                                                      {{-- <img class="lozad magnificPopup" data-src="{{ asset($cartapprovesData->where('cartId', $cart->cartId)->pluck('picPath')->first()) }}" data-mfp-src="{{ asset($cartapprovesData->where('cartId', $cart->cartId)->pluck('picPath')->first()) }}" alt="" style="max-width: 500px; max-height: 300px;"> --}}
                                                                        <a href="{{asset($cartapprovesData->where('cartId', $cart->cartId)->pluck('picPath')->first())}}" target="_blank"  style="text-decoration: underline;">{{ __('prescription.clicktoopenfile') }}</a>
                                                                @endif
                                                              </td>
                                                            </tr>


                                                            <tr>
                                                              <th>{{ __('orderhistory.paymentsummary') }}</th>
                                                              <td>
                                                                  <ul class="list-group">
                                                                      @foreach ($paymentsummaryData->where('paymentMethodId', $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentMethodId')->first()) as $paymentsummary)
                                                                          <li class="list-group-item list-group-item-action">
                                                                            @if (app()->getLocale()=='en')
                                                                              {!! $paymentsummary->paymentSummary !!}
                                                                            @elseif(app()->getLocale()=='cn')
                                                                              {!! $paymentsummary->paymentSummaryCN !!}
                                                                            @elseif(app()->getLocale()=='ru')
                                                                              {!! $paymentsummary->paymentSummaryRU !!}
                                                                            @endif
                                                                          </li>
                                                                      @endforeach
                                                                  </ul>
                                                              </td>
                                                            </tr>
                                                            <tr>
                                                              <th>{{ __('orderhistory.additionalpaymentaccountdetails') }}</th>
                                                              <td>
                                                                  @if (app()->getLocale()=='en')
                                                                    {!! $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentAccountDetailsAdditional')->first() !!}
                                                                  @elseif(app()->getLocale()=='cn')
                                                                    {!! $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentAccountDetailsAdditionalCN')->first() !!}
                                                                  @elseif(app()->getLocale()=='ru')
                                                                    {!! $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentAccountDetailsAdditionalRU')->first() !!}
                                                                  @endif
                                                              </td>
                                                            </tr>
                                                            
                                                          </tbody>
                                                        </table>
                                                        
                                                      </fieldset>
                                                      
                                                    @endif

                                          
                                                  </div>
                                              </div>
                                          </div>

                                          <!-- Accordion card 1 end -->



                                          <!-- Accordion card 2 start -->
                                            <div class="card">
                                                <!-- Card header -->
                                                <div class="card-header  " style="color:grey; {{ $cart->isCartApproved==2 ? 'color:green;' : ''}} {{( $cart->isCartApproved==2 and $cart->isPaymentConfirm==2)? 'color:#d0b30b;' : ''}}" role="tab"  id="cart-id-{{ $cart->cartId }}-heading2">
                                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading2" href="#cart-id-{{ $cart->cartId }}-collapseHeading2"
                                                    aria-expanded="false" aria-controls="cart-id-{{ $cart->cartId }}-collapseHeading2">
                                                    <h5 class="mb-0">
                                                      <i class="fa fa-plus-square" ></i>
                                                      {{ __('orderhistory.step2') }} : {{ __('orderhistory.paymentreceiptinfo') }}
                                                      <span style="font-weight: bold; ">
                                                        {{-- {{ $cart->isCartApproved==2 ? '(✓)' : ''}} --}}
                                                        @if ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1)
                                                          (✓)
                                                        @endif
                                                      </span> 
                                                    </h5>
                                                  </a>
                                                </div>

                                                <div id="cart-id-{{ $cart->cartId }}-collapseHeading2" class="collapse" role="tabpanel" aria-labelledby="heading2"
                                                  data-parent="#accordionHeading2" >
                                                  <div class="card-body">

                                                    @if ($cart->isCartApproved==2 && $cart->isPaymentConfirm!=1  )
                                                        

                                                    <fieldset class="cart-tab" style="margin-top: 25px;">

                                                      <form class="form-horizontal" method="POST"  enctype="multipart/form-data"  action="{{ route('customerPaymentReceiptUpload', [app()->getLocale(), $cart->cartId]) }}" onsubmit="return confirm('{!!__('productdetails.confirmalert')!!}');">
                                                        @csrf
                                                              <div class="form-group row col-md-12 text-center mt-2 mb-2 text-success font-weight-bold justify-text mob-font-12px" style="font-size: 18px;  margin: 30px 0px;">
                                                                {{ __('orderhistory.paymentreceiptinfomsg') }} <br>
                                                                <span style="color: red; font-size: 15px;">{{ '('.__('orderhistory.multiplereceiptcopies').')' }}</span>
                                                                                                                              
                                                              </div>
                      
                                                              <div class="form-group row col-md-12">
                                                                  <label for="paymentReceiptImagePath" class="col-md-4 col-form-label text-md-right">{{ __('orderhistory.uploadimage') }}</label>
                      
                                                                  <div class="col-md-8 mob-font-12px">
                                                                        <input id="paymentReceiptImagePath" name="paymentReceiptImagePath[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true" required>
                                                                        <div>
                                                                          <p style="margin:0px;"><strong>{{__('orderhistory.note')}}:</strong> </p>
                                                                          <p style="margin:0px;">1. {{__('orderhistory.only')}} pdf, jpeg, png, doc {{__('orderhistory.formatcanbeuploaded')}}</p>
                                                                          <p style="margin:0px;">2. {{__('orderhistory.maximum')}} 8 {{__('orderhistory.filescanbeuploadedatatime')}}</p>
                                                                          <p style="margin:0px;">3. {{__('orderhistory.eachfilesize')}} 10mb.</p>
                                                                        </div>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-12">
                                                                <div class="form-group row ">
                                                                  <label class="col-sm-4 col-form-label control-label">{{ __('orderhistory.message') }}</label>
                                                                  <div class="col-sm-8">
                                                                    <textarea class="form-control "  rows="4" id="paymentReceiptMessage" name="paymentReceiptMessage"  ></textarea>
                        
                                                                  </div>
                                                                </div>
                                                              </div>
                      
                                                              <div class="form-group row col-md-12 " style=" margin-bottom: 20px;">
                                                                  <div class="col-md-12 ">
                                                                      <button type="submit" class="btn btn-success btn-lg "  id="send" style="float: right;">{{ __('orderhistory.send') }}</button>
                                                                  </div>
                                                              </div>
                                                      </form>
                                                    </fieldset>
                                                    @endif
                                                      

                                                  </div>
                                              </div>
                                          </div>

                                          <!-- Accordion card 2 end -->


                                          <!-- Accordion card 3 start -->
                                            <div class="card">
                                                <!-- Card header -->
                                                <div class="card-header " style="color:grey; {{ ($cart->isCartApproved==2 and $cart->isPaymentConfirm==1)? 'color:green;' : ''}} {{( $cart->isCartApproved==2 and $cart->isPaymentConfirm==2)? 'color:#d0b30b;' : ''}}" role="tab"  id="cart-id-{{ $cart->cartId }}-heading3">
                                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading3" href="#cart-id-{{ $cart->cartId }}-collapseHeading3"
                                                    aria-expanded="false" aria-controls="cart-id-{{ $cart->cartId }}-collapseHeading3">
                                                    <h5 class="mb-0">
                                                      <i class="fa fa-plus-square" ></i>
                                                      {{ __('orderhistory.step3') }} :  {{ __('orderhistory.paymentconfirmation') }} 
                                                      <span style="font-weight: bold; ">
                                                        {{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1) ? '(✓)' : ''}}
                                                      </span> 

                                                      @if ($cart->isPaymentReceiptUploaded==1)
                                                          ( {{ __('orderhistory.paymentchecking') }}  )
                                                      @elseif($cart->isCartApproved==2 and  $cart->isPaymentConfirm==2)
                                                          ( {{__('orderhistory.paymentunconfirmedclickforreasons')}} )
                                                      @endif
                                                    </h5>
                                                  </a>
                                                </div>

                                                <div id="cart-id-{{ $cart->cartId }}-collapseHeading3" class="collapse" role="tabpanel" aria-labelledby="heading3"
                                                  data-parent="#accordionHeading3" >
                                                  <div class="card-body">
                                                    
                                                    <br><br>
                                                    <table class="table table-bordered">
                                                      <tr>
                                                        <th>{{__('orderhistory.paymentstatus')}}</th>
                                                        <th style="{{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==2) ? 'color: green;' : 'color: red;'}}">
                                                          {{-- approved and payment confirmed --}}
                                                          @if ( $cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 ) 
                                                              {{ __('orderhistory.confirmed') }}
                                                          @elseif ( $cart->isCartApproved==2 and  $cart->isPaymentConfirm==2 ) 
                                                              {{ __('orderhistory.unconfirmed') }}
                                                          @endif
                                                        </th>
                                                      </tr>
                                                    </table>
                                                    <br> <br>  

                                                    <h4 class="text-center mt-2">{{__('orderhistory.prevconversation')}}</h4>
                                                    <table class="table table-bordered table-hover" >
                                                        <tbody>
                                                            @foreach ($cartpaymentreceiptmessagesData->where('cartId', $cart->cartId)->sortByDesc('created_at') as $cartpaymentreceiptmessage)
                                                                <tr>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item">
                                                                                <i class="fa fa-user" aria-hidden="true"></i> 
                                                                                @if ($cartpaymentreceiptmessage->isCustomer==1)
                                                                                    {{ $cart->takingFor}} 
                                                                                @else
                                                                                    {{-- {{ $usersData->where('id', $cartpaymentreceiptmessage->userId)->pluck('name')->first() }} --}}
                                                                                    {{ __('orderhistory.admin') }}
                                                                                @endif
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <i class="fa fa-clock-o" aria-hidden="true"></i> {{ YmdTodmYPmgiA($cartpaymentreceiptmessage->created_at)}}
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <i class="fa fa-calendar" aria-hidden="true"></i> {{ YmdTodmYPmdMy($cartpaymentreceiptmessage->created_at)}}
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item">

                                                                                @if ($cartpaymentreceiptmessage->isCustomer!=1)

                                                                                    @if (app()->getLocale()=='en')
                                                                                        {!! $cartpaymentreceiptmessage->reason !!}
                                                                                    @elseif(app()->getLocale()=='cn')
                                                                                        {!! $cartpaymentreceiptmessage->reasonCN !!}
                                                                                    @elseif(app()->getLocale()=='ru')
                                                                                        {!! $cartpaymentreceiptmessage->reasonRU !!}
                                                                                    @endif
                                                                                @else
                                                                                        {!! $cartpaymentreceiptmessage->reason !!}      
                                                                                @endif

                                                                            </li>
                                                                            @if ($cartpaymentreceiptmessage->picPath)
                                                                                <li class="list-group-item">
                                                                                    <a href="{{asset($cartpaymentreceiptmessage->picPath)}}" target="_blank" style="text-decoration: underline;">
                                                                                      {{__('prescription.clicktoopenfile')}}
                                                                                    </a>
                                                                                    {{-- <img class="lozad magnificPopup" data-src="/..{{ $cartpaymentreceiptmessage->picPath }}" data-mfp-src="/..{{ $cartpaymentreceiptmessage->picPath }}" style="border-radius: 0%; width: 200px; height: 200px;"> --}}
                                                                                </li>
                                                                            @endif
                                                                        </ul>
                                        
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                        
                                                    </table>


                                          
                                                  </div>
                                              </div>
                                          </div>

                                          <!-- Accordion card 3 end -->


                                          <!-- Accordion card 4 start -->
                                            <div class="card">
                                                <!-- Card header -->
                                                <div class="card-header " style="{{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1) ? 'color:green;' : 'color:grey;'}}"  role="tab"  id="cart-id-{{ $cart->cartId }}-heading4">
                                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading4" href="#cart-id-{{ $cart->cartId }}-collapseHeading4"
                                                    aria-expanded="false" aria-controls="cart-id-{{ $cart->cartId }}-collapseHeading4">
                                                    <h5 class="mb-0">
                                                      <i class="fa fa-plus-square" ></i>
                                                      {{ __('orderhistory.step4') }} :  {{ __('orderhistory.trackinginformation') }}  
                                                      <span style="font-weight: bold; ">
                                                        {{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1) ? '(✓)' : ''}}
                                                      </span> 
                                                    </h5>
                                                  </a>
                                                </div>

                                                <div id="cart-id-{{ $cart->cartId }}-collapseHeading4" class="collapse" role="tabpanel" aria-labelledby="heading4"
                                                  data-parent="#accordionHeading4" >
                                                  <div class="card-body">
                                                    
                                                    {{--  approved, payment confirmed and tracking added  --}}
                                                    @if ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 )  
                                                        <ul class="list-group">
                                                              <li class="list-group-item list-group-item-action list-group-item-success text-center font-weight-bold">{{ __('orderhistory.trackinginfo') }}</li>
                                                              <li class="list-group-item list-group-item-action ">
                                                                @if (app()->getLocale()=='en')
                                                                  {{ $trackingData->where('cartId', $cart->cartId)->pluck('tracking')->first() }} 
                                                                @elseif(app()->getLocale()=='cn')
                                                                  {{ $trackingData->where('cartId', $cart->cartId)->pluck('trackingCN')->first() }} 
                                                                @elseif(app()->getLocale()=='ru')
                                                                  {{ $trackingData->where('cartId', $cart->cartId)->pluck('trackingRU')->first() }}
                                                                @endif
                                                                <hr>

                                                                {{-- @if ($trackingData->where('cartId', $cart->cartId)->pluck('picPath')->first())
                                                                  <img class="lozad magnificPopup" data-src="/..{{ $trackingData->where('cartId', $cart->cartId)->pluck('picPath')->first() }}" data-mfp-src="/..{{ $trackingData->where('cartId', $cart->cartId)->pluck('picPath')->first() }}"  style="border-radius: 0%; width: 100px; height: 100px;"><hr>
                                                                @endif --}}

                                                                <ul class="list-group ">
                                                                    @foreach ($trackingpicturesData->where('trackingId', $trackingData->where('cartId', $cart->cartId)->pluck('trackingId')->first()) as $trackingpicture)
                                                                        <li class="list-group-item list-group-item-action">
                                                                            <a href="{{ asset($trackingpicture->picPath) }}" target="_blank">{{ asset($trackingpicture->picPath) }}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                                
                                                              </li>
                                                          
                                                        </ul>
                                                    @endif

                                          
                                                  </div>
                                              </div>
                                          </div>

                                          <!-- Accordion card 4 end -->


                                          <!-- Accordion card 5 start -->
                                            <div class="card">
                                                <!-- Card header -->
                                                <div class="card-header" style="{{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and  ($cart->isDeliveryInfoAdded==1 or $cart->isDeliveryConfirmed==1) ) ? 'color:green;' : 'color:grey;'}} {{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and $cart->isDeliveryConfirmed==0 ) ? 'color:#d0b30b;' : ''}}" role="tab"  id="cart-id-{{ $cart->cartId }}-heading5">
                                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading5" href="#cart-id-{{ $cart->cartId }}-collapseHeading5"
                                                    aria-expanded="false" aria-controls="cart-id-{{ $cart->cartId }}-collapseHeading5">
                                                    <h5 class="mb-0">
                                                      <i class="fa fa-plus-square" ></i>
                                                      {{ __('orderhistory.step5') }} :  {{ __('orderhistory.deliveryinfo') }}  
                                                      <span style="font-weight: bold; ">
                                                        {{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and  ($cart->isDeliveryInfoAdded==1 or $cart->isDeliveryConfirmed==1) ) ? '(✓)' : ''}}
                                                      </span>  
                                                    </h5>
                                                  </a>
                                                </div>

                                                <div id="cart-id-{{ $cart->cartId }}-collapseHeading5" class="collapse" role="tabpanel" aria-labelledby="heading5"
                                                  data-parent="#accordionHeading5" >
                                                  <div class="card-body">

                                                    @if ($cart->isDeliveryConfirmed!=1 && $cart->isPaymentConfirm==1 && $cart->isCartApproved==2 )
                                                        
                                                    
                                                    <fieldset class="cart-tab" style="margin-top: 25px;">

                                                      <form class="form-horizontal" method="POST"  enctype="multipart/form-data"  action="{{ route('customerAddDeliveryInfo', [app()->getLocale(), $cart->cartId]) }}" onsubmit="return confirm('{!!__('productdetails.confirmalert')!!}');">
                                                        @csrf
                                                              <div class="form-group row col-md-12 text-center mt-2 mb-2 text-success font-weight-bold " style="font-size: 18px;  margin: 30px 0px;">
                                                                {{--  {{ __('orderhistory.paymentreceiptinfomsg') }}                                                                 --}}
                                                              </div>
                      
                                                              <div class="form-group row col-md-12">
                                                                  <label for="picPath" class="col-md-4 col-form-label text-md-right">{{ __('orderhistory.uploadimage') }}</label>
                      
                                                                  <div class="col-md-8">
                                                                        <input id="picPath" name="picPath[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true" >
                                                                        <div>
                                                                          <p style="margin:0px;"><strong>{{__('orderhistory.note')}}:</strong> </p>
                                                                          <p style="margin:0px;">1. {{__('orderhistory.only')}} pdf, jpeg, png, doc {{__('orderhistory.formatcanbeuploaded')}}</p>
                                                                          <p style="margin:0px;">2. {{__('orderhistory.maximum')}} 8 {{__('orderhistory.filescanbeuploadedatatime')}}</p>
                                                                          <p style="margin:0px;">3. {{__('orderhistory.eachfilesize')}} 10mb.</p>
                                                                        </div>
                                                                  </div>
                                                              </div>

                                                              <div class="col-md-12">
                                                                <div class="form-group row required">
                                                                  <label class="col-sm-4 col-form-label control-label">{{ __('orderhistory.message') }}</label>
                                                                  <div class="col-sm-8">
                                                                    <textarea class="form-control "  rows="4" id="message" name="message"  required></textarea>
                        
                                                                  </div>
                                                                </div>
                                                              </div>
                      
                                                              <div class="form-group row col-md-12 " style=" margin-bottom: 20px;">
                                                                  <div class="col-md-12 ">
                                                                      <button type="submit" class="btn btn-success btn-lg "  id="send" style="float: right;">{{ __('orderhistory.send') }}</button>
                                                                  </div>
                                                              </div>
                                                      </form>
                                                    </fieldset>

                                                    @endif
                                                    
                                                    <br><br>
                                                    <table class="table table-bordered">
                                                      <tr>
                                                        <th>{{__('orderhistory.deliverystatus')}}</th>
                                                        <th style="{{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and  $cart->isDeliveryConfirmed==1) ? 'color: green;' : 'color: red;'}}">
                                                          {{-- approved and payment confirmed and tracking added and delivery confirmed--}}
                                                          @if ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and  $cart->isDeliveryConfirmed==1)
                                                              {{ __('orderhistory.complete') }}
                                                          @else
                                                              {{ __('orderhistory.incomplete') }}
                                                          @endif
                                                        </th>
                                                      </tr>
                                                    </table>
                                                    <br> <br>  

                                                    <h4 class="text-center mt-2">{{__('orderhistory.prevconversation')}}</h4>
                                                    <table class="table table-bordered table-hover" >
                                                        <tbody>
                                                            @foreach ($cartdeliveryinfoData->where('cartId', $cart->cartId)->sortByDesc('created_at') as $cartdeliveryinfo)
                                                                <tr>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item">
                                                                                <i class="fa fa-user" aria-hidden="true"></i> 
                                                                                @if ($cartdeliveryinfo->isCustomer==1)
                                                                                    {{ $cart->takingFor}} 
                                                                                @else
                                                                                    {{-- {{ $usersData->where('id', $cartdeliveryinfo->userId)->pluck('name')->first() }} --}}
                                                                                    {{ __('orderhistory.admin') }}
                                                                                @endif
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <i class="fa fa-clock-o" aria-hidden="true"></i> {{ YmdTodmYPmgiA($cartdeliveryinfo->created_at)}}
                                                                            </li>
                                                                            <li class="list-group-item">
                                                                                <i class="fa fa-calendar" aria-hidden="true"></i> {{ YmdTodmYPmdMy($cartdeliveryinfo->created_at)}}
                                                                            </li>
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        <ul class="list-group">
                                                                            <li class="list-group-item">
                                                                              @if ($cartdeliveryinfo->isCustomer!=1)

                                                                                @if (app()->getLocale()=='en')
                                                                                  {{ $cartdeliveryinfo->message}}
                                                                                @elseif (app()->getLocale()=='cn')
                                                                                  {{ $cartdeliveryinfo->messageCN}}
                                                                                @elseif (app()->getLocale()=='ru')
                                                                                  {{ $cartdeliveryinfo->messageRU}}
                                                                                @endif

                                                                              @else
                                                                                {{ $cartdeliveryinfo->message}}
                                                                              @endif
                                                                            </li>
                                                                            @if ($cartdeliveryinfo->picPath)
                                                                                <li class="list-group-item">
                                                                                    {{-- <img class="lozad magnificPopup" data-src="/..{{ $cartdeliveryinfo->picPath }}" data-mfp-src="/..{{ $cartdeliveryinfo->picPath }}" style="border-radius: 0%; width: 200px; height: 200px;"> --}}
                                                                                    <a href="{{asset($cartdeliveryinfo->picPath)}}" target="_blank"  style="text-decoration: underline;">{{ __('prescription.clicktoopenfile') }}</a>
        
                                                                                </li>
                                                                            @endif
                                                                        </ul>
                                        
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                        
                                                    </table>


                                          
                                                  </div>
                                              </div>
                                          </div>

                                          <!-- Accordion card 5 end -->


                                          <!-- Accordion card 6 start -->
                                            <div class="card">
                                                <!-- Card header -->
                                                <div class="card-header"  style="{{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and   $cart->isDeliveryConfirmed==1 and $cart->isCartComplete==1  ) ? 'color:green;' : 'color:grey;'}}"  role="tab"  id="cart-id-{{ $cart->cartId }}-heading6">
                                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading6" href="#cart-id-{{ $cart->cartId }}-collapseHeading6"
                                                    aria-expanded="false" aria-controls="cart-id-{{ $cart->cartId }}-collapseHeading6">
                                                    <h5 class="mb-0">
                                                      <i class="fa fa-plus-square" ></i>
                                                      {{ __('orderhistory.step6') }} :  {{ __('orderhistory.complete') }}  
                                                      <span style="font-weight: bold; ">
                                                        {{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and   $cart->isDeliveryConfirmed==1 and $cart->isCartComplete==1  ) ? '(✓)' : ''}}
                                                      </span>  
                                                    </h5>
                                                  </a>
                                                </div>

                                                <div id="cart-id-{{ $cart->cartId }}-collapseHeading6" class="collapse" role="tabpanel" aria-labelledby="heading6"
                                                  data-parent="#accordionHeading6" >
                                                  <div class="card-body">

                                                    <br><br>
                                                    <table class="table table-bordered">
                                                      <tr>
                                                        {{--  <th>{{__('orderhistory.deliverystatus')}}</th>  --}}
                                                        <th style="{{ ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and  $cart->isDeliveryConfirmed==1  and $cart->isCartComplete==1  ) ? 'color: green;' : 'color: red;'}}">
                                                          {{-- approved and payment confirmed and tracking added and delivery confirmed--}}
                                                          @if ($cart->isCartApproved==2 and  $cart->isPaymentConfirm==1 and $cart->isTrackingAdded==1 and  $cart->isDeliveryConfirmed==1  and $cart->isCartComplete==1 )
                                                              {{--  {{ __('orderhistory.complete') }}  --}}
                                                              {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).', '.__('orderhistory.complete').'! ' }}
                                                          @else
                                                              {{--  {{ __('orderhistory.incomplete') }}  --}}
                                                              {{  __('orderhistory.your_order').process_order_number($cart->cartId, $cart->created_at).', '.__('orderhistory.incomplete').'! ' }}
                                                          @endif
                                                        </th>
                                                      </tr>
                                                    </table>


                                          
                                                  </div>
                                              </div>
                                          </div>

                                          <!-- Accordion card 6 end -->






                                        </div>


                                        {{-- cart details --}}
                                        {{-- cart details --}}
                                        <fieldset class="cart-tab" style="margin-top: 60px;">
                                          <legend style="border-bottom: none;">{{ __('checkout.orderdetails') }} ({{ process_order_number($cart->cartId, $cart->created_at) }})</legend>
                                                
                                                <table class="table table-hover table-responsive " id="orderdetails_table">
                                                  
                                                  <thead >
                                                    <tr class="bg-success">
                                                      <th>{{ __('checkout.products') }}</th>
                                                      <th>{{ __('checkout.qty') }}</th>
                                                      <th>{{ __('checkout.total') }}{{ ' ('.$cart->currency.')' }}</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach ($cartdetailsData->where('cartId', $cart->cartId) as $cartdetail)
                                                      <tr>
                                                        <td>

                                                            <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $cartdetail->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $cartdetail->genericBrandId ) ) }}" target="_blank">

                                                              @if (app()->getLocale()=='en')
                                                                  {{$cartdetail->genericBrand .' ('.$cartdetail->genericStrength.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packType.' | '.$cartdetail->dosageForm.', '. $cartdetail->genericCompany  }}
                                                                  
                                                              @elseif (app()->getLocale()=='cn')
                                                                  {{$cartdetail->genericBrandCN. ' ('.$cartdetail->genericStrengthCN.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packTypeCN.' | '.$cartdetail->dosageFormCN.', '. $cartdetail->genericCompanyCN  }}
                                                              @elseif (app()->getLocale()=='ru')
                                                                {{$cartdetail->genericBrandRU. ' ('.$cartdetail->genericStrengthRU.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packTypeRU.' | '.$cartdetail->dosageFormRU.', '. $cartdetail->genericCompanyRU  }}
                                                              @endif

                                                            </a>

                                                        </td>
                                                        <td>{{ $cartdetail->qty }}</td>
                                                        <td>{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cartdetail->subtotal * ( $countryData->where('currency', $cart->currency)->pluck('usdToCurrencyRate')->first() )  }}</td>
                                                      </tr>
                                                    @endforeach
                                                  </tbody>
                                                  <tfoot class="text-success">
        
                                                    <tr>
                                                      <th>{{ __('checkout.subtotal') }}</th>
                                                      <th>{{ $cart->totalQty }}</th>
                                                      <th>{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->subTotalAmount  }}</th>
                                                    </tr>
                                                    <tr>
                                                      <th>{{ __('checkout.discount') }}</th>
                                                      <td></td>
                                                      <td>{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->discount }}</td>
                                                    </tr>
                                                    <tr>
                                                      <th>{{ __('checkout.tax') }}</th>
                                                      <td></td>
                                                      <td>{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->tax }}</td>
                                                    </tr>
                                                    <tr>
                                                      <th>{{ __('checkout.shippingcost') }}</th>
                                                      <td></td>
                                                      <td id="cartShippingCost">{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->shippingAmount}}</td>
                                                    </tr>
        
                                                    <tr>
                                                      <th>{{ __('checkout.transactionFee') }}</th>
                                                      <td></td>
                                                      <td >{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->transactionFeeAmount }} </td>
                                                    </tr>
                            
                                                    <tr>
                                                      <th>{{ __('checkout.netpayable') }}</th>
                                                      <td></td>
                                                      <th id="cartTotal">{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->totalAmount }}</th>
                                                    </tr>
        
                                                  </tfoot>
                                                </table>
        
        
                                        </fieldset>
                                        {{-- cart details --}}
                                        {{-- cart details --}}
        
        
        
        
        
                                        {{-- delivery details --}}
                                        {{-- delivery details --}}
                                        <fieldset class="cart-tab" style="margin-top: 25px;">
                                          <legend style="border-bottom: none;">{{ __('checkout.deliverydetails') }}</legend>
        
        
                                          <table class="table table-hover table-responsive " id="deliverydetails_table">
                                                  
                                                  <thead>
                                                    <th></th>
                                                    <th></th>
                                                  </thead>
                                                  <tbody>
                                                      <tr>
                                                        <th>{{ __('checkout.name').' ('.__('checkout.inenglish').')' }}</th>
                                                        <td >{{ $cart->takingFor }}</td>
                                                      </tr>
        
                                                      <tr>
                                                        <th>{{ __('checkout.name').' ('.__('checkout.inlocallanguage').')' }}</th>
                                                        <td >{{ $cart->takingForLocalLang }}</td>
                                                      </tr>
        
                                                      {{-- <tr>
                                                        <th>{{ __('checkout.email') }}</th>
                                                        <td >{{ $cart->email}}</td>
                                                      </tr> --}}
        
                                                      <tr>
                                                        <th>{{ __('checkout.phone') }}</th>
                                                        <td >{{ $cart->phoneCode.$cart->phone }}</td>
                                                      </tr>
        
                                                      <tr>
                                                        <th>{{ __('checkout.alternativephone') }}</th>
                                                        <td >{{ $cart->phonenumber2 }}</td>
                                                      </tr>
        
        
        
        
                                                      <tr>
                                                        <th>{{ __('checkout.housestreet').' ('.__('checkout.inenglish').')' }}</th>
                                                        <td >{{ $cart->streethouse }}</td>
                                                      </tr>
        
                                                      <tr>
                                                        <th>{{ __('checkout.housestreet').' ('.__('checkout.inlocallanguage').')' }}</th>
                                                        <td >{{ $cart->streethouseLocalLang }}</td>
                                                      </tr>
        
        
        
        
                                                      <tr>
                                                        <th>{{ __('checkout.country') }}</th>
                                                        <td >{{ $countryData->where('countryId', $cart->countryId )->pluck('country')->first() }}</td>
                                                      </tr>
        
        
                                                      <tr>
                                                        <th>{{ __('checkout.city').' ('.__('checkout.inenglish').')' }}</th>
                                                        <td >{{ $cart->city }}</td>
                                                      </tr>
        
                                                      <tr>
                                                        <th>{{ __('checkout.city').' ('.__('checkout.inlocallanguage').')' }}</th>
                                                        <td >{{ $cart->cityLocalLang }}</td>
                                                      </tr>
        
                                                      
        
                                                      <tr>
                                                        <th>{{ __('checkout.postcode') }}</th>
                                                        <td >{{ $cart->postalCode }}</td>
                                                      </tr>
        
                                                      
        
                                                      
        
                                                      <tr>
                                                        <th>{{ __('checkout.deliverymethod') }} </th>
                                                        <td >
                                                            @if ( app()->getLocale() == 'en' )
                                                                {{ $deliverymethodsData->where('deliveryMethodId', $cart->deliveryMethodId )->pluck('deliveryMethod')->first() }}
                                                            @elseif ( app()->getLocale() == 'cn' )
                                                                {{ $deliverymethodsData->where('deliveryMethodId', $cart->deliveryMethodId )->pluck('deliveryMethodCN')->first() }}
                                                            @elseif ( app()->getLocale() == 'ru' )
                                                                {{ $deliverymethodsData->where('deliveryMethodId', $cart->deliveryMethodId )->pluck('deliveryMethodRU')->first() }}
                                                            @endif
                                                        </td>
                                                      </tr>

                                                      <tr>
                                                        <th>{{ __('checkout.paymentmethod') }} </th>
                                                        <td >
                                                              @if (app()->getLocale()=='en')
                                                                {{ $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentMethod')->first() }}
                                                              @elseif(app()->getLocale()=='cn')
                                                                {{ $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentMethodCN')->first() }}
                                                              @elseif(app()->getLocale()=='ru')
                                                                {{ $cartapprovesData->where('cartId',$cart->cartId)->pluck('paymentMethodRU')->first() }}
                                                              @endif
                                                        </td>
                                                      </tr>
        
        
                                                  </tbody>
                                                
                                            </table>
                                          
        
        
                                        </fieldset>
                                        {{-- delivery details --}}
                                        {{-- delivery details --}}

                                      </div>
                                 
                                @endforeach

                                
                              </div>
                              
                              <div class="clearfix"></div>
                            <!-- Tab panes -->

                        </div>
                          



                    </div>
                </div>
            </div>




        </div>
    </div>
</div>


<div class="container-fluid padd-20 " style="margin: 15px;">
  <h4 class="card-title" style="text-align: center; font-weight: bold;">{{ __('orderhistory.totalcompletedorders') }}</h4>

        <table id="datatabletcomporderhistoryWScroll" class="table table-striped table-bordered table-hover " >
            <thead>
                <tr class="bg-primary text-light">
                    <th scope="col">{{ __('orderhistory.serial') }}</th>
                    <th scope="col">{{ __('orderhistory.date') }}</th>
                    <th scope="col">{{ __('orderhistory.cartnumber') }}</th>
                    <th scope="col">{{ __('orderhistory.shippingaddress') }}</th>
                    <th scope="col">{{ __('orderhistory.medicineinfo') }}</th>
                    <th scope="col">{{ __('orderhistory.transactionfee') }}</th>
                    <th scope="col">{{ __('orderhistory.shippingcost') }} </th>
                    <th scope="col">{{ __('orderhistory.netamount') }} </th>
                    <th scope="col">{{ __('orderhistory.trackingnumber') }} </th>
                    <th scope="col">{{ __('orderhistory.deliverystatus') }} </th>
                </tr>
            </thead>

        </table>
</div>


<script>
  // var exportableColumns = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28,30 ];
  $(document).ready( function () {
      $('#datatabletcomporderhistoryWScroll').removeAttr('width').DataTable({
          // fixedHeader: {
          //     header: true,
          // },
          "fnRowCallback" : function(nRow, aData, iDisplayIndex){
            $("td:first", nRow).html(iDisplayIndex +1);
            return nRow;
          },
          processing: true,
          serverSide: true,
          "bSort": true,
          "responsive": true,
          // "autoWidth": false,
          "scrollX": true,
          "scrollY": false,
          language: {
                  search: "_INPUT_",
                  searchPlaceholder: "Search..."
              },
          "pagingType": "simple_numbers",
          dom: 'lBfrtip',
          buttons: [
              // 'excel',
              {
                  extend: 'excelHtml5',
                  // exportOptions: {
                  //     columns: exportableColumns
                  // }
              },
              //  'csv' ,
              {
                  extend: 'csvHtml5',
                  // exportOptions: {
                  //     columns: exportableColumns
                  // }
              },
              'print',
           ],
          columnDefs: [
              { width: 100, targets: 2 },
              { width: 200, targets: 3 },
              { width: 1000, targets: 4 },
              { width: 200, targets: 5 },
              { width: 200, targets: 6 },
              { width: 600, targets: 8 },
            
          ],

          // ajax: "{{url('/')}}"+"/api/report/casehistoryreportgenerator?customerId={{Auth::user()->id}}",
          
          ajax: {
                url: "{{url('/')}}"+"/api/report/casehistoryreportgenerator?customerId={{Auth::user()->id}}",
                type: 'POST',
                headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },


          datatype:'json',
          // type: 'get',
          lengthMenu: [
          [ 10, 25, 50, -1 ],
              [ '10', '25', '50','All' ]
          ],
          columns: [
                      { data: 'cartId', 
                          render: function(data, type, full, meta){
                              if (data)
                              {
                                  return data;
                              }
                              else{
                                  return   " ";
                              }
                          },
                          width: 100
                       },
                       { data: 'dateOfOrderDateWithDot', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return data;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'cartNumber', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let cartId=dataArray[0];
                                    let cartNumber=dataArray[1];
                                    return "<a href='"+"{{url('/').'/customerOrderHistory?cartId='}}"+cartId+"&lang={{app()->getLocale()}}' target='_blank'> "+cartNumber+"</a>";
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'shippingAddress', 
                            render: function(data, type, full, meta){

                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let takingFor=dataArray[0];
                                    let takingForLocalLang=dataArray[1];
                                    let streethouse=dataArray[2];
                                    let streethouseLocalLang=dataArray[3];
                                    let postalCode=dataArray[4];
                                    let country=dataArray[5];
                                    let phone=dataArray[6];
                                    let city=dataArray[7];
                                    let cityLocalLang=dataArray[8];

                                    return   takingFor+'<span style="color:white;"> || </span>'+'<br>'+
                                            takingForLocalLang+'<span style="color:white;"> || </span>'+'<br>'+
                                            phone+'<span style="color:white;"> || </span>'+'<br>'+
                                        streethouse+'<span style="color:white;"> || </span>'+'<br>'+
                                        streethouseLocalLang+'<span style="color:white;"> || </span>'+'<br>'+
                                        city+'<span style="color:white;"> || </span>'+'<br>'+
                                        cityLocalLang+'<span style="color:white;"> || </span>'+'<br>'+
                                        postalCode+'<span style="color:white;"> || </span>'+'<br>'+
                                        country+'<span style="color:white;"> || </span>'+'<br>'
                                        
                                    ;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                       
                         { data: 'medicineInfo', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':::');

                                    let rows = " ";

                                    let product = " ";
                                    let quantity = " ";
                                    let offerprice = " ";
                                    let discount = " ";
                                    let total = " ";

                                    let productLink = " ";

                                    dataArray.forEach(record => {

                                      record=record.split('::');
                                      let rowEN=record[0];
                                      let rowCN=record[1];
                                      let rowRU=record[2];


                                      @if (app()->getLocale()=='en')

                                        rowEN=rowEN.split(':');
                                        product = rowEN[0];
                                        quantity = rowEN[1];
                                        offerprice = rowEN[2];
                                        discount = rowEN[3];
                                        total = rowEN[4];
                                        genericBrandId = rowEN[5];
                                        productLink = "<a target='_blank' href='{{ URL::to('productDetailsPageCaller') }}/"+genericBrandId+"'>"+product+"</a>";

                                      @elseif(app()->getLocale()=='cn')
                                        rowCN=rowCN.split(':');
                                        product = rowCN[0];
                                        quantity = rowCN[1];
                                        offerprice = rowCN[2];
                                        discount = rowCN[3];
                                        total = rowCN[4];
                                        genericBrandId = rowCN[5];
                                        productLink = "<a target='_blank' href='{{ URL::to('productDetailsPageCaller') }}/"+genericBrandId+"'>"+product+"</a>";

                                      @elseif(app()->getLocale()=='ru')

                                        rowRU=rowRU.split(':');
                                        product = rowRU[0];
                                        quantity = rowRU[1];
                                        offerprice = rowRU[2];
                                        discount = rowRU[3];
                                        total = rowRU[4];
                                        genericBrandId = rowRU[5];
                                        productLink = "<a target='_blank' href='{{ URL::to('productDetailsPageCaller') }}/"+genericBrandId+"'>"+product+"</a>";

                                      @endif


                                      rows = rows+"<tr>"+  "<td> "+productLink+"<span style='color:white;'> || </span><br></td>"+
                                                    "<td>"+quantity+"<span style='color:white;'> || </span><br></td>"+
                                                    "<td>"+offerprice+"<span style='color:white;'> || </span><br></td>"+
                                                    "<td>"+discount+"<span style='color:white;'> || </span><br></td>"+
                                                    // "<td>"+total+"<span style='color:white;'> || </span><br></td>"+
                                                  "</tr>";
                                    });


                                    let tableStr = "<table class='table table-striped table-bordered table-hover'>"+
                                                      "<thead>"+
                                                        "<tr class='bg-secondary'>"+
                                                          "<th scope='col'>"+ "{{ __('orderhistory.product') }}" +"<span style='color:white;'> || </span>"+"<br>"+"</th>"+
                                                            "<th scope='col'>"+ "{{ __('orderhistory.quantity') }}" +"<span style='color:white;'> || </span>"+"<br>"+"</th>"+
                                                            "<th scope='col'>"+ "{{ __('orderhistory.offerprice') }}" +"<span style='color:white;'> || </span>"+"<br>"+"</th>"+
                                                            "<th scope='col'>"+ "{{ __('orderhistory.discount') }}" +"<span style='color:white;'> || </span>"+"<br>"+"</th>"+
                                                            // "<th scope='col'>"+ "{{ __('orderhistory.total') }}" +"<span style='color:white;'> || </span>"+"<br>"+"</th>"+
                                                          "</tr>"+
                                                      "</thead>"+
                                                      "<tbody>"+ rows+"</tbody>"
                                                    +"</table>";
                                    return tableStr;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                       { data: 'transactionFeeAmountWithPaymentMedia', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    let paymentMethod=dataArray[0];
                                    let paymentMethodCN=dataArray[1];
                                    let paymentMethodRU=dataArray[2];
                                    let transactionFeeAmount=dataArray[3];

                                    @if (app()->getLocale()=='en')
                                      paymentMethod = paymentMethod
                                    @elseif(app()->getLocale()=='cn')
                                      paymentMethod = paymentMethodCN
                                    @elseif(app()->getLocale()=='ru')
                                      paymentMethod = paymentMethodRU
                                    @endif

                                    return   paymentMethod+'<span style="color:white;"> || </span>'+'<br>'+ transactionFeeAmount;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'shippingCostWithDeliveryMethod', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    let deliveryMethod=dataArray[0];
                                    let deliveryMethodCN=dataArray[1];
                                    let deliveryMethodRU=dataArray[2];
                                    let shippingAmount=dataArray[3];

                                    @if (app()->getLocale()=='en')
                                      deliveryMethod = deliveryMethod
                                    @elseif(app()->getLocale()=='cn')
                                      deliveryMethod = deliveryMethodCN
                                    @elseif(app()->getLocale()=='ru')
                                      deliveryMethod = deliveryMethodRU
                                    @endif

                                    return   deliveryMethod+'<span style="color:white;"> || </span>'+'<br>'+ shippingAmount;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'totalAmount', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return data;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'trackingWithDocs', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split('::');
                                    let tracking=dataArray[0];
                                    let trackingCN=dataArray[1];
                                    let trackingRU=dataArray[2];
                                    let trackingDocs=dataArray[3];

                                    trackingDocs=trackingDocs.split(':');
                                    let trackingDocsStr = " ";
                                    
                                    trackingDocs.forEach(element => {
                                      if (element) {
                                        trackingDocsStr = trackingDocsStr + "<a href='"+"{{url('/')}}"+element+"' target='_blank'> "+"{{url('/')}}"+element+"</a>"+'<span style="color:white;"> || </span>'+'<br>'
                                      }
                                    });                                    
                                    

                                    @if (app()->getLocale()=='en')
                                      tracking = tracking
                                    @elseif(app()->getLocale()=='cn')
                                      tracking = trackingCN
                                    @elseif(app()->getLocale()=='ru')
                                      tracking = trackingRU
                                    @endif

                                    return   tracking+'<span style="color:white;"> || </span>'+'<br><br>'+trackingDocsStr;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                       
                       { data: 'isCartComplete', 
                            render: function(data, type, full, meta){
                                if (data==1)
                                {
                                    return "{{__('orderhistory.complete')}}";
                                }
                                else{
                                    return   "{{__('orderhistory.incomplete')}}";
                                }
                            },
                         },
                       
                       
                  ],
      });
   });
</script>

<style type="text/css">

    .detail-left .zoom-btn {
        position: absolute;
        display: inline-block;
        right: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #fff;
        color: #d5d5d5;
        line-height: 40px;
        text-align: center;
        bottom: 175px;
        z-index: 6;
    }

    .detail-left {
        background-color: #f7f7f7;
        padding-bottom: 30px;
        padding-top: 50px;
    }


    .detail-page .coupon {
        padding: 14px 35px;
        float: left;
    }
    .coupon:hover {
        border: 1px solid rgb(33, 157, 32);
        color: rgb(33, 157, 32);
        background-color: transparent;
    }
    a:active, a:hover {
        outline: 0;
    }
    .coupon {
        background-color: rgb(33, 157, 32);
        padding: 16px 60px;
        text-align: center;
        margin-left: 8px;
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        letter-spacing: 0;
        margin-top: 3px;
        border-radius: 30px;
        transition: all .3s;
        border: 1px solid rgb(33, 157, 32);
    }


    .action-icon a {
        font-size: 16px;
        color: #dbdbdb;
        transition: all .3s;
        margin-left: 8px;
    }

    .action-icon a i {
        font-size: 20px;
        margin-right: 7px;
        color: #dbdbdb;
        transition: all .3s;
        vertical-align: middle;
    }

    .action-icon a
    {
        margin-left: 0px !important;
        margin-right: 15px !important;
    }



    .product-tab{
    border:1px solid #dcdcdc;
    position:relative;
    margin:50px 0
    }
    .product-tab ul.nav-tabs{
        width:25%;
        float:left;
        border-right:1px solid #dcdcdc;
        position:absolute;
        height:100%;
        left:0;
        top:0;
        border-bottom:none
    }
    .product-tab ul.nav-tabs li{
        display:block
    }
    .product-tab ul.nav-tabs li a{
        font-size:16px;
        font-weight:700;
        color:#222;
        padding:15px 0 15px 25px;
        border-bottom:1px solid #dcdcdc;
        border-left:5px solid transparent;
        transition:all .3s;
        margin:0;
        display:block!important
    }
    .product-tab ul.nav-tabs li.active a,.product-tab ul.nav-tabs li:hover a{
        background-color:#efefef;
        border-left:5px solid #232f3e
    }
    .product-tab .tab-content{
        width:75%;
        float:left;
        margin-left:25%
    }
    .product-tab .tab-pane{
        padding:35px
    }
    .detail-page .tab-pane p{
        font-size:16px;
        font-weight:400;
        line-height:1.6;
        color:#868686;
        margin-bottom:15px
    }
    .detail-page .tab-pane p b{
        font-weight:700;
        color:#232f3e

    }

    .tab-pane{
        min-height: 400px;
    }

    .action-icon a:hover, .action-icon a:hover i 
    {
        color: #25bb2b;
    }




</style>


<style type="text/css" media="screen">
  fieldset{
   border:1px solid #cccc;
   padding: 8px;
}
</style>




{{-- accordion --}}


<script type="text/javascript">

  
  $(document).ready(function(){

    @foreach ($cartData->sortByDesc('created_at') as $cart)

 
      $("#cart-id-{{ $cart->cartId }}-heading1").click(function(){
        if ($('#cart-id-{{ $cart->cartId }}-heading1 i').attr('class')=='fa fa-plus-square') {
          $("#cart-id-{{ $cart->cartId }}-heading1 i").removeClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-heading1 i").addClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-collapseHeading1").removeClass(' in');

        }else {
          $("#cart-id-{{ $cart->cartId }}-heading1 i").removeClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-heading1 i").addClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-collapseHeading1").addClass(' in');

        }
      });


      $("#cart-id-{{ $cart->cartId }}-heading2").click(function(){
        if ($('#cart-id-{{ $cart->cartId }}-heading2 i').attr('class')=='fa fa-plus-square') {
          $("#cart-id-{{ $cart->cartId }}-heading2 i").removeClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-heading2 i").addClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-collapseHeading2").removeClass(' in');
        }else {
          $("#cart-id-{{ $cart->cartId }}-heading2 i").removeClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-heading2 i").addClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-collapseHeading2").addClass(' in');
          
        }
      });

      $("#cart-id-{{ $cart->cartId }}-heading3").click(function(){
        if ($('#cart-id-{{ $cart->cartId }}-heading3 i').attr('class')=='fa fa-plus-square') {
          $("#cart-id-{{ $cart->cartId }}-heading3 i").removeClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-heading3 i").addClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-collapseHeading3").removeClass(' in');

        }else {
          $("#cart-id-{{ $cart->cartId }}-heading3 i").removeClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-heading3 i").addClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-collapseHeading3").addClass(' in');

        }
      });


      $("#cart-id-{{ $cart->cartId }}-heading4").click(function(){
        if ($('#cart-id-{{ $cart->cartId }}-heading4 i').attr('class')=='fa fa-plus-square') {
          $("#cart-id-{{ $cart->cartId }}-heading4 i").removeClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-heading4 i").addClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-collapseHeading4").removeClass(' in');

        }else {
          $("#cart-id-{{ $cart->cartId }}-heading4 i").removeClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-heading4 i").addClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-collapseHeading4").addClass(' in');

        }
      });

      $("#cart-id-{{ $cart->cartId }}-heading5").click(function(){
        if ($('#cart-id-{{ $cart->cartId }}-heading5 i').attr('class')=='fa fa-plus-square') {
          $("#cart-id-{{ $cart->cartId }}-heading5 i").removeClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-heading5 i").addClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-collapseHeading5").removeClass(' in');

        }else {
          $("#cart-id-{{ $cart->cartId }}-heading5 i").removeClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-heading5 i").addClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-collapseHeading5").addClass(' in');

        }
      });

      $("#cart-id-{{ $cart->cartId }}-heading6").click(function(){
        if ($('#cart-id-{{ $cart->cartId }}-heading6 i').attr('class')=='fa fa-plus-square') {
          $("#cart-id-{{ $cart->cartId }}-heading6 i").removeClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-heading6 i").addClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-collapseHeading6").removeClass(' in');

        }else {
          $("#cart-id-{{ $cart->cartId }}-heading6 i").removeClass("fa fa-minus-square");
          $("#cart-id-{{ $cart->cartId }}-heading6 i").addClass('fa fa-plus-square');
          $("#cart-id-{{ $cart->cartId }}-collapseHeading6").addClass(' in');

        }
      });

    @endforeach
   
  });
</script>



<script type="text/javascript">
  {{-- image upload and preview --}}

  function readURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#photoUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#photoUploadInput").change(function() 
  {
    readURL(this);
  });

  function readURL2(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#photoUploadPreview2').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#photoUploadInput2").change(function() 
  {
    readURL2(this);
  });


</script>


{{-- bootstrap-fileinput --}}
<script type="text/javascript">
  $(document).ready(function() {
      $("#paymentReceiptImagePath").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          maxFileCount: 8,
          maxFileSize:1024*10,
          allowedFileExtensions: ["jpg","jpeg", "png", "pdf", "doc"],

      });        
  });
</script>


{{-- bootstrap-fileinput --}}
<script type="text/javascript">
  $(document).ready(function() {
      $("#picPath").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          maxFileCount: 8,
          maxFileSize:1024*10,
          allowedFileExtensions: ["jpg","jpeg", "png", "pdf", "doc"],
      });        
  });
</script>





<link rel="stylesheet" href="{{ asset('frontend/css/thankyou.css') }}">





<style>
  @media (max-width: 550px) {

     
      .product-tab ul.nav-tabs li a{
          padding: 7px 0 15px 2px !important;
      }

      .product-tab ul.nav-tabs li.active a, .product-tab ul.nav-tabs li:hover a {
          border-left: 2px solid #232f3e !important;
      }

      .product-tab ul.nav-tabs li a{
          font-size: 12px !important;
      }

      .product-tab .tab-pane {
          padding: 4px !important;
      }

      .tab-pane table tbody tr td, .cart-tab table tbody tr td, .cart-tab table tbody tr th{
        font-size: 12px !important;
      }

      legend{
        font-size: 14px !important;
        font-weight: bold !important;
      }
      .table-responsive tbody tr td, .table-responsive tbody tr th,.table-responsive thead tr td, .table-responsive thead tr th,.table-responsive tfoot tr td, .table-responsive tfoot tr th, .table-bordered  tbody tr td, .table-bordered  tbody tr th, .card-body h4{
        font-size: 12px !important;
      } 

      th, td { 
        font-size: 12px; 
      }


      
  }
</style>

<script>
  

  $(document).ready(function () {
      $('#orderdetails_table').DataTable({
          "responsive": true,
          "scrollX": true,
          dom: 't',
          "bSort": false,

      });
      
  });

  $(document).ready(function () {
      $('#deliverydetails_table').DataTable({
          "responsive": true,
          "scrollX": true,
          dom: 't',
          "drawCallback": function( settings ) {
                $("#deliverydetails_table thead").remove(); 
          } ,
          "bSort": false,


      });
      
  });
</script>
<style>
#deliverydetails_table thead, #deliverydetails_table .dataTables_scrollHead{
  display: none !important;
}

</style>

@endsection
