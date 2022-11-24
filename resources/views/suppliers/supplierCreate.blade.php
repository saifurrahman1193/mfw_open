
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Create Supplier')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


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
        <h4 class="card-title" style="text-align: center;">Create New Supplier</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">
	                {{-- <div class="panel-heading">Add New User</div> --}}

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('supplier.settings.supplier.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>

			                        	<div class="row">
			                        		
				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Supplier</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="supplier" name="supplier" required>
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Phone</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="phone" name="phone" required>
				                                </div>
				                              </div>
				                            </div>

			                        	</div>


			                        	<div class="row">
			                        		
				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Email</label>
				                                <div class="col-sm-8">
				                                  <input type="email" class="form-control" id="email" name="email" required>
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Address</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="address" name="address" required>
				                                </div>
				                              </div>
				                            </div>

			                        	</div>


			                        	<div class="row">
			                        		
				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Country</label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="countryId" id="countryId" required >
				                                      <option value="">--Select Country--</option>
				                                      @foreach($countryData as $country)
				                                          <option value="{{ $country->countryId }}">
				                                            {{ $country->country}}
				                                          </option> 
				                                      @endforeach   
				                                  </select>
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row">
				                                <label class="col-sm-4 col-form-label control-label">Generic Company</label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="genericCompanyId" id="genericCompanyId">
				                                      <option value="">--Select Generic Company--</option>
				                                      @foreach($genericcompanyData as $genericcompany)
				                                          <option value="{{ $genericcompany->genericCompanyId }}">
				                                            {{ $genericcompany->genericCompany}}
				                                          </option> 
				                                      @endforeach   
				                                  </select>
				                                </div>
				                              </div>
				                            </div>

			                        	</div>


			                        	<div class="row">
			                        		
				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Position</label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="positionId" id="positionId" required >
				                                      <option value="">--Select Position--</option>
				                                      @foreach($positionsData as $position)
				                                          <option value="{{ $position->positionId }}">
				                                            {{ $position->position}}
				                                          </option> 
				                                      @endforeach   
				                                  </select>
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Third Party Company</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="thirdPartyCompany" name="thirdPartyCompany" >
				                                </div>
				                              </div>
				                            </div>

				                            

			                        	</div>


			                        	<div class="row">
			                        		
				                           

				                            <div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Comment</label>
				                                <div class="col-sm-8">
				                                  <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
				                                </div>
				                              </div>
				                            </div>
				                            

			                        	</div>



			                            


			                            


			                            


			                            
										{{-- supplier social media start --}}
										{{-- supplier social media start --}}

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Social Media</legend>

			                                <div class="row ">

			                                	<div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Social Media</label>
					                                <div class="col-sm-8">
					                                  <select class="form-control m-bot15" name="socialMediaId" id="socialMediaId"  >
					                                      <option value="">--Select Social Media--</option>
					                                      @foreach($socialMediaData as $socialmedia)
					                                          <option value="{{ $socialmedia->socialMediaId }}"
																	
																	data-socialmediaid = "{{ $socialmedia->socialMediaId }}"
																	data-socialmedia = "{{ $socialmedia->socialMedia }}"
					                                          	>
					                                            {{ $socialmedia->socialMedia}}
					                                          </option> 
					                                      @endforeach   
					                                  </select>
					                                </div>
					                              </div>
					                            </div>

					                            


					                            <div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Social Name Or Id </label>
					                                <div class="col-sm-8">
					                                  <input type="text" class="form-control" id="supplierSocialNameOrId" name="supplierSocialNameOrId" >
					                                </div>
					                              </div>
					                            </div>
												
			                                  
			                                </div>
			                                

			                                <input type="button" class="btn btn-primary add-row  mb-5 float-right" value="Add Social Media" id="add_social_media">

			                                <table id="social_media_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Social Media</th>
			                                            <th class="text-center">Social Name or Id</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>




			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger socail_media_table_delete_row mt-2" id="delete_social_media">Delete Social Media</button>
			                              

			                            </fieldset>

										{{-- supplier social media end --}}
										{{-- supplier social media end --}}






			                            <div class="row offset-sm-5">
				                            <button   type="submit"   class="btn btn-success mr-2 ">Save</button>

			                            	<a href="{{ route('supplier.index') }}"><button type="button" class="btn btn-danger mr-1" >Cancel</button></a>

			                            </div>


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









{{-- supplier social media adding, deleting code --}}

<script type="text/javascript">

    var socialMediaList = [];   // checking if the module is already enlisted (part)
    

    $(document).ready(function(){
        $(".add-row").click(function(){

            // getting social media values
            var socialMediaId = $("#socialMediaId").val();
            var socialMedia =  $('select#socialMediaId').find(':selected').data('socialmedia');
            var supplierSocialNameOrId = $("#supplierSocialNameOrId").val();

            if (supplierSocialNameOrId.length > 0 && socialMediaId>0) 
            {    
            	// checking if the module is already enlisted (part)      
	            if (socialMediaList.includes(socialMediaId) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {
		            socialMediaList.push(socialMediaId); // checking if the module is already enlisted (part)
		            // alert(socialMediaList);
	            	// alert('ok');
	                // adding row

	                var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='number' name='socialMediaId[]'  value='" +socialMediaId + 
	                                                  "' readonly multiple hidden>"+
	                                                  	"<input  class='form-control' type='text'  value='"+socialMedia+ "' readonly multiple > " 
	                                                  +" </td> <td> <input  class='form-control' type='text'  name='supplierSocialNameOrId[]' value='" +supplierSocialNameOrId+ 
	                                                  "' readonly multiple > "                                                  
	                                                   +"</td></tr>";
	                $("#social_media_table tbody").append(markup);


	                 // after add social media clearing fieldset=======
	                 $('#socialMediaId').val('');
	                 $('#supplierSocialNameOrId').val('');
	            	
	            }
            

            }
            else 
            {
                alert('Please add a social Media and Social Name Or Id!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".socail_media_table_delete_row").click(function(){
            $("#social_media_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("social_media_table");
                    var socialMediaId = $("input[name='socialMediaId[]']").map(function(){return $(this).val();}).get();
                    var socialMediaId = socialMediaId[rowindex-1];
                    removeAllElements(socialMediaList, socialMediaId);
		            // alert(socialMediaList);
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









{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#countryId').select2({
        placeholder: {
          id: '123', // the value of the option
          text: '--Select Country--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true,
        language: {
          noResults: function (params) {
            return "No Data Found!";
          }
        },
     });


     $('#genericCompanyId').select2({
        placeholder: {
          id: '123', // the value of the option
          text: '--Select Generic Company--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true,
        language: {
          noResults: function (params) {
            return "No Data Found!";
          }
        },
     });



     $('#positionId').select2({
        placeholder: {
          id: '123', // the value of the option
          text: '--Select Position--'
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