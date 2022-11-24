@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Profile')


{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@section('page_content')

<div class="clearfix"></div>

 <div class="container text-success" id="path-section" style="padding-top: 50px; font-weight: bold;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ app()->getLocale()?action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}">{{ __('header.Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('header.profile') }}</li>
      </ol>
    </nav>

</div>

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-30">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            
            {{-- <div class="card-title">Register</div> --}}
            
            <div class="content-wrapper" style="min-height: 0px;" id="prescriptiontable">

                <h3 class="card-title padd-30" style="text-align: center; font-weight: bold;">{{ __('header.profile') }}</h3>
                <div class="card">
                    <div class="card-body">

                          <form class="form-horizontal" method="POST"  enctype="multipart/form-data"  action="{{ app()->getLocale() ?  action('UserController_F@customerRegistrationUpdate', array('lang'=>app()->getLocale() ) ) : action('UserController_F@customerRegistrationUpdate', array('lang'=>app()->getLocale() ) ) }}" aria-label="{{ __('header.profile') }}">
                                @csrf


                                <div class="row col-md-8 col-md-offset-2">

                                    <input type="number" value="{{$userData->id}}" hidden name="id" readonly>

                                    <div class="form-group row col-md-12 required">
                                        <label for="name" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('checkout.name').' ('.__('checkout.inenglish').')' }}                                       
                                        </label>

                                        <div class="col-md-8">
                                            <textarea id="name" name="name"  class="form-control"      rows="2" required autofocus>{{ $userData->name }}</textarea>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row col-md-12 ">
                                        <label for="name" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('checkout.name').' ('.__('checkout.inlocallanguage').')' }}                                       
                                        </label>

                                        <div class="col-md-8">
                                            <textarea id="nameLocalLang" name="nameLocalLang"  class="form-control"      rows="2"  >{{ $userData->nameLocalLang }}</textarea>

                                            @if ($errors->has('nameLocalLang'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('nameLocalLang') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    

                                    <div class="form-group row col-md-12">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">
                                         {{ __('register.email') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $userData->email }}" required readonly>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row col-md-12">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">
                                          {{ __('register.changepassword') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
                                            <span style="color: red; font-size: 10px;">{{__('register.hint')}} : {{__('register.pass6charlong')}}</span>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif

                                            @if (session('passwordChanged'))
                                                <span class="invalid-feedback text-success" role="alert">
                                                    <strong>{{__('register.passwordchanged')}} !</strong>
                                                </span>
                                            @endif

                                        </div>
                                    </div>


                                    {{-- <div class="form-group row col-md-12">
                                        <label for="confirmpassword" class="col-md-4 col-form-label text-md-right">
                                          {{ __('register.confirmpassword') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input id="confirmpassword" type="password" class="form-control{{ $errors->has('confirmpassword') ? ' is-invalid' : '' }}" name="confirmpassword" required>

                                            @if ($errors->has('confirmpassword'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('confirmpassword') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> --}}




                                    <div class="form-group row col-md-12 required">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('register.phone') }} 
                                        </label>

                                        <div class="col-md-8">

                                             <div class="col-md-6">
                                              
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
                                             <div class="col-md-6">
                                                <input type="tel" id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $userData->phone }}" required>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                             </div>

                                            
                                        </div>
                                    </div>


                                    <div class="form-group row col-md-12 ">
                                        <label for="cityTownDivision" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('register.city') }} 
                                        </label>

                                        <div class="col-md-8">
                                            {{-- <input id="cityTownDivision" type="text" class="form-control{{ $errors->has('cityTownDivision') ? ' is-invalid' : '' }}" name="cityTownDivision" required value="{{ $userData->cityTownDivision }}"> --}}
                                            <textarea id="cityTownDivision" name="cityTownDivision"  class="form-control"    rows="2" >{{ $userData->cityTownDivision }}</textarea>

                                            @if ($errors->has('cityTownDivision'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('cityTownDivision') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row col-md-12 ">
                                        <label for="streethouse" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('register.housestreetinfo') }} 
                                        </label>

                                        <div class="col-md-8">
                                            {{-- <input id="streethouse" type="text" class="form-control{{ $errors->has('streethouse') ? ' is-invalid' : '' }}" value="{{ $userData->streethouse }}" name="streethouse" required> --}}
                                            <textarea id="streethouse" name="streethouse"  class="form-control"    rows="2" >{{ $userData->streethouse }}</textarea>

                                            @if ($errors->has('streethouse'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('streethouse') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row col-md-12 ">
                                        <label for="postalCode" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('register.postcode') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input id="postalCode" type="number" class="form-control{{ $errors->has('postalCode') ? ' is-invalid' : '' }}" name="postalCode"   value="{{ $userData->postalCode }}" >

                                            @if ($errors->has('postalCode'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('postalCode') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row col-md-12 required">
                                        <label for="countryId" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('register.country') }} 
                                        </label>

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


                                            @if ($errors->has('countryId'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('countryId') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row col-md-12">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">
                                          {{ __('register.photo') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input id="photoPath" name="photoPath" type="file" class="file"  data-show-upload="true" data-show-caption="true" >

                                              @if ($errors->has('photoPath'))
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $errors->first('photoPath') }}</strong>
                                                  </span>
                                              @endif
                                              <div>
                                                <p style="margin:0px; font-size: 11px;"><strong>{{__('orderhistory.note')}}:</strong> </p>
                                                <p style="margin:0px; font-size: 11px;">1. {{__('orderhistory.only')}}  jpeg, png {{__('orderhistory.formatcanbeuploaded')}}</p>
                                                <p style="margin:0px; font-size: 11px;">2. {{__('orderhistory.eachfilesize')}} 10mb.</p>
                                              </div>
                                              {{-- <img id="photoUploadPreview" src="{{ empty($userData->photoPath) ? '#' : asset($userData->photoPath) }}"   style="max-width: 200px; max-height: 200px;" /> --}}

                                              @if ($userData->photoPath)
                                                <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                                    <tr>
                                                        <td>
                                                            <img id="photoUploadPreview" data-src="{{ empty($userData->photoPath) ? '#' : url('/').$userData->photoPath }}" alt="your image" class="lozad magnificPopup"  data-mfp-src="{{ empty($userData->photoPath) ? '#' : url('/').$userData->photoPath }}" 
                                                                style=" min-width: 50px !important; min-height: 50px !important; max-width: 100px !important; max-height: 100px !important;   border-radius: 0% !important; " />
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('useprofilepicDelete', $userData->id) }}" class=" tooltipster" title="Delete selected file?" >
                                                                <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>                                                
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row col-md-12">
                                      <label for="socialMedia" class="col-md-4 col-form-label text-md-right">
                                        {{ __('register.socialmedia') }} 
                                      </label>

                                      <div class="col-md-8">
                                          <input id="socialMedia" type="text" class="form-control{{ $errors->has('socialMedia') ? ' is-invalid' : '' }}" name="socialMedia"  value="{{ $userData->socialMedia }}">

                                          @if ($errors->has('socialMedia'))
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $errors->first('socialMedia') }}</strong>
                                              </span>
                                          @endif
                                      </div>
                                  </div>




                                    

                                    <div class="form-group row col-md-12">
                                        <div class="col-md-12 ">
                                            
                                            <button type="submit" class="btn btn-primary btn-lg" style="float: right;">
                                                {{__('register.save')}}
                                            </button>

                                            <a href="#" style="float: left; margin-right: 10px; padding: 0; " data-toggle="modal" data-target="#delecteaccountModal" >
                                              <button  class="btn  btn-link" style="color: red; font-weight: bold; text-decoration: underline;" >
                                                  {{__('register.deleteaccount')}}
                                              </button>
                                            </a>

                                        </div>
                                    </div>

                                  {{--   <div class="form-group row col-md-12">
                                        <label  class="col-md-4 col-form-label">Whatsapp </label>
                                        <label  class="col-md-8 col-form-label"> +880 1916 942 634</label>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label  class="col-md-4 col-form-label">Mobile </label>
                                        <label  class="col-md-8 col-form-label"> +880 1916 942 634</label>
                                    </div> --}}

                                </div>
                          </form>
                       



                    </div>
                </div>
            </div>












            



        </div>
    </div>
</div>





{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#countryId').select2({
      dropdownAutoWidth : true,
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
      dropdownAutoWidth : true,
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


<script type="text/javascript">
  $(window).on('load',function(){
      @if (session('profileUpdated'))
          $('#profileupdateModal').modal('show');
      @endif
  });



</script>

<div class="container" style="z-index: 10000000000000000000000">
  <div class="row">
      <div class="modal fade" id="profileupdateModal" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-body">
                    <div class="thank-you-pop">
                      <p > {{__('modals.profileupdateModalmsg')}}  </p>
                    </div>
                  </div>
        
              </div>
          </div>
      </div>
  </div>
</div>

<div class="container" style="z-index: 10000000000000000000000">
  <div class="row">
      <div class="modal fade" id="delecteaccountModal" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-body">
                    <div class="thank-you-pop">
                      <h2 > {{__('modals.delecteaccountModalmsg')}}  </h2>
                      <h5 class="text-danger"> {{__('modals.delecteaccountModalnote')}}  </h5>

                    </div>
                  </div>
                  <div class="modal-footer">
                        <div class="row">
                          <div class="col col-md-6">
                            <button  class="btn btn-success btn-lg"  data-dismiss="modal">
                                {{__('modals.delecteaccountModalnobutton')}}
                            </button>
                          </div>

                          <div class="col col-md-6">
                            <form  method="POST" enctype="multipart/form-data"  action="{{ app()->getLocale() ?  action('UserController_F@customerAccountDelete', array('lang'=>app()->getLocale() ) ) : action('UserController_F@customerAccountDelete', array('lang'=>app()->getLocale() ) ) }}" >
                              @csrf
                              <button type="submit"  class="btn btn-danger btn-lg"  >
                                  {{__('modals.delecteaccountModalyesbutton')}}
                              </button>
                            </form>
                          </div>
                        </div>
                  </div>
        
              </div>
          </div>
      </div>
  </div>
</div>

<link rel="stylesheet" href="{{ asset('frontend/css/thankyou.css') }}">


<script type="text/javascript">
  $(document).ready(function() {
      $("#photoPath").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          maxFileCount: 1,
          maxFileSize:1024*10,
          allowedFileExtensions: ["jpg","jpeg", "png"],
      });        
  });
</script>

@endsection
