@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Duplicate Invoice Settings')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 


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
        <h4 class="card-title text-center pt-2">Duplicate Invoice Setup</h4>
        <div class="card-body">

            <ul class="list-group">
                <li class="list-group-item list-group-item-action">Cart Id : <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"  target="_blank">{{ process_order_number($cartData->cartId, $cartData->created_at) }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Name : <a href="{{ route('customerProfileUpdate', $cartData->customerId)}}" target="_blank" >{{ $cartData->takingFor }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Email : {{ $userData->email }}</li>  
                <li class="list-group-item list-group-item-action">Customer Phone : {{ $cartData->phone }}</li>  
            </ul>

            <br> <br> 



            <form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="{{ route('generateDuplicateInvoiceUpdate', $cartData->cartId) }}"  onsubmit="return confirm('Do you really want to proceed?');">

                {{ csrf_field() }}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label class="col-md-4 col-form-label control-label"> Delivery Date</label>
                            <div class="col-md-8">
                                <input  type="text" id="duplicateInvoiceDate" name="duplicateInvoiceDate" class="form-control"   data-date-format="dd-mm-yyyy" required value="{{YmdTodmY($cartData->duplicateInvoiceDate)}}">
                            </div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="form-group row required">
                          <label class="col-sm-4 col-form-label control-label">Duplicate Invoice Company </label>
                          <div class="col-sm-8">
                            <select class="form-control m-bot15" name="duplicateInvoiceCompanyId" id="duplicateInvoiceCompanyId" required >
                                <option value="">--Select Company--</option>
                                @foreach($proformacompanyData as $proformacompany)
                                    <option value="{{ $proformacompany->proformaCompanyId }}" {{$cartData->duplicateInvoiceCompanyId==$proformacompany->proformaCompanyId ? 'selected': ''}}>
                                      {{ title_case($proformacompany->company)}}
                                    </option> 
                                @endforeach   
                            </select>
                          </div>
                        </div>
                    </div>
                </div>




                <table  width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Product</th>
                            <th class="text-center">Duplicate Product</th>
                            <th class="text-center">Real Price</th>
                            <th class="text-center">Duplicate Price</th>

                            <th class="text-center">Real Qty</th>
                            <th class="text-center">Duplicate Qty</th>

                            <th class="text-center">Amount</th>
                            <th class="text-center">Visible?</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cartdetailsData as $cartdetail)
                            <tr>
                                <td>
                                    <input type="number" hidden id="cartDetailId" name="cartDetailId[]" value="{{$cartdetail->cartDetailId}}" class="form-control">
                                    {{  $cartdetail->genericBrand.' ('.$cartdetail->genericStrength.$cartdetail->genericName.' ) '.$cartdetail->packType.' / '.' manufactured by '.$cartdetail->genericCompany }}
                                    
                                </td>

                                <td>
                                    <input type="text"  id="fakeProduct" name="fakeProduct[]" value="{{ $cartdetail->fakeProduct==null ?  $cartdetail->genericBrand.' ('.$cartdetail->genericStrength.$cartdetail->genericName.' ) '.$cartdetail->packType.' / '.' manufactured by '.$cartdetail->genericCompany : $cartdetail->fakeProduct }}" required class="form-control">
                                </td> 
                                
                                <td>
                                    <input type="number"  id="realPrice" name="realPrice[]" value="{{$cartdetail->cartsubtotalwithdiscount/$cartdetail->qty}}"  readonly class="form-control">
                                </td>          
                                <td>
                                    <input type="number"  id="fakePrice" name="fakePrice[]" value="{{$cartdetail->fakePrice==null ? $cartdetail->cartsubtotalwithdiscount/$cartdetail->qty : $cartdetail->fakePrice}}" required class="form-control">
                                </td>  

                                <td>
                                    <input type="number"  id="realQty" name="realQty[]" value="{{$cartdetail->qty}}"  readonly class="form-control">
                                </td> 

                                <td>
                                    <input type="number"  id="fakeQty" name="fakeQty[]" value="{{$cartdetail->fakeQty>0 ? $cartdetail->fakeQty : $cartdetail->qty }}"   class="form-control">
                                </td> 

                                <td>
                                    <input type="number"  id="fakeSubAmount" name="fakeSubAmount[]" value="{{$cartdetail->fakeSubAmount}}"  readonly class="form-control">
                                </td> 

                                <td>
                                    <select name="fakeProductVisible[]" class="form-control">
                                        <option value="1" {{$cartdetail->fakeProductVisible==1 ? "selected" : ""}}>Visible</option>
                                        <option value="0" {{$cartdetail->fakeProductVisible==0 ? "selected" : ""}}>Invisible</option>
                                    </select>
                                </td> 

                                
                                
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>


                <div class="col-md-12 text-center mt-4">
                    <input type="submit" class="btn btn-success mr-2"  value="Save">
                    <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"><button type="button" class="btn btn-danger  mr-1" >Back</button></a>

                </div>

            </form>    
            
            


        </div>
    </div>
</div>


<script type="text/javascript">
    $(function() {
       $( "#duplicateInvoiceDate" ).datepicker(
           { 
             // maxDate:0,
             dateFormat: 'dd-mm-yy' 
         }
       );
    });
  
  
  </script>

@endsection