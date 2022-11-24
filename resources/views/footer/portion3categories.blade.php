
@extends('layouts.app')

@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Footer Portion 3 Categories')


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
            <h4 class="card-title" style="text-align: center;">Update A Footer Portion 3 Categories </h4>

            <form class="form-horizontal" method="post"  action="{{ route('footer.portion3categoriesUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
              {{method_field('put')}}
              {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                    </p>
                    



                    <fieldset  class=" mb-4 mt-4">
                                    <legend>Add Category</legend>

                                      <div class="row ">


                                        <div class="col-md-6">
                                          <div class="form-group row required">
                                            <label class="col-sm-4 col-form-label control-label">Category</label>
                                            <div class="col-sm-8">

                                                <select class="form-control m-bot15" name="categoryId" id="categoryId"   >

                                                        <option value="">--Select Category--</option>


                                                        @foreach($categoryData as $category)
                                                            <option value="{{ $category->categoryId }}" 

                                                              data-categoryid="{{ $category->categoryId }}"  
                                                              data-category="{{ $category->category }}"  
                                                              >
                                                              {{ title_case($category->category ) }}
                                                            </option> 
                                                        @endforeach   


                                                </select>


                                            </div>



                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                            {{-- role adding portion --}}
                                            <input type="button" class="btn btn-primary add-row  mb-5" value="Add Category" id="add_category">
                                        </div>



                                          
                                        
                                      </div>
                                      


                                      <table id="page_table" class="col-md-6 offset-md-1">
                                          <thead>
                                              <tr>
                                                  <th>Select</th>
                                                  <th class="text-center">Category</th>
                                              </tr>
                                          </thead>

                                          <tbody>

                                            {{-- existing records --}}
                                            @foreach ($footerportion3categoriesData as $footerportion3category)
                                                <tr>
                                                  <td><input type='checkbox' name='record'></td>
                                                  <td>
                                                    <input  class='form-control' type='number' name='categoryId[]'  value='{{ $footerportion3category->categoryId}}'  readonly multiple hidden>
                                                    <input  class='form-control' type='text'   value='{{ title_case($footerportion3category->category)}}' readonly multiple >

                                                  </td>
                                                  
                                                  
                                                </tr>
                                            @endforeach


                                              {{-- inputs will be loaded dynamically from user input --}}


                                          </tbody>

                                        

                                      </table>


                                    <div class="text-md-center text-sm-center mt-3">
                                      <button type="button" class="btn btn-danger delete-row " id="delete_item">Delete Category</button>
                                    </div>
                                    


                                  </fieldset>





                    <div class="text-center mt-4">
                      <button   type="submit"   class="btn btn-success mr-2">Update</button>
                     
                      {{-- <button class="btn btn-light">Clear</button> --}}
                    </div>


              </form>

             
    
        </div>


        

    </div>

</div>




    




<script type="text/javascript">



  // dynamically module data loading
  $(document).ready(function(e) {
      $('select#categoryId').change(function() {
          var categoryId = $('select#categoryId').find(':selected').data('categoryid');
          var category = $('select#categoryId').find(':selected').data('category');

          $('#categoryId').val(categoryId);
      });
  });


</script>





{{-- role adding, deleting code --}}

<script type="text/javascript">

    var categoriesList = [];   // checking if the module is already enlisted (part)
    
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
      @foreach ($footerportion3categoriesData as $footerportion3category)
        categoriesList.push({{ $footerportion3category->categoryId}});
      @endforeach
      // alert(categoriesList)
    };


    $(document).ready(function(){
        $(".add-row").click(function(){


            // getting role values
            var categoryId = $("#categoryId").val();
            var category = $('select#categoryId').find(':selected').data('category');
            // alert(categoryId);


            if (category != null) 
            {          

                // checking if the module is already enlisted (part)    
                // alert(categoriesList.includes(parseInt(categoryId))); 

                if (categoriesList.includes(parseInt(categoryId)) ) 
                {
                    alert('Duplicate record!');
                    return false;
                } 
                else 
                {
                    categoriesList.push(parseInt(categoryId)); // checking if the module is already enlisted (part)
                    // alert(categoriesList);
                    // alert('ok');
                      // adding row
                
                    // adding row
                    var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='number' name='categoryId[]'  value='" +categoryId + 
                                                      "' readonly multiple hidden> <input  class='form-control' type='text'   value='" +category+ 
                                                      "' readonly multiple > "                                                  
                                                       +"</tr>";
                    $("table tbody").append(markup);


                     // after add role clearing fieldset=======
                     $('#categoryId').val('');
                     $('#category').val('');
                } 

            }
            else 
            {
                alert('Please select a page!');
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
                    var table = document.getElementById("page_table");
                    var categoryId = $("input[name='categoryId[]']").map(function(){return $(this).val();}).get();
                    var categoryId = categoryId[rowindex-1];
                    removeAllElements(categoriesList, parseInt(categoryId));
                    // alert(categoriesList);
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

     $('#categoryId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Category--'
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

