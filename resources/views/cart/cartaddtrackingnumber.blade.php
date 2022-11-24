
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Cart Add Tracking Info')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


<div class="content-wrapper" style="min-height: 0px;">

    <div class="card">
        <div class="card-title mt-4">
                <h4 class="text-center mt-2">Add Cart Tracking Info</h4>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item list-group-item-action">Cart Id : <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}">{{ process_order_number($cartData->cartId, $cartData->created_at) }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Name : {{ $cartData->takingFor }}</li>  
                <li class="list-group-item list-group-item-action">Customer Email : {{ $userData->email }}</li>  
                <li class="list-group-item list-group-item-action">Customer Phone : {{ $cartData->phone }}</li>  
            </ul>

            

            <br> <br> 
            
            <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('cartAddTrackingNumberUpdate', Request('cartId')) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
                {{ csrf_field() }}

    
                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Message</label>
                            <div class="col-sm-8">
                                <textarea id="tracking" name="tracking"  rows="5" class="form-control" >@isset($trackingData->tracking)   {{ $trackingData->tracking }}  @endisset</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Message (CN)</label>
                            <div class="col-sm-8">
                                <textarea id="trackingCN" name="trackingCN"  rows="5" class="form-control" >@isset($trackingData->tracking)   {{ $trackingData->trackingCN }}  @endisset</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Message (RU)</label>
                            <div class="col-sm-8">
                                <textarea id="trackingRU" name="trackingRU"  rows="5" class="form-control" >@isset($trackingData->tracking)   {{ $trackingData->trackingRU }}  @endisset</textarea>
                            </div>
                        </div>
                    </div>

                    


                    <div class="form-group row col-md-12">
                        <label for="picPath" class="col-md-4 col-form-label ">Photo</label>

                        <div class="col-md-8">
                                {{-- <input type="file" name="picPath" value="picPath" class="form-control" placeholder="picPath"   id="photoUploadInput"    style="margin-bottom: 10px; padding-bottom: 40px;" >
                              <img id="photoUploadPreview"    style="max-width: 200px; max-height: 200px;" src="/..{{ isset($trackingData->picPath)? $trackingData->picPath : ''}}" /> --}}
                                <div class="row">
                                    @isset($trackingpicturesData)
                                        <ul class="list-group ">
                                            @foreach ($trackingpicturesData as $trackingpicture)
                                                <li class="list-group-item list-group-item-action">
                                                    <a href="{{ asset($trackingpicture->picPath) }}" target="_blank">{{ asset($trackingpicture->picPath) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endisset
                                </div>
                              <input id="picPath" name="picPath[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true" >
                              <div >
                                <p style="margin:0px;font-size: 11px;"><strong>Note:</strong> </p>
                                <p style="margin:0px;font-size: 11px;">1. Only pdf, jpeg, png, doc format can be uploaded.</p>
                                <p style="margin:0px;font-size: 11px;">2. Maximum 8 files can be uploaded.</p>
                                <p style="margin:0px;font-size: 11px;">3. Each file size limit 10mb.</p>
                            </div>

                        </div>
                    </div>

                    {{-- {{dd($trackingData)}} --}}
                    <div class="form-group row col-md-12">
                        <label for="sendingDate" class="col-md-4 col-form-label ">Sending Date</label>
                        <div class="col-md-8">
                            {{-- <input type="date" name="sendingDate" value="sendingDate" class="form-control" placeholder="sendingDate"   id="sendingDate" > --}}
                            <input  type="text" id="sendingDate" name="sendingDate" class="form-control"  value="{{ ($trackingData==null)? \Carbon\Carbon::parse(now())->format('d-m-Y') :  \Carbon\Carbon::parse($trackingData->sendingDate)->format('d-m-Y') }}"  data-date-format="dd-mm-yyyy"  required>
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
    $(function() {
       $( "#sendingDate" ).datepicker(
           { 
             // maxDate:0,
             dateFormat: 'dd-mm-yy' 
         }
       );
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