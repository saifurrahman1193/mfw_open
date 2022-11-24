


@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Create User')

@section('page_content')
    {{-- <h1>add new user</h1>   --}}

    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


	{{-- add new user --}}
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



		{{-- add new user form --}}
		{{-- add new user form --}}

		<div class="card col-md-8">
		<div class="card-body">
        <h4 class="card-title" style="text-align: center;">Create New User</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">
	                {{-- <div class="panel-heading">Add New User</div> --}}

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="/superadmin/user"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>

			                           


			                            <div class="col-md-12">
			                                <div class="form-group row required">
			                                  <label class="col-sm-4 col-form-label control-label">Email</label>
			                                  <div class="col-sm-8">
			                                    <input type="text" class="form-control" id="email" name="email" required>
			                                  </div>
			                                </div>
			                            </div>


			                            <div class="col-md-12">
			                                <div class="form-group row required">
			                                  <label class="col-sm-4 col-form-label control-label">Password</label>
			                                  <div class="col-sm-8">
			                                    <input type="password" class="form-control" id="password" name="password" required>
			                                  </div>
			                                </div>
			                            </div>


			                            <fieldset  class=" mb-4">
			                              <legend>Add Roles</legend>

			                                <div class="row ">

			                                  <div class="col-md-12">
			                                    <div class="form-group row required">
			                                      <label class="col-sm-4 col-form-label control-label">Role</label>
			                                      <div class="col-sm-8">

			                                          <select class="form-control m-bot15" name="roleId" id="roleId"   >

			                                                  <option value="">--Select Role--</option>

			                                                  @foreach(DB::table('roles')->select('roleId', 'role', 'description')->get() as $role)
			                                                      <option value="{{ $role->roleId }}" 

			                                                        data-roleid="{{ $role->roleId }}"  
			                                                        data-roles="{{ title_case($role->role) }}"  
			                                                        data-description="{{ $role->description }}"  
			                                                        >
			                                                        {{ title_case($role->role ) }}
			                                                      </option> 
			                                                  @endforeach   

			                                          </select>

			                                      </div>

			                                    </div>
			                                  </div>

			                                    <div class="col-md-12">
			                                      <div class="form-group row ">
			                                        <label class="col-sm-4 col-form-label ">Role Description</label>
			                                        <div class="col-sm-8">
			                                          <input type="text" id="description" name="description" class="form-control" readonly >


			                                        </div>
			                                      </div>
			                                    </div>			                                    
			                                  
			                                </div>			                                

			                                {{-- role adding portion --}}
			                                <input type="button" class="btn btn-primary add-row offset-md-6 mb-5" value="Add Role" id="add_role">

			                                <table id="role_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Role</th>
			                                            <th class="text-center">Role Description</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>
			                                        {{-- inputs will be loaded dynamically from user input --}}
			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger delete-row mt-2" id="delete_item">Delete Role</button>
			                              


			                            </fieldset>



			                            <button data-toggle="modal" data-target="#userSaveConfirmationModal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>


			                            <a href="{{ route('user.index') }}"><button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button></a>
			                        </div>


			                </form>
	                </div>
	            </div>
	        </div>
	    </div>
	    </div>
	    </div>

	</div>
	{{-- end add new user  --}}







<script type="text/javascript">
    // dynamically employee data loading
  // $(document).ready(function(e) {
  //     $('select#hrId').change(function() {
  //         var hrId = $('select#hrId').find(':selected').data('hrid');
  //         var email = $('select#hrId').find(':selected').data('email');

  //         $('#hrId').val(hrId);
  //         $('#email').val(email);
  //     });
  // });


  // dynamically role data loading
  $(document).ready(function(e) {
      $('select#roleId').change(function() {
          var roleId = $('select#roleId').find(':selected').data('roleid');
          var roles = $('select#roleId').find(':selected').data('roles');
          var description = $('select#roleId').find(':selected').data('description');

          $('#roleId').val(roleId);
          $('#roles').val(roles);
          $('#description').val(description);
      });
  });


</script>





{{-- role adding, deleting code --}}

<script type="text/javascript">
    var roleList = [];   // checking if the role is already enlisted (part)

    $(document).ready(function(){
        $(".add-row").click(function(){

            // getting role values
            var roleId = $("#roleId").val();
            var description = $("#description").val();
            var roles = $('select#roleId').find(':selected').data('roles');


            if (roles != null) 
            {   

            	// checking if the module is already enlisted (part)      
	            if (roleList.includes(roleId) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {    
		             roleList.push(roleId); // checking if the module is already enlisted (part)
		            // alert(roleList);
	            	// alert('ok');    
	                // adding row
	                var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='number' name='roleId[]'  value='" +roleId + 
	                                                  "' readonly multiple hidden> <input  class='form-control' type='text' name='roles[]'  value='" +roles+ 
	                                                  "' readonly multiple > </td>"+ 
	                                                  "<td> <input  class='form-control' type='text' name='description[]' readonly value='"+description+"'></td>"
	                                                   +"</tr>";
	                $("table tbody").append(markup);


	                 // after add role clearing fieldset=======
	                 $('#roleId').val('');
	                 $('#description').val('');
	            }
            

            }
            else 
            {
                alert('Please select a role!');
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
                     // checking if the role is already enlisted 
                    var table = document.getElementById("role_table");
                    var roleId = $("input[name='roleId[]']").map(function(){return $(this).val();}).get();
                    var roleId = roleId[rowindex-1];
                    removeAllElements(roleList, roleId);
		            // alert(roleList);
                     // remove/delete/pop array element before delete the row 



                    // removing the checked row
                    $(this).parents("tr").remove();
                }
            });
        });
    });   

    // checking if the role is already enlisted (part)
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
{{-- select 2 script --}}
<script >
  $(document).ready(function() {
     // $('#hrId').select2({
     //    placeholder: {
     //      id: '', // the value of the option
     //      text: '--Select Employee--'
     //    },
     //    // placeholder : "--Select Employee--",
     //    allowClear: true,
     //    language: {
     //      noResults: function (params) {
     //        return "All employees are already user!";
     //      }
     //    },
     // });

     $('#roleId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Role--'
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