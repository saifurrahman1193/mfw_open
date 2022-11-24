


@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Create Role')

@section('page_content')
    {{-- <h1>add new user</h1>   --}}

    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


<style type="text/css" media="screen">
  fieldset{
   border:1px solid #cccc;
   padding: 8px;
}
</style>


	{{-- add new user --}}
	<div class="container">


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
		<div class="card col-md-8">
		<div class="card-body">
        <h4 class="card-title" style="text-align: center;">Create New Role</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">
	                {{-- <div class="panel-heading">Add New User</div> --}}

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="/superadmin/role"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>

			                            


			                            <div class="col-md-12">
			                              <div class="form-group row required">
			                                <label class="col-sm-4 col-form-label control-label">Role Name</label>
			                                <div class="col-sm-8">
			                                  <input type="text" class="form-control" id="role" name="role" required>
			                                </div>
			                              </div>
			                            </div>


			                            <div class="col-md-12">
			                                <div class="form-group row required">
			                                  <label class="col-sm-4 col-form-label control-label">Role Description</label>
			                                  <div class="col-sm-8">
			                                    <input type="text" class="form-control" id="description" name="description" required>
			                                  </div>
			                                </div>
			                            </div>


			                            <fieldset  class=" mb-4">
			                              <legend>Add Modules</legend>

			                                <div class="row ">


			                                  <div class="col-md-12">
			                                    <div class="form-group row required">
			                                      <label class="col-sm-4 col-form-label control-label">Module</label>
			                                      <div class="col-sm-8">

			                                          <select class="form-control m-bot15" name="moduleId" id="moduleId"   >

			                                                  <option value="">--Select Module--</option>


			                                                  @foreach(DB::table('modules')->select('moduleId', 'module')->get() as $module)
			                                                      <option value="{{ $module->moduleId }}" 

			                                                        data-moduleid="{{ $module->moduleId }}"  
			                                                        data-modules="{{ title_case($module->module) }}"  
			                                                        >
			                                                        {{ title_case($module->module ) }}
			                                                      </option> 
			                                                  @endforeach   


			                                          </select>


			                                      </div>



			                                    </div>
			                                  </div>



			                                    
			                                  
			                                </div>
			                                

			                                {{-- role adding portion --}}
			                                <input type="button" class="btn btn-primary add-row offset-md-6 mb-5" value="Add Module" id="add_role">

			                                <table id="module_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Module</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>


			                                        {{-- inputs will be loaded dynamically from user input --}}


			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger delete-row mt-2" id="delete_item">Delete Module</button>
			                              


			                            </fieldset>


			                            <a href="{{ route('role.index') }}"><button type="button" class="btn btn-danger float-right mr-1" >Cancel</button></a>

			                            <button data-toggle="modal" data-target="#userSaveConfirmationModal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>


			                        </div>


			                </form>
	                </div>
	            </div>
	        </div>
	    </div>
	    </div>
	    </div>
	    </div>

	</div>
	{{-- end add new user  --}}







<script type="text/javascript">



  // dynamically module data loading
  $(document).ready(function(e) {
      $('select#moduleId').change(function() {
          var moduleId = $('select#moduleId').find(':selected').data('moduleid');
          var modules = $('select#moduleId').find(':selected').data('modules');

          $('#moduleId').val(moduleId);
          $('#modules').val(modules);
      });
  });


</script>





{{-- role adding, deleting code --}}

<script type="text/javascript">

    var moduleList = [];   // checking if the module is already enlisted (part)
    

    $(document).ready(function(){
        $(".add-row").click(function(){

            // getting role values
            var moduleId = $("#moduleId").val();
            var modules = $('select#moduleId').find(':selected').data('modules');

            if (modules != null) 
            {    
            	// checking if the module is already enlisted (part)      
	            if (moduleList.includes(moduleId) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {
		            moduleList.push(moduleId); // checking if the module is already enlisted (part)
		            // alert(moduleList);
	            	// alert('ok');
	                // adding row

	                var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='number' name='moduleId[]'  value='" +moduleId + 
	                                                  "' readonly multiple hidden> <input  class='form-control' type='text'   value='" +modules+ 
	                                                  "' readonly multiple > "                                                  
	                                                   +"</tr>";
	                $("table tbody").append(markup);


	                 // after add role clearing fieldset=======
	                 $('#moduleId').val('');
	                 $('#modules').val('');
	            	
	            }
            

            }
            else 
            {
                alert('Please select a module!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("module_table");
                    var moduleId = $("input[name='moduleId[]']").map(function(){return $(this).val();}).get();
                    var moduleId = moduleId[rowindex-1];
                    removeAllElements(moduleList, moduleId);
		            // alert(moduleList);
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


     $('#moduleId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Module--'
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


@endsection