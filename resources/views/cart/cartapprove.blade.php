
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Cart Approve')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


<div class="content-wrapper" style="min-height: 0px;">

    <div class="card">
        <div class="card-title mt-4">
                <h4 class="text-center mt-2">Cart Approval Type : <span class="text-success">Approve</span></h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item list-group-item-action">Cart Id : <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"  target="_blank">{{ process_order_number($cartData->cartId, $cartData->created_at) }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Name : <a href="{{ route('customerProfileUpdate', $cartData->customerId)}}" target="_blank" >{{ $cartData->takingFor }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Email : {{ $userData->email }}</li>  
                <li class="list-group-item list-group-item-action">Customer Phone : {{ $cartData->phone }}</li>  
              
            </ul>
            <ul class="list-group mt-2">
                <li class="list-group-item list-group-item-action">Payment Method : {{ $paymentmethodsData->where('paymentMethodId', $cartData->paymentMethodId)->pluck('paymentMethod')->first() }}</li>  
            </ul>


            <br> <br>  
            
            <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('cartApprovalApproveUpdate', Request('cartId')) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
                {{ csrf_field() }}
                <div class="row ">

                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Payment Method</label>
                            <div class="col-sm-8">
                                <select class="form-control m-bot15" id="paymentMethodId" name="paymentMethodId" required >
                                    
                                    <option value="">--Select Payment Method--</option>
                                    @foreach($paymentmethodsData as $paymentmethod)
                                        <option value="{{ $paymentmethod->paymentMethodId }}"	
                                            data-paymentMethodid="{{ $paymentmethod->paymentMethodId }}"
                                            data-paymentmethod="{{ $paymentmethod->paymentMethod }}"

                                            {{ isset($cartapprovesData) ? ( ($cartapprovesData->paymentMethodId == $paymentmethod->paymentMethodId) ? 'selected' : '') : ''}}
                                        >
                                        {{ $paymentmethod->paymentMethod}} 
                                        </option> 
                                    @endforeach   
                                </select>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="form-group row ">
                        <label class="col-sm-4 col-form-label control-label">Payment Account Details Title</label>
                        <div class="col-sm-8">
                            <select class="form-control m-bot15" id="paymentAccountDetailsId" name="paymentAccountDetailsId" required >
                                @if (isset($cartapprovesData) && $cartapprovesData->paymentAccountDetailsId)
                                    <option value="{{ isset($cartapprovesData) ? $cartapprovesData->paymentAccountDetailsId : ''}}" >{{$cartapprovesData->paymentAccountDetailsTitle}}</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    </div>
                    
                    
                    
                </div>
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-sm-4 col-form-label control-label">Payment Account Details (html)</label>
                            <div class="col-sm-8">
                                <textarea id="paymentAccountDetails" name="paymentAccountDetails"  rows="5" class="form-control" >{{isset($cartapprovesData->paymentAccountDetails)? $cartapprovesData->paymentAccountDetails : ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-sm-4 col-form-label control-label">Payment Account Details (CN) (html)</label>
                            <div class="col-sm-8">
                                <textarea id="paymentAccountDetailsCN" name="paymentAccountDetailsCN"  rows="5" class="form-control" >{{isset($cartapprovesData->paymentAccountDetailsCN)? $cartapprovesData->paymentAccountDetailsCN : ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    
                    
                    <textarea id="paymentAccountDetailsTitle" name="paymentAccountDetailsTitle"  rows="5" class="form-control" hidden>{{isset($cartapprovesData->paymentAccountDetailsTitle)?$cartapprovesData->paymentAccountDetailsTitle:''}}</textarea>
                    <input type="number" id="cartId" name="cartId" value="{{ Request('cartId') }}" hidden>

                </div> 

                <div class="row">
                    

                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-sm-4 col-form-label control-label">Payment Account Details (RU) (html)</label>
                            <div class="col-sm-8">
                                <textarea id="paymentAccountDetailsRU" name="paymentAccountDetailsRU"  rows="5" class="form-control" >{{isset($cartapprovesData->paymentAccountDetailsRU)? $cartapprovesData->paymentAccountDetailsRU : ''}}</textarea>
                            </div>
                        </div>
                    </div>
                    

                </div> 
    
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-sm-4 col-form-label control-label">Additional Payment Instruction (html)</label>
                            <div class="col-sm-8">
                                <textarea id="paymentAccountDetailsAdditional" name="paymentAccountDetailsAdditional"  rows="5" class="form-control" >{{isset($cartapprovesData)? $cartapprovesData->paymentAccountDetailsAdditional : ''}}</textarea>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-sm-4 col-form-label control-label">Additional Payment Instruction (CN) (html)</label>
                            <div class="col-sm-8">
                                <textarea id="paymentAccountDetailsAdditionalCN" name="paymentAccountDetailsAdditionalCN"  rows="5" class="form-control" >{{isset($cartapprovesData) ? $cartapprovesData->paymentAccountDetailsAdditionalCN : ''}}</textarea>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-sm-4 col-form-label control-label">Additional Payment Instruction (RU) (html)</label>
                            <div class="col-sm-8">
                                <textarea id="paymentAccountDetailsAdditionalRU" name="paymentAccountDetailsAdditionalRU"  rows="5" class="form-control" >{{isset($cartapprovesData) ? $cartapprovesData->paymentAccountDetailsAdditionalRU : ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    
                </div> 

                <div class="col-md-12">
                    <div class="form-group row required">
                        <label class="col-sm-2 col-form-label control-label">Proforma Invoice Company</label>
                        <div class="col-sm-10">
                            <select class="form-control m-bot15" id="proformaCompanyId" name="proformaCompanyId" required >
                                <option value="">--Select Proforma Invoice Company--</option>
                                @foreach($proformacompanyData as $proformacompany)
                                    <option value="{{ $proformacompany->proformaCompanyId }}" {{ isset($cartapprovesData) ? ($cartapprovesData->proformaCompanyId==$proformacompany->proformaCompanyId ? 'selected':''):''}}>
                                    {{ 
                                        $proformacompany->companyAlias.' - '.
                                        $proformacompany->company.' - '.
                                     $proformacompany->phone.' - '. 
                                     $proformacompany->email.' - '. 
                                     $proformacompany->web.' - '.
                                     ($proformacompany->paymentAccDetailsIsVisible ==1 ? 'show': 'hide')
                                     }} 
                                    </option> 
                                @endforeach   
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group row ">
                      <label  for="text2"  class="col-sm-4 col-form-label control-label">Is Proforma Invoice Visible?</label>
                      <div class="col-sm-8">
                          <div class="col-sm-6 d-inline">
                            <input type="radio" name="isProformaInvoiceVisible" value="1"  {{$cartData->isProformaInvoiceVisible==1? 'checked':''}}> Visible
                          </div>

                          <div class="col-sm-6 d-inline">
                              <input type="radio" name="isProformaInvoiceVisible" value="0"  {{$cartData->isProformaInvoiceVisible!=1? 'checked':''}}> Invisible
                          </div>

                      </div>

                    </div>
                </div>

                <div class="row offset-sm-5">
                    <button   type="submit"   class="btn btn-success mr-2 ">Save</button>
                    <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"><button type="button" class="btn btn-danger  mr-1" >Back</button></a>
                </div>


            </form>


        </div>
    </div>
    
</div>



<script type="text/javascript">
    $(document).ready(function() {
  
      $('select[name="paymentMethodId"]').on('change', function(){
        $('select[name="paymentAccountDetailsId"]').empty();
          var paymentMethodId = $(this).val();
          if(paymentMethodId) {
              $.ajax({
                  url: '/getpaymentaccountdetailstitlesagainstpaymentmethod/'+paymentMethodId,
                  type:"GET",
                  dataType:"json",
                  beforeSend: function(){
                      $('#loader').css("visibility", "visible");
                  },
  
                  success:function(data) {

  
                    $('select[name="paymentAccountDetailsId"]')
                          .append('<option value="">' + '--Select Payment Account Details Title--' + '</option>');
                      $(data).each(function(index, el) {

                        console.log(el.paymentAccountDetailsId)

                          

                          $('select[name="paymentAccountDetailsId"]')
                          .append('<option  value="'+el.paymentAccountDetailsId
                                +'"  data-paymentaccountdetailsid="'+el.paymentAccountDetailsId
                                +'" data-paymentaccountdetailstitle="'+el.paymentAccountDetailsTitle
                                +'"  data-paymentaccountdetails="'+el.paymentAccountDetails
                                +'"  data-paymentaccountdetailscn="'+el.paymentAccountDetailsCN
                                +'"  data-paymentaccountdetailsru="'+el.paymentAccountDetailsRU
                                +'"  >' 
                                + el.paymentAccountDetailsTitle + '</option>');
  
                      });
                  },
                  complete: function(){
                      $('#loader').css("visibility", "hidden");
                  }
              });
          } else {
              $('select[name="stateId"]').empty();
          }
  
      });
  
  });
  </script>



  
<script type="text/javascript">
    $(document).ready(function() {

  
      $('select[name="paymentAccountDetailsId"]').on('change', function(){
          var paymentAccountDetailsId =  $('select#paymentAccountDetailsId').find(':selected').data('paymentaccountdetailsid');
          var paymentAccountDetailsTitle =  $('select#paymentAccountDetailsId').find(':selected').data('paymentaccountdetailstitle');
          var paymentAccountDetails =  $('select#paymentAccountDetailsId').find(':selected').data('paymentaccountdetails');
          var paymentAccountDetailsCN =  $('select#paymentAccountDetailsId').find(':selected').data('paymentaccountdetailscn');
          var paymentAccountDetailsRU =  $('select#paymentAccountDetailsId').find(':selected').data('paymentaccountdetailsru');

          $('#paymentAccountDetailsTitle').text(paymentAccountDetailsTitle);
          $('#paymentAccountDetails').text(paymentAccountDetails);
          $('#paymentAccountDetailsCN').text(paymentAccountDetailsCN);
          $('#paymentAccountDetailsRU').text(paymentAccountDetailsRU);
      });
  
  });
  </script>
@endsection