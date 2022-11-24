
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Cart Payment Unconfirm')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


<div class="content-wrapper" style="min-height: 0px;">

    <div class="card">
        <div class="card-title mt-4">
                <h4 class="text-center mt-2">Cart Payment Unconfirm</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item list-group-item-action">Cart Id : <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"  target="_blank">{{ process_order_number($cartData->cartId, $cartData->created_at) }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Name : <a href="{{ route('customerProfileUpdate', $cartData->customerId)}}" target="_blank" >{{ $cartData->takingFor }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Email : {{ $userData->email }}</li>  
                <li class="list-group-item list-group-item-action">Customer Phone : {{ $cartData->phone }}</li>  
            </ul>

            <br> <br>  

            <h4 class="text-center mt-2">Previous Conversations</h4>
            <table class="table table-bordered table-hover" >
                <tbody>
                    @foreach ($cartpaymentreceiptmessagesData->sortByDesc('created_at') as $cartpaymentreceiptmessage)
                        <tr>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <i class="fa fa-user" aria-hidden="true"></i> 
                                        @if ($cartpaymentreceiptmessage->isCustomer==1)
                                            {{ $cartData->takingFor}} 
                                        @else
                                            {{ $usersData->where('id', $cartpaymentreceiptmessage->userId)->pluck('name')->first() }}
                                        @endif
                                    </li>
                                    <li class="list-group-item">
                                        <i class="icon-clock" aria-hidden="true"></i> {{ YmdTodmYPmgiA($cartpaymentreceiptmessage->created_at)}}
                                    </li>
                                    <li class="list-group-item">
                                        <i class="fa fa-calendar" aria-hidden="true"></i> {{ YmdTodmYPmdMy($cartpaymentreceiptmessage->created_at)}}
                                    </li>
                                </ul>
                            </td>
                            <td>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        {{ $cartpaymentreceiptmessage->reason}}
                                        @if ($cartpaymentreceiptmessage->isCustomer!=1)
                                            <hr>   
                                            {{ $cartpaymentreceiptmessage->reasonCN}}
                                            <hr>   
                                            {{ $cartpaymentreceiptmessage->reasonRU}}
                                        @endif
                                    </li>
                                    @if ($cartpaymentreceiptmessage->picPath)
                                        <li class="list-group-item">
                                            <a href="{{ asset($cartpaymentreceiptmessage->picPath) }}" target="_blank" >{{asset($cartpaymentreceiptmessage->picPath)}}</a>
                                        </li>
                                    @endif
                                </ul>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <br> <br> 
            
            <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('cartPaymentUnconfirmUpdate', Request('cartId')) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
                {{ csrf_field() }}

                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Default Message</label>
                            <div class="col-sm-8">
                                <select class="form-control m-bot15" id="defaultReasonId" name="defaultReasonId" required >
                                    <option value="">--Select Payment Unconfirm Default Messages--</option>
                                    @foreach($paymentreceiptdefaultmessagesData as $paymentreceiptdefaultmessage)
                                        <option value="{{ $paymentreceiptdefaultmessage->defaultReasonId }}"	
                                            data-defaultreasonid="{{ $paymentreceiptdefaultmessage->defaultReasonId }}"
                                            data-defaultreason="{{ $paymentreceiptdefaultmessage->defaultReason }}"
                                            data-defaultreasoncn="{{ $paymentreceiptdefaultmessage->defaultReasonCN }}"
                                            data-defaultreasonru="{{ $paymentreceiptdefaultmessage->defaultReasonRU }}"
                                        >
                                        {{ $paymentreceiptdefaultmessage->defaultReason}} 
                                        </option> 
                                    @endforeach   
                                </select>
                            </div>
                        </div>
                    </div>
                    
    
                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Message</label>
                            <div class="col-sm-8">
                                <textarea id="reason" name="reason"  rows="5" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>

    
    
                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Message (CN)</label>
                            <div class="col-sm-8">
                                <textarea id="reasonCN" name="reasonCN"  rows="5" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Message (RU)</label>
                            <div class="col-sm-8">
                                <textarea id="reasonRU" name="reasonRU"  rows="5" class="form-control" ></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row col-md-12">
                        <label for="picPath" class="col-md-4 col-form-label ">Photo</label>

                        <div class="col-md-8">
                            {{-- <input type="file" name="picPath" value="picPath" class="form-control" placeholder="picPath"   id="photoUploadInput"    style="margin-bottom: 10px; padding-bottom: 40px;" >
                              
                              <img id="photoUploadPreview"    style="max-width: 200px; max-height: 200px;" /> --}}
                              <input id="picPath" name="picPath[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true" >

                              <div >
                                <p style="margin:0px;font-size: 11px;"><strong>Note:</strong> </p>
                                <p style="margin:0px;font-size: 11px;">1. Only pdf, jpeg, png, doc format can be uploaded.</p>
                                <p style="margin:0px;font-size: 11px;">2. Maximum 8 files can be uploaded.</p>
                                <p style="margin:0px;font-size: 11px;">3. Each file size limit 10mb.</p>
                            </div>
                            
                        </div>
                    </div>


                    

                    <div class="row offset-sm-5">
                        <button   type="submit"   class="btn btn-success mr-2 ">Unconfirm</button>
                        <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"><button type="button" class="btn btn-danger  mr-1" >Back</button></a>
                    </div>


            </form>


        </div>
    </div>
    
</div>




  
<script type="text/javascript">
    $(document).ready(function() {
  
      $('select[name="defaultReasonId"]').on('change', function(){
          var defaultReasonId =  $('select#defaultReasonId').find(':selected').data('defaultReasonid');
          var defaultReason =  $('select#defaultReasonId').find(':selected').data('defaultreason');
          var defaultReasonCN =  $('select#defaultReasonId').find(':selected').data('defaultreasoncn');
          var defaultReasonRU =  $('select#defaultReasonId').find(':selected').data('defaultreasonru');

          $('#reason').text(defaultReason);
          $('#reasonCN').text(defaultReasonCN);
          $('#reasonRU').text(defaultReasonRU);
      });
  
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
  
  
    
  
  </script>
  

  



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


@endsection