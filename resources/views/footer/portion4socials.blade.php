
@extends('layouts.app')

@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Footer Portion 4 Socials')


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
            <h4 class="card-title" style="text-align: center;">Update A Footer Portion 4 Socials </h4>

            <form class="form-horizontal" method="post"  action="{{ route('footer.portion4SocialsUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
              {{method_field('put')}}
              {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                    </p>
                    



                    <fieldset  class=" mb-4 mt-4">
                                    <legend>Add Social Media</legend>

                                      <div class="row ">


                                        <div class="col-md-6">
                                          <div class="form-group row required">
                                            <label class="col-sm-4 col-form-label control-label">Social Media</label>
                                            <div class="col-sm-8">

                                                <select class="form-control m-bot15" name="socialMediaId" id="socialMediaId"   >

                                                        <option value="">--Select Social Media--</option>


                                                        @foreach($socialmediaData as $socialmedia)
                                                            <option value="{{ $socialmedia->socialMediaId }}" 

                                                              data-socialmediaid="{{ $socialmedia->socialMediaId }}"  
                                                              data-socialmedia="{{ $socialmedia->socialMedia }}"  
                                                              >
                                                              {{ title_case($socialmedia->socialMedia ) }}
                                                            </option> 
                                                        @endforeach   


                                                </select>


                                            </div>



                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                            {{-- role adding portion --}}
                                            <input type="button" class="btn btn-primary add-row  mb-5" value="Add Social Media" id="add_socialmedia">
                                        </div>



                                          
                                        
                                      </div>
                                      


                                      <table id="social_media_table" class="col-md-6 offset-md-1">
                                          <thead>
                                              <tr>
                                                  <th>Select</th>
                                                  <th class="text-center">Social Media</th>
                                              </tr>
                                          </thead>

                                          <tbody>

                                            {{-- existing records --}}
                                            @foreach ($footerportion4socialsData as $footerportion4social)
                                                <tr>
                                                  <td><input type='checkbox' name='record'></td>
                                                  <td>
                                                    <input  class='form-control' type='number' name='socialMediaId[]'  value='{{ $footerportion4social->socialMediaId}}'  readonly multiple hidden>
                                                    <input  class='form-control' type='text'   value='{{ title_case($footerportion4social->socialMedia)}}' readonly multiple >

                                                  </td>
                                                  
                                                  
                                                </tr>
                                            @endforeach


                                              {{-- inputs will be loaded dynamically from user input --}}


                                          </tbody>

                                        

                                      </table>


                                    <div class="text-md-center text-sm-center mt-3">
                                      <button type="button" class="btn btn-danger delete-row " id="delete_item">Delete Social Media</button>
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
      $('select#socialMediaId').change(function() {
          var socialMediaId = $('select#socialMediaId').find(':selected').data('socialmediaid');

          $('#socialMediaId').val(socialMediaId);
      });
  });


</script>





{{-- role adding, deleting code --}}

<script type="text/javascript">

    var socliaMediaList = [];   // checking if the module is already enlisted (part)
    
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
      @foreach ($footerportion4socialsData as $footerportion4socials)
        socliaMediaList.push({{ $footerportion4socials->socialMediaId}});
      @endforeach
      // alert(socliaMediaList)
    };


    $(document).ready(function(){
        $(".add-row").click(function(){


            // getting role values
            var socialMediaId = $("#socialMediaId").val();
            var socialMedia = $('select#socialMediaId').find(':selected').data('socialmedia');
            // alert(socialMediaId);


            if (socialMedia != null) 
            {          

                // checking if the module is already enlisted (part)    
                // alert(socliaMediaList.includes(parseInt(socialMediaId))); 

                if (socliaMediaList.includes(parseInt(socialMediaId)) ) 
                {
                    alert('Duplicate record!');
                    return false;
                } 
                else 
                {
                    socliaMediaList.push(parseInt(socialMediaId)); // checking if the module is already enlisted (part)
                    // alert(socliaMediaList);
                    // alert('ok');
                      // adding row
                
                    // adding row
                    var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='number' name='socialMediaId[]'  value='" +socialMediaId + 
                                                      "' readonly multiple hidden> <input  class='form-control' type='text'   value='" +socialMedia+ 
                                                      "' readonly multiple > "                                                  
                                                       +"</tr>";
                    $("table tbody").append(markup);


                     // after add role clearing fieldset=======
                     $('#socialMediaId').val('');
                     $('#socialMedia').val('');
                } 

            }
            else 
            {
                alert('Please select a social media!');
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
                    var table = document.getElementById("social_media_table");
                    var socialMediaId = $("input[name='socialMediaId[]']").map(function(){return $(this).val();}).get();
                    var socialMediaId = socialMediaId[rowindex-1];
                    removeAllElements(socliaMediaList, parseInt(socialMediaId));
                    // alert(socliaMediaList);
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

     $('#socialMediaId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Social Media--'
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

