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

@section('pageTitle', 'Edit Payment Methods Assignment')

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
        <h4 class="card-title" style="text-align: center;">Add/Remove Payment Methods</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('paymentPriceUpdate', $paymentpriceData->pluck('countryId')->first() ) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                
			                {{method_field('put')}}
	                          {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>


			                        	<div class="row">

			                        		<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label"> Country</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control"   value="{{ $paymentpriceData->pluck('country')->first() }}" readonly>
				                                </div>
				                              </div>
				                            </div>		                            

			                        		
			                        	</div>	 


			                        	{{-- payment method start --}}
										{{-- payment method start --}}

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Payment Methods</legend>

			                                <div class="row ">

			                                	<div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Payment Method</label>
					                                <div class="col-sm-8">

					                                  <select class="form-control m-bot15" name="paymentMethodId" id="paymentMethodId"   >
						                                      <option value="">--Select Payment Method--</option>
						                                      @foreach($paymentmethodData as $paymentmethod)
						                                          <option value="{{ $paymentmethod->paymentMethodId }}" 

						                                            data-paymentmethodid="{{ $paymentmethod->paymentMethodId }}"  
						                                            data-paymentmethod="{{ $paymentmethod->paymentMethod }}"  
						                                            
						                                            >
						                                            {{ $paymentmethod->paymentMethod }}
						                                          </option> 
						                                      @endforeach   
						                              </select>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-6">
												  <div class="form-group row required">
												    <label class="col-sm-4 col-form-label control-label">Transaction Fee (%)</label>
												    <div class="col-sm-8">
												      <input type="number" class="form-control" id="transactionFee"  step="0.01" value="0">
												    </div>
												  </div>
												</div>

											</div>

					                           

					                            

				                            <div class="row justify-content-center mb-5">
												
				                               	 <input type="button" class="btn btn-primary add-paymentprice-row text-center " value="Add Payment Price" id="add-paymentprice-row">
			                                  
			                                </div>
			                                


			                                <table id="paymentprice_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Payment Method</th>
			                                            <th class="text-center">Transaction Fee (%)</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>

			                                    	 @foreach ($paymentpriceData->where('paymentMethodId', '!=', null) as $paymentprice)
			                                            <tr>
			                                              <td><input type="checkbox" name="record"></td>
			                                              <td>
	                                                  		<input  class="form-control" name="paymentMethodId[]" type="number"  value="{{ $paymentprice->paymentMethodId }}"  multiple hidden>

	                                                  		<input  class="form-control"  type="text"  value="{{ $paymentprice->paymentMethod }}"  multiple >


			                                              </td>

			                                              <td>
			                                              		<input type="number" step="0.01" class="form-control"  name="transactionFee[]" value="{{ $paymentprice->transactionFee }}" >
			                                              </td>

			                                              
			                                              
			                                            </tr>
			                                        @endforeach


			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger paymentprice_table_delete_row mt-2" id="delete_payment_price">Delete Payment Method</button>
			                              

			                            </fieldset>

										{{-- payment method --}}
										{{-- payment method --}}



			                            

			                            


			                            <a href="{{ route('paymentsettings') }}"><button type="button" class="btn btn-danger float-right mr-1" >Cancel</button></a>

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








{{-- payment methodadding, deleting code --}}

<script type="text/javascript">

    var paymentPriceList = [];   // checking if the module is already enlisted (part)
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
        @foreach ($paymentpriceData as $paymentprice) 
	          paymentPriceList.push( "{{ $paymentprice->paymentMethodId}}" ); 
        @endforeach
      // console.log(paymentPriceList)
    };
    

    $(document).ready(function(){
        $("#add-paymentprice-row").on('click', function(){


            // getting payment summary values
            var paymentMethodId = $('select#paymentMethodId').find(':selected').val();
            var paymentMethod = $('select#paymentMethodId').find(':selected').data('paymentmethod');

            console.log(paymentMethod);

            var transactionFee = $("#transactionFee").val();
            
        


            if ( paymentMethodId > 0 && transactionFee>=0) 
            {    
            	// checking if the module is already enlisted (part)      
	            if (paymentPriceList.includes(paymentMethodId) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {
		            paymentPriceList.push(paymentMethodId); // checking if the module is already enlisted (part)
		            // alert(paymentPriceList);
	            	// alert('ok');
	                // adding row

	                var markup = "<tr><td><input type='checkbox' name='record'></td> "+
	                                                  	"<td> <input  class='form-control' type='text' name='paymentMethodId[]'  value='"+paymentMethodId+ "'  multiple hidden> " +                                                                                  
	                                                   " <input  class='form-control' type='text'  value='"+paymentMethod+ "'  multiple > </td>"+
	                                                   "<td> <input  class='form-control'  name='transactionFee[]'  type='number' step='0.01'  value='"+transactionFee+ "'  multiple > </td>"+

	                                                  


	                                                   "</tr>";
	                $("#paymentprice_table tbody").append(markup);


	                 // after add social media clearing fieldset=======
	                 $('#paymentMethodId').val('');
	                 $('#transactionFee').val(0);
	            	
	            }
            

            }
            else 
            {
                alert('Please add a payment method!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".paymentprice_table_delete_row").click(function(){
            $("#paymentprice_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("paymentprice_table");
                    var paymentMethodId = $("input[name='paymentMethodId[]']").map(function(){return $(this).val();}).get();
                    var paymentMethodId = paymentMethodId[rowindex-1];
                    removeAllElements(paymentPriceList, paymentMethodId);
		            // alert(paymentPriceList);
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