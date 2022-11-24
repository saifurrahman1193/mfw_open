@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Best Selling Products Slider')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 



@section('page_content')


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

    
          <div class="card">
            <div class="card-body">

				

				{{-- top side of the table --}}

				<h4 class="card-title" style="text-align: center;">Add Best Selling Products</h4>


				


          <form class="form-sample" id="new_products_slider_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('best_selling_products_slider_insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    

                    

                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label  for="text2"  class="col-sm-4 col-form-label control-label">Generic Brand</label>
                            <div class="col-sm-8">
                              <select class="form-control m-bot15" name="genericBrandId" id="genericBrandId"   >
                                      <option value="">--Select Generic Brand--</option>
                                      @foreach($genericbrand_data->whereNotIn('genericBrandId',$slider_best_selling_products_data->pluck('genericBrandId')) as $genericbrand)
                                          <option value="{{ $genericbrand->genericBrandId }}" 

                                            data-moduleid="{{ $genericbrand->genericBrandId }}"  
                                            data-modules="{{ title_case($genericbrand->genericBrand) }}"  
                                            >
                                            {{ title_case($genericbrand->genericBrand ) }}
                                          </option> 
                                      @endforeach   
                              </select>
                            </div>
                          </div>
                      </div>



                    </div>



                  <div class="col-md-12 text-center mt-4">
                      <input type="submit" class="btn btn-success mr-2"  value="Save">
                      <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear">
                  </div>


                  </form>
        

            </div>
          </div>
        </div>







<div class="content-wrapper" style="min-height: 0px; margin-top: -20px">
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">New Products</h4>



    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  <th scope="col">Photo</th>
                  <th scope="col">Generic Brand</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          

          <tbody>
               @foreach ($slider_best_selling_products_data as $slider_best_selling_products)
                  <tr>
                      <td>
                          <img  class="lozad" data-src="{{ asset($genericbrandpicData->where('genericBrandId', $slider_best_selling_products->genericBrandId )->pluck('picPath')->first() ) }}" alt="your image" class="sliderImage"  data-mfp-src="{{ asset($genericbrandpicData->where('genericBrandId', $slider_best_selling_products->genericBrandId )->pluck('picPath')->first() ) }}" 
                                style="
                                        min-width: 50px !important;
                                        min-height: 50px !important;
                                        max-width: 100px !important;
                                        max-height: 100px !important;
                                        border-radius: 0% !important;
                                " 
                           />
                      </td>
                      <td>{{$slider_best_selling_products->genericBrand}}</td>
                      
                      <td id="tdtableaction">
                           

                            <div class="d-inline-block">
                              <form  method="post" action="{{ route('best_selling_products_slider_delete', $slider_best_selling_products->slider_best_selling_product_id) }}"  onsubmit="return confirm('Do you really want to proceed?');">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    <a>
                                      <button type="submit" value="DELETE" class="btn btn-link" >
                                        <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                      </button>
                                    </a>
                              </form>
                            </div>

                      </td>
                  </tr>
                @endforeach

             
             
          </tbody>
      </table>



    </div>
  </div>
</div>



<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("new_products_slider_insert_form").reset();
    }

</script>



<script type="text/javascript">
  {{-- image upload and preview --}}

  function readURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#photoUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#photoUploadInput").change(function() 
  {
    readURL(this);
  });


  function readURL2(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#photoUpdateUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#photoUpdateUploadInput").change(function() 
  {
    readURL2(this);
  });

</script>




<script type="text/javascript">
  $(document).ready(function() {
    $('.sliderImage').magnificPopup({type:'image'});
  });
</script>




{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#genericBrandId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select Generic Brand--'
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