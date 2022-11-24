@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Batch setup')

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
        <h4 class="card-title text-center pt-2">Batch Setup</h4>
        <div class="card-body">

            <ul class="list-group">
                <li class="list-group-item list-group-item-action">Cart Id : <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}">{{ process_order_number($cartData->cartId, $cartData->created_at) }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Name : <a href="{{ route('customerProfileUpdate', $cartData->customerId)}}" target="_blank" >{{ $cartData->takingFor }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Email : {{ $userData->email }}</li>  
                <li class="list-group-item list-group-item-action">Customer Phone : {{ $cartData->phone }}</li>  
            </ul>

            <br> <br> 



            <form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="{{ route('batchupdateforcartproductsUpdate', $cartData->cartId) }}"  onsubmit="return confirm('Do you really want to proceed?');">

                {{ csrf_field() }}

                <table  width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Product</th>
                            <th class="text-center">Batch</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Add/Update Image</th>
                            <th class="text-center">Manufacture Date</th>
                            <th class="text-center">Expire Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cartdetailsData as $cartdetail)
                            <tr>
                                <td>
                                    <input type="number" hidden id="cartDetailId" name="cartDetailId[]" value="{{$cartdetail->cartDetailId}}" class="form-control">
                                    {{$cartdetail->genericBrand.' '. '('.$cartdetail->genericName.' '. $cartdetail->genericStrength.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packType.' | '.$cartdetail->dosageForm.' | '.$cartdetail->genericCompany }}
                                </td>
                                
                                
                                <td>
                                    <input type="text"  id="batch" name="batch[]" value="{{$cartdetail->batch}}" class="form-control">
                                </td>
                                <td>
                                    @if ($cartdetail->batchPicPath!=null)
                                        <img class="lozad magnificPopup" data-src="{{ $cartdetail->batchPicPath }}" data-mfp-src="{{ $cartdetail->batchPicPath }}" style="border-radius: 0%; width: 100px; height: 100px;">
                                    @endif
                                </td>
                                <td>
                                    <input id="batchPicPath" name="batchPicPath[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true" >
                                    <div >
                                        <p style="margin:0px; font-size: 11px;"><strong>Note:</strong> </p>
                                        <p style="margin:0px; font-size: 11px;">1. Only  jpeg, png format can be uploaded.</p>
                                        <p style="margin:0px; font-size: 11px;">2. Maximum 1 files can be uploaded.</p>
                                        <p style="margin:0px; font-size: 11px;">3. File size limit 10mb.</p>
                                    </div>
                                </td>
                                <td>
                                    <input type="text"  id="manufactureDate-{{$cartdetail->genericPackSizeId}}" name="manufactureDate[]" value="{{$cartdetail->manufactureDate?\Carbon\Carbon::parse($cartdetail->manufactureDate)->format('d-m-Y'):null}}" class="form-control" data-date-format="dd-mm-yyyy" >
                                </td>
                                <td>
                                    <input type="text"  id="expireDate-{{$cartdetail->genericPackSizeId}}" name="expireDate[]" value="{{$cartdetail->expireDate?\Carbon\Carbon::parse($cartdetail->expireDate)->format('d-m-Y'):null}}" class="form-control" data-date-format="dd-mm-yyyy" >
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
        @foreach ($cartdetailsData as $cartdetail)
            $( "#manufactureDate-{{$cartdetail->genericPackSizeId}}" ).datepicker(
                { 
                    // maxDate:0,
                    dateFormat: 'dd-mm-yy' 
                }
            );
            $( "#expireDate-{{$cartdetail->genericPackSizeId}}" ).datepicker(
                { 
                    // maxDate:0,
                    dateFormat: 'dd-mm-yy' 
                }
            );
        @endforeach
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("#batchPicPath").fileinput({
            theme : 'fa',
            overwriteInitial:false,
            // uploadUrl: "/site/image-upload",
            allowedFileExtensions: ["jpeg", "png"],
            // maxImageWidth: 2000,                                                                                                                                                                        
            maxFileCount: 1,
			maxFileSize:1024*10,
            // resizeImage: true
        });        
    });
</script>

@endsection