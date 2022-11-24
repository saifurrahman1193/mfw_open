@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Main Navbar Categories')

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

				<h4 class="card-title" style="text-align: center;">Add Menubar Category</h4>


				


          <form class="form-sample" id="main_menu_navbar_category_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('frontend_main_navbar_insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    

                    

                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label  for="text2"  class="col-sm-4 col-form-label control-label">Category</label>
                            <div class="col-sm-8">
                              <select class="form-control m-bot15" name="categoryId" id="categoryId"   >
                                      <option value="">--Select Category--</option>
                                      @foreach( ($category_data->sortBy('category'))->whereNotIn('categoryId', $menu_categories_f_data->pluck('categoryId')) as $category)
                                          <option value="{{ $category->categoryId }}" >
                                            {{ title_case($category->category ) }}
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


        <h4 class="card-title" style="text-align: center;">Menubar Categories</h4>



    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  <th scope="col">Category</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          

          <tbody>
               @foreach ($menu_categories_f_data->where('categoryId', '!=', null) as $menu_category)
                  <tr>
                      
                      <td>{{$category_data->where('categoryId', $menu_category->categoryId)->pluck('category')->first()}}</td>
                      
                      <td id="tdtableaction">
                           

                            <div class="d-inline-block">
                              <form  method="post" action="{{ route('frontend_main_navbar_delete', $menu_category->categoryId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
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
        document.getElementById("main_menu_navbar_category_insert_form").reset();
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