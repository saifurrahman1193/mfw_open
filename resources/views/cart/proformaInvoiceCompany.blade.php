<!DOCTYPE html>


@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Proforma Invoice Settings')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 






@section('page_content')



<script type="text/javascript">

    $(function(){

        $('#proformaCompanyUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var proformaCompanyId = button.data('proformacompanyid') ;
              var companyAlias = button.data('companyalias') ;
              var company = button.data('company') ;
              var address = button.data('address') ;
              var phone = button.data('phone') ;
              var email = button.data('email') ;
              var web = button.data('web') ;
              var paymentAccDetailsIsVisible = button.data('paymentaccdetailsisvisible') ;
              var logo = button.data('logo') ;
              var signature = button.data('signature') ;
              var seal = button.data('seal') ;
              var watermarkLogo = button.data('watermarklogo') ;
              var footerBackground = button.data('footerbackground') ;


              var modal = $(this);
              modal.find('.modal-body #proformaCompanyId').val(proformaCompanyId);
              modal.find('.modal-body #companyAlias').val(companyAlias);
              modal.find('.modal-body #company').val(company);
              modal.find('.modal-body #address').val(address);
              modal.find('.modal-body #phone').val(phone);
              modal.find('.modal-body #email').val(email);
              modal.find('.modal-body #web').val(web);
              modal.find('.modal-body #paymentAccDetailsIsVisible').val(paymentAccDetailsIsVisible);
              modal.find('.modal-body #logoUpdateUploadPreview').attr("src", "");
              modal.find('.modal-body #signatureUpdateUploadPreview').attr("src", "");
              modal.find('.modal-body #sealUpdateUploadPreview').attr("src", "");
              modal.find('.modal-body #watermarkLogoUpdateUploadPreview').attr("src", "");
              modal.find('.modal-body #footerBackgroundUpdateUploadPreview').attr("src", "");

              if (logo.length>5) {
                  modal.find('.modal-body #logoUpdateUploadPreview').attr("src", logo)
              }
              if (signature.length>5) {
                  modal.find('.modal-body #signatureUpdateUploadPreview').attr("src", signature)
              }
              if (seal.length>5) {
                  modal.find('.modal-body #sealUpdateUploadPreview').attr("src", seal)
              }

              if (watermarkLogo.length>5) {
                  modal.find('.modal-body #watermarkLogoUpdateUploadPreview').attr("src", watermarkLogo)
              }
              if (footerBackground.length>5) {
                  modal.find('.modal-body #footerBackgroundUpdateUploadPreview').attr("src", footerBackground)
              }
              
        });

    });
