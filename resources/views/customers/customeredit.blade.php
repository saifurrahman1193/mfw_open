@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Users')

@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>


<style type="text/css" media="screen">
  fieldset{
    border:1px solid #cccc;
    padding: 8px;
}
</style>

   <div class="content-wrapper" style="min-height: 0px;">
        <div class="card">
            <div class="card-body">
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

                <h4 class="card-title" style="text-align: center;">Customer Information Edit</h4>
                <form class="form-horizontal" method="POST"  enctype="multipart/form-data"  action="{{ route('customerProfileUpdateSave') }}" aria-label="Customer Profile Update"  onsubmit="return confirm('Do you really want to proceed?');">
                    @csrf

                    <input id="id" type="number"  name="id" value="{{ $userData->id }}" required readonly hidden>

                    <div class="row col-md-8 col-md-offset-2">

                        <div class="form-group row col-md-12 required">
                            <label for="name" class="col-md-4 col-form-label text-md-right  control-label">Name (in english)</label>
                            <div class="col-md-8">
                                <textarea id="name" name="name"  class="form-control"      rows="5" required autofocus>{{ $userData->name }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row col-md-12 ">
                            <label for="nameLocalLang" class="col-md-4 col-form-label text-md-right  control-label">Name (in local lang)</label>
                            <div class="col-md-8">
                                <textarea id="nameLocalLang" name="nameLocalLang"  class="form-control"      rows="5"  >{{ $userData->nameLocalLang }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row col-md-12 required">
                            <label for="email" class="col-md-4 col-form-label text-md-right control-label">Email</label>
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control"  value="{{ $userData->email }}" required readonly>
                            </div>
                        </div>


                        <div class="form-group row col-md-12 required">
                            <label for="phone" class="col-md-4 col-form-label text-md-right control-label">Phone</label>
                            <div class="col-md-8">
                                 <div class="col col-md-6">
                                   <select class="form-control m-bot15" id="phoneCode" name="phoneCode" required >
                                        <option value="">--Select Phone Code--</option>
                                        @foreach($countryData->sortBy('country') as $country)
                                            <option value="{{ '+'.$country->phoneCode }}" 
                                                {{ ($country->phoneCode)==$userData->phoneCode ? 'selected' : '' }}
                                              >
                                              {{ '+'.$country->phoneCode.' ('.$country->country.')'  }}
                                            </option> 
                                        @endforeach   
                                    </select>
                                 </div>
                                 <div class="col col-md-6">
                                    <input type="tel" id="phone" type="phone" class="form-control" name="phone" value="{{ $userData->phone }}" required>
                                 </div>
                            </div>
                        </div>


                        <div class="form-group row col-md-12 ">
                            <label for="cityTownDivision" class="col-md-4 col-form-label text-md-right control-label">City</label>
                            <div class="col-md-8">
                                <input id="cityTownDivision" type="text" class="form-control" name="cityTownDivision"  value="{{ $userData->cityTownDivision }}">
                                @if ($errors->has('cityTownDivision'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cityTownDivision') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row col-md-12 ">
                            <label for="streethouse" class="col-md-4 col-form-label text-md-right  control-label">Street/House</label>
                            <div class="col-md-8">
                                {{-- <input id="streethouse" type="text" class="form-control" value="{{ $userData->streethouse }}" name="streethouse" > --}}
                                <textarea id="streethouse" name="streethouse"  class="form-control"      rows="5" >{{ $userData->streethouse }}</textarea>
                              </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <label for="socialMedia" class="col-md-4 col-form-label text-md-right">Social Media</label>
                            <div class="col-md-8">
                                {{-- <input id="socialMedia" type="text" class="form-control" value="{{ $userData->socialMedia }}" name="socialMedia" > --}}
                                <textarea id="socialMedia" name="socialMedia"  class="form-control"      rows="5" >{{ $userData->socialMedia }}</textarea>
                              </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <label for="takingForRelationship" class="col-md-4 col-form-label text-md-right">Taking For Relationship</label>
                            <div class="col-md-8">
                                {{-- <input id="takingForRelationship" type="text" class="form-control" value="{{ $userData->takingForRelationship }}" name="takingForRelationship" > --}}
                                <textarea id="takingForRelationship" name="takingForRelationship"  class="form-control"      rows="5" >{{ $userData->takingForRelationship }}</textarea>
                              </div>
                        </div>

                        <div class="form-group row col-md-12 ">
                            <label for="patientName" class="col-md-4 col-form-label text-md-right  control-label">Patient Name</label>
                            <div class="col-md-8">
                                {{-- <input id="patientName" type="text" class="form-control" value="{{ $userData->patientName }}" name="patientName" > --}}
                                <textarea id="patientName" name="patientName"  class="form-control"      rows="5" >{{ $userData->patientName }}</textarea>
                              </div>
                        </div>


                        <div class="form-group row col-md-12 ">
                            <label for="postalCode" class="col-md-4 col-form-label text-md-right   control-label">Post Code</label>
                            <div class="col-md-8">
                                <input id="postalCode" type="number" class="form-control" name="postalCode"   value="{{ $userData->postalCode }}" >
                            </div>
                        </div>


                        <div class="form-group row col-md-12 required">
                            <label for="countryId" class="col-md-4 col-form-label text-md-right  control-label">Country</label>
                            <div class="col-md-8">
                                <select class="form-control m-bot15" name="countryId" id="countryId" required >
                                    <option  value="">--Select Country--</option>
                                    @foreach($countryData->sortBy('country') as $country)
                                        <option value="{{ $country->countryId }}" 
                                          {{ $country->countryId==$userData->countryId ? 'selected' : '' }}
                                         >
                                          {{ title_case($country->country)}}
                                        </option> 
                                    @endforeach   
                                </select>
                            </div>
                        </div>


                        <div class="form-group row col-md-12">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Photo</label>
                            <div class="col-md-8">
                                <input type="file" name="photoPath" value="photoPath" class="form-control" placeholder="photoPath"   id="photoUploadInput"    style="margin-bottom: 10px; padding-bottom: 40px;">
                                  <img id="photoUploadPreview" src="{{ empty($userData->photoPath) ? '#' : url('/').'/..'.$userData->photoPath }}"   style="max-width: 200px; max-height: 200px;"  alt="image" />
                            </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <div class="col-md-12 ">
                                <a href="{{ route('customers.customers') }}"><button type="button" class="btn btn-danger float-right mr-1" >Cancel</button></a>
                                <button   type="submit"   class="btn btn-success mr-2 float-right">Save</button>
                            </div>
                        </div>
                    
                    </div>
                </form>

            </div>
        </div>
    </div>




{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
    $(document).ready(function() {
  
       $('#countryId').select2({
        // dropdownAutoWidth : true,
          placeholder: {
            id: '12', // the value of the option
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
  
       $('#phoneCode').select2({
        // dropdownAutoWidth : true,
          placeholder: {
            id: '12', // the value of the option
            text: '--Select Phone Code--'
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
  
  
  
  
@endsection

