<!DOCTYPE html>


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

@section('pageTitle', 'Edit Delivery Method')

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
        <h4 class="card-title" style="text-align: center;">Update Delivery Method</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('deliveryMethodUpdate', $deliverymethodData->deliveryMethodId) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                
			                {{method_field('put')}}
	                          {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>


			                        	<div class="row">

			                        		<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Delivery Method</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="deliveryMethod" name="deliveryMethod" value="{{ $deliverymethodData->deliveryMethod }}" required>
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Delivery Method (CN)</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="deliveryMethodCN" name="deliveryMethodCN" value="{{ $deliverymethodData->deliveryMethodCN }}" >
				                                </div>
				                              </div>
				                            </div>

				                        </div>

				                        <div class="row">

				                            <div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Delivery Method (RU)</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="deliveryMethodRU" name="deliveryMethodRU" value="{{ $deliverymethodData->deliveryMethodRU }}" >
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
											  <div class="form-group row ">
											    <label  for="text2"  class="col-sm-4 col-form-label control-label">Is Comment Applicable ?</label>
											    <div class="col-sm-8">
											    	<div class="col-sm-6 d-inline">
													  <input type="radio" name="isCommentApplicable" value="1" {{ ($deliverymethodData->isCommentApplicable==1) ? 'checked' : '' }}> Yes
											    	</div>

											    	<div class="col-sm-6 d-inline">
												    	<input type="radio" name="isCommentApplicable" value="0" {{ ($deliverymethodData->isCommentApplicable==0) ? 'checked' : '' }}> No
											    	</div>

											    </div>

				

											  </div>
											</div>

			                        		
			                        	</div>
			                        	




			                        	{{-- delivery method start --}}
										{{-- delivery method start --}}

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Delivery Summary</legend>

			                                <div class="row ">

			                                	<div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Delivery Summary (HTML)</label>
					                                <div class="col-sm-8">
													  <textarea id="deliverySummary"  class="form-control  tinymce-editor"  rows="5" class="form-control" ></textarea>
					                                </div>
					                              </div>
					                            </div>

					                            <div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Delivery Summary (CN) (HTML)</label>
					                                <div class="col-sm-8">
													  <textarea id="deliverySummaryCN"  class="form-control  tinymce-editor"  rows="5" class="form-control" ></textarea>
					                                </div>
					                              </div>
					                            </div>

					                            <div class="col-md-6">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Delivery Summary (RU) (HTML)</label>
					                                <div class="col-sm-8">
													  <textarea id="deliverySummaryRU"  class="form-control  tinymce-editor"  rows="5" class="form-control" ></textarea>
					                                </div>
					                              </div>
					                            </div>

					                            
												
				                                <input type="button" class="btn btn-primary add-deliverysummary-row  mb-5 float-right" value="Add Delivery Summary" id="add-deliverysummary-row" style="max-height: 50px !important;">
			                                  
			                                </div>
			                                


			                                <table id="deliverysummary_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Delivery Summary</th>
			                                            <th class="text-center">Delivery Summary (CN)</th>
			                                            <th class="text-center">Delivery Summary (RU)</th>
			                                        </tr>
			                                    </thead>
			                                    <tbody>
													@foreach ($deliverysummaryData as $deliverysummary)
														<tr>
															<td><input type="checkbox" name="record"></td>
															<td>
																<textarea  name="deliverySummary[]"  rows="5" class="form-control" multiple>{{ $deliverysummary->deliverySummary }} </textarea>
															</td>
															<td>
																<textarea  name="deliverySummaryCN[]"  rows="5" class="form-control" multiple>{{ $deliverysummary->deliverySummaryCN }} </textarea>
															</td>
															<td>
																<textarea  name="deliverySummaryRU[]"  rows="5" class="form-control" multiple>{{ $deliverysummary->deliverySummaryRU }} </textarea>
															</td>
														</tr>
			                                        @endforeach
			                                    </tbody>
			                                </table>

			                              <button type="button" class="btn btn-danger deliverysummary_table_delete_row mt-2" id="delete_social_media">Delete Delivery Summary</button>

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

    var deliverySummaryList = [];   // checking if the module is already enlisted (part)
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
      @foreach ($deliverysummaryData as $deliverysummary)
        deliverySummaryList.push( "{{ $deliverysummary->deliverySummary}}" );
      @endforeach
      // console.log(deliverySummaryList)
    };
    

    $(document).ready(function(){
        $("#add-deliverysummary-row").on('click', function(){


            // getting delivery summary values
            var deliverySummary = tinymce.get("deliverySummary").getContent();
            var deliverySummaryCN = tinymce.get("deliverySummaryCN").getContent();
			var deliverySummaryRU = tinymce.get("deliverySummaryRU").getContent();
			
			console.log(deliverySummary)

            if ( deliverySummary.length > 0) 
            {    
            	// checking if the module is already enlisted (part)      
	            if (deliverySummaryList.includes(deliverySummary) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {
		            deliverySummaryList.push(deliverySummary); // checking if the module is already enlisted (part)
		            // alert(deliverySummaryList);
	            	// alert('ok');
	                // adding row

					var markup = "<tr><td><input type='checkbox' name='record'></td> "
									+
									"<td> <textarea  name='deliverySummary[]'  rows='5' class='form-control' multiple>"+deliverySummary+" </textarea> </td>" +                                                                                  
									"<td> <textarea  name='deliverySummaryCN[]'  rows='5' class='form-control' multiple>"+deliverySummaryCN+" </textarea> </td>"
									+
									"<td> <textarea  name='deliverySummaryRU[]'  rows='5' class='form-control' multiple>"+deliverySummaryRU+" </textarea> </td>"
									+
									"</tr>";
	                $("#deliverysummary_table tbody").append(markup);


	                 // after add social media clearing fieldset=======
					tinymce.get("deliverySummary").setContent('');
            		tinymce.get("deliverySummaryCN").setContent('');
					tinymce.get("deliverySummaryRU").setContent('');
	            }
            }
            else 
            {
                alert('Please add a delivery summary!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".deliverysummary_table_delete_row").click(function(){
            $("#deliverysummary_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("deliverysummary_table");
                    var deliverySummary = $("input[name='deliverySummary[]']").map(function(){return $(this).val();}).get();
                    var deliverySummary = deliverySummary[rowindex-1];
                    removeAllElements(deliverySummaryList, deliverySummary);
		            // alert(deliverySummaryList);
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