@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Cart Payment Confirm')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


<div class="content-wrapper" style="min-height: 0px;">

    <div class="card">
        <div class="card-title mt-4">
                <h4 class="text-center mt-2">Cart Payment Confirm</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item list-group-item-action">Cart Id : <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"  target="_blank">{{ process_order_number($cartData->cartId, $cartData->created_at) }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Name : <a href="{{ route('customerProfileUpdate', $cartData->customerId)}}" target="_blank" >{{ $cartData->takingFor }}</a></li>   
                <li class="list-group-item list-group-item-action">Customer Email : {{ $userData->email }}</li>  
                <li class="list-group-item list-group-item-action">Customer Phone : {{ $cartData->phone }}</li>  
            </ul>


            <br> <br> 
            
            <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('cartPaymentConfirmUpdate', Request('cartId')) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
                {{ csrf_field() }}

                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-2 col-form-label control-label">Invoice Company</label>
                            <div class="col-sm-10">
                                <select class="form-control m-bot15" id="paymentConfirmCompanyId" name="paymentConfirmCompanyId" required >
                                    <option value="">--Select Invoice Company--</option>

                                    @foreach($proformacompanyData as $proformacompany)
                                        <option value="{{ $proformacompany->proformaCompanyId }}" 
                                            {{$proformacompany->proformaCompanyId==$cartData->paymentConfirmCompanyId ? 'selected':''}}
                                            >
                                        {{ $proformacompany->company.' - '.
                                            $proformacompany->phone.' - '. 
                                            $proformacompany->email.' - '. 
                                            $proformacompany->web
                                        }} 
                                        {{'-'.($proformacompany->paymentAccDetailsIsVisible==1 ? 'Show' : 'Hidden').'(P.A.D.)'}}
                                        </option> 
                                    @endforeach   
                                </select>
                            </div>
                        </div>
                    </div>  
                    
                    
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label  for="text2"  class="col-sm-4 col-form-label control-label">Is Invoice Visible ?</label>
                            <div class="col-sm-8">
                                <div class="col-sm-6 d-inline">
                                    <input type="radio" name="isInvoiceVisible" value="1"  {{$cartData->isInvoiceVisible==1 ? 'checked':''}}> Visible
                                </div>
        
                                <div class="col-sm-6 d-inline">
                                    <input type="radio" name="isInvoiceVisible" value="0" {{$cartData->isInvoiceVisible==0 ? 'checked':''}}> Invisible
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row offset-sm-5">
                        <button   type="submit"   class="btn btn-success mr-2 ">Confirm</button>
                        <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"><button type="button" class="btn btn-danger  mr-1" >Back</button></a>
                    </div>

            </form>


        </div>
    </div>
    
</div>



@endsection