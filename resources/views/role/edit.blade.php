
@extends('layouts.app')

@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Roles')


@section('page_content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

  <style type="text/css" media="screen">
        .content-wrapper{
              padding: 0 40px;
        }
    
  </style>

  <style type="text/css" media="screen">
      fieldset{
       border:1px solid #cccc;
       padding: 8px;
    }
    </style>






<div class="content-wrapper " style="min-height: 0px;">

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

    
    <div class="card ">
            
        <div class="card-body">




            {{-- top side of the table --}}
            <h4 class="card-title" style="text-align: center;">Update A Role </h4>

            <form class="form-horizontal" method="post"  action="{{ route('role.updating', $roleData[0]->roleId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
              {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                    </p>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Role Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="role" name="role" value="{{ $roleData[0]->role }}">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Role Description</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="description" name="description" value="{{ $roleData[0]->description }}">
                          </div>
                        </div>
                      </div>

                    </div>



                    <fieldset  class=" mb-4 mt-4">
                                    <legend>Add Modules</legend>

                                      <div class="row ">


                                        <div class="col-md-6">
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

                                        <div class="col-md-6">
                                            {{-- role adding portion --}}
                                            <input type="button" class="btn btn-primary add-row  mb-5" value="Add Module" id="add_role">
                                        </div>



                                          
                                        
                                      </div>
                                      


                                      <table id="module_table" class="col-md-6 offset-md-1">
                                          <thead>
                                              <tr>
                                                  <th>Select</th>
                                                  <th class="text-center">Module</th>
                                              </tr>
                                          </thead>

                                          <tbody>

                                            {{-- existing records --}}
                                            @foreach (DB::table('rolemodules_view')->where('roleId', $roleData[0]->roleId)->orderBy('moduleId')->get() as $userroles)
                                                <tr >
                                                  <td><input type='checkbox' name='record'></td>

                                                  <td style= "{{ oneTo99Check($userroles->moduleId) ? 'padding-left: 30px;  ' : '' }}">
                                                    <input  class='form-control' type='number' name='moduleId[]'  value='{{ $userroles->moduleId}}'  readonly multiple hidden>
                                                    <input style= "{{ oneTo99Check($userroles->moduleId) ? '' : 'background: #038fcd; color: white; font-size: 16px; border: #038fcd; box-shadow: 5px 8px #038fcd30;' }}"
                                                     class='form-control' type='text'   value='{{ title_case($userroles->module)}}' readonly multiple >
                                                  </td>

                                                  {{--  background: #038fcd; color: white;  --}}

                                                </tr>
                                            @endforeach


                                              {{-- inputs will be loaded dynamically from user input --}}


                                          </tbody>

                                        

                                      </table>


                                    <div class="text-md-center text-sm-center mt-3">
                                      <button type="button" class="btn btn-danger delete-row " id="delete_item">Delete Module</button>
                                    </div>
                                    


                                  </fieldset>





                    <div class="text-center mt-4">
                      <button   type="submit"   class="btn btn-success mr-2">Update</button>
                      <a href="{{ route('role.index') }}">
                        <button type="button" class="btn btn-danger " >
                            Cancel
                        </button>
                      </a>
                      {{-- <button class="btn btn-light">Clear</button> --}}
                    </div>


              </form>

             
    
        </div>


        

    </div>

</div>




    




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
    
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
      @foreach (DB::table('rolemodules_view')->where('roleId', $roleData[0]->roleId)->get() as $userroles)
        moduleList.push({{ $userroles->moduleId}});
      @endforeach
      // alert(moduleList)
    };


    $(document).ready(function(){
        $(".add-row").click(function(){


            // getting role values
            var moduleId = $("#moduleId").val();
            var modules = $('select#moduleId').find(':selected').data('modules');
            // alert(moduleId);


            if (modules != null) 
            {          

                // checking if the module is already enlisted (part)    
                // alert(moduleList.includes(parseInt(moduleId))); 

                if (moduleList.includes(parseInt(moduleId)) ) 
                {
                    alert('Duplicate record!');
                    return false;
                } 
                else 
                {
                    moduleList.push(parseInt(moduleId)); // checking if the module is already enlisted (part)
                    // alert(moduleList);
                    // alert('ok');
                      // adding row
                
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
                    removeAllElements(moduleList, parseInt(moduleId));
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

