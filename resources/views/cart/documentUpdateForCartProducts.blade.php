@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Prescription/Document add/update')

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


            <div class="row">
                <div class="col col-md-6 "  >

                    <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                        <thead>
                            <th>Cart Detail Items</th>
                        </thead>
                        @foreach ($cartdetailsData as $cartdetail)
                            <tr>
                                <td>
                                    {{$cartdetail->genericBrand.' '. '('.$cartdetail->genericName.' '.$cartdetail->genericStrength.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packType.' | '. $cartdetail->dosageForm.', '.$cartdetail->genericCompany }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>


                <div class="col col-md-6 " >

                    <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                        <thead>
                            <th>Link</th>
                            <th>Delete</th>
                        </thead>
                        @foreach ($cartprescriptionsData as $cartprescription)
                            <tr>
                                <td>
                                    <a href="{{$cartprescription->prescriptionPath}}" target="_blank">{{url('/').$cartprescription->prescriptionPath}}</a>
                                </td>
                                <td>
                                    <a href="{{ route('documentUpdateForCartProductsDelete', $cartprescription->cartPrescriptionId) }}" class=" tooltipster" title="Delete selected file?" >
                                        <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>



            <form class="form-horizontal"  method="POST" enctype="multipart/form-data" action="{{ route('documentUpdateForCartProductsUpdate', $cartData->cartId) }}"  onsubmit="return confirm('Do you really want to proceed?');">

                {{ csrf_field() }}


                



                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-2 col-form-label control-label">Prescription/Document</label>
                            <div class="col-sm-10">
                                <select class="form-control m-bot15" name="prescriptionPath" id="prescriptionPath" required onchange="linkCaller()">
                                    <option value="">--Select Prescription/Document--</option>
                                    @foreach($usergenericinquiryData->sortBy('genericBrand')  as $usergenericinquiry)
                                        <option value="{{ $usergenericinquiry->prescriptionPath }}" >
                                            {{ $usergenericinquiry->genericBrand.' ('.$usergenericinquiry->genericName.' '.$usergenericinquiry->genericStrength.'), '.$usergenericinquiry->genericPackSize.'\'s '.$usergenericinquiry->packType.' | '. $usergenericinquiry->dosageForm.', '.$usergenericinquiry->genericCompany.' '.$usergenericinquiry->prescriptionPath}}
                                        </option> 
                                    @endforeach   
                                </select>
                            </div>
                        </div>
                    </div>
                    
                </div>
                


                <div class="col-md-12 text-center mt-4">
                    <input type="submit" class="btn btn-success mr-2"  value="Add">
                    <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"><button type="button" class="btn btn-danger  mr-1" >Back</button></a>
                </div>

            </form>            


        </div>
    </div>
</div>




{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
	$(document).ready(function() {
  
	   $('#prescriptionPath').select2({
		   // dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
		  placeholder: {
			id: '', // the value of the option
			text: '--Select Prescription/Document--'
		  },
		  // placeholder : "--Select Employee--",
		  allowClear: true,
		  language: {
			noResults: function (params) {
			  return "No Data Found!";
			}
		  },
	   });
	});
  </script>
  
  


<script>
    function linkCaller() {
        var prescriptionPath = document.getElementById("prescriptionPath").value;
        console.log('prescriptionPath = '+ prescriptionPath)
        window.open(prescriptionPath, '_blank').focus();
    }
</script>
@endsection