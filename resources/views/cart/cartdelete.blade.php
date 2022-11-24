
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Cart Delete')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script>	

<style type="text/css" media="screen">
  fieldset{
   border:1px solid #cccc;
   padding: 8px;
}
</style>

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
	<div class="card col-md-12">
		<div class="card-body">
		    <h4 class="card-title text-center"><span class="text-danger">Cart Delete</span></h4>

			<ul class="list-group">
                <li class="list-group-item list-group-item-action">Cart Id : <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"  target="_blank">{{ process_order_number($cartData->cartId, $cartData->created_at) }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Name : <a href="{{ route('customerProfileUpdate', $cartData->customerId)}}" target="_blank" >{{ $cartData->takingFor }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Email : {{ $userData->email }}</li>  
                <li class="list-group-item list-group-item-action">Customer Phone : {{ $cartData->phone }}</li>  
            </ul>

            <br> <br>

			<form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('cartApprovalDeleteUpdate', Request('cartId')) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
				{{method_field('put')}}
				{{ csrf_field() }}


			    {{-- cart reject reason start --}}
				{{-- cart reject reason start --}}


	                <div class="row ">

	                    <div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Reason</label>
	                        <div class="col-sm-8">
	                          <textarea id="reason" name="reason" rows="3" class="form-control" required></textarea>
	                        </div>
	                      </div>
	                    </div>

	                	
		                {{-- <div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Reason (CN)</label>
	                        <div class="col-sm-8">
	                          <textarea id="reasonCN" rows="3" class="form-control"></textarea>
	                        </div>
	                      </div>
	                    </div>

	                    <div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Reason (RU)</label>
	                        <div class="col-sm-8">
	                          <textarea id="reasonRU" rows="3" class="form-control"></textarea>
	                        </div>
	                      </div>
	                    </div> --}}
	                    
	                  
	                </div>

	     
				{{-- cart reject reason end --}}
				{{-- cart reject reason end --}}




				<div class="row offset-sm-5">
                    <button   type="submit"   class="btn btn-danger mr-2 ">Delete</button>

                    <a href="{{ route('cartListAdmin') }}"><button type="button" class="btn btn-success  mr-1" >Back</button></a>
                </div>

			</form>


		 </div>
	</div>
</div>

@endsection