
@extends('layouts.app')

@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Footer Portion 2 Pages')


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
            <h4 class="card-title" style="text-align: center;">Update A Footer Portion 2 Pages </h4>

            <form class="form-horizontal" method="post"  action="{{ route('footer.portion2pagesUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
              {{method_field('put')}}
              {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                    </p>
                    



                    <fieldset  class=" mb-4 mt-4">
                                    <legend>Add Page</legend>

                                      <div class="row ">


                                        <div class="col-md-6">
                                          <div class="form-group row required">
                                            <label class="col-sm-4 col-form-label control-label">Page</label>
                                            <div class="col-sm-8">

                                                <select class="form-control m-bot15" name="pageId" id="pageId"   >

                                                        <option value="">--Select Page--</option>


                                                        @foreach($pagesData as $page)
                                                            <option value="{{ $page->pageId }}" 

                                                              data-pageid="{{ $page->pageId }}"  
                                                              data-pagetitle="{{ $page->pageTitle }}"  
                                                              >
                                                              {{ title_case($page->pageTitle ) }}
                                                            </option> 
                                                        @endforeach   


                                                </select>


                                            </div>



                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                            {{-- role adding portion --}}
                                            <input type="button" class="btn btn-primary add-row  mb-5" value="Add Page" id="add_page">
                                        </div>



                                          
                                        
                                      </div>
                                      


                                      <table id="page_table" class="col-md-6 offset-md-1">
                                          <thead>
                                              <tr>
                                                  <th>Select</th>
                                                  <th class="text-center">Page</th>
                                              </tr>
                                          </thead>

                                          <tbody>

                                            {{-- existing records --}}
                                            @foreach ($footerportion2pagesData as $footerportion2page)
                                                <tr>
                                                  <td><input type='checkbox' name='record'></td>
                                                  <td>
                                                    <input  class='form-control' type='number' name='pageId[]'  value='{{ $footerportion2page->pageId}}'  readonly multiple hidden>
                                                    <input  class='form-control' type='text'   value='{{ title_case($footerportion2page->pageTitle)}}' readonly multiple >

                                                  </td>
                                                  
                                                  
                                                </tr>
                                            @endforeach


                                              {{-- inputs will be loaded dynamically from user input --}}


                                          </tbody>

                                        

                                      </table>


                                    <div class="text-md-center text-sm-center mt-3">
                                      <button type="button" class="btn btn-danger delete-row " id="delete_item">Delete Page</button>
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
      $('select#pageId').change(function() {
          var pageId = $('select#pageId').find(':selected').data('pageid');
          var pageTitle = $('select#pageId').find(':selected').data('pagetitle');

          $('#pageId').val(pageId);
      });
  });


</script>





{{-- role adding, deleting code --}}

<script type="text/javascript">

    var pagesList = [];   // checking if the module is already enlisted (part)
    
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
      @foreach ($footerportion2pagesData as $footerportion2pages)
        pagesList.push({{ $footerportion2pages->pageId}});
      @endforeach
      // alert(pagesList)
    };


    $(document).ready(function(){
        $(".add-row").click(function(){


            // getting role values
            var pageId = $("#pageId").val();
            var pageTitle = $('select#pageId').find(':selected').data('pagetitle');
            // alert(pageId);


            if (pageTitle != null) 
            {          

                // checking if the module is already enlisted (part)    
                // alert(pagesList.includes(parseInt(pageId))); 

                if (pagesList.includes(parseInt(pageId)) ) 
                {
                    alert('Duplicate record!');
                    return false;
                } 
                else 
                {
                    pagesList.push(parseInt(pageId)); // checking if the module is already enlisted (part)
                    // alert(pagesList);
                    // alert('ok');
                      // adding row
                
                    // adding row
                    var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='number' name='pageId[]'  value='" +pageId + 
                                                      "' readonly multiple hidden> <input  class='form-control' type='text'   value='" +pageTitle+ 
                                                      "' readonly multiple > "                                                  
                                                       +"</tr>";
                    $("table tbody").append(markup);


                     // after add role clearing fieldset=======
                     $('#pageId').val('');
                     $('#pageTitle').val('');
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
                    var pageId = $("input[name='pageId[]']").map(function(){return $(this).val();}).get();
                    var pageId = pageId[rowindex-1];
                    removeAllElements(pagesList, parseInt(pageId));
                    // alert(pagesList);
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

     $('#pageId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Page--'
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

