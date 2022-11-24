@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Register')


{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


@section('page_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60" id="app" >
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            <h2 class="card-title" style="text-align: center;">{{ __('register.register') }} </h2>

             <h4 style="color: black; text-align: center;">( <span style="color: red;">*</span> {{ __('checkout.markedfieldsmandatory') }}  )</h4>
            {{-- <div class="card-title">Register</div> --}}

            <div class="row justify-content-center ">
                <div class="row col-md-12">
                    <div class="card row  col-md-12"  style=" margin-top: 25px;">

                        <div class="card-body">
                            <form class="form-horizontal" method="POST"  enctype="multipart/form-data"  action="{{ app()->getLocale() ?  action('UserController_F@customerRegistrationInsert', array(app()->getLocale() ) ) : action('UserController_F@customerRegistrationInsert', array(app()->getLocale() ) ) }}" aria-label="{{ __('register.register') }}" v-if="!isRegistrationUnderConstruction">

                              <div id="container">

                              </div>
                              <input type="text" name="_token" value="{{ csrf_token() }}" hidden />

                                <input type="text" name="ip" value="{{ Request::ip() }}" hidden>
                                <input type="text" name="website" value="{{ url('/') }}" hidden>
                                @if ( ! preg_match("/127.0/", Request::ip()) )
                                    <input type="text" name="countrybasedonip" value="{{   ( Location::get( Request::ip() ) )->countryName }}" hidden>
                                @endif

                                {{-- {{ dd(Location::get( )) }} --}}
                                <input type="text" name="userAgent" value="{{ Request:: userAgent()  }}" hidden>
                                <input type="number" name="isCustomer" value="1" hidden>

                                <div class="row col-md-8 col-md-offset-2">                                    

                                    <div class="form-group row col-md-12 required">
                                        <label for="name" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('checkout.firstlastname') }}                                               
                                        </label>

                                        <div class="col-md-8">
                                            <textarea id="name" name="name"  class="form-control"      rows="2" required style="resize: none;">{{ old('name') }}</textarea>

                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback  text-danger" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- <div class="form-group row col-md-12 ">
                                        <label for="name" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('checkout.name').' ('.__('checkout.inlocallanguage').')' }}                                     
                                        </label>

                                        <div class="col-md-8">
                                            <textarea id="nameLocalLang" name="nameLocalLang"  class="form-control"      rows="2" >{{ old('nameLocalLang') }}</textarea>
                                            @if ($errors->has('nameLocalLang'))
                                                <span class="invalid-feedback  text-danger" role="alert">
                                                    <strong>{{ $errors->first('nameLocalLang') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> --}}

                                    <div class="form-group row col-md-12 required">
                                        <label for="email" class="col-md-4 col-form-label text-md-right control-label">
                                         {{ __('register.email') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autocomplete="new email" v-model="email">
                                            

                                            {{--  <i class="fa fa-check text-success" v-if="isMailValid && !emailCheckProcessing"> Valid Email</i>
                                            <span class="invalid-feedback text-danger" role="alert" v-if="!isMailValid && !emailCheckProcessing"> <strong>Enter A Valid Email</strong>   </span>
                                            <i class="fa fa-refresh  fa-spin text-danger" v-if="emailCheckProcessing"></i>  --}}


                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row col-md-12 required">
                                        <label for="password" class="col-md-4 col-form-label text-md-right  control-label">
                                          {{ __('register.password') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                            <span style="color: red; font-size: 10px;">{{__('register.hint')}} : {{__('register.pass6charlong')}}</span>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback  text-danger" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row col-md-12 required">
                                        <label for="confirmpassword" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('register.confirmpassword') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input id="confirmpassword" type="password" class="form-control{{ $errors->has('confirmpassword') ? ' is-invalid' : '' }}" name="confirmpassword" required>

                                            @if ($errors->has('confirmpassword'))
                                                <span class="invalid-feedback  text-danger" role="alert">
                                                    <strong>{{ $errors->first('confirmpassword') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>




                                    <div class="form-group row col-md-12 required">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right  control-label">
                                          {{ __('register.phone') }} 
                                        </label>

                                        <div class="col-md-8">

                                             <div class="col-md-6">
                                              
                                               <select class="form-control m-bot15" id="phoneCode" name="phoneCode" required style="width:100%;">
                                                    @if (old('phoneCode') != null )
                                                      <option  value="{{ old('phoneCode') }}" selected="">
                                                        {{ old('phoneCode').' ('.$countryData->where('phoneCode', substr(old('phoneCode'), 1) )->pluck('country')->first().')' }}
                                                      </option>
                                                    @endif
                                                    <option value="">--Select Phone Code--</option>
                                                    @foreach($countryData->sortBy('country') as $country)
                                                        <option value="{{ '+'.$country->phoneCode }}">
                                                          {{ '+'.$country->phoneCode.' ('.$country->country.')'  }}
                                                        </option> 
                                                    @endforeach   
                                                </select>
                                             </div>
                                             <div class="col-md-6">
                                                <input type="tel" id="phone" type="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback  text-danger" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                             </div>

                                          

                                            
                                        </div>
                                    </div>


                                    {{-- <div class="form-group row col-md-12 required">
                                        <label for="cityTownDivision" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('register.city') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <textarea id="cityTownDivision" name="cityTownDivision"  class="form-control"     rows="2" required>{{ old('cityTownDivision') }}</textarea>

                                            @if ($errors->has('cityTownDivision'))
                                                <span class="invalid-feedback  text-danger" role="alert">
                                                    <strong>{{ $errors->first('cityTownDivision') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> --}}

                                    {{-- <div class="form-group row col-md-12 required">
                                        <label for="streethouse" class="col-md-4 col-form-label text-md-right  control-label">
                                          {{ __('register.housestreetinfo') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <textarea id="streethouse" name="streethouse"  class="form-control"     rows="2" required>{{ old('streethouse') }}</textarea>

                                            @if ($errors->has('streethouse'))
                                                <span class="invalid-feedback  text-danger" role="alert">
                                                    <strong>{{ $errors->first('streethouse') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> --}}


                                    {{-- <div class="form-group row col-md-12 required">
                                        <label for="postalCode" class="col-md-4 col-form-label text-md-right control-label">
                                          {{ __('register.postcode') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input id="postalCode" type="number" class="form-control{{ $errors->has('postalCode') ? ' is-invalid' : '' }}" name="postalCode" required  value="{{ old('postalCode') }}" >

                                            @if ($errors->has('postalCode'))
                                                <span class="invalid-feedback  text-danger" role="alert">
                                                    <strong>{{ $errors->first('postalCode') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div> --}}


                                    <div class="form-group row col-md-12 required">
                                        <label for="countryId" class="col-md-4 col-form-label text-md-right  control-label">
                                          {{ __('register.country') }} 
                                        </label>

                                        <div class="col-md-8">
                                            <select class="form-control m-bot15" name="countryId" id="countryId" required >

                                              @if (old('countryId') != null )
                                                <option  value="{{ old('countryId') }}">{{ $countryData->where('countryId', old('countryId'))->pluck('country')->first() }}</option>
                                              @endif

                                                <option  value="">--Select Country--</option>
                                                @foreach($countryData->sortBy('country') as $country)
                                                    <option value="{{ $country->countryId }}">
                                                      {{ title_case($country->country)}}
                                                    </option> 
                                                @endforeach   
                                            </select>


                                            @if ($errors->has('countryId'))
                                                <span class="invalid-feedback  text-danger" role="alert">
                                                    <strong>{{ $errors->first('countryId') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    {{-- <div class="form-group row col-md-12">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">
                                          {{ __('register.photo').' ('.__('register.optional').')' }} 
                                        </label>

                                        <div class="col-md-8">
                                            <input type="file" name="photoPath" value="photoPath" class="form-control" placeholder="photoPath"   id="photoUploadInput"    style="margin-bottom: 10px; padding-bottom: 40px;">
                                              @if ($errors->has('photoPath'))
                                                  <span class="invalid-feedback  text-danger" role="alert">
                                                      <strong>{{ $errors->first('photoPath') }}</strong>
                                                  </span>
                                              @endif
                                              <img id="photoUploadPreview"    style="max-width: 200px; max-height: 200px;" />
                                        </div>
                                    </div> --}}


                                    <div class="form-group row col-md-12 required">
                                        <label  class="col-md-4 col-form-label  control-label   col-xs-12" >{{ __('productdetails.captcha') }}</label>
                                         <div class="col-md-2 col-xs-3"> <input type="number" id="num1" name="cn1" class="form-control" readonly v-model="num1"> </div>
                                         <label  class="col-md-1 col-form-label  col-xs-1 " >+</label>
                                         <div class="col-md-2 col-xs-3"> <input type="number" id="num2" name="cn2" class="form-control" readonly  v-model="num2"> </div>
                                         <label  class="col-md-1 col-form-label   col-xs-1" >=</label>
                                         <div class="col-md-2 col-xs-3"> <input type="number" id="result" name="cn3" class="form-control" title="Please enter summation of 2 numbers" required v-model="sum"> </div>
                                    </div>


                                    <div class="row col-md-12 col-sm-10 col-xs-10" style="margin-top: 30px; " id="byclick">

                                      <div class="form-group">
                                         <div class="form-check">
                                           <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" checked >
                                           <label class="form-check-label" for="invalidCheck2" style="color: red;" id="byclick-label">
                                             {{ __('checkout.byclick') }}  
                                             <u><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),1 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),1 ) ) }}" target="_blank" style="padding: 0 px; color: red !important; float: none;">{{  __('checkout.termsconditions')}}</a></u>
                                              {{ __('checkout.and') }} 
                                              {{-- <u><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),2 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),2 ) ) }}" target="_blank" style="padding: 0 px; color: red !important; float: none;">{{  __('checkout.deliverymethod')}}</a></u> {{ __('checkout.and') }}  --}}
                                              {{-- <u><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),3 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),3 ) ) }}" target="_blank" style="padding: 0 px; color: red !important; float: none;">{{  __('checkout.paymentmethodUPPER')}}</a></u>  +  --}}
                                              <u><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),7 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),7 ) ) }}" target="_blank" style="padding: 0 px; color: red !important; float: none;">{{ __('checkout.privacypolicy') }}</a></u>
                                           </label>
                                         </div>
                                       </div>
                           
                                   </div>


                                  




                                    

                                    <div class="form-group row col-md-12" id="customerregistration-holder">
                                        <div class="col-md-12 ">
                                            <button id="customerregistration" type="submit" class="btn btn-primary btn-lg" style="float: right;"  :disabled="!isFormValidToSubmit">
                                                {{ __('register.register') }}
                                            </button>
                                        </div>
                                    </div>


                                   




                                  

                                   {{--  <div class="form-group row col-md-12">
                                        <label  class="col-md-4 col-form-label">Whatsapp </label>
                                        <label  class="col-md-8 col-form-label"> +880 1916 942 634</label>
                                    </div>
                                    <div class="form-group row col-md-12">
                                        <label  class="col-md-4 col-form-label">Mobile </label>
                                        <label  class="col-md-8 col-form-label"> +880 1916 942 634</label>
                                    </div> --}}

                                </div>
                            </form>

                            <h1 v-if="isRegistrationUnderConstruction" class="text-center">
                              Under construction
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            
            

        </div>
    </div>
