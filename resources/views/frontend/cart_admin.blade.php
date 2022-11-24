@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Carts')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 


<script type="text/javascript">
  $(document).ready(function() {
    // with sxrol-x
        $('#datatable1WScrollCustomized').removeAttr('width').DataTable( {
            "pagingType": "simple_numbers",
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            },
             
            "scrollX": true,
            // "scrollY": false,
            scrollY:        500,
            deferRender:    true,
            scroller:       true,
            // "ordering": false,
            "responsive": true,
            "autoWidth": false,
            "order": [[ 0, "desc" ]]
            
            
        } );
  });
</script>

<script type="text/javascript">

  $(function(){
    $('#makeDeliveryConfirmationModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) ;
          var cartId = button.data('cartid') ;
          var modal = $(this);
          modal.find('.modal-body #cartId').val(cartId);

          // modal.find(".modal-body #deliveryCompleteDate" ).datepicker(
          //     { 
          //         dateFormat: 'dd-mm-yy' 
          //     }
          // );
          // modal.find(".modal-body #remindingAlarmDate" ).datepicker(
          //     { 
          //         dateFormat: 'dd-mm-yy' 
          //     }
          // );
    });
  });

</script>




@section('page_content')


<div class="content-wrapper" style="min-height: 0px;">

   {{-- Notification --}}
    {{-- Notification --}}
    @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error)
            <div class="alert alert-danger" id="alert-danger" role="alert" >
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              {{ $error }}
            </div>
          @endforeach
        </ul>

    @endif

      
    @if (session('successMsg'))
                

      <div class="alert alert-success"  id="alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        {{ session('successMsg') }}
      </div>

    @endif






  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Carts</h4>



    <table id="datatable1WScrollCustomized" class="table table-striped table-bordered table-hover" >
          <thead>
              <tr class="bg-primary text-light">
                  <th scope="col">#</th>
                  <th scope="col">Customer Info</th>
                  <th scope="col" >Order Details</th>
                  <th scope="col">Delivery Details</th>
                  <th scope="col">Comments</th>
                  <th scope="col" >Prescription/Document</th>
                  <th scope="col">Cart Approval</th>
                  <th scope="col" style="width: 400px;">Payment Receipt Information</th>
                  <th scope="col">Payment Confirmation</th>
                  <th scope="col">Tracking Info</th>
                  <th scope="col">Delivery</th>
                  <th scope="col">Delivery Info</th>
                  <th scope="col">Batch</th>
                  {{-- <th scope="col">Action</th> --}}
              </tr>
          </thead>
          

          <tbody>
               
              @foreach ($cartData->where('customerId', '!=', null)->sortByDesc('created_at') as $cart)
                  
                <tr id="cartId-{{ $cart->cartId }}" style="{{$cart->isCartComplete ? 'background-color:#00800030':''}}">
                    <td>
                    <a href="/cart/cartListAdmin?cartId={{$cart->cartId}}">
                        {{ str_replace('#','',process_order_number($cart->cartId, $cart->created_at)) }}
                      </a>
                    </td>
                    <td>
                        <ul class="list-group ">
                            <li class="list-group-item  list-group-item-action">

                              {{--  {{ dd($cart->customerId) }}  --}}
                              <a href="{{ route('customerProfileUpdate', $cart->customerId) }}" target="_blank" >{{ $userData->where('id', $cart->customerId)->pluck('name')->first() }}</a>
                            </li>
                            <li class="list-group-item  list-group-item-action">{{ $userData->where('id', $cart->customerId)->pluck('email')->first() }}</li>

                            @if ($userData->where('id', $cart->customerId)->pluck('isCreatedByAdmin')->first())
                              <li class="list-group-item list-group-item-action">
                                {{ ($userData->where('id', $cart->customerId)->pluck('isCreatedByAdmin')->first()==1)? 'Created by Admin' : '' }}
                              </li>
                            @endif
                            @if ($userData->where('id', $cart->customerId)->pluck('isDeleted')->first())
                              <li class="list-group-item list-group-item-action">
                                  <strong style="color:red;">{{ ($userData->where('id', $cart->customerId)->pluck('isDeleted')->first()==1)? 'Deleted Account' : '' }}</strong>
                              </li>
                            @endif


                            <li class="list-group-item  list-group-item-action">
                              {{ $userData->where('id', $cart->customerId)->pluck('phoneCode')->first().$userData->where('id', $cart->customerId)->pluck('phone')->first()  }}
                            </li>
                            <li class="list-group-item  list-group-item-action">
                              {{ Carbon\Carbon::parse($cart->created_at)->format('d-M-Y') }}
                            </li>
                            @if ($cart->website)
                              <li class="list-group-item  list-group-item-action">
                                {{$cart->website}}
                              </li>
                            @endif
                            <li class="list-group-item  list-group-item-action">
                                <a class="btn btn-success p-2" href="{{'/report/allcustomersdata?customerId='.$cart->customerId}}" target="_blank"><i class="fa fa-bar-chart"></i> Customer Data Report</a>
                            </li>
                            
                        </ul>
                        @if ($cart->isManualCart==1)
                          <ul class="list-group ">
                              <li class="list-group-item  list-group-item-action">Patient : {{$cart->patientName}}</li>
                              <li class="list-group-item  list-group-item-action">Relationship :  {{$cart->takingForRelationship}}</li>
                              <li class="list-group-item  list-group-item-action">Cocial Media :  {{$cart->socialMedia}}</li>
                          </ul>
                        @endif
                    </td>

                    <td >

                        <table class="table table-hover  " style="width: 500px;">
                        
                            <thead >
                              <tr class="bg-secondary">
                                <th>Products</th>
                                <th>Qty</th>
                                <th>Total ({{ $cart->currency }})</th>
                              </tr>
                            </thead>
                            <tbody>

                                @foreach ($cartdetailsData->where('cartId', $cart->cartId) as $cartdetail)
                                    <tr>
                                        <td>
                                          {{$cartdetail->genericBrand.' '. '('.$cartdetail->genericName.' '. $cartdetail->genericStrength.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packType.' | '.$cartdetail->dosageForm.' | '.$cartdetail->genericCompany }}

                                            <a href="{{ route('productPricesForUsers.assign', [$cartdetail->customerId]) }}" target="_blank">Details</a>
                                            

                                        </td>
                                        <td>
                                            {{ $cartdetail->qty }}
                                        </td>
                                        <td>
                                            {!! $countryData->where('currency', $cart->currency )->pluck('hexcode')->first() !!}  {{ $cartdetail->subtotal *  $cart->usdToCurrencyRate}}
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                            <tfoot >
                              <tr>
                                <th>Sub Total</th>
                                <th>{{ $cart->totalQty }}</th>
                                <th>{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->subTotalAmount  }}</th>
                              </tr>
                              <tr>
                                <th>Discount</th>
                                <td></td>
                                <td>{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->discount }}</td>
                              </tr>
                              <tr>
                                <th>Tax</th>
                                <td></td>
                                <td>{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->tax }}</td>
                              </tr>
                              <tr>
                                <th>Shipping Cost</th>
                                <td></td>
                                <td >{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->shippingAmount}}</td>
                              </tr>

                              <tr>
                                <th>Transaction Fee</th>
                                <td></td>
                                <td >{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->transactionFeeAmount }} </td>
                              </tr>


                              <tr>
                                <th>Total</th>
                                <td></td>
                                <th >{!! $countryData->where('currency', $cart->currency)->pluck('hexcode')->first() !!}  {{ $cart->totalAmount}}  </th>
                              </tr>

                            </tfoot>


                        </table>
                    </td>

                    <td >
                          {{-- delivery details --}}
                          {{-- delivery details --}}
                                  <ul class="list-group" style="width: 300px;">
                                      {{-- <li class="list-group-item list-group-item-action">{{ $cart->email }}</li> --}}
                                      <li class="list-group-item list-group-item-action">{{ $cart->takingFor.' ('.$cart->takingForLocalLang.')' }}</li>
                                      <li class="list-group-item list-group-item-action">{{ $cart->streethouse }}</li>
                                      <li class="list-group-item list-group-item-action">{{ $cart->streethouseLocalLang }}</li>
                                      <li class="list-group-item list-group-item-action">{{ $countryData->where('countryId', $cart->countryId )->pluck('country')->first() }}</li>
                                      <li class="list-group-item list-group-item-action">{{ $cart->city.' ('.$cart->cityLocalLang.')' }}</li>
                                      <li class="list-group-item list-group-item-action">{{ 'Post Code : '.$cart->postalCode }}</li>
                                      <li class="list-group-item list-group-item-action">{{ $cart->phoneCode.$cart->phone.', '.$cart->phonenumber2 }}</li>
                                      <li class="list-group-item list-group-item-action">{{ 'Delivery Method : '.$deliverymethodsData->where('deliveryMethodId', $cart->deliveryMethodId )->pluck('deliveryMethod')->first() }}</li>
                                      <li class="list-group-item list-group-item-action">{{ 'Payment Method : '.$paymentmethodsData->where('paymentMethodId', $cart->paymentMethodId )->pluck('paymentMethod')->first() }}</li>
                                  </ul>
                          {{-- delivery details --}}
                          {{-- delivery details --}}
                      
                    </td>

                    <td>
                      <ul class="list-group " style="width: 300px;">
                          <li class="list-group-item  list-group-item-action"><strong>Delivery Comment :</strong> {{$cart->deliveryComment}}</li>
                          <li class="list-group-item  list-group-item-action"><strong>Payment Comment :</strong> {{$cart->paymentComment}}</li>
                      </ul>
                    </td>

                    <td>
                      <a class="btn btn-success p-2 mb-5" href="{{ route('documentUpdateForCartProducts',$cart->cartId ) }}" role="button">Prescription/Document add/update</a>
                      <table class="table table-hover  " style="width: 700px;">
                        
                        <thead >
                          <tr class="bg-secondary">
                            <th>Link</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($cartprescriptionsData->where('cartId', $cart->cartId) as $cartprescription)
                                <tr>
                                    <td>
                                        <a href="{{ url('/').$cartprescription->prescriptionPath }}" target="_blank">{{url('/').$cartprescription->prescriptionPath}}</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    </td>

                    
                    
                    <td>

                      <ul class="list-group">
                          @if ($cart->isCartApproved==2) 
                              <li class="list-group-item list-group-item-action list-group-item-success text-center font-weight-bold">Approved</li>
                          @elseif ($cart->isCartApproved==3)  
                              <li class="list-group-item list-group-item-action list-group-item-danger text-center font-weight-bold">Rejected</li>
                          @elseif ($cart->isCartApproved==1)  
                              <li class="list-group-item list-group-item-action list-group-item-warning text-center font-weight-bold">Pending</li>
                          @endif

                          @if ( $cart->isCartComplete!=1)
                            <li class="list-group-item ">
                              <table>
                                
                                <tbody>
                                  <tr>
                                    {{-- @if ($cartpaymentreceiptmessagesData->where('cartId', $cart->cartId)->count('cartId')>0) --}}
                                      <td >
                                          <a class="btn btn-success p-2" href="{{ route('cartApprovalApprove',$cart->cartId ) }}" role="button">Approve?</a>
                                      </td>
                                      <td>
                                        <a class="btn btn-danger p-2" href="{{ route('cartApprovalReject',$cart->cartId ) }}" role="button">Reject?</a>
                                      </td>
                                    
                                    {{-- @endif --}}
                                    <td>
                                      <a class="btn btn-danger p-2" href="{{ route('cartApprovalDelete',$cart->cartId ) }}" role="button">Delete?</a>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                          @endif

                          

                          
                      </ul>

                      <ul class="list-group">
                        
                        @if ($cart->isCartApproved==2)
                          

                          <li class="list-group-item list-group-item-action">

                            
                            @if ($cart->isCartApproved==2)
                                @if ($cart->isProformaInvoiceVisible==1)
                                  <a class="btn btn-success  p-2" href="{{ route('customerOrderProformaInvociePrint', ['en', Crypt::encrypt($cart->cartId)] ) }}" role="button" target="_blank"><i class="fa fa-file-pdf-o"></i>  Proforma Invoice</a>
                                  <a class="btn btn-success p-2" href="{{ route('proformaInvoiceHiding',$cart->cartId ) }}" role="button">Proforma Invoice Showing</a>
                                @else
                                  <a class="btn btn-danger p-2" href="{{ route('proformaInvoiceShowing',$cart->cartId ) }}" role="button">Proforma Invoice Hidden</a>
                                @endif
                            @endif

                          </li>
                        @endif
                        <li class="list-group-item list-group-item-action">Total Updated : {{ $cart->updateCount }}</li>
                        <li class="list-group-item list-group-item-action">Total Approved : {{ $cart->approveCount }}</li>
                        <li class="list-group-item list-group-item-action">Total Rejected : {{ $cart->rejectCount }}</li>
                      </ul>

                    </td>
                    <td > 
                      <table class="table table-bordered table-hover"  style="width: 500px;">
                        <tbody>
                            @foreach ($cartpaymentreceiptmessagesData->where('cartId', $cart->cartId)->sortByDesc('created_at') as $cartpaymentreceiptmessage)
                                <tr>
                                    <td>
                                        <ul class="list-group" style="width: 130px;">
                                            <li class="list-group-item">
                                                <i class="fa fa-user" aria-hidden="true"></i> 
                                                @if ($cartpaymentreceiptmessage->isCustomer==1)
                                                    {{ $cart->takingFor}} 
                                                @else
                                                    Admin
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
                                                {!! $cartpaymentreceiptmessage->reason !!}      
                                            </li>
                                            @if ($cartpaymentreceiptmessage->picPath)
                                                <li class="list-group-item">
                                                    {{-- <img class="lozad magnificPopup" data-src="/..{{ $cartpaymentreceiptmessage->picPath }}" data-mfp-src="/..{{ $cartpaymentreceiptmessage->picPath }}" style="border-radius: 0%; width: 200px; height: 200px;"> --}}

                                                    <a href="{{ asset($cartpaymentreceiptmessage->picPath) }}" target="_blank">{{ asset($cartpaymentreceiptmessage->picPath) }}</a>

                                                </li>
                                            @endif
                                        </ul>
        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
        
                    </table>
                    </td>
                    <td>
                        <ul class="list-group">
                            @if ($cart->isPaymentReceiptUploaded==1) 
                              <li class="list-group-item list-group-item-action list-group-item-warning text-center font-weight-bold">Payment checking</li>
                            @elseif ($cart->isPaymentConfirm==1) 
                              <li class="list-group-item list-group-item-action list-group-item-success text-center font-weight-bold">Confirmed</li>
                            @elseif ($cart->isPaymentConfirm==2) 
                              <li class="list-group-item list-group-item-action list-group-item-danger text-center font-weight-bold">Unconfirmed</li>
                            @endif

                            @if ($cart->isCartApproved==2  && $cart->isCartComplete!=1)
                              <li class="list-group-item ">
                                <table>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <a class="btn btn-danger p-2" href="{{ route('cartPaymentUnconfirm',$cart->cartId ) }}" role="button">Unconfirm?</a>
                                        </td>
                                        <td>
                                          <a class="btn btn-success p-2" href="{{ route('cartPaymentConfirm',$cart->cartId ) }}" role="button">Confirm?</a>
                                        </td>
                                      </tr>
                                    </tbody>
                                </table>
                            </li>
                            @endif
                            

                            

                            @if ($cart->paymentConfirmCompanyId!=null)
                              <li class="list-group-item ">
                                
                                @if ($cart->isInvoiceVisible==1)
                                  <a class="btn btn-success  p-2" href="{{ route('customerOrderInvociePrint', ['en', Crypt::encrypt($cart->cartId)]) }}" role="button" target="_blank"><i class="fa fa-file-pdf-o"></i>  Invoice</a>
                                  <a class="btn btn-success p-2" href="{{ route('invoiceHiding',$cart->cartId ) }}" role="button">Showing</a>
                                @else
                                  <a class="btn btn-danger p-2" href="{{ route('invoiceShowing',$cart->cartId ) }}" role="button">Hidden</a>
                                @endif
                              </li>

                              <li class="list-group-item ">
                                <a class="btn btn-success  p-2" href="{{ route('generateDuplicateInvoice', $cart->cartId) }}" role="button" target="_blank"><i class="fa fa-file-pdf-o"></i>  Generate/Update Duplicate Invoice</a>
                              </li>
                              @if ($cart->fakeTotalPrice!=null)
                                <li class="list-group-item ">
                                  
                                  @if ($cart->duplicateInvoiceCompanyId!=null )
                                      @if ($cart->isDuplicateInvoiceVisible==1)
                                        <a class="btn btn-success  p-2" href="{{ route('fakeInvociePrint', Crypt::encrypt($cart->cartId)) }}" role="button" target="_blank"><i class="fa fa-file-pdf-o"></i>  Duplicate Invoice</a>
                                        <a class="btn btn-success p-2" href="{{ route('duplicateInvoiceHiding',$cart->cartId ) }}" role="button">Showing</a>
                                      @else
                                        <a class="btn btn-danger p-2" href="{{ route('duplicateInvoiceShowing',$cart->cartId ) }}" role="button">Hidden</a>
                                      @endif
                                  @endif
                                  
                                </li>
                              @endif
                            @endif


                            

                        </ul>

                    </td>


                    <td>
                      <ul class="list-group">
                          @if ($cart->isTrackingAdded==1) 
                            <li class="list-group-item list-group-item-action list-group-item-success text-center font-weight-bold">Tracking Added</li>
                            <li class="list-group-item list-group-item-action ">
                              {{ $trackingData->where('cartId', $cart->cartId)->pluck('tracking')->first() }} <hr>
                              {{ $trackingData->where('cartId', $cart->cartId)->pluck('trackingCN')->first() }} <hr>
                              {{ $trackingData->where('cartId', $cart->cartId)->pluck('trackingRU')->first() }}<hr>
                              
                              {{-- @if ($trackingData->where('cartId', $cart->cartId)->pluck('picPath')->first())
                                <img class="lozad magnificPopup" data-src="{{ '/..'.$trackingData->where('cartId', $cart->cartId)->pluck('picPath')->first() }}" data-mfp-src="{{ '/..'.$trackingData->where('cartId', $cart->cartId)->pluck('picPath')->first() }}"  style="border-radius: 0%; width: 100px; height: 100px;"><hr>
                              @endif --}}

                              <ul class="list-group ">
                                  @foreach ($trackingpicturesData->where('trackingId', $trackingData->where('cartId', $cart->cartId)->pluck('trackingId')->first()) as $trackingpicture)
                                      <li class="list-group-item list-group-item-action">
                                          <a href="{{ asset($trackingpicture->picPath) }}" target="_blank">{{ asset($trackingpicture->picPath) }}</a>
                                      </li>
                                  @endforeach
                              </ul>

                              
                            </li>
                          @else
                            <li class="list-group-item list-group-item-action list-group-item-danger text-center font-weight-bold">Tracking Not Added</li>
                          @endif


                          @if ($cart->isCartApproved==2 && $cart->isPaymentConfirm==1 && $cart->isCartComplete!=1)

                            <li class="list-group-item ">
                                <table>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <a class="btn btn-danger p-2" href="{{ route('cartAddTrackingNumber',$cart->cartId ) }}" role="button">Add Tracking Info</a>
                                        </td>
                                      </tr>
                                    </tbody>
                                </table>
                            </li>
                          @endif

                      </ul>

                  </td>

                  

                  <td>
                      <ul class="list-group" style="min-width: 300px;">
                          @if (isset($cart->remindingAlarmDate))
                            <li class="list-group-item list-group-item-action">
                              Reminding Alarm Date : {{YmdTodmY($cart->remindingAlarmDate)}}
                            </li>
                          @endif
                          @if ($cart->isDeliveryConfirmed==1) 
                            <li class="list-group-item list-group-item-action list-group-item-success text-center font-weight-bold">Delivered</li>
                          @else
                            <li class="list-group-item list-group-item-action list-group-item-danger text-center font-weight-bold">Not Delivered</li>
                          @endif

                          @if ($cart->isCartApproved==2 && $cart->isPaymentConfirm==1  && $cart->isCartComplete!=1)
                              <li class="list-group-item ">
                                <table>
                                    <tbody>
                                      <tr>
                                        <td>
                                          <a class="btn btn-danger p-2" href="{{ route('cartDeliveryInfo',$cart->cartId ) }}" role="button">Add Delivery Info</a>
                                        </td>
                                        <td>
                                          {{-- <a class="btn btn-success p-2" href="{{ route('cartDeliveryConfirm',$cart->cartId ) }}" role="button">Make Delivery Complete</a> --}}
                                          <a class="btn btn-success p-2" role="button" href="#"   data-toggle="modal" data-target="#makeDeliveryConfirmationModal"  

                                              data-cartid='{{ $cart->cartId }}' 

                                              title="Make Delivery Complete">Make Delivery Complete</a>
                                        </td>
                                      </tr>
                                    </tbody>
                                </table>
                            </li>
                          @endif


                          

                      </ul>

                  </td>

                  <td>
                    <table class="table table-bordered table-hover" style="width: 600px;" >
                      <tbody>
      
                          
                          @foreach ($cartdeliveryinfoData->where('cartId', $cart->cartId)->sortByDesc('created_at') as $cartdeliveryinfo)
                              <tr>
                                  <td>
                                      <ul class="list-group" style="width: 130px;">
                                          <li class="list-group-item">
                                              <i class="fa fa-user" aria-hidden="true"></i> 
                                              @if ($cartdeliveryinfo->isCustomer==1)
                                                  {{ $cart->takingFor}} 
                                              @else
                                                  {{ $userData->where('id', $cartdeliveryinfo->userId)->pluck('name')->first() }}
                                              @endif
                                          </li>
                                          <li class="list-group-item">
                                              <i class="icon-clock" aria-hidden="true"></i> {{ YmdTodmYPmgiA($cartdeliveryinfo->created_at)}}
                                          </li>
                                          <li class="list-group-item">
                                              <i class="fa fa-calendar" aria-hidden="true"></i> {{ YmdTodmYPmdMy($cartdeliveryinfo->created_at)}}
                                          </li>
                                      </ul>
                                  </td>
                                  <td>
                                      <ul class="list-group">
                                          <li class="list-group-item">
                                              {{ $cartdeliveryinfo->message}}
                                              @if ($cartdeliveryinfo->isCustomer!=1)
                                                  <hr>   
                                                  {{ $cartdeliveryinfo->messageCN}}
                                                  <hr>   
                                                  {{ $cartdeliveryinfo->messageRU}}
                                              @endif
                                          </li>
                                          @if ($cartdeliveryinfo->picPath)
                                              <li class="list-group-item">
                                                  {{-- <img class="lozad magnificPopup" data-src="{{ asset('/..'.$cartdeliveryinfo->picPath) }}" data-mfp-src="{{ asset('/..'.$cartdeliveryinfo->picPath) }}" style="border-radius: 0%; width: 200px; height: 200px;"> --}}

                                                  <a href="{{ asset($cartdeliveryinfo->picPath) }}" target="_blank">{{ asset($cartdeliveryinfo->picPath) }}</a>

                                              </li>
                                          @endif
                                      </ul>
      
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
      
                    </table>
                  </td>

                  

                  <td >
                    <a class="btn btn-success p-2 mb-5" href="{{ route('batchupdateforcartproducts',$cart->cartId ) }}" role="button">Add/Update Batch</a>
                    <table class="table table-hover  " style="width: 700px;">
                      
                        <thead >
                          <tr class="bg-secondary">
                            <th>Products</th>
                            <th>Batch</th>
                            <th>Batch Image</th>
                            <th>Manufacture Date</th>
                            <th>Expire Date</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($cartdetailsData->where('cartId', $cart->cartId) as $cartdetail)
                                <tr>
                                    <td>
                                      {{$cartdetail->genericBrand.' '. '('.$cartdetail->genericName.' '. $cartdetail->genericStrength.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packType.' | '.$cartdetail->dosageForm.' | '.$cartdetail->genericCompany }}

                                        <a href="{{ route('productPricesForUsers.assign', [$cartdetail->customerId]) }}" target="_blank">Details</a>
                                    </td>
                                    <td>
                                      {{$cartdetail->batch}}
                                    </td>
                                    <td>
                                      @if ($cartdetail->batchPicPath!=null)
                                          {{-- <img class="lozad magnificPopup" data-src="{{ $cartdetail->batchPicPath }}" data-mfp-src="{{ $cartdetail->batchPicPath }}" style="border-radius: 0%; width: 100px; height: 100px;"> --}}
                                          <a href="{{ asset($cartdetail->batchPicPath) }}" target="_blank">{{ asset($cartdetail->batchPicPath) }}</a>

                                      @endif
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($cartdetail->manufactureDate)->format('d-m-Y') }}
                                    </td>
                                    <td>
                                        {{\Carbon\Carbon::parse($cartdetail->expireDate)->format('d-m-Y')}}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                  </td>
                  
                  </tr>

              @endforeach
             
             
          </tbody>
    </table>


    </div>
  </div>