</script>




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

                <h4 class="card-title" style="text-align: center;">Proforma Invoice Company</h4>

                <form class="form-sample" id="slider_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('proformaInvoiceCompanyInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                    {{ csrf_field() }}

                    <br>
                    <p class="card-description">
                    {{-- Personal info --}}
                    </p>
                    

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row required">
                                <label  for="companyAlias"  class="col-sm-4 col-form-label control-label">Company Alias</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control "  rows="4" id="companyAlias" name="companyAlias"  required> </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row required">
                                <label  for="company"  class="col-sm-4 col-form-label control-label">Company</label>
                                <div class="col-sm-8">
                                    {{-- <input type="text" name="company" id="company" class="form-control"  placeholder="" required> --}}
                                    <textarea class="form-control "  rows="4" id="company" name="company"  required> </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row required">
                            <label  for="phone"  class="col-sm-4 col-form-label control-label">Phone</label>
                            <div class="col-sm-8">
                                {{-- <input type="text" name="phone" id="phone" class="form-control"  placeholder=""required> --}}
                                <textarea class="form-control "  rows="4" id="phone" name="phone"  required> </textarea>
                            </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row required">
                                <label  for="address"  class="col-sm-4 col-form-label control-label">Address (HTML)</label>
                                <div class="col-sm-8">
                                <textarea class="form-control tinymce-editor"  rows="4" id="address" name="address"  required> </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row  required">
                            <label  for="email"  class="col-sm-4 col-form-label control-label">Email (HTML)</label>
                            <div class="col-sm-8">
                                {{-- <input type="text" name="email" id="email" class="form-control"  placeholder="" required> --}}
                                <textarea class="form-control tinymce-editor"  rows="4" id="email" name="email"  required> </textarea>
                            </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row ">
                                <label  for="web"  class="col-sm-4 col-form-label control-label">Web (HTML)</label>
                                <div class="col-sm-8">
                                    {{-- <input type="text" name="web" id="web" class="form-control"  placeholder=""> --}}
                                    <textarea class="form-control tinymce-editor"  rows="4" id="web" name="web"  > </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row ">
                            <label  for="paymentAccDetailsIsVisible"  class="col-sm-4 col-form-label control-label">Payment Account Details Is Visible ?</label>
                            <div class="col-sm-8">
                                <select class="form-control m-bot15" name="paymentAccDetailsIsVisible" id="paymentAccDetailsIsVisible" required >
                                    <option value="0">Hide</option>
                                    <option value="1">Show</option>
                                </select>
                            </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                    
                        <div class="col-md-6">
                            <div class="form-group row " >
                            <label  for="logo"  class="col-sm-4 col-form-label control-label">Logo</label>
                            <div class="col-sm-8">
                                <input type="file" name="logo" value="logo" class="form-control" placeholder="logo"   id="logoUploadInput" >
                                @if ($errors->has('logo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                                <img id="logoUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                            </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row " >
                                <label  for="signature"  class="col-sm-4 col-form-label control-label">Signature</label>
                                <div class="col-sm-8">
                                    <input type="file" name="signature" value="signature" class="form-control" placeholder="signature"   id="signatureUploadInput" >
                                    @if ($errors->has('signature'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('signature') }}</strong>
                                        </span>
                                    @endif
                                    <img id="signatureUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row " >
                            <label  for="seal"  class="col-sm-4 col-form-label control-label">Seal</label>
                            <div class="col-sm-8">
                                <input type="file" name="seal" value="seal" class="form-control" placeholder="seal"   id="sealUploadInput" >
                                @if ($errors->has('seal'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('seal') }}</strong>
                                    </span>
                                @endif
                                <img id="sealUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                            </div>
                            </div>
                        </div>
                        
                    </div>



                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group row " >
                            <label  for="watermarkLogo"  class="col-sm-4 col-form-label control-label">Watermark Logo</label>
                            <div class="col-sm-8">
                                <input type="file" name="watermarkLogo" value="watermarkLogo" class="form-control" placeholder="watermarkLogo"   id="watermarkLogoUploadInput" >
                                @if ($errors->has('watermarkLogo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('watermarkLogo') }}</strong>
                                    </span>
                                @endif
                                <img id="watermarkLogoUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                            </div>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-group row " >
                            <label  for="footerBackground"  class="col-sm-4 col-form-label control-label">Footer Background</label>
                            <div class="col-sm-8">
                                <input type="file" name="footerBackground" value="footerBackground" class="form-control" placeholder="footerBackground"   id="footerBackgroundUploadInput" >
                                @if ($errors->has('footerBackground'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('footerBackground') }}</strong>
                                    </span>
                                @endif
                                <img id="footerBackgroundUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                            </div>
                            </div>
                        </div>
                        
    
                    </div>



                    <div class="col-md-12 text-center mt-4">
                        <input type="submit" class="btn btn-success mr-2"  value="Save">
                    </div>


                </form>


            </div>
        </div>





        <div class="card">
            <div class="card-body">

                <h4 class="card-title" style="text-align: center;">Company List</h4>

                <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
                    <thead>
                        <tr class="bg-primary text-light">
                            <th scope="col">Company Id</th>
                            <th scope="col">Company Alias</th>
                            <th scope="col">Company</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Address</th>
                            <th scope="col">Email</th>
                            <th scope="col">Web</th>
                            <th scope="col">Payment Acc Details Visibility</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Signature</th>
                            <th scope="col">Seal</th>
                            <th scope="col">Watermark Logo</th>
                            <th scope="col">Footer Background</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($proformacompanyData as $proformacompany)
                            <tr>
                                
                                <td>{{$proformacompany->proformaCompanyId}}</td>
                                <td>{{$proformacompany->companyAlias}}</td>
                                <td>{{$proformacompany->company}}</td>
                                <td>{{$proformacompany->phone}}</td>
                                <td>{{$proformacompany->address}}</td>
                                <td>{{$proformacompany->email}}</td>
                                <td>{{$proformacompany->web}}</td>
                                <td class="{{ $proformacompany->paymentAccDetailsIsVisible==1 ? 'text-success': 'text-danger'}} font-weight-bold">{{ $proformacompany->paymentAccDetailsIsVisible==1 ? "Show" : "Hide" }}</td>
                                <td>

                                    @if ($proformacompany->logo)
                                        <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2 ">
                                            <tr class="bg-transparent">
                                                <td>
                                                    <img  data-src="{{ empty($proformacompany->logo) ? '#' : url('/').$proformacompany->logo }}" alt="your image" class="lozad magnificPopup"  data-mfp-src="{{ empty($proformacompany->logo) ? '#' : url('/').$proformacompany->logo }}" 
                                                        style=" min-width: 50px !important; min-height: 50px !important; max-width: 100px !important; max-height: 100px !important;   border-radius: 0% !important; " />
                                                </td>
                                                <td>
                                                    <a href="{{ route('proformacompanylogoDelete', $proformacompany->proformaCompanyId) }}" class=" tooltipster" title="Delete selected file?" >
                                                        <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>                                                
                                    @endif
                                    
                                </td>

                                <td>
                                    @if ($proformacompany->signature)
                                        <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                            <tr class="bg-transparent">
                                                <td>
                                                    <img  data-src="{{ empty($proformacompany->signature) ? '#' : url('/').$proformacompany->signature }}" alt="your image" class="lozad magnificPopup"  data-mfp-src="{{ empty($proformacompany->signature) ? '#' : url('/').$proformacompany->signature }}" 
                                                        style=" min-width: 50px !important; min-height: 50px !important; max-width: 100px !important; max-height: 100px !important;   border-radius: 0% !important; " />
                                                </td>
                                                <td>
                                                    <a href="{{ route('proformacompanysignatureDelete', $proformacompany->proformaCompanyId) }}" class=" tooltipster" title="Delete selected file?" >
                                                        <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>                                                
                                    @endif
                                </td>

                                <td>
                                    @if ($proformacompany->seal)
                                        <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                            <tr class="bg-transparent">
                                                <td>
                                                    <img  data-src="{{ empty($proformacompany->seal) ? '#' : url('/').$proformacompany->seal }}" alt="your image" class="lozad magnificPopup"  data-mfp-src="{{ empty($proformacompany->seal) ? '#' : url('/').$proformacompany->seal }}" 
                                                        style=" min-width: 50px !important; min-height: 50px !important; max-width: 100px !important; max-height: 100px !important;   border-radius: 0% !important; " />
                                                </td>
                                                <td>
                                                    <a href="{{ route('proformacompanysealDelete', $proformacompany->proformaCompanyId) }}" class=" tooltipster" title="Delete selected file?" >
                                                        <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>                                                
                                    @endif
                                </td>


                                <td>
                                    

                                    @if ($proformacompany->watermarkLogo)
                                        <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                            <tr class="bg-transparent">
                                                <td>
                                                    <img  data-src="{{ empty($proformacompany->watermarkLogo) ? '#' : url('/').$proformacompany->watermarkLogo }}" alt="your image" class="lozad magnificPopup"  data-mfp-src="{{ empty($proformacompany->watermarkLogo) ? '#' : url('/').$proformacompany->watermarkLogo }}" 
                                                        style=" min-width: 50px !important; min-height: 50px !important; max-width: 100px !important; max-height: 100px !important;   border-radius: 0% !important; " />
                                                </td>
                                                <td>
                                                    <a href="{{ route('proformacompanywatermarkLogoDelete', $proformacompany->proformaCompanyId) }}" class=" tooltipster" title="Delete selected file?" >
                                                        <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>                                                
                                    @endif
                                </td>

                                <td>
                                    @if ($proformacompany->footerBackground)
                                        <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                            <tr class="bg-transparent">
                                                <td>
                                                    <img  data-src="{{ empty($proformacompany->footerBackground) ? '#' : url('/').$proformacompany->footerBackground }}" alt="your image" class="lozad magnificPopup"  data-mfp-src="{{ empty($proformacompany->footerBackground) ? '#' : url('/').$proformacompany->footerBackground }}" 
                                                        style=" min-width: 50px !important; min-height: 50px !important; max-width: 100px !important; max-height: 100px !important;   border-radius: 0% !important; " />
                                                </td>
                                                <td>
                                                    <a href="{{ route('proformacompanyfooterBackgroundDelete', $proformacompany->proformaCompanyId) }}" class=" tooltipster" title="Delete selected file?" >
                                                        <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>                                                
                                    @endif
                                </td>
                              
                                <td id="tdtableaction">
                            
                                    
                                    <table>
                                        <tr  class="bg-transparent">
                                            <td>
                                                    <a role="button" href="#"   data-toggle="modal" data-target="#proformaCompanyUpdateModal"  
            
                                                    data-proformacompanyid='{{ $proformacompany->proformaCompanyId }}' 
                                                    data-companyalias='{{ $proformacompany->companyAlias }}' 
                                                    data-company='{{ $proformacompany->company }}' 
                                                    data-address='{{ $proformacompany->address }}' 
                                                    data-phone='{{ $proformacompany->phone }}' 
                                                    data-email='{{ $proformacompany->email }}' 
                                                    data-web='{{ $proformacompany->web }}' 
                                                    data-paymentaccdetailsisvisible='{{ $proformacompany->paymentAccDetailsIsVisible }}' 
                                                    data-logo='{{ $proformacompany->logo }}' 
                                                    data-signature='{{ $proformacompany->signature }}' 
                                                    data-seal='{{ $proformacompany->seal }}' 
                                                    data-watermarklogo='{{ $proformacompany->watermarkLogo }}' 
                                                    data-footerbackground='{{ $proformacompany->footerBackground }}' 
            
                                                    ><i class="fa fa-edit tooltipster" title="Edit Record?" style="font-size:25px;"></i></a>
                                            </td>
                                            <td>
                                                    @if ($proformacompany->isProformacompanyUsed==0)
                                                        <form  method="post" action="{{ route('proformaInvoiceCompanyDelete', $proformacompany->proformaCompanyId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
                                                            {{ csrf_field() }}
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <a>
                                                                    <button type="submit" value="DELETE" class="btn btn-link" >
                                                                        <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                                                    </button>
                                                                </a>
                                                        </form>
                                                    @endif
                                            </td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        @endforeach

                        
                    </tbody>
                </table>

            </div>
        </div>


</div>





<div class="content-wrapper" style="min-height: 0px;">

    <div class="card">
        <div class="card-body">

            <h4 class="card-title text-center">Proforma Invoice Common Settings</h4>


            <form class="form-sample"  method="POST" enctype="multipart/form-data" action="{{ route('proformaInvoiceCommonSettingsSave') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                {{ csrf_field() }}

                <br>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label  for="officeContactTitle"  class="col-sm-4 col-form-label control-label">Office Contact Title</label>
                            <div class="col-sm-8">
                            <input type="text" name="officeContactTitle" id="officeContactTitle" class="form-control"  placeholder="" required value="{{ $proformainvoicecommonsettingsData->officeContactTitle }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row required">
                        <label  for="proformaInvoiceTitle"  class="col-sm-4 col-form-label control-label">Proforma Invoice Title</label>
                        <div class="col-sm-8">
                            <input type="text" name="proformaInvoiceTitle" id="proformaInvoiceTitle" class="form-control"  placeholder=""required value="{{ $proformainvoicecommonsettingsData->proformaInvoiceTitle }}">
                        </div>
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label  for="consigneeTitle"  class="col-sm-4 col-form-label control-label">Consignee Title</label>
                            <div class="col-sm-8">
                            <input type="text" name="consigneeTitle" id="consigneeTitle" class="form-control"  placeholder="" required value="{{ $proformainvoicecommonsettingsData->consigneeTitle }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row required">
                        <label  for="traderTitle"  class="col-sm-4 col-form-label control-label">Trader Title</label>
                        <div class="col-sm-8">
                            <input type="text" name="traderTitle" id="traderTitle" class="form-control"  placeholder=""required value="{{ $proformainvoicecommonsettingsData->traderTitle }}">
                        </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label  for="paymentMediaTitle"  class="col-sm-4 col-form-label control-label">Payment Media Title</label>
                            <div class="col-sm-8">
                            <input type="text" name="paymentMediaTitle" id="paymentMediaTitle" class="form-control"  placeholder="" required value="{{ $proformainvoicecommonsettingsData->paymentMediaTitle }}">
                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-md-12">
                    <div class="form-group row required">
                        <label  for="terms"  class="col-sm-2 col-form-label control-label">Terms</label>
                        <div class="col-sm-10">
                        <textarea class="form-control "  rows="7" id="terms" name="terms"  required>{{ $proformainvoicecommonsettingsData->terms }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row required">
                        <label  for="declaration"  class="col-sm-2 col-form-label control-label">Declaration</label>
                        <div class="col-sm-10">
                        <textarea class="form-control "  rows="4" id="declaration" name="declaration"  required>{{ $proformainvoicecommonsettingsData->declaration }}</textarea>
                        </div>
                    </div>
                </div>



                <div class="col-md-12 text-center mt-4">
                    <input type="submit" class="btn btn-success mr-2"  value="Save">
                </div>


            </form>            


        </div>
    </div>
</div>




<!-- proforma company Edit Modal -->
<!-- proforma company Edit Modal -->
<div class="modal fade" id="proformaCompanyUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        
        <div class="modal-body" style="margin-top: -2vw;">
            
            <h5 class="modal-title text-center" id="exampleModalLabel">Proforma Invoice Company Update</h5>

            <form class="form-sample" id="proformaCompanyUpdate_form" method="POST" enctype="multipart/form-data" action="{{ route('proformaInvoiceCompanyUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                @method('put')
                @csrf

                <br>
                <p class="card-description">
                {{-- Personal info --}}
                </p>

                <input type="number" name="proformaCompanyId" id="proformaCompanyId" class="form-control"  placeholder="" required hidden>

                <div class="col-md-12">
                    <div class="form-group row required">
                        <label  for="companyAlias"  class="col-sm-4 col-form-label control-label">Company Alias</label>
                        <div class="col-sm-8">
                        <input type="text" name="companyAlias" id="companyAlias" class="form-control"  placeholder="" required>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-group row required">
                        <label  for="company"  class="col-sm-4 col-form-label control-label">Company</label>
                        <div class="col-sm-8">
                        <input type="text" name="company" id="company" class="form-control"  placeholder="" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row required">
                        <label  for="phone"  class="col-sm-4 col-form-label control-label">Phone</label>
                        <div class="col-sm-8">
                            <input type="text" name="phone" id="phone" class="form-control"  placeholder=""required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row required">
                        <label  for="address"  class="col-sm-4 col-form-label control-label">Address (HTML)</label>
                        <div class="col-sm-8">
                        <textarea class="form-control "  rows="4" id="address" name="address"  required> </textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row  required">
                        <label  for="email"  class="col-sm-4 col-form-label control-label">Email (HTML)</label>
                        <div class="col-sm-8">
                            <textarea class="form-control "  rows="4" id="email" name="email"  required> </textarea>
                        </div>
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="form-group row ">
                        <label  for="web"  class="col-sm-4 col-form-label control-label">Web (HTML)</label>
                        <div class="col-sm-8">
                            <textarea class="form-control "  rows="4" id="web" name="web" > </textarea>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row ">
                        <label  for="paymentAccDetailsIsVisible"  class="col-sm-4 col-form-label control-label">Payment Account Details Is Visible ?</label>
                        <div class="col-sm-8">
                            <select class="form-control m-bot15" name="paymentAccDetailsIsVisible" id="paymentAccDetailsIsVisible" required >
                                <option value="0">Hide</option>
                                <option value="1">Show</option>
                            </select>
                        </div>
                    </div>
                </div>

            
                <div class="col-md-12">
                    <div class="form-group row " >
                    <label  for="logo"  class="col-sm-4 col-form-label control-label">Logo</label>
                    <div class="col-sm-8">
                        <input type="file" name="logo" value="logo" class="form-control" placeholder="logo"   id="logoUpdateUploadInput" >
                        @if ($errors->has('logo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('logo') }}</strong>
                            </span>
                        @endif
                        <img id="logoUpdateUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                    </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row " >
                        <label  for="signature"  class="col-sm-4 col-form-label control-label">Signature</label>
                        <div class="col-sm-8">
                            <input type="file" name="signature" value="signature" class="form-control" placeholder="signature"   id="signatureUpdateUploadInput" >
                            @if ($errors->has('signature'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('signature') }}</strong>
                                </span>
                            @endif
                            <img id="signatureUpdateUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row " >
                        <label  for="seal"  class="col-sm-4 col-form-label control-label">Seal</label>
                        <div class="col-sm-8">
                            <input type="file" name="seal" value="seal" class="form-control" placeholder="seal"   id="sealUpdateUploadInput" >
                            @if ($errors->has('seal'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('seal') }}</strong>
                                </span>
                            @endif
                            <img id="sealUpdateUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                        </div>
                    </div>
                </div>




                <div class="col-md-12">
                    <div class="form-group row " >
                        <label  for="watermarkLogo"  class="col-sm-4 col-form-label control-label">Watermark Logo</label>
                        <div class="col-sm-8">
                            <input type="file" name="watermarkLogo" value="watermarkLogo" class="form-control" placeholder="watermarkLogo"   id="watermarkLogoUpdateUploadInput" >
                            @if ($errors->has('watermarkLogo'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('watermarkLogo') }}</strong>
                                </span>
                            @endif
                            <img id="watermarkLogoUpdateUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group row " >
                        <label  for="footerBackground"  class="col-sm-4 col-form-label control-label">Footer Background</label>
                        <div class="col-sm-8">
                            <input type="file" name="footerBackground" value="footerBackground" class="form-control" placeholder="footerBackground"   id="footerBackgroundUpdateUploadInput" >
                            @if ($errors->has('footerBackground'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('footerBackground') }}</strong>
                                </span>
                            @endif
                            <img id="footerBackgroundUpdateUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                        </div>
                    </div>
                </div>
                    



                <div class="col-md-12 text-center mt-4">
                    <input type="submit" class="btn btn-success mr-2"  value="Save">
                </div>


            </form>    

        </div>

    </div>
  </div>
</div>
<!-- proforma company Edit Modal -->
<!-- proforma company Edit Modal -->





<script type="text/javascript">
  {{-- image upload and preview --}}

  function logoReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#logoUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#logoUploadInput").change(function() 
  {
    logoReadURL(this);
  });


  function logoUpdateReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#logoUpdateUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#logoUpdateUploadInput").change(function() 
  {
    logoUpdateReadURL(this);
  });

  function signatureReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#signatureUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#signatureUploadInput").change(function() 
  {
    signatureReadURL(this);
  });


  function signatureUpdateReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#signatureUpdateUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#signatureUpdateUploadInput").change(function() 
  {
    signatureUpdateReadURL(this);
  });


  function sealReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#sealUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#sealUploadInput").change(function() 
  {
    sealReadURL(this);
  });


  function sealUpdateReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#sealUpdateUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#sealUpdateUploadInput").change(function() 
  {
    sealUpdateReadURL(this);
  });









  function watermarkLogoReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#watermarkLogoUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#watermarkLogoUploadInput").change(function() 
  {
    watermarkLogoReadURL(this);
  });


  function watermarkLogoUpdateReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#watermarkLogoUpdateUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#watermarkLogoUpdateUploadInput").change(function() 
  {
    watermarkLogoUpdateReadURL(this);
  });

  function footerBackgroundReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#footerBackgroundUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#footerBackgroundUploadInput").change(function() 
  {
    footerBackgroundReadURL(this);
  });


  function footerBackgroundUpdateReadURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#footerBackgroundUpdateUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#footerBackgroundUpdateUploadInput").change(function() 
  {
    footerBackgroundUpdateReadURL(this);
  });



</script>



@endsection