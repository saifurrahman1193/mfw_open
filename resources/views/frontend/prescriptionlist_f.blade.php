@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Prescriptions')


{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@section('page_content')

<div class="clearfix"></div>

 <div class="container text-success" id="path-section" style="padding-top: 50px; font-weight: bold;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ app()->getLocale()?action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}">{{ __('header.Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('header.prescriptions') }}</li>
      </ol>
    </nav>

</div>


{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-30">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            
            {{-- <div class="card-title">Register</div> --}}
            
            <div class="content-wrapper" style="min-height: 0px;" id="prescriptiontable">

                <h3 class="card-title padd-30" style="text-align: center; font-weight: bold;">{{ __('prescription.addprescription') }}</h3>
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST"  enctype="multipart/form-data"  action="{{ route('customerPrescriptionInsert', app()->getLocale()) }}" >
                            @csrf

                            <div class="row col-md-12">
                                

                                <input type="number" name="inquirerId" value="{{ Auth::user()->id }}" hidden readonly>

                                <div class="form-group row col-md-12 required">
                                    <label for="prescriptionPath" class="col-md-2 col-form-label text-md-right control-label">{{ __('prescription.prescriptionimage') }}</label>

                                    <div class="col-md-10">
                                        <input id="prescriptionPath" name="prescriptionPath[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true" required>
                                        <div>
                                          <p style="margin:0px;"><strong>{{__('orderhistory.note')}}:</strong> </p>
                                          <p style="margin:0px;">1. {{__('orderhistory.only')}} pdf, jpeg, png, doc {{__('orderhistory.formatcanbeuploaded')}}</p>
                                          <p style="margin:0px;">2. {{__('orderhistory.maximum')}} 8 {{__('orderhistory.filescanbeuploadedatatime')}}</p>
                                          <p style="margin:0px;">3. {{__('orderhistory.eachfilesize')}} 10mb.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row col-md-12 ">
                                    <label for="name" class="col-md-2 col-form-label text-md-right control-label">
                                      {{ __('prescription.message') }}                                          
                                    </label>

                                    <div class="col-md-10">
                                        <textarea id="message" name="message"  class="form-control"      rows="2"  ></textarea>
                                    </div>
                                </div>


                                <div class="form-group row col-md-12 required">
                                    <label for="genericBrandName" class="col-md-2 col-form-label text-md-right control-label" >{{ __('prescription.packinfo') }}</label>

                                      <div class="col-md-10">
                                        <select class="form-control m-bot15" name="genericPackSizeId" id="genericPackSizeId" required >
                                            <option  value="">--{{ __('prescription.selectpackinfo') }}--</option>
                                            @foreach($genericpacksizesData->sortBy('genericbrand') as $genericpacksize)
                                                <option value="{{ $genericpacksize->genericPackSizeId }}">
                                                  
                                                  @if (app()->getLocale()=='en')
                                                      {{ $genericpacksize->genericBrand.' ('.$genericpacksize->genericName.' '.$genericpacksize->genericStrength.'), '.$genericpacksize->genericPackSize.'\'s '. $genericpacksize->packType.' | '.$genericpacksize->dosageForm.' | '.$genericpacksize->genericCompany }}
                                                  @elseif (app()->getLocale()=='ru')
                                                      {{ $genericpacksize->genericBrandRU.' ('.$genericpacksize->genericNameRU.' '.$genericpacksize->genericStrengthRU.'), '.$genericpacksize->genericPackSize.'\'s '. $genericpacksize->packTypeRU.' | '.$genericpacksize->dosageFormRU.' | '.$genericpacksize->genericCompanyRU }}
                                                  @elseif (app()->getLocale()=='cn')
                                                      {{ $genericpacksize->genericBrandCN.' ('.$genericpacksize->genericNameCN.' '.$genericpacksize->genericStrengthCN.'), '.$genericpacksize->genericPackSize.'\'s '. $genericpacksize->packTypeCN.' | '.$genericpacksize->dosageFormCN.' | '.$genericpacksize->genericCompanyCN }}
                                                  @endif

                                                </option> 
                                            @endforeach   
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row col-md-12 " style=" margin-bottom: 20px;">
                                    <div class="col-md-12 ">
                                        <button type="submit" class="btn btn-success btn-lg "  id="addPrescription">{{ __('prescription.addprescription') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            {{-- Prescription table --}}
            {{-- Prescription table --}}
            <div class="content-wrapper" style="min-height: 0px;" id="prescriptiontable">
              <div class="card">
                <div class="card-body">



                    {{-- <a href="#"  class="btn btn-success " style="margin-bottom: 10px; " data-toggle="modal" data-target="#prescriptionSaveConfirmationModal" ><span><h5>+ Add prescription</h5></span></a> --}}

                    {{-- data table start --}}
                    {{-- data table start --}}
                    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " style="width: 100%;">

                        <caption class="text-center font-weight-bold text-success">{{ __('prescription.prescription') }}</caption>

                          <thead>
                              <tr class="bg-success text-success">
                                  <th scope="col">{{ __('prescription.serial') }}</th>
                                  <th scope="col">{{ __('prescription.prescriptions') }}</th>
                                  <th scope="col">{{ __('prescription.medicine') }}</th>
                                  <th scope="col">{{ __('prescription.originator') }}</th>
                                  <th scope="col">{{ __('prescription.message') }}</th>
                                  <th scope="col">{{ __('prescription.datetime') }}</th>
                              </tr>
                          </thead>
                          
                          <tbody>
                               @foreach ($usergenericinquiryData->sortByDesc('created_at') as $usergenericinquiry)
                                  <tr>
                                      <td>
                                        {{$loop->index+1}}
                                      </td>
                                      <td>
                                        @isset($usergenericinquiry->prescriptionPath)
                                          <a href="{{asset($usergenericinquiry->prescriptionPath)}}" target="_blank" style="text-decoration: underline;" >{{ __('prescription.clicktoopenfile') }}</a> 
                                        @endisset
                                      </td>
                                      <td>
                                          @if (app()->getLocale()=='en')
                                              {{ $usergenericinquiry->genericBrand.' ('.$usergenericinquiry->genericName.' '.$usergenericinquiry->genericStrength.'), '.$usergenericinquiry->genericPackSize.'\'s '. $usergenericinquiry->packType.' | '.$usergenericinquiry->dosageForm.' | '.$usergenericinquiry->genericCompany }}
                                          @elseif (app()->getLocale()=='ru')
                                              {{ $usergenericinquiry->genericBrandRU.' ('.$usergenericinquiry->genericNameCN.' '.$usergenericinquiry->genericStrengthRU.'), '.$usergenericinquiry->genericPackSize.'\'s '. $usergenericinquiry->packTypeRU.' | '.$usergenericinquiry->dosageFormRU.' | '.$usergenericinquiry->genericCompanyRU }}
                                          @elseif (app()->getLocale()=='cn')
                                              {{ $usergenericinquiry->genericBrandCN.' ('.$usergenericinquiry->genericNameRU.' '.$usergenericinquiry->genericStrengthCN.'), '.$usergenericinquiry->genericPackSize.'\'s '. $usergenericinquiry->packTypeCN.' | '.$usergenericinquiry->dosageFormCN.' | '.$usergenericinquiry->genericCompanyCN }}
                                          @endif
                                        
                                      </td>
                                      

                                      <td>
                                        @if (app()->getLocale()=='en')
                                            {{ $usergenericinquiry->globalTradeNameCompany }}
                                        @elseif (app()->getLocale()=='ru')
                                            {{ $usergenericinquiry->globalTradeNameCompanyRU }}
                                        @elseif (app()->getLocale()=='cn')
                                            {{ $usergenericinquiry->globalTradeNameCompanyCN }}
                                        @endif
                                      </td>

                                      <td>
                                        {{ $usergenericinquiry->message }}
                                      </td>


                                      <td>
                                            {{   \Carbon\Carbon::parse($usergenericinquiry->created_at)->format('d-m-Y g:i A') }}
                                      </td>
                                      
                                  </tr>
                                @endforeach
                          </tbody>
                      </table>

                </div>
              </div>
            </div>
            {{-- Prescription table --}}
            {{-- Prescription table --}}







            



        </div>
    </div>
</div>




{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#genericPackSizeId').select2({
        placeholder: {
          id: '12', // the value of the option
          text: '--{{ __("prescription.selectpackinfo") }}--'
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
  $(document).ready(function() {
      $("#prescriptionPath").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          maxFileCount: 8,
          maxFileSize:1024*10,
          allowedFileExtensions: ["jpg","jpeg", "png", "pdf", "doc"],
      });        
  });
</script>


<script type="text/javascript">
	$(window).on('load',function(){
      @if (session('prescriptionUploaded'))
            $('#prescriptionUploadedModal').modal('show');
      @endif
    });
</script>

<div class="container" style="z-index: 10000000000000000000000">
  <div class="row">
      {{-- <a class="btn btn-primary" data-toggle="modal" href="#prescriptionUploadedModal">open Popup</a> --}}
      <div class="modal fade" id="prescriptionUploadedModal" role="dialog">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h3 class="text-center  text-success">{{__('modals.prescriptionUploadedModaltitlemsg')}}</h3>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


@endsection
