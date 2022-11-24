
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Cart Reject')

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
		    <h4 class="card-title text-center">Cart Approval Type : <span class="text-danger">Reject</span></h4>

			<ul class="list-group">
                <li class="list-group-item list-group-item-action">Cart Id : <a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"  target="_blank" >{{ process_order_number($cartData->cartId, $cartData->created_at) }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Name : <a href="{{ route('customerProfileUpdate', $cartData->customerId)}}" target="_blank" >{{ $cartData->takingFor }}</a></li>  
                <li class="list-group-item list-group-item-action">Customer Email : {{ $userData->email }}</li>  
                <li class="list-group-item list-group-item-action">Customer Phone : {{ $cartData->phone }}</li>  
            </ul>

            <br> <br>

			<form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('cartApprovalRejectUpdate', Request('cartId')) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
				{{method_field('put')}}
				{{ csrf_field() }}


			    {{-- cart reject reason start --}}
				{{-- cart reject reason start --}}


	            <fieldset  class=" mb-4 mt-5">
	              <legend>Add Reasons</legend>

	                <div class="row ">

	                	<div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Reason</label>
	                        <div class="col-sm-8">
	                          <select class="form-control m-bot15" id="defaultReasonId"  >
	                              <option value="">--Select Default Reason--</option>
	                              @foreach($defaultreasonsData as $defaultreason)
	                                  <option value="{{ $defaultreason->defaultReasonId }}"	
	                                  		data-defaultreasonid="{{ $defaultreason->defaultReasonId }}"
	                                  		data-defaultreason="{{ $defaultreason->defaultReason }}"
	                                  		data-defaultreasoncn="{{ $defaultreason->defaultReasonCN }}"
	                                  		data-defaultreasonru="{{ $defaultreason->defaultReasonRU }}"
	                                  	>
	                                    {{ $defaultreason->defaultReason}}
	                                  </option> 
	                              @endforeach   
	                          </select>
	                        </div>
	                      </div>
	                    </div>



	                    <div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Default Reason(html)</label>
	                        <div class="col-sm-8">
	                          <textarea id="defaultReason" rows="3" class="form-control"></textarea>
	                        </div>
	                      </div>
	                    </div>

	                    
	                  
	                	
		                <div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Default Reason (CN)(html)</label>
	                        <div class="col-sm-8">
	                          <textarea id="defaultReasonCN" rows="3" class="form-control"></textarea>
	                        </div>
	                      </div>
	                    </div>

	                    <div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Default Reason (RU)(html)</label>
	                        <div class="col-sm-8">
	                          <textarea id="defaultReasonRU" rows="3" class="form-control"></textarea>
	                        </div>
	                      </div>
	                    </div>

	                    
	                  
	                </div>

	     
	                

	                <input type="button" class="btn btn-primary add-row-reason  mb-5 float-right" value="Add Reason" id="add_reason">

	                <table id="reason_table" width="100%">
	                    <thead>
	                        <tr>
	                            <th>Select</th>
	                            <th class="text-center">Reason</th>
	                            <th class="text-center">Reason (CN)</th>
	                            <th class="text-center">Reason (RU)</th>
	                        </tr>
	                    </thead>

	                    <tbody>

	                        @foreach ($cartarejectreasonsData as $cartarejectreason)
	                            <tr>
	                              <td><input type='checkbox' name='record'></td>
	                              <td>
	                              	<textarea  class='form-control' rows='3'    name='reason[]'   multiple  >{{ $cartarejectreason->reason }}</textarea>
	                              </td>

	                              <td>
	                              	<textarea  class='form-control' rows='3'    name='reasonCN[]'  multiple  >{{ $cartarejectreason->reasonCN }}</textarea>
	                              </td>

	                              <td>
	                              	<textarea  class='form-control' rows='3'    name='reasonRU[]'  multiple  >{{ $cartarejectreason->reasonRU }}</textarea>
	                              </td>
	                              
	                              
	                              
	                            </tr>
	                        @endforeach


	                    </tbody>

	                </table>


	              <button type="button" class="btn btn-danger reason_table_delete_row mt-2" id="reason_table_delete_row">Delete Reason</button>
	              

	            </fieldset>

				{{-- cart reject reason end --}}
				{{-- cart reject reason end --}}


				{{-- cart reject solution start --}}
				{{-- cart reject solution start --}}


	            <fieldset  class=" mb-4 mt-5">
	              <legend>Add Solutions</legend>

	                <div class="row ">

	                	<div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Solution</label>
	                        <div class="col-sm-8">
	                          <select class="form-control m-bot15" id="defaultSolutionId"  >
	                              <option value="">--Select Default Solution--</option>
	                              @foreach($defaultsolutionsData as $defaultsolution)
	                                  <option value="{{ $defaultsolution->defaultSolutionId }}"	
	                                  		data-defaultsolutionid="{{ $defaultsolution->defaultSolutionId }}"
	                                  		data-defaultsolution="{{ $defaultsolution->defaultSolution }}"
	                                  		data-defaultsolutioncn="{{ $defaultsolution->defaultSolutionCN }}"
	                                  		data-defaultsolutionru="{{ $defaultsolution->defaultSolutionRU }}"
	                                  	>
	                                    {{ substr($defaultsolution->defaultSolution, 0, 150)}}
	                                  </option> 
	                              @endforeach   
	                          </select>
	                        </div>
	                      </div>
	                    </div>



	                    <div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Default Solution(html)</label>
	                        <div class="col-sm-8">
	                          <textarea id="defaultSolution" rows="3" class="form-control"></textarea>
	                        </div>
	                      </div>
	                    </div>

	                    
	                  
	                	
		                <div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Default Solution (CN)(html)</label>
	                        <div class="col-sm-8">
	                          <textarea id="defaultSolutionCN" rows="3" class="form-control"></textarea>
	                        </div>
	                      </div>
	                    </div>

	                    <div class="col-md-12">
	                      <div class="form-group row required">
	                        <label class="col-sm-4 col-form-label control-label">Default Solution (RU)(html)</label>
	                        <div class="col-sm-8">
	                          <textarea id="defaultSolutionRU" rows="3" class="form-control"></textarea>
	                        </div>
	                      </div>
	                    </div>

	                    
	                  
	                </div>

	     
	                

	                <input type="button" class="btn btn-primary add-row-solution  mb-5 float-right" value="Add Solution" id="add_solution">

	                <table id="solution_table" width="100%">
	                    <thead>
	                        <tr>
	                            <th>Select</th>
	                            <th class="text-center">Solution</th>
	                            <th class="text-center">Solution (CN)</th>
	                            <th class="text-center">Solution (RU)</th>
	                        </tr>
	                    </thead>

	                    <tbody>

	                        @foreach ($cartarejectsolutionsData as $cartarejectsolution)
	                            <tr>
	                              <td><input type='checkbox' name='record'></td>
	                              <td>
	                              	<textarea  class='form-control' rows='3'    name='solution[]'   multiple  >{{ $cartarejectsolution->solution }}</textarea>
	                              </td>

	                              <td>
	                              	<textarea  class='form-control' rows='3'    name='solutionCN[]'  multiple  >{{ $cartarejectsolution->solutionCN }}</textarea>
	                              </td>

	                              <td>
	                              	<textarea  class='form-control' rows='3'    name='solutionRU[]'  multiple  >{{ $cartarejectsolution->solutionRU }}</textarea>
	                              </td>
	                              
	                              
	                              
	                            </tr>
	                        @endforeach


	                    </tbody>

	                </table>


	              <button type="button" class="btn btn-danger solution_table_delete_row mt-2" id="solution_table_delete_row">Delete Solution</button>
	              

	            </fieldset>

				{{-- cart reject solution end --}}
				{{-- cart reject solution end --}}


				<div class="row offset-sm-5">
                    <button   type="submit"   class="btn btn-success mr-2 ">Save</button>

					<a href="{{url('/').'/cart/cartListAdmin?cartId='.$cartData->cartId}}"><button type="button" class="btn btn-danger  mr-1" >Back</button></a>
                </div>

			</form>


		 </div>
	</div>
