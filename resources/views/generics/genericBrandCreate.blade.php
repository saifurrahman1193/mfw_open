
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Create Generic Brand')

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
        <h4 class="card-title" style="text-align: center;">Create New Generic Brand</h4>


		
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">
	                {{-- <div class="panel-heading">Add New User</div> --}}

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('generic.settings.brand.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                {{ csrf_field() }}

			                    <br>
			                      <p class="card-description">
			                      </p>
			                        <div>

			                        	<div class="row">

			                        		<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic Brand</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="genericBrand" name="genericBrand" required>
				                                </div>
				                              </div>
				                            </div>

			                        		<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic </label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="genericId" id="genericId" required >
				                                      <option value="">--Select Generic--</option>
				                                      @foreach($genericData as $generic)
				                                          <option value="{{ $generic->genericId }}">
				                                            {{ title_case($generic->genericName)}}
				                                          </option> 
				                                      @endforeach   
				                                  </select>
				                                </div>
				                              </div>
				                            </div>



			                        		

				                            
			                            </div>



				                          <div class="row">

				                          	<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Generic Brand (CN)</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="genericBrandCN" name="genericBrandCN" >
				                                </div>
				                              </div>
				                            </div>

				                          	<div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic Company</label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="genericCompanyId" id="genericCompanyId" required >
				                                      <option value="">--Select Generic Company--</option>
				                                      @foreach($genericcompanyData as $genericcompany)
				                                          <option value="{{ $genericcompany->genericCompanyId }}">
				                                            {{ title_case($genericcompany->genericCompany)}}
				                                          </option> 
				                                      @endforeach   
				                                  </select>
				                                </div>
				                              </div>
				                            </div>

				                            

			                        	</div>

			                        	<div class="row">

			                        		<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Generic Brand (RU)</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="genericBrandRU" name="genericBrandRU" >
				                                </div>
				                              </div>
				                            </div>


				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Is Rx Applicable </label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="isRxApplicable" id="isRxApplicable" required >
				                                          <option value="">--Select--</option> 
				                                          
				                                          <option value="0">No</option> 
				                                          <option value="1">Yes</option> 
				                                  </select>
				                                </div>
				                              </div>
				                            </div>

				                            


				                            



			                        	</div>




			                        	{{-- disease category start --}}
										{{-- disease category start --}}

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Disease Category</legend>

			                                <div class="row ">

			                                	<div class="col-md-6">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Disease Category</label>
					                                <div class="col-sm-8">
					                                  <select class="form-control m-bot15" name="diseaseCategoryId" id="diseaseCategoryId"  >
					                                      <option value="">--Select Disease Category--</option>
					                                      @foreach($diseasecategoryData as $diseasecategory)
					                                          <option value="{{ $diseasecategory->diseaseCategoryId }}"
																	
																	data-diseasecategoryid = "{{ $diseasecategory->diseaseCategoryId }}"
																	data-diseasecategory = "{{ $diseasecategory->diseaseCategory }}"
					                                          	>
					                                            {{ $diseasecategory->diseaseCategory}}
					                                          </option> 
					                                      @endforeach   
					                                  </select>
					                                </div>
					                              </div>
					                            </div>

					                            
												
				                                <input type="button" class="btn btn-primary add-disease-category-row  mb-5 float-right" value="Add Disease Category" id="add_disease_category">
			                                  
			                                </div>
			                                


			                                <table id="disease_category_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Disease Category</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>




			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger disease_category_table_delete_row mt-2" id="delete_social_media">Delete Disease Category</button>
			                              

			                            </fieldset>

										{{-- disease category end --}}
										{{-- disease category end --}}






			                           


			                            

			                            <fieldset  class=" mb-4 mt-5">
			                              <legend>Add Generic Brand Pictures</legend>

			                                <div class="row ">
{{-- 
			                                	<div class="col-md-6">
				                                    <div class="form-group row required  " >
				                                      <label  for="picPath"  class="col-sm-4 col-form-label control-label">Picture</label>
				                                      <div class="col-sm-8">
				                                        <input type="file" name="picPath" value="picPath" class="form-control" placeholder="picPath"   id="photoUploadInput" required   >
				                                          @if ($errors->has('picPath'))
				                                              <span class="invalid-feedback" role="alert">
				                                                  <strong>{{ $errors->first('picPath') }}</strong>
				                                              </span>
				                                          @endif
				                                          <img id="photoUploadPreview"   style="max-width: 200px; max-height: 200px;" />
				                                      </div>
				                                    </div>
				                                  </div> --}}

												
				                                <div class="col-md-6">
					                                <input type="button" class="btn btn-primary add-picture-row  mb-5 float-left" value="Add Row" id="add_brandPicture">
				                                </div>
			                                </div>
			                                


			                                <table id="brandpic_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Picture</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>


			                                        {{-- inputs will be loaded dynamically from user input --}}


			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger delete-picture-row mt-2" id="delete_item">Delete Picture</button>
			                              


			                            </fieldset>


			                            <a href="{{ route('generics.genericBrandListIndex.index') }}"><button type="button" class="btn btn-danger float-right mr-1" >Cancel</button></a>

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

<script type="text/javascript">

    var pictureList = [];   // checking if the module is already enlisted (part)
    

    $(document).ready(function(){
        $(".add-picture-row").click(function(){

            // getting role values
            // var picPath = $("#picPath").val();
            // var d = document.getElementById('picPath');


			// alert($('#photoUploadInput')[0].files[0]);
			// console.log($('#photoUploadInput')[0].files[0]);
            // var picName =$('#photoUploadInput')[0].files[0].name ;
            // var picPath =window.URL.createObjectURL($('#photoUploadInput')[0].files[0]);
            // var picPath =$('#photoUploadInput')[0].files[0];

			// console.log(picName);


            // if (($('#photoUploadInput')[0].files[0].name).length > 0 ) 
            // {    
            	// checking if the module is already enlisted (part)      
		            // pictureList.push(picName); // checking if the module is already enlisted (part)
		            // alert(pictureList);
	            	// alert('ok');
	                // adding row

	                var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='file' name='picPath[]'   readonly multiple  > <img   style='max-width: 200px; max-height: 200px;' /> </td> " +"</tr>";


	                $("#brandpic_table tbody").append(markup);


	                 // after add role clearing fieldset=======
	                 // $('#picPath').val('');
	            	
            // }
            // else 
            // {
            //     alert('Please add a picture!');
            //     return false;
            // }

        });


        
        // Find and remove selected table rows
        $(".delete-picture-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("brandpic_table");
                    var picPath = $("input[name='picPath[]']").map(function(){return $(this).val();}).get();
                    var picPath = picPath[rowindex-1];
                    removeAllElements(pictureList, picPath);
		            // alert(pictureList);
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








{{-- disease category adding, deleting code --}}

<script type="text/javascript">

    var diseaseCategoryList = [];   // checking if the module is already enlisted (part)
    

    $(document).ready(function(){
        $(".add-disease-category-row").click(function(){

            // getting social media values
            var diseaseCategoryId = $("#diseaseCategoryId").val();
            var diseaseCategory =  $('select#diseaseCategoryId').find(':selected').data('diseasecategory');

            if ( diseaseCategoryId>0) 
            {    
            	// checking if the module is already enlisted (part)      
	            if (diseaseCategoryList.includes(diseaseCategoryId) ) 
	            {
	            	alert('Duplicate record!');
	            	return false;
	            }
	            else 
	            {
		            diseaseCategoryList.push(diseaseCategoryId); // checking if the module is already enlisted (part)
		            // alert(diseaseCategoryList);
	            	// alert('ok');
	                // adding row

	                var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input  class='form-control' type='number' name='diseaseCategoryId[]'  value='" +diseaseCategoryId + 
	                                                  "' readonly multiple hidden>"+
	                                                  	"<input  class='form-control' type='text'  value='"+diseaseCategory+ "' readonly multiple > " 
	                                                                                                   
	                                                   +"</td></tr>";
	                $("#disease_category_table tbody").append(markup);


	                 // after add social media clearing fieldset=======
	                 $('#diseaseCategoryId').val('');
	            	
	            }
            

            }
            else 
            {
                alert('Please add a disease category!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $(".disease_category_table_delete_row").click(function(){
            $("#disease_category_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                     // remove/delete/pop array element before delete the row 
                     // checking if the module is already enlisted 
                    var table = document.getElementById("disease_category_table");
                    var diseaseCategoryId = $("input[name='diseaseCategoryId[]']").map(function(){return $(this).val();}).get();
                    var diseaseCategoryId = diseaseCategoryId[rowindex-1];
                    removeAllElements(diseaseCategoryList, diseaseCategoryId);
		            // alert(diseaseCategoryList);
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

     $('#genericId').select2({
     	// dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
     	dropdownAutoWidth : true,
        placeholder: {
          id: '', // the value of the option
          text: '--Select Generic--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true,
        language: {
          noResults: function (params) {
            return "No Data Found!";
          }
        },
     });


     $('#diseaseCategoryId').select2({
     	// dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
     	dropdownAutoWidth : true,
        placeholder: {
          id: '', // the value of the option
          text: '--Select Disease Category--'
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
     	// dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
     	dropdownAutoWidth : true,
        placeholder: {
          id: '', // the value of the option
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


     $('#diseaseCategoryId').select2({
     	// dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
     	dropdownAutoWidth : true,
        placeholder: {
          id: '', // the value of the option
          text: '--Select Disease Category--'
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



{{-- <script type="text/javascript">

  function readURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('.photoUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#photoUploadInput").change(function() 
  {
    readURL(this);
  });


</script> --}}




@endsection