<!DOCTYPE html>


@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Edit Payment Method')

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
        <h4 class="card-title" style="text-align: center;">Update Payment Method</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('paymentMethodUpdate', $paymentmethodData->paymentMethodId) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                
			                {{method_field('put')}}
	                          {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>


			                        	<div class="row">

			                        		<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Payment Method</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="paymentMethod" name="paymentMethod" value="{{ $paymentmethodData->paymentMethod }}" required>
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Payment Method (CN)</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="paymentMethodCN" name="paymentMethodCN" value="{{ $paymentmethodData->paymentMethodCN }}" >
				                                </div>
				                              </div>
				                            </div>

				                        </div>

				                        <div class="row">

				                            <div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Payment Method (RU)</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="paymentMethodRU" name="paymentMethodRU" value="{{ $paymentmethodData->paymentMethodRU }}" >
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
											  <div class="form-group row ">
											    <label  for="text2"  class="col-sm-4 col-form-label control-label">Is Comment Applicable ?</label>
											    <div class="col-sm-8">
											    	<div class="col-sm-6 d-inline">
													  <input type="radio" name="isCommentApplicable" value="1" {{ ($paymentmethodData->isCommentApplicable==1) ? 'checked' : '' }}> Yes
											    	</div>

											    	<div class="col-sm-6 d-inline">
												    	<input type="radio" name="isCommentApplicable" value="0" {{ ($paymentmethodData->isCommentApplicable==0) ? 'checked' : '' }}> No
											    	</div>

											    </div>

				

											  </div>
											</div>

											<div class="col-md-6">
												<div class="form-group row ">
												  <label  for="text2"  class="col-sm-4 col-form-label control-label">Is Comment Required ?</label>
												  <div class="col-sm-8">
													  <div class="col-sm-6 d-inline">
														<input type="radio" name="isCommentRequired" value="1" {{ ($paymentmethodData->isCommentRequired==1) ? 'checked' : '' }}> Yes
													  </div>
  
													  <div class="col-sm-6 d-inline">
														  <input type="radio" name="isCommentRequired" value="0" {{ ($paymentmethodData->isCommentRequired==0) ? 'checked' : '' }}> No
													  </div>
												  </div>
												</div>
											</div>

			                        		
			                        	</div>


			                        	
			                        	




			                        	{{-- payment Instruction start --}}
										{{-- payment Instruction start --}}

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Payment Instruction</legend>

			                                <div class="row ">

			                                	<div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Payment Instruction (HTML)</label>
					                                <div class="col-sm-8">
													  <textarea name="paymentSummary" id="paymentSummary" class="form-control   tinymce-editor" rows="5"></textarea>
					                                </div>
					                              </div>
					                            </div>

					                            <div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Payment Instruction (CN) (HTML)</label>
					                                <div class="col-sm-8">
													  <textarea name="paymentSummaryCN" id="paymentSummaryCN" class="form-control   tinymce-editor" rows="5"></textarea>
					                                </div>
					                              </div>
					                            </div>

					                            <div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Payment Instruction (RU) (HTML)</label>
					                                <div class="col-sm-8">
													  <textarea name="paymentSummaryRU" id="paymentSummaryRU" class="form-control   tinymce-editor" rows="5"></textarea>
					                                </div>
					                              </div>
					                            </div>

					                            
												
				                                <input type="button" class="btn btn-primary add-paymentsummary-row  mb-5 float-right" value="Add Payment Instruction" id="add-paymentsummary-row"  style="max-height: 50px !important;">
			                                  
			                                </div>
			                                


			                                <table id="paymentsummary_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Payment Instruction</th>
			                                            <th class="text-center">Payment Instruction (CN)</th>
			                                            <th class="text-center">Payment Instruction (RU)</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>

			                                    	 @foreach ($paymentsummaryData as $paymentsummary)
			                                            <tr>
			                                              <td><input type="checkbox" name="record"></td>
			                                              <td>
	                                                  		<textarea  class="form-control" name="paymentSummary[]" type="text"   multiple  rows="5" >{!! $paymentsummary->paymentSummary !!} </textarea>
			                                              </td>

			                                              <td>
		                                                  		<textarea  class="form-control"  name="paymentSummaryCN[]" type="text"   multiple  rows="5" > {!! $paymentsummary->paymentSummaryCN !!}</textarea>
			                                              </td>

			                                              <td>
		                                                  		<textarea  class="form-control"  name="paymentSummaryRU[]" type="text"    multiple  rows="5" > {!! $paymentsummary->paymentSummaryRU !!}</textarea>
			                                              </td>
			                                              
			                                            </tr>
			                                        @endforeach




			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger paymentsummary_table_delete_row mt-2" id="delete_social_media">Delete Payment Instruction</button>
			                              

			                            </fieldset>

										{{-- payment Instruction --}}
										{{-- payment Instruction --}}



										{{-- payment account details start --}}
										{{-- payment account details start --}}

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Payment Account Details</legend>

											
			                                <div class="row ">

			                                	<div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Payment Account Title</label>
					                                <div class="col-sm-8">
					                                  <input type="text" class="form-control" id="paymentAccountDetailsTitle" name="paymentAccountDetailsTitle"  >
					                                </div>
					                              </div>
					                            </div>

					                            <div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Payment Account Details (html)</label>
					                                <div class="col-sm-8">
														<textarea name="paymentAccountDetails" id="paymentAccountDetails" class="form-control  tinymce-editor" rows="5"></textarea>
					                                </div>
					                              </div>
					                            </div>

					                            <div class="col-md-6">
													<div class="form-group row ">
														<label class="col-sm-4 col-form-label control-label">Payment Account Details (CN) (html)</label>
														<div class="col-sm-8">
															<textarea name="paymentAccountDetailsCN" id="paymentAccountDetailsCN" class="form-control  tinymce-editor" rows="5"></textarea>
														</div>
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group row ">
														<label class="col-sm-4 col-form-label control-label">Payment Account Details (RU) (html)</label>
														<div class="col-sm-8">
															<textarea name="paymentAccountDetailsRU" id="paymentAccountDetailsRU" class="form-control  tinymce-editor" rows="5"></textarea>
														</div>
													</div>
												</div>

					                            
												
				                                <input type="button" class="btn btn-primary add-paymentaccountdetails-row  mb-5 float-right" value="Add Payment Account Detail" id="add-paymentaccountdetails-row">
			                                  
			                                </div>
			                                


			                                <table id="paymentaccountdetails_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Picture</th>
			                                            <th class="text-center">Payment Account Detail Title</th>
			                                            <th class="text-center">Payment Account Detail (html)</th>
			                                            <th class="text-center">Payment Account Detail (CN) (html)</th>
			                                            <th class="text-center">Payment Account Detail (RU) (html)</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>

													@foreach ($paymentaccountdetailsData as $paymentaccountdetail)
														<tr>
															<td>
																<input type="checkbox" name="record">
																<input type="text" name="oldPicPath[]" value="{{$paymentaccountdetail->picPath}}" hidden readonly>
															</td>

															<td> 
																<input id="picPath" name="picPath[]" class='file' type="file"  multiple data-show-upload="true" data-show-caption="true" >
																
																@if ($paymentaccountdetail->picPath)
																			<img class="img-fluid img-thumbnail lozad" data-src="{{ asset($paymentaccountdetail->picPath) }}" data-mfp-src="{{ asset($paymentaccountdetail->picPath) }}" alt="" style="max-width: 100px; max-height: 200px;">
																			<a href="{{ route('paymentaccountdetailpicDelete', $paymentaccountdetail->paymentAccountDetailsId) }}" class=" tooltipster" title="Delete selected file?" >
																				<i class="fa fa-trash fa-lg " style="color : red;"></i>
																			</a>
																@endif
															</td>

															<td>
																<textarea name='paymentAccountDetailsTitle[]' id='paymentAccountDetailsTitle[]' class='form-control' rows='5' multiple>{!! $paymentaccountdetail->paymentAccountDetailsTitle !!}</textarea>
															</td>

															<td>
																	<textarea name='paymentAccountDetails[]' id='paymentAccountDetails[]' class='form-control' rows='5' multiple>{!! $paymentaccountdetail->paymentAccountDetails !!}</textarea>
															</td>

															<td>
																	<textarea name='paymentAccountDetailsCN[]' id='paymentAccountDetailsCN[]' class='form-control' rows='5' multiple>{!! $paymentaccountdetail->paymentAccountDetailsCN !!}</textarea>
															</td>

															<td>
																	<textarea name='paymentAccountDetailsRU[]' id='paymentAccountDetailsRU[]' class='form-control' rows='5' multiple>{!! $paymentaccountdetail->paymentAccountDetailsRU !!}</textarea>
															</td>
															
														</tr>
													@endforeach


			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger paymentaccountdetails_table_delete_row mt-2" id="delete_social_media">Delete Payment Account Detail</button>
			                              

			                            </fieldset>

										{{-- payment account details --}}
										{{-- payment account details --}}



			                            

			                            


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








{{-- payment Instruction  adding, deleting code --}}

<script type="text/javascript">

   
    

    $(document).ready(function(){
        $("#add-paymentsummary-row").on('click', function(){


            // getting payment Instruction values
            var paymentSummary = tinymce.get("paymentSummary").getContent();
            var paymentSummaryCN = tinymce.get("paymentSummaryCN").getContent();
            var paymentSummaryRU = tinymce.get("paymentSummaryRU").getContent();

			console.log('paymentSummary = '+ paymentSummary)

            if ( paymentSummary.length > 0) 
            {    
            	

	                var markup = "<tr><td><input type='checkbox' name='record'></td> "+
	                                                  	"<td> <textarea  class='form-control' type='text' name='paymentSummary[]'    multiple  rows='5'> "+paymentSummary+"</textarea></td>" +                                                                                  
	                                                   "<td> <textarea  class='form-control' type='text' name='paymentSummaryCN[]'    multiple rows='5' >"+paymentSummaryCN+"</textarea> </td>"+

	                                                   "<td> <textarea  class='form-control' type='text' name='paymentSummaryRU[]'    multiple rows='5' >"+paymentSummaryRU+"</textarea> </td>"+


	                                                   "</tr>";
	                $("#paymentsummary_table tbody").append(markup);


	                 // after add social media clearing fieldset=======
					tinymce.get("paymentSummary").setContent('');
					tinymce.get("paymentSummaryCN").setContent('');
					tinymce.get("paymentSummaryRU").setContent('');

            }
            else 
            {
                alert('Please add a payment Instruction!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".paymentsummary_table_delete_row").click(function(){
            $("#paymentsummary_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("paymentsummary_table");
                    var paymentSummary = $("input[name='paymentSummary[]']").map(function(){return $(this).val();}).get();
                    var paymentSummary = paymentSummary[rowindex-1];
                    // removeAllElements(paymentSummaryList, paymentSummary);
		            // alert(paymentSummaryList);
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








{{-- payment account details  adding, deleting code --}}

<script type="text/javascript">

    var paymentAccountDetailsList = [];   // checking if the module is already enlisted (part)
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
      @foreach ($paymentaccountdetailsData as $paymentaccountdetail)
        paymentAccountDetailsList.push( "{{ $paymentaccountdetail->paymentAccountDetailsTitle}}" );
      @endforeach
      // console.log(paymentAccountDetailsList)
    };
    

    $(document).ready(function(){
        $("#add-paymentaccountdetails-row").on('click', function(){


            // getting payment Instruction values
            var paymentAccountDetailsTitle = $("#paymentAccountDetailsTitle").val();
            var paymentAccountDetails = tinymce.get("paymentAccountDetails").getContent() ;
            var paymentAccountDetailsCN = tinymce.get("paymentAccountDetailsCN").getContent() ;
            var paymentAccountDetailsRU = tinymce.get("paymentAccountDetailsRU").getContent() ;

            if ( paymentAccountDetailsTitle.length > 0) 
            {    
            	// checking if the module is already enlisted (part)      
	            if (paymentAccountDetailsList.includes(paymentAccountDetailsTitle) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {
		            paymentAccountDetailsList.push(paymentAccountDetails); // checking if the module is already enlisted (part)
		            // alert(paymentAccountDetailsList);
	            	// alert('ok');
	                // adding row

	                var markup = "<tr><td><input type='checkbox' name='record'></td> "+
	                                                  	"<td> <input  id='picPath' name='picPath[]'  type='file' class='file' multiple data-show-upload='true' data-show-caption='true'   > <img   style='max-width: 200px; max-height: 200px;' /> </td>" +                                                                                  
														  "<td><textarea name='paymentAccountDetailsTitle[]' id='paymentAccountDetailsTitle[]' class='form-control' rows='5' multiple>"+paymentAccountDetailsTitle+"</textarea> </td>"  
														+                                                                                  
														  "<td><textarea name='paymentAccountDetails[]' id='paymentAccountDetails[]' class='form-control' rows='5' multiple>"+paymentAccountDetails+"</textarea> </td>" 
														  +                                                                                  
	                                                 
													   "<td><textarea name='paymentAccountDetailsCN[]' id='paymentAccountDetailsCN[]' class='form-control' rows='5' multiple>"+paymentAccountDetailsCN+"</textarea> </td>" 
													   
													   +

													   "<td><textarea name='paymentAccountDetailsRU[]' id='paymentAccountDetailsRU[]' class='form-control' rows='5' multiple>"+paymentAccountDetailsRU+"</textarea> </td>" 

	                                                   +

	                                                   "</tr>";
	                $("#paymentaccountdetails_table tbody").append(markup);


	                 // after add social media clearing fieldset=======
	                 $('#paymentAccountDetailsTitle').val('');
					tinymce.get("paymentAccountDetails").setContent('');
            		tinymce.get("paymentAccountDetailsCN").setContent('');
					tinymce.get("paymentAccountDetailsRU").setContent('');
	            	
	            }
            

            }
            else 
            {
                alert('Please add a payment account details!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".paymentaccountdetails_table_delete_row").click(function(){
            $("#paymentaccountdetails_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("paymentaccountdetails_table");
                    var paymentAccountDetails = $("input[name='paymentAccountDetails[]']").map(function(){return $(this).val();}).get();
                    var paymentAccountDetails = paymentAccountDetails[rowindex-1];
                    removeAllElements(paymentAccountDetailsList, paymentAccountDetails);
		            // alert(paymentAccountDetailsList);
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




{{-- magnific popup for image --}}
<script type="text/javascript">
  $(document).ready(function() {
    $('.lozad').magnificPopup({type:'image'});
  });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $("#picPath").fileinput({
            theme : 'fa',
            overwriteInitial:false,
            // uploadUrl: "/site/image-upload",
            allowedFileExtensions: ["jpg","jpeg", "png", "gif", "webp"],
            // maxImageWidth: 2000,                                                                                                                                                                        
            maxFileCount: 1,
            // resizeImage: true
        });        
    });
</script>


@endsection