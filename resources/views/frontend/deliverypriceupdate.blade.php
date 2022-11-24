<style type="text/css">
	.uploaded-pic{
		position: relative;
		display: inline-block;
	}

	.uploaded-pic:hover .pic-delete {
		display: block;
		color: red !important;
		
	}

	.pic-delete {
		padding-top: 7px;	
		padding-right: 15px !important;
		position: absolute;
		right: 0;
		top: 0;
		display: none;

	}

	.pic-delete a {
		color: red !important;
	}




</style>


@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Edit Delivery Prices')

@section('page_content')

{{-- <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}"> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>	
{{-- <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>	 --}}



<style type="text/css" media="screen">
  fieldset{
	   border:1px solid #cccc;
	   padding: 8px;
	}
</style>

	{{-- <div class="container"> --}}


		{{-- add new user form --}}
		{{-- add new user form --}}

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
        <h4 class="card-title" style="text-align: center;">Update Delivery Prices</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('deliveryPriceUpdate', $deliverypriceData->pluck('countryId')->first() ) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                
			                {{method_field('put')}}
	                          {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>


			                        	<div class="row">

			                        		<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Delivery Country</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control"   value="{{ $deliverypriceData->pluck('country')->first() }}" required>
				                                </div>
				                              </div>
				                            </div>

				                            

			                        		
			                        	</div>
			                        	




			                        	{{-- delivery method start --}}
										{{-- delivery method start --}}

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Delivery Prices</legend>

			                                <div class="row ">

			                                	<div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Delivery Method</label>
					                                <div class="col-sm-8">

					                                  <select class="form-control m-bot15" name="deliveryMethodId" id="deliveryMethodId"   >
						                                      <option value="">--Select Delivery Method--</option>
						                                      @foreach($deliverymethodData as $deliverymethod)
						                                          <option value="{{ $deliverymethod->deliveryMethodId }}" 

						                                            data-deliverymethodid="{{ $deliverymethod->deliveryMethodId }}"  
						                                            data-deliverymethod="{{ $deliverymethod->deliveryMethod }}"  
						                                            
						                                            >
						                                            {{ $deliverymethod->deliveryMethod }}
						                                          </option> 
						                                      @endforeach   
						                              </select>

					                                </div>
					                              </div>
					                            </div>

					                            <div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Delivery Price Initial</label>
					                                <div class="col-sm-8">
					                                  <input type="number" class="form-control" id="deliveryPriceInitial" name="deliveryPriceInitial"  step="0.001" >
					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Delivery Price Increment</label>
					                                <div class="col-sm-8">
					                                  <input type="number" class="form-control" id="deliveryPriceIncrement" name="deliveryPriceIncrement"  >
					                                </div>
					                              </div>
					                            </div>

					                            

					                            
												
				                               <div class="col-md-6">
				                               	 <input type="button" class="btn btn-primary add-deliveryprice-row  mb-5 float-right" value="Add Delivery Price" id="add-deliveryprice-row">
				                               </div>
			                                  
			                                </div>
			                                


			                                <table id="deliveryprice_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Delivery Method</th>
			                                            <th class="text-center">Delivery Price Initial</th>
			                                            <th class="text-center">Delivery Price Increment</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>

			                                    	 @foreach ($deliverypriceData->where('deliveryMethodId', '!=', null) as $deliveryprice)
			                                            <tr>
			                                              <td><input type="checkbox" name="record"></td>
			                                              <td>
	                                                  		<input  class="form-control" name="deliveryMethodId[]" type="number"  value="{{ $deliveryprice->deliveryMethodId }}"  multiple hidden>

	                                                  		<input  class="form-control"  type="text"  value="{{ $deliveryprice->deliveryMethod }}"  multiple >


			                                              </td>

			                                              <td>
		                                                  		<input  class="form-control"  name="deliveryPriceInitial[]" type="text"  value="{{ $deliveryprice->deliveryPriceInitial }}"  multiple >
			                                              </td>

			                                              <td>
		                                                  		<input  class="form-control"  name="deliveryPriceIncrement[]" type="text"  value="{{ $deliveryprice->deliveryPriceIncrement }}"  multiple >
			                                              </td>
			                                              
			                                            </tr>
			                                        @endforeach

			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger deliveryprice_table_delete_row mt-2" id="delete_delivery_price">Delete Delivery Price</button>
			                              

			                            </fieldset>

										{{-- delivery method --}}
										{{-- delivery method --}}



			                            

			                            


			                            <a href="{{ route('deliverysettings') }}"><button type="button" class="btn btn-danger float-right mr-1" >Cancel</button></a>

			                            <button   type="submit"   class="btn btn-success mr-2 float-right">Save</button>


			                        </div>


			                </form>
	                </div>
	            </div>
	        </div>
	    </div>
	    </div>
	    </div>
	    </div>

	{{-- </div> --}}
	{{-- end add new user  --}}








{{-- role adding, deleting code --}}








{{-- delivery methodadding, deleting code --}}

<script type="text/javascript">

    var deliveryPriceList = [];   // checking if the module is already enlisted (part)
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
        @foreach ($deliverypriceData as $deliveryprice) 
	          deliveryPriceList.push( "{{ $deliveryprice->deliveryMethodId}}" ); 
        @endforeach
      // console.log(deliveryPriceList)
    };
    

    $(document).ready(function(){
        $("#add-deliveryprice-row").on('click', function(){


            // getting delivery summary values
            var deliveryMethodId = $('select#deliveryMethodId').find(':selected').val();
            var deliveryMethod = $('select#deliveryMethodId').find(':selected').data('deliverymethod');

            console.log(deliveryMethod);

            var deliveryPriceInitial = $("#deliveryPriceInitial").val();
            var deliveryPriceIncrement = $("#deliveryPriceIncrement").val();
            
        


            if ( deliveryMethodId > 0 && deliveryPriceInitial>=0 && deliveryPriceIncrement>=0 ) 
            {    
            	// checking if the module is already enlisted (part)      
	            if (deliveryPriceList.includes(deliveryMethodId) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {
		            deliveryPriceList.push(deliveryMethodId); // checking if the module is already enlisted (part)
		            // alert(deliveryPriceList);
	            	// alert('ok');
	                // adding row

	                var markup = "<tr><td><input type='checkbox' name='record'></td> "+
	                                                  	"<td> <input  class='form-control' type='text' name='deliveryMethodId[]'  value='"+deliveryMethodId+ "'  multiple hidden> " +                                                                                  
	                                                   " <input  class='form-control' type='text'  value='"+deliveryMethod+ "'  multiple > </td>"+

	                                                   "<td> <input  class='form-control' type='number' step='0.01' name='deliveryPriceInitial[]'  value='"+deliveryPriceInitial+ "'  multiple > </td>"+

	                                                   "<td> <input  class='form-control' type='number' step='0.01' name='deliveryPriceIncrement[]'  value='"+deliveryPriceIncrement+ "'  multiple > </td>"+


	                                                   "</tr>";
	                $("#deliveryprice_table tbody").append(markup);


	                 // after add social media clearing fieldset=======
	                 $('#deliveryMethodId').val('');
	                 $('#deliveryPriceInitial').val('');
	                 $('#deliveryPriceIncrement').val('');
	            	
	            }
            

            }
            else 
            {
                alert('Please add a delivery method!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".deliveryprice_table_delete_row").click(function(){
            $("#deliveryprice_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("deliveryprice_table");
                    var deliveryMethodId = $("input[name='deliveryMethodId[]']").map(function(){return $(this).val();}).get();
                    var deliveryMethodId = deliveryMethodId[rowindex-1];
                    removeAllElements(deliveryPriceList, deliveryMethodId);
		            // alert(deliveryPriceList);
                     // remove/delete/pop array element before delete the row 

                    // removing the checked row
                    $(this).parents("tr").remove();
                }
            });


        });
    });   


    // checking if the (data ) is already enlisted (part)
    function removeAllElements(array, elem) 
    {  
	    var index = array.indexOf(elem);
	    while (index > -1) 
	    {
	        array.splice(index, 1);
	        index = array.indexOf(elem);
	    }
	}

</script>









@endsection