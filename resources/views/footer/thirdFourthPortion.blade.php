@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Third & Fourth Portion')
@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>

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

{{-- Payment Method table --}}
{{-- Payment Method table --}}
  
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Third & Fourth Portion</h4>

        <form action="{{ route('footer.thirdFourthPortionUpdate') }}" method="POST">
          @csrf
           @method('PUT') 
            <div class="row">

            <div class="col-md-6">
                <div class="form-group row required">
                  <label class="col-sm-4 col-form-label control-label">Third Portion Category</label>
                  <div class="col-sm-8">
                    <select class="form-control m-bot15" name="thirdPortionCategoryId" id="thirdPortionCategoryId" required >
                        <option value="">--Select Category--</option>
                        option
                        @foreach($categoryData as $category)
                            <option value="{{ $category->categoryId }}" {{ $category->categoryId == $footerthirdfourthportionData->thirdPortionCategoryId ? 'selected' : ''}} >
                              {{ title_case($category->category)}}
                            </option> 
                        @endforeach 
                    </select>
                  </div>
                </div>
              </div>

            <div class="col-md-6">
                <div class="form-group row required">
                  <label class="col-sm-4 col-form-label control-label">Fourth Portion Category </label>
                  <div class="col-sm-8">
                    <select class="form-control m-bot15" name="fourthPortionCategoryId" id="fourthPortionCategoryId" required >
                        <option value="">--Select Category--</option>
                        @foreach($categoryData as $category)
                            <option value="{{ $category->categoryId }}" {{ $category->categoryId == $footerthirdfourthportionData->fourthPortionCategoryId ? 'selected' : ''}}>
                              {{ title_case($category->category)}}
                            </option> 
                        @endforeach   
                    </select>
                  </div>
                </div>
              </div>
          </div>
        
          <div class="form-group">
              <div class="col-md-12  d-flex  justify-content-center">

                  <button type="submit" class="btn btn-success text-center" >
                      Save
                  </button>

              </div>
            </div>

        </form>       

    </div>
  </div>
</div>
{{-- Payment Method table --}}
{{-- Payment Method table --}}


{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

    $('#thirdPortionCategoryId').select2({
      // dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
      // dropdownAutoWidth : true,
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

     $('#fourthPortionCategoryId').select2({
      // dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
      // dropdownAutoWidth : true,
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