</div>





{{-- delivery status dynamic update --}}

<script type="text/javascript">
 
  $(document).ready(function()
  {
      $('#cartApprovalUpdate1, #cartApprovalUpdate2').on('click', function(event) {

          var cartId = $(this).data("cartid");
          // var token = $(this).data("token");
          var token = $("meta[name='csrf-token']").attr("content");

          console.log(cartId);
          console.log(token);

          if ($('#cartId-'+cartId+' .cartApprovalUpdate').val()==='Approved')
          {

              $.ajax(
              {
                url: '/cartListAdminApprovalStatusUpdate/'+cartId,
                type: 'post',
                // dataType: "JSON",
                data: {
                  // "cartId": cartId
                  "_token": token,
                  "_method": 'post',
                },
                 beforeSend:function(){
                     return confirm("Are you sure?");
                  },
              })

                .done(function() {
                  console.log("success");
                  $("#cartId-"+cartId+" #cartApprovalUpdate1").removeClass("btn-success");
                  $("#cartId-"+cartId+" #cartApprovalUpdate1").addClass("btn-danger");
                  $("#cartId-"+cartId+" #cartApprovalUpdate1").val("Rejected");
                   $("#cartId-"+cartId+" #cartApprovalUpdate1").prop('id', 'cartApprovalUpdate2');
                 
                })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");

                });
            }
            else
            {
                $.ajax(
                {
                  url: '/cartListAdminApprovalStatusUpdate/'+cartId,
                  type: 'post',
                  // dataType: "JSON",
                  data: {
                    // "cartId": cartId
                    "_token": token,
                    "_method": 'post',
                  },
                  beforeSend:function(){
                     return confirm("Are you sure?");
                  },
                })
                  .done(function() {
                    console.log("success");
                    $("#cartId-"+cartId+" #cartApprovalUpdate2").removeClass("btn-danger");
                    $("#cartId-"+cartId+" #cartApprovalUpdate2").addClass("btn-success");
                    $("#cartId-"+cartId+" #cartApprovalUpdate2").val("Approved");
                     $("#cartId-"+cartId+" #cartApprovalUpdate2").prop('id', 'cartApprovalUpdate1');
                   
                  })
                  .fail(function() {
                    console.log("error");
                  })
                  .always(function() {
                    console.log("complete");
                   
                  });
            }
     
      });

      
  });
 
