
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Create Generic Pack Sizes')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


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
        <h4 class="card-title" style="text-align: center;">Create New Generic Brand Pack Size & Price</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">
	                {{-- <div class="panel-heading">Add New User</div> --}}

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('generic.pack.sizes.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>

			                        	<div class="row">

			                        		<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic</label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="genericId" id="genericId"  required>
				                                      <option value="">--Select Generic--</option>
				                                      @foreach($generic_Data->sortBy('genericName') as $generic)
				                                          <option value="{{ $generic->genericId }}"	
				                                          		data-genericid="{{ $generic->genericId }}"
				                                          		data-genericname="{{ $generic->genericName }}"
				                                          		data-avgpriceoforiginator="{{ $generic->avgPriceOfOriginator }}"
				                                          	>
				                                            {{ $generic->genericName}}
				                                          </option> 
				                                      @endforeach   
				                                  </select>
				                                </div>
				                              </div>
				                            </div>


				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic Brand</label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="genericBrandId" id="genericBrandId" data-genericcompany=""  data-dosageform=""  required>
				                                      <option value="">--Select Generic brand--</option>
				                                      
				                                  </select>
				                                </div>
				                              </div>
				                            </div>

			                        		
				                            
			                        	</div>

			                        	<div class="row">
			                        		<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Generic Company</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="genericCompany" readonly="" >
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic Strength </label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="genericStrengthId" id="genericStrengthId" required >
				                                      <option value="">--Select Generic Strength--</option>
				                                      @foreach($genericstrengthData->sortBy('genericStrength') as $genericstrength)
				                                          <option value="{{ $genericstrength->genericStrengthId }}">
				                                            {{ $genericstrength->genericStrength}}
				                                          </option> 
				                                      @endforeach   
				                                  </select>
				                                </div>
				                              </div>
				                            </div>
			                        		
			                        	</div>



			                            <div class="row">

			                            	{{-- <div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Dosage Form</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="dosageForm"  readonly="">
				                                </div>
				                              </div>
											</div> --}}
											
											<div class="col-md-6">
												<div class="form-group row required">
												  <label class="col-sm-4 col-form-label control-label">Dosage Form</label>
												  <div class="col-sm-8">
													<select class="form-control m-bot15" name="dosageFormId" id="dosageFormId" required >
														<option value="">--Select Dosage Form--</option>
														@foreach($dosageformData->sortBy('dosageForm') as $dosageform)
															<option value="{{ $dosageform->dosageFormId }}">
															  {{ $dosageform->dosageForm}}
															</option> 
														@endforeach   
													</select>
												  </div>
												</div>
											  </div>

			                            	

			                            	<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic Pack Size</label>
				                                <div class="col-sm-8">
				                                  <input type="number" class="form-control" id="genericPackSize" name="genericPackSize" required>
				                                </div>
				                              </div>
				                            </div>

				                            


			                            </div>


			                            <div class="row">

			                            	<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic Pack Type </label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="packTypeId" id="packTypeId" required >
				                                      <option value="">--Select Pack Type--</option>
				                                      @foreach($packTypesData as $packtype)
				                                          <option value="{{ $packtype->packTypeId }}">
				                                            {{ title_case($packtype->packType)}}
				                                          </option> 
				                                      @endforeach   
				                                  </select>
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Avg. price of originator</label>
				                                <div class="col-sm-8">
				                                  <input type="number" step="0.1" class="form-control" id="avgPriceOfOriginator" name="avgPriceOfOriginator" >
				                                </div>
				                              </div>
				                            </div>

			                            	


				                            
			                            </div>


			                            <div class="row">

			                            	<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Patient Selling Price</label>
				                                <div class="col-sm-8">
				                                  <input type="number" class="form-control" id="ptSellingPrice" name="ptSellingPrice" >
				                                </div>
				                              </div>
				                            </div>

			                            	<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Patient MOQ</label>
				                                <div class="col-sm-8">
				                                  <input type="number" class="form-control" id="ptMOQ" name="ptMOQ" >
				                                </div>
				                              </div>
				                            </div>

			                            	
			                            	

				                            
			                            </div>



			                            <div class="row">

			                            	<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Dealer Selling Price</label>
				                                <div class="col-sm-8">
				                                  <input type="number" class="form-control" id="dealerSellingPrice" name="dealerSellingPrice" >
				                                </div>
				                              </div>
				                            </div>

			                            	<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Dealer MOQ</label>
				                                <div class="col-sm-8">
				                                  <input type="number" class="form-control" id="dealerMOQ" name="dealerMOQ" >
				                                </div>
				                              </div>
				                            </div>

			                            	

				                            
			                            </div>


			                            <div class="row">

			                            	<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">VIP Selling Price</label>
				                                <div class="col-sm-8">
				                                  <input type="number" class="form-control" id="vipSellingPrice" name="vipSellingPrice" >
				                                </div>
				                              </div>
				                            </div>

			                            	<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Company Patient Selling Price</label>
				                                <div class="col-sm-8">
				                                  <input type="number" class="form-control" id="compPtSellingPrice" name="compPtSellingPrice" >
				                                </div>
				                              </div>
				                            </div>

			                            	
			                            	
			                            </div>


			                            <div class="row">

			                            	<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Company Patient Selling Price Old</label>
				                                <div class="col-sm-8">
				                                  <input type="number" class="form-control" id="compPtSellingPriceOld" name="compPtSellingPriceOld" >
				                                </div>
				                              </div>
				                            </div>

			                            	<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Company MRP (Local)</label>
				                                <div class="col-sm-8">
				                                  <input type="number" class="form-control" id="compLocalSellingPrice" name="compLocalSellingPrice" >
				                                </div>
				                              </div>
				                            </div>
			                            </div>

			                            <div class="row">
			                            	<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Availability</label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="availabilityTypeId" id="availabilityTypeId"  required>
				                                      <option value="">--Select Availability--</option>
				                                      @foreach($availabilitytypeData as $availabilitytype)
				                                          <option value="{{ $availabilitytype->availabilityTypeId }}"	
				                                          		data-availabilitytypeid="{{ $availabilitytype->availabilityTypeId }}"
				                                          		data-availabilitytype="{{ $availabilitytype->availabilityType }}"
				                                          	>
					                                            {{ $availabilitytype->availabilityType}}
				                                          </option> 
				                                      @endforeach   
				                                  </select>
				                                </div>
				                              </div>
				                            </div>

				                            


			                            </div>


			                            


			                            

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Global Market Prices</legend>

			                                <div class="row ">

			                                	<div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Site</label>
					                                <div class="col-sm-8">
					                                  <input type="text" class="form-control" id="site" name="site" >
					                                </div>
					                              </div>
					                            </div>

												<div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Golobal Market Price</label>
					                                <div class="col-sm-8">
					                                  <input type="number" class="form-control" id="price" name="price" >
					                                </div>
					                              </div>
					                            </div>
			                                  
			                                </div>
			                                

			                                {{-- role adding portion --}}
			                                <input type="button" class="btn btn-primary add-row  mb-5 float-right" value="Add Global Market Price" id="add_global_market_price">

			                                <table id="global_market_price_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Site</th>
			                                            <th class="text-center">Golobal Market Price</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>


			                                        {{-- inputs will be loaded dynamically from user input --}}


			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger delete-row mt-2" id="delete_item">Delete Golobal Market Price</button>
			                              


			                            </fieldset>







			                            {{-- supplier generic prices start --}}
										{{-- supplier generic prices start --}}

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Supplier Generic Prices</legend>

			                                <div class="row ">

			                                	<div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Supplier</label>
					                                <div class="col-sm-8">
					                                  <select class="form-control m-bot15" name="supplierId" id="supplierId"  >
					                                      <option value="">--Select Supplier--</option>
					                                      @foreach(DB::table('supplier')->select('supplierId', 'supplier')->get() as $supplier)
					                                          <option value="{{ $supplier->supplierId }}"	
					                                          		data-supplierid="{{ $supplier->supplierId }}"
					                                          		data-supplier="{{ $supplier->supplier }}"
					                                          	>
					                                            {{ $supplier->supplier}}
					                                          </option> 
					                                      @endforeach   
					                                  </select>
					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">MOQ</label>
					                                <div class="col-sm-8">
					                                  <input type="number" step="0.1" min="0" class="form-control" id="moq"  >
					                                </div>
					                              </div>
					                            </div>
			                                  

					                            
			                                  
			                                </div>

			                                <div class="row">
			                                	<div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Buying Price</label>
					                                <div class="col-sm-8">
					                                  <input type="number" step="0.1" min="0" class="form-control" id="buyingPrice" >
					                                </div>
					                              </div>
					                            </div>
											
			                                	<div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Date</label>
					                                <div class="col-sm-8">
														<input  type="text" id="buyingDate" name="buyingDate" class="form-control"   data-date-format="dd-mm-yyyy"  >
					                                </div>
					                              </div>
					                            </div>
											</div>
											
											<div class="row">
			                                	
											
			                                	<div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Note</label>
					                                <div class="col-sm-8">
														<textarea class="form-control "  rows="4" id="note" name="note"  ></textarea>
														
					                                </div>
					                              </div>
					                            </div>
			                                </div>
			                                

			                                <input type="button" class="btn btn-primary add-row-generic-price  mb-5 float-right" value="Add Generic Price" id="add_supplier_generic_price">

			                                <table id="generic_price_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Supplier</th>
			                                            <th class="text-center">MOQ</th>
			                                            <th class="text-center">Buying Price</th>
			                                            <th class="text-center">Date</th>
			                                            <th class="text-center">Note</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>




			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger generic_price_table_delete_row mt-2" id="delete_supplier_generic_price">Delete Generic Price</button>
			                              

			                            </fieldset>

										{{-- supplier generic prices end --}}
										{{-- supplier generic prices end --}}








										<div class="row offset-sm-5">
				                            <button   type="submit"   class="btn btn-success mr-2 ">Save</button>

				                            <a href="{{ route('genericBrandPriceListIndex') }}"><button type="button" class="btn btn-danger  mr-1" >Cancel</button></a>
			                            </div>


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

<script type="text/javascript">

    var globalMarketPriceList = [];   // checking if the module is already enlisted (part)
    

    $(document).ready(function(){
        $(".add-row").click(function(){

            // getting role values
            var site = $("#site").val();
            var price = $("#price").val();

            if (price > 0 && site.length>0) 
            {    
            	// checking if the module is already enlisted (part)      
	            if (globalMarketPriceList.includes(site) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {
		            globalMarketPriceList.push(site); // checking if the module is already enlisted (part)
		            // alert(globalMarketPriceList);
	            	// alert('ok');
	                // adding row

	                var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='text' name='site[]'  value='" +site + 
	                                                  "' readonly multiple > </td> <td> <input  class='form-control' type='number'  name='price[]' value='" +price+ 
	                                                  "' readonly multiple > "                                                  
	                                                   +"</td></tr>";
	                $("#global_market_price_table tbody").append(markup);


	                 // after add role clearing fieldset=======
	                 $('#site').val('');
	                 $('#price').val('');
	            	
	            }
            

            }
            else 
            {
                alert('Please add a site and price!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("#global_market_price_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("global_market_price_table");
                    var site = $("input[name='site[]']").map(function(){return $(this).val();}).get();
                    var site = site[rowindex-1];
                    removeAllElements(globalMarketPriceList, site);
		            // alert(globalMarketPriceList);
                     // remove/delete/pop array element before delete the row 

                    // removing the checked row
                    $(this).parents("tr").remove();
                }
            });




        });
    });   


    // checking if the module is already enlisted (part)
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



{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

  	$('#genericId').select2({
        placeholder: {
          id: '123', // the value of the option
          text: '--Select Generic--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true,
        language: {
          noResults: function (params) {
            return "No Data Found!";
          }
        },
     });

     $('#packTypeId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Pack Type--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true,
        language: {
          noResults: function (params) {
            return "No Data Found!";
          }
        },
     });


     $('#genericBrandId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Generic Brand--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true,
        language: {
          noResults: function (params) {
            return "No Data Found!";
          }
        },
     });


     $('#supplierId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Supplier--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true,
        language: {
          noResults: function (params) {
            return "No Data Found!";
          }
        },
     });

     $('#genericStrengthId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Generic Strength--'
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






{{-- dynamic dependent based on generic to generic brand --}}
<script type="text/javascript">
  $(document).ready(function() {

    $('select[name="genericId"]').on('change', function(){
        var genericId = $(this).val();
        console.log('generic id = '+ genericId);

        var avgpriceoforiginator =  $('select#genericId').find(':selected').data('avgpriceoforiginator');

        $("#avgPriceOfOriginator").val(avgpriceoforiginator);

        $("#genericCompany").val('');
        $("#dosageForm").val('');



        if(genericId) {
            $.ajax({
                // url: '/inventory/states/get/'+genericId,
                url: '/generics/genericPackSizes/genericPackSizesCreate/getGenericBrands/'+genericId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {
                	// console.log(response);
                	// console.log(response.data);
                	console.log(data);
                	console.log(data.data);
                	// var json_obj = $.parseJSON(data.object);//parse JSON


                	

                    $('select[name="genericBrandId"]').empty();

                	$(data.data).each(function(index, el) {
                		console.log(el.genericBrandId);
                		console.log(el.genericBrand);

            			console.log('genericBrandId = '+el.genericBrandId+ ' genericBrand = '+el.genericBrand+' genericCompany = '+el.genericCompany);

                        $('select[name="genericBrandId"]').append('<option value="">' + '--Select Generic Brand--' + '</option>');
                        $('select[name="genericBrandId"]').append('<option data-genericbrandid="'+el.genericBrandId+'" data-genericbrand="'+el.genericBrand+'"  data-genericcompany="'+el.genericCompany+'"  data-dosageform="'+el.dosageForm+'"   value="'+ el.genericBrandId +'">' + el.genericBrand + '</option>');
                	});

                   


                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="genericBrandId"]').empty();

            $("#genericCompany").val('');
	        $("#dosageForm").val('');
        }

    });

    $('select[name="genericBrandId"]').on('change', function(){
        var genericCompany =  $('select#genericBrandId').find(':selected').data('genericcompany');
        var dosageForm =  $('select#genericBrandId').find(':selected').data('dosageform');

        $("#genericCompany").val(genericCompany);
        $("#dosageForm").val(dosageForm);
	});


});


</script>








{{-- generic price adding, deleting code --}}

<script type="text/javascript">

    

    $(document).ready(function(){
        $(".add-row-generic-price").click(function(){

            // getting generic pack sizes and price and values values

            var moq = $("#moq").val();
            var buyingDate = $("#buyingDate").val();
            var note = $("#note").val();
            var buyingPrice = $("#buyingPrice").val();
            var supplierId = $('select#supplierId').find(':selected').data('supplierid');
            var supplier = $('select#supplierId').find(':selected').data('supplier');


            if ( supplierId>0 &&  moq>0 && buyingPrice>0) 
            {    
            	
                var markup = "<tr><td><input type='checkbox' name='record'></td>"

                                                  	+"<td> <input  class='form-control' type='number'   name='supplierId[]' value='" +supplierId+ "' readonly multiple hidden >  <input  class='form-control' type='text'    value='" +supplier+ "' readonly multiple  > </td>"

                                                  	+"<td> <input  class='form-control' type='number' step='0.1'  name='moq[]' value='" +moq+ "' readonly multiple > </td>"

                                                  	+"<td> <input  class='form-control' type='number' step='0.1'  name='buyingPrice[]' value='" +buyingPrice+ "' readonly multiple > </td>"

                                                  	+"<td> <input  class='form-control' type='text' name='buyingDate[]' value='" +buyingDate+ "' readonly multiple > </td>"
                                                  	+"<td> <textarea  class='form-control'   rows='4'   name='note[]'   multiple >"+note+" </textarea> </td>"
                                                  +"</tr>";
                $("#generic_price_table tbody").append(markup);


				// after add generic price clearing fieldset=======
				// $('select[name="genericId"]').reset();
				$('#moq').val('0');
				$('#buyingPrice').val('0');

            }
            else 
            {
                alert('Please add required fields!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".generic_price_table_delete_row").click(function(){
            $("#generic_price_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                    // removing the checked row
                    $(this).parents("tr").remove();
                }
            });


        });
    });   


</script>


{{-- autocomplete --}}
{{-- <script type="text/javascript">
	$(function(){
		var siteData = {!! ((DB::table('genpacksizeglobalmarketprices')->pluck('site'))->unique('site'))->sortBy('site') !!};

		$('#site').autocomplete({
			source : siteData
		});
	});
</script> --}}


<script type="text/javascript">
	$(function() {
	   
	   $( "#buyingDate" ).datepicker(
		   { 
			 // maxDate:0,
			 dateFormat: 'dd-mm-yy' 
		 }
	   );
	   
	});
  
  
  </script>

@endsection