</div>



{{-- processing reasons --}}
{{-- processing reasons --}}
<script type="text/javascript">
	$(document).ready(function() {

		// loading default reasons to reasons fields
		$('select[id="defaultReasonId"]').on('change', function(){
	        var defaultReasonId = $(this).val();
	        var reason =  $('select#defaultReasonId').find(':selected').data('defaultreason');
	        var reasoncn =  $('select#defaultReasonId').find(':selected').data('defaultreasoncn');
	        var reasonru =  $('select#defaultReasonId').find(':selected').data('defaultreasonru');


	        $('#defaultReason').val(reason);
	        $('#defaultReasonCN').val(reasoncn);
	        $('#defaultReasonRU').val(reasonru);


	    });

	    // then change defaultReason,defaultReasonCN, defaultReasonRU
	    // then add to tabular list

	    $(".add-row-reason").click(function(){

	    	var reason =  $("#defaultReason").val();
	        var reasoncn =  $("#defaultReasonCN").val();
	        var reasonru =  $("#defaultReasonRU").val();



            if ( reason.length>0 ) 
            {    
            	
                var markup = "<tr><td><input type='checkbox' name='record'></td>"

                                                  	+"<td> <textarea  class='form-control' rows='3'    name='reason[]'   multiple  >"+reason+"</textarea>"
                                                  	+"<td> <textarea  class='form-control' rows='3'    name='reasonCN[]'  multiple  >"+reasoncn+"</textarea>"
                                                  	+"<td> <textarea  class='form-control' rows='3'    name='reasonRU[]'   multiple  >"+reasonru+"</textarea>"

                                                  	
                                                  +"</tr>";
                $("#reason_table tbody").append(markup);


				// after add generic price clearing fieldset=======
				$('select[id="defaultReasonId"]').val('');
				$('#defaultReason').val('');
				$('#defaultReasonCN').val('');
				$('#defaultReasonRU').val('');

            }
            else 
            {
                alert('Please add required fields!');
                return false;
            }

        });


        // Find and remove selected table rows
        $(".reason_table_delete_row").click(function(){
            $("#reason_table tbody").find('input[name="record"]').each(function(){

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







{{-- processing solutions --}}
{{-- processing solutions --}}
<script type="text/javascript">
	$(document).ready(function() {

		// loading default solutions to solutions fields
		$('select[id="defaultSolutionId"]').on('change', function(){
	        var genericId = $(this).val();
	        console.log('defaultSolutionId = '+ defaultSolutionId);

	        var solution =  $('select#defaultSolutionId').find(':selected').data('defaultsolution');
	        var solutioncn =  $('select#defaultSolutionId').find(':selected').data('defaultsolutioncn');
	        var solutionru =  $('select#defaultSolutionId').find(':selected').data('defaultsolutionru');

	        $('#defaultSolution').val(solution);
	        $('#defaultSolutionCN').val(solutioncn);
	        $('#defaultSolutionRU').val(solutionru);


	    });

	    // then change defaultSolution,defaultSolutionCN, defaultSolutionRU
	    // then add to tabular list

	    $(".add-row-solution").click(function(){

	    	var solution =  $("#defaultSolution").val();
	        var solutioncn =  $("#defaultSolutionCN").val();
	        var solutionru =  $("#defaultSolutionRU").val();



            if ( solution.length>0 ) 
            {    
            	
                var markup = "<tr><td><input type='checkbox' name='record'></td>"

                                                  	+"<td> <textarea  class='form-control' rows='3'    name='solution[]'   multiple  >"+solution+"</textarea>"
                                                  	+"<td> <textarea  class='form-control' rows='3'    name='solutionCN[]'  multiple  >"+solutioncn+"</textarea>"
                                                  	+"<td> <textarea  class='form-control' rows='3'    name='solutionRU[]'   multiple  >"+solutionru+"</textarea>"

                                                  	
                                                  +"</tr>";
                $("#solution_table tbody").append(markup);


				// after add generic price clearing fieldset=======
				$('select[id="defaultSolutionId"]').val('');
				$('#defaultSolution').val('');
				$('#defaultSolutionCN').val('');
				$('#defaultSolutionRU').val('');

            }
            else 
            {
                alert('Please add required fields!');
                return false;
            }

        });


        // Find and remove selected table rows
        $(".solution_table_delete_row").click(function(){
            $("#solution_table tbody").find('input[name="record"]').each(function(){

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

@endsection