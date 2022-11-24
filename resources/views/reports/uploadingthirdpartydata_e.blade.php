

@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Edit third party data')

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
        <h4 class="card-title" style="text-align: center;">Update third party data</h4>



		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('uploadingthirdpartydata_e_update', request('thirdpartydataId') ) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                
			                {{method_field('put')}}
	                          {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>


			                        	<div class="row">
			                        		<div class="col-md-6">
												<div class="form-group row required">
													<label class="col-sm-4 col-form-label control-label">Purchasing Date</label>
													<div class="col-sm-8">
														<input  type="text" id="purchasingDate" name="purchasingDate" class="form-control"  value="{{ $thirdpartydata->purchasingDate == null ?  YmdTodmY(now()) : YmdTodmY($thirdpartydata->purchasingDate) }}"  data-date-format="dd-mm-yyyy"  required>
													</div>
												</div>
											</div>
											
				                            <div class="col-md-6">
												<div class="form-group row ">
													<label class="col-sm-4 col-form-label control-label">Purchasing amount</label>
													<div class="col-sm-8">
														<input type="number" class="form-control" id="purchaseAmount" name="purchaseAmount" value="{{$thirdpartydata->purchaseAmount}}">
													</div>
												</div>
				                            </div>
										</div>
										
										<div class="row">
			                        		<div class="col-md-6">
												<div class="form-group row required">
													<label class="col-sm-4 col-form-label control-label">Supplier</label>
													<div class="col-sm-8">
														<select class="form-control m-bot15" name="supplierId" id="supplierId" required >
															<option value="">--Select Supplier--</option>
															@foreach($supplierData as $supplier)
																<option value="{{ $supplier->supplierId }}" {{$thirdpartydata->supplierId == $supplier->supplierId ? 'selected' : '' }}>
																	{{ $supplier->supplier}}
																</option> 
															@endforeach   
														</select>
													</div>
												</div>
											</div>
											
				                            
				                        </div>


			                        	{{-- Cart start --}}
										{{-- Cart start --}}

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Cart</legend>

			                                <div class="row ">

			                                	<div class="col-md-12">
													<div class="form-group row ">
														<label class="col-sm-4 col-form-label control-label">Cart</label>
														<div class="col-sm-8">
															<select class="form-control m-bot15" name="cartId" id="cartId"  >
																<option value="">--Select Cart--</option>
																@foreach($cartData as $cart)
																	<option value="{{ $cart->cartId }}" data-cart="{{ process_order_number($cart->cartId, $cart->created_at) }}">
																		{{ process_order_number($cart->cartId, $cart->created_at).', '.$cart->takingFor.', '.$cart->email.($cart->isCreatedByAdmin==1 ? ', Created by Admin' : '').($cart->isDeleted==1 ? ', Deleted Account' : '') }}
																	</option> 
																@endforeach   
															</select>
														</div>
													</div>
					                            </div>

					                            

					                            
												
				                                <input type="button" class="btn btn-primary add-cart-row  mb-5 float-right" value="Add Cart" id="add-cart-row">
			                                  
			                                </div>
			                                


			                                <table id="cart_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Cart</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>

													@foreach ($thirdpartydata_cartsData as $thirdpartydata_carts)
			                                            <tr>
															<td><input type="checkbox" name="record"></td>
															<td>
																<input  class="form-control" type='number' name='cartId[]'  multiple hidden value="{{$thirdpartydata_carts->cartId}}" enctype="multipart/form-data">
																<input  class="form-control" type='text'   multiple value="{{ process_order_number($thirdpartydata_carts->cartId, $thirdpartydata_carts->cart_created_at).', '.$thirdpartydata_carts->takingFor.', '.$thirdpartydata_carts->email.($thirdpartydata_carts->isCreatedByAdmin==1 ? ', Created by Admin' : '').($thirdpartydata_carts->isDeleted==1 ? ', Deleted Account' : '')  }}"  enctype="multipart/form-data">
															</td>
			                                            </tr>
			                                        @endforeach




			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger cart_table_delete_row mt-2" id="delete_cart">Delete Cart</button>
			                              

			                            </fieldset>

										{{-- cart --}}
										{{-- cart --}}



										{{-- File start --}}
										{{-- File start --}}

			                            <fieldset  class=" mb-4 mt-5">
											<legend>Add File</legend>
											
												
											<h4 class="font-weight-light text-center text-lg-left mt-4 mb-0">Uploaded Files</h4>

											<hr class="mt-2 mb-5">

											<div class="row " id="file-delete">

												<table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
													<thead>
														<th>Link</th>
														<th>Delete</th>
													</thead>
													@foreach ($thirdpartydata_filesData as $thirdpartydata_file)
														<tr>
															<td>
																<a href="{{$thirdpartydata_file->filePath}}" target="_blank">{{url('/').$thirdpartydata_file->filePath}}</a>
															</td>
															<td>
																<a href="{{ route('uploadingthirdpartydata_delete_file', $thirdpartydata_file->thirdpartdata_filesId) }}" class=" tooltipster" title="Delete selected file?" >
																	<i class="fa fa-trash fa-lg " style="color : red;"></i>
																</a>
															</td>
														</tr>
													@endforeach
												</table>
											</div>

			                                {{-- <div class="row ">
				                                <div class="col-md-6">
													<input type="button" class="btn btn-primary add-file-row  mb-5 float-left" value="Add file" id="add-file-row">
												</div>
			                                </div> --}}
			                                


			                                {{-- <table id="file_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">File</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>

			                                    </tbody>

											</table> --}}
											
											<input id='filePath' class='form-control' type='file' data-show-upload='true' name='filePath[]'   data-show-caption='true'   multiple  >
											<div >
												<p style="margin:0px;font-size: 11px;"><strong>Note:</strong> </p>
												<p style="margin:0px;font-size: 11px;">1. Only pdf, jpeg, png, doc format can be uploaded.</p>
												<p style="margin:0px;font-size: 11px;">2. Maximum 8 files can be uploaded.</p>
												<p style="margin:0px;font-size: 11px;">3. Each file size limit 10mb.</p>
											</div>



			                              {{-- <button type="button" class="btn btn-danger delete-file-row mt-2" id="delete_cart">Delete File</button> --}}
			                              

			                            </fieldset>

										{{-- File --}}
										{{-- File --}}



			                            

			                            


			                            <a href="{{ route('uploadingthirdpartdataindex') }}"><button type="button" class="btn btn-danger float-right mr-1" >Cancel</button></a>

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








{{-- cart  adding, deleting code --}}

<script type="text/javascript">

    var cartList = [];   // checking if the module is already enlisted (part)
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
    //   @foreach ($cartData as $cartId)
    //     cartList.push( "{{ $cartId->cartId}}" );
    //   @endforeach
      // console.log(cartList)
    };
    

    $(document).ready(function(){
        $("#add-cart-row").on('click', function(){


            // getting cart values
            var cartId = $("#cartId").val();
            var cart =  $('select#cartId').find(':selected').data('cart');

            if ( cartId> 0) 
            {    
            	// checking if the module is already enlisted (part)      
	            if (cartList.includes(cartId) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {
		            cartList.push(cartId); // checking if the module is already enlisted (part)
		            // alert(cartList);
	            	// alert('ok');
	                // adding row

	                var markup = "<tr><td><input type='checkbox' name='record'></td> "+
									"<td> <input  class='form-control' type='number' name='cartId[]'  value='"+cartId+ "'  multiple hidden  enctype='multipart/form-data'>" +                                                                                  
									" <input  class='form-control' type='text'  value='"+cart+ "'  multiple  ></td>" +                                                                                  
									"</tr>";
	                $("#cart_table tbody").append(markup);


	                 // after add social media clearing fieldset=======
	                 $('#cartId').val('');
	            	
	            }
            

            }
            else 
            {
                alert('Please add a cart!');
                return false;
            }
        });


        
        // Find and remove selected table rows
        $(".cart_table_delete_row").click(function(){
            $("#cart_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("cart_table");
                    var cartId = $("input[name='cartId[]']").map(function(){return $(this).val();}).get();
                    var cartId = cartId[rowindex-1];
                    removeAllElements(cartList, cartId);
		            // alert(cartList);
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









<script type="text/javascript">
    $(function() {
       $( "#purchasingDate" ).datepicker(
           { 
             // maxDate:0,
             dateFormat: 'dd-mm-yy' 
         }
       );
       
       
    });
</script>




{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
	$(document).ready(function() {
  
	   $('#supplierId').select2({
		   // dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
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

	   $('#cartId').select2({
		   // dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
		  placeholder: {
			id: '', // the value of the option
			text: '--Select Cart--'
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
  
  

  
<script type="text/javascript">

    $(document).ready(function(){
        $(".add-file-row").click(function(){
			var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='file' name='filePath[]'   readonly multiple  enctype='multipart/form-data' > </td> " +"</tr>";

			$("#file_table tbody").append(markup);
        });

        // Find and remove selected table rows
        $(".delete-file-row").click(function(){
            $("#file_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("file_table");
                    var filePath = $("input[name='filePath[]']").map(function(){return $(this).val();}).get();
                    var filePath = filePath[rowindex-1];
		            // alert(pictureList);
                     // remove/delete/pop array element before delete the row 

                    // removing the checked row
                    $(this).parents("tr").remove();
                }
            });
        });
    });   

</script>



<script type="text/javascript">
	$(document).ready(function() {
		$("#filePath").fileinput({
			theme : 'fa',
			overwriteInitial:false,
			maxFileCount: 8,
			maxFileSize:1024*10,
			allowedFileExtensions: ["jpg","jpeg", "png", "pdf", "doc"],
		});        
	});
</script>

@endsection