</script>





<!-- Make delivery complete modal -->
<!-- Make delivery complete modal -->
<div class="modal fade" id="makeDeliveryConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="makeDeliveryConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="makeDeliveryConfirmationModal">Make Delivery Complete</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('cartDeliveryConfirm') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}
                    <input type="number" name="cartId" id="cartId"  value="" hidden> 
                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label"> Delivery Date</label>
                                <div class="col-sm-8">
                                  <input  type="text" id="deliveryCompleteDate" name="deliveryCompleteDate" class="form-control"   data-date-format="dd-mm-yyyy"  >
                                </div>
                              </div>
                            </div>

                            

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label"> Special Note</label>
                                <div class="col-sm-8">
                                  {{-- <input type="text" class="form-control" id="specialNote" name="specialNote" value=""> --}}
                                  <textarea id="specialNote" name="specialNote"  class="form-control"      rows="5"  ></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label"> Reminding Alarm Date</label>
                                <div class="col-sm-8">
                                  <input  type="text" id="remindingAlarmDate" name="remindingAlarmDate" class="form-control"   data-date-format="dd-mm-yyyy"  >

                                  

                                </div>
                              </div>
                            </div>

                            <button data-toggle="modal"   type="submit"   class="btn btn-success mr-2 float-right">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>

                </form>
      </div>
    </div>
  </div>
</div>
<!-- Make delivery complete modal -->
<!-- Make delivery complete modal -->



<script type="text/javascript">
  $(function() {
     $( "#deliveryCompleteDate" ).datepicker(
         { 
           // maxDate:0,
           dateFormat: 'dd-mm-yy' 
       }
     );
     $( "#remindingAlarmDate" ).datepicker(
         { 
           // maxDate:0,
           dateFormat: 'dd-mm-yy' 
       }
     );
     
  });


</script>


<style>
  #ui-datepicker-div{
    top: 320px !important;
  }
</style>


<style>
  .table td, .table th {
      vertical-align: top;
  }
</style>

<style>
  .spacious-container {
      overflow: auto;
      width: 100%;
  }
</style>


@endsection