</div>





@if ( preg_match("/127.0/", Request::ip()) )
  <script src="{{ asset('js/vue.js') }}"></script>
@else
  <script src="{{ asset('js/vue.min.js') }}"></script>
@endif


<script src="{{ asset('js/axios.min.js') }}"></script>





{{-- select 2 script --}}
{{-- select 2 script --}}
<script >

  function called()
  {
    console.log("============called==========")
  }
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




<style>
  @media (max-width: 991px) {
    #byclick{
      position: absolute !important;
    }

    #customerregistration-holder{
      margin-top: 88px !important;
    }
  }

  @media (max-width: 767px) {
    #byclick{
      margin-left: 20px !important;
      
    }
    #byclick-label{
      font-size: 11px;
    }
  }
</style>












<script>

  var _this = this
  
  var app = new Vue({
    el: '#app',
    data: {
      num1: Math.floor((Math.random() * 99) + 1),
      num2: Math.floor((Math.random() * 9) + 1),
      sum: null,

      email: "",

      isMailValid: false,
      isMailFormatOk: false,
      domainrecordsCount:0,
      emailCheckProcessing: false,


      isCaptchaSuccess: false,

      isRegistrationUnderConstruction: false,
      current_year: 0,
      todayDateYmd: '',
      dayNumber:0,

    },
    methods: {

        mailCheckRequest(email){
          var _this = this

          this.emailCheckProcessing = true

          axios.get('/api/mailValidationChecking/'+email)
          .then(function (response) {
            _this.emailCheckProcessing = false

            var data = response.data
            _this.domainrecordsCount = data.domainrecordsCount;

            if (parseInt(_this.domainrecordsCount)>0) {
              _this.isMailValid = true
              console.log("_this.isMailValid")
            }

          })
          .catch(function (error) {
            _this.emailCheckProcessing = false

            _this.domainrecordsCount = 0;
            _this.isMailValid = false
          })
        },

        mailFormatChecker(mail){
            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(mail))
            {
              return (true)
            }
              return (false)
        },

        addField(){
            var container = document.getElementById("container");


            var input = document.createElement("input");
            input.type = "number";
            input.name = "isFormValidToSubmit";
            input.setAttribute("value", 1234)
            input.setAttribute("hidden", true)
            container.appendChild(input);


            var input2 = document.createElement("input");
            input2.type = "string";
            input2.name = "td";
            var todaydate = this.todayDateYmd 
            input2.setAttribute("value", todaydate)
            input2.setAttribute("hidden", true)
            container.appendChild(input2);

            var input3 = document.createElement("input");
            input3.type = "number";
            var dayNumber = this.dayNumber 
            input3.name = "tddn_"+dayNumber;
            input3.setAttribute("value", dayNumber)
            input3.setAttribute("hidden", true)
            container.appendChild(input3);

        },


        removeField(){
          var container = document.getElementById("container");
          container.innerHTML=""
        },

        currentYear(){
          this.current_year = new Date().getFullYear();
        },

        getTodayDateYmd(){
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd ;
            this.todayDateYmd= today
        },

        getTodayDayNumberOfCurrentYear(){
            var now = new Date();
            var start = new Date(now.getFullYear(), 0, 0);
            var diff = now - start;
            var oneDay = 1000 * 60 * 60 * 24;
            var day = Math.floor(diff / oneDay);

            this.dayNumber = day;
        },

    },
    computed: {
      isSumValid: { 
        get: function() {
          return (parseInt(this.num1)+parseInt(this.num2)) == parseInt(this.sum || 0);
        }
      },

      isFormValidToSubmit: { 
        get: function() {
          // return this.isMailValid && this.isSumValid && this.isCaptchaSuccess;
          return this.isSumValid && this.isMailFormatOk;
        }
      },

      isOkToContinue: { 
        get: function() {
          return this.isMailValid && this.isSumValid ;
        }
      },


    },

    watch: {
      email(val){
          this.isMailFormatOk = this.mailFormatChecker(val)
          if (this.isMailFormatOk) {
            this.mailCheckRequest(this.email)
          }
          else{
            this.isMailValid = false
          }
      },
      isFormValidToSubmit(val){
          
          if (this.isFormValidToSubmit) {
            this.addField()
          }
          else{
            this.removeField()
          }
          
      }
    },
    mounted() {
      this.currentYear()
      this.getTodayDateYmd()
      this.getTodayDayNumberOfCurrentYear()
    },

  })
</script>



@endsection
