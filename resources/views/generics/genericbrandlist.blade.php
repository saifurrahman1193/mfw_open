@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Generic Brands')
@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}





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








{{-- Generic Brand form table --}}
{{-- Generic Brand form table --}}
  <div class="card">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center;">Generic Brands</h4>

        {{-- <a href="{{ route('generic.settings.brand.create') }}"  class="btn btn-default " style="margin-bottom: 10px; "  ><span>+ Create New Generic Brand</span></a> --}}
        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#genericBrandSaveConfirmationModal" ><span>+ Create New Generic brand</span></a>
        
        <table id="datatable2WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">S/L</th>
                      <th scope="col">Action</th>
                      <th scope="col">Generic brand</th>
                      <th scope="col">Generic</th>
                      <th scope="col">Generic brand company</th>
                      <th scope="col">Dosage form</th>
                      <th scope="col">Rx</th>
                      <th scope="col">Frontend visible</th>
                      <th scope="col">Category</th>
                      <th scope="col">Disease category</th>
                      <th scope="col">Picture links</th>
                      <th scope="col">Video link</th>
                      <th scope="col">Youtube</th>
                      <th scope="col">Dailymotion</th>
                      <th scope="col">Vimeo</th>
                      {{-- <th scope="col">Indication & Dosage</th>
                      <th scope="col">Side effect</th>
                      <th scope="col">Prescribing information</th>
                      <th scope="col">Additional information</th> --}}
                      <th scope="col">Page Title</th>
                      <th scope="col">Meta keywords</th>
                      <th scope="col">Meta description</th>

                      
                  </tr>
              </thead>
              
              
              <tbody>
                   @foreach ($genericbrandData->sortByDesc('genericBrandId') as $genericbrand)
                      <tr>
                          <td>{{$loop->index+1}}</td>
                          <td id="tdtableaction">

                            <div class="d-inline-block">
                                <a role="button" href="{{ route('generic.settings.brand.edit', $genericbrand->genericBrandId) }}"  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                            </div>

                            {{-- @php                  
                                dd($genericbrand->isGenericBrandUsed>0);
                            @endphp --}}                            

                            @if ( !($genericbrand->isGenericBrandUsed>0) )
                              <div class="d-inline-block tooltipster" title="Delete selected record?">
                                  <form  method="post" action="{{ route('generics.settings.brand.delete', $genericbrand->genericBrandId) }}" onsubmit="return confirm('Do you really want to proceed?');">
                                      {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE">
                                          <button type="submit" value="DELETE" class="btn btn-link" >
                                            <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                          </button>
                                  </form>
                                </div>
                            @endif


                        </td>
                          <td>
                            <a href="{{ route('productDetailsPageCaller', array(app()->getLocale(), $genericbrand->genericBrandId)) }}" target="_blank">{{$genericbrand->genericBrand}}</a>
                            <br> <hr>
                            <a href="{{ route('productDetailsPageCaller', array("cn", $genericbrand->genericBrandId)) }}" target="_blank">{{$genericbrand->genericBrandCN}}</a>
                            <br> <hr>
                            <a href="{{ route('productDetailsPageCaller', array("ru", $genericbrand->genericBrandId)) }}" target="_blank">{{$genericbrand->genericBrandRU}}</a>                            
                          </td>
                          <td>
                            {{$genericbrand->genericName}}<br> <hr>
                            {{$genericbrand->genericNameCN}}<br> <hr>
                            {{$genericbrand->genericNameRU}}
                          </td>
                          <td>
                              {{$genericbrand->genericCompany}}<br> <hr>
                              {{$genericbrand->genericCompanyCN}}<br> <hr>
                              {{$genericbrand->genericCompanyRU}}
                          </td>
                      
                         

                          <td>
                            {{$genericbrand->dosageForm}}<br> <hr>
                            {{$genericbrand->dosageFormCN}}<br> <hr>
                            {{$genericbrand->dosageFormRU}}
                          </td>


                          <td>
                            {{$genericbrand->isRxApplicable? 'Rx' : ''}}
                          </td>
                          
                          <td>
                            {{$genericbrand->isFrontendVisible? 'Visible' : 'Invisible'}}
                          </td>
                          <td>{{$genericbrand->categories}}</td>
                          <td>{{$genericbrand->diseaseCategories}}</td>
                          <td>
                            <ul class="list-group">

                              @foreach ($genericbrandpicData->where('genericBrandId', $genericbrand->genericBrandId) as $genericbrandpic)
                                  <li class="list-group-item list-group-item-action">
                                    <a href="{{asset($genericbrandpic->picPath)}}" target="_blank" >{{asset($genericbrandpic->picPath)}}</a>
                                  </li>
                              @endforeach
                            </ul>
                          </td>
                          <td>

                            <ul class="list-group">
                              @if ($genericbrand->videourl)
                                  <li class="list-group-item list-group-item-action"> Primary</li>
                                  <li class="list-group-item list-group-item-action">
                                    <table>
                                      <thead>
                                        <tr>
                                          <th>Pic</th>
                                          <th>Video</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>
                                            <a href="{{ asset($genericbrand->videothumb) }}" target="_blank" >{{ asset($genericbrand->videothumb) }}</a>
                                          </td>
                                          <td><a href="{{ asset($genericbrand->videourl) }}" target="_blank" >{{ asset($genericbrand->videourl) }}</a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </li>
                              @endif

                              @foreach ($genericbrandvideosData->where('genericBrandId', $genericbrand->genericBrandId) as $genericbrandvideo)
                                  <li class="list-group-item list-group-item-action"> Additionals</li>
                                  
                                  <li class="list-group-item list-group-item-action">

                                    <table>
                                      <thead>
                                        <tr>
                                          <th>Pic</th>
                                          <th>Video</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td>
                                            <a href="{{ asset($genericbrandvideo->thumbnailUrl) }}" target="_blank" >{{ asset($genericbrandvideo->thumbnailUrl) }}</a>
                                          </td>
                                          <td><a href="{{ asset($genericbrandvideo->videoUrl) }}" target="_blank" >{{ asset($genericbrandvideo->videoUrl) }}</a></a></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    
                                  </li>
                              @endforeach


                            </ul>


                            

                            
                          </td>
                          <td class="{{ !empty($genericbrand->youtubevideourl) ? 'text-success' : 'text-danger' }} font-weight-bold">{{!empty($genericbrand->youtubevideourl)?  'Yes' : 'No'}}</td>
                          <td class="{{ !empty($genericbrand->youtubevideourl) ? 'text-success' : 'text-danger' }} font-weight-bold">{{!empty($genericbrand->dailymotionvideourl)?  'Yes' : 'No'}}</td>
                          <td class="{{ !empty($genericbrand->youtubevideourl) ? 'text-success' : 'text-danger' }} font-weight-bold">{{!empty($genericbrand->vimeovideourl)?  'Yes' : 'No'}}</td>
                          {{-- <td>
                            <span id="{{'genericbrandid-'.$genericbrand->genericBrandId.'-indicationanddosage'}}" data-indicationanddosage="{{$genericbrand->indicationanddosage}}">{!! substr($genericbrand->indicationanddosage, 0, 200) !!}</span> 
                            @if (strlen($genericbrand->indicationanddosage)>200)
                              <button id="{{'genericbrandid-'.$genericbrand->genericBrandId.'-btn'}}" style="font-size: 14px !important; font-weight: normal !important;" onClick="readMoreindicationanddosage({{$genericbrand->genericBrandId}})">Read More...</button>
                            @endif

                          </td>
                          <td>
                            <span id="{{'genericbrandid-'.$genericbrand->genericBrandId.'-sideeffects'}}" data-sideeffects="{{$genericbrand->sideeffects}}">{!! substr($genericbrand->sideeffects, 0, 200) !!}</span> 
                            @if (strlen($genericbrand->sideeffects)>200)
                              <button id="{{'genericbrandid-'.$genericbrand->genericBrandId.'-sideeffects-btn'}}" style="font-size: 14px !important; font-weight: normal !important;" onClick="readMoresideeffects({{$genericbrand->genericBrandId}})">Read More...</button>
                            @endif

                          </td>
                          <td>
                            <span id="{{'genericbrandid-'.$genericbrand->genericBrandId.'-prescribinginformation'}}" data-prescribinginformation="{{$genericbrand->prescribinginformation}}">{!! substr($genericbrand->prescribinginformation, 0, 200) !!}</span> 
                            @if (strlen($genericbrand->prescribinginformation)>200)
                              <button id="{{'genericbrandid-'.$genericbrand->genericBrandId.'-prescribinginformation-btn'}}" style="font-size: 14px !important; font-weight: normal !important;" onClick="readMoreprescribinginformation({{$genericbrand->genericBrandId}})">Read More...</button>
                            @endif
                          </td>
                          <td>
                            <span id="{{'genericbrandid-'.$genericbrand->genericBrandId.'-additionalinformation'}}" data-additionalinformation="{{$genericbrand->additionalinformation}}">{!! substr($genericbrand->additionalinformation, 0, 200) !!}</span> 
                            @if (strlen($genericbrand->additionalinformation)>200)
                              <button id="{{'genericbrandid-'.$genericbrand->genericBrandId.'-additionalinformation-btn'}}" style="font-size: 14px !important; font-weight: normal !important;" onClick="readMoreadditionalinformation({{$genericbrand->genericBrandId}})">Read More...</button>
                            @endif
                          </td> --}}

                          <td>
                            {{$genericbrand->pageTitle}}<br> <hr>
                            {{$genericbrand->pageTitleCN}}<br> <hr>
                            {{$genericbrand->pageTitleRU}}
                          </td>


                          <td>
                            <p style="word-break: break-all;">
                                {{strlen($genericbrand->meta_keywords)>200?substr($genericbrand->meta_keywords, 0, 200): $genericbrand->meta_keywords }}
                                @if (strlen($genericbrand->meta_keywords)>200)
                                  <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                                  data-title='Meta Keywords' 
                                  data-body='{{ $genericbrand->meta_keywords }}' 
                                  >
                                    Show Full  
                                  </a>
                                @endif
                            </p><br> <hr>
                            <p style="word-break: break-all;">
                                {{strlen($genericbrand->meta_keywordsCN)>200?substr($genericbrand->meta_keywordsCN, 0, 200): $genericbrand->meta_keywordsCN }}
                                @if (strlen($genericbrand->meta_keywordsCN)>200)
                                  <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                                  data-title='Meta Keywords' 
                                  data-body='{{ $genericbrand->meta_keywordsCN }}' 
                                  >
                                    Show Full  
                                  </a>
                                @endif
                            </p><br> <hr>
                            <p style="word-break: break-all;">
                                {{strlen($genericbrand->meta_keywordsRU)>200?substr($genericbrand->meta_keywordsRU, 0, 200): $genericbrand->meta_keywordsRU }}
                                @if (strlen($genericbrand->meta_keywordsRU)>200)
                                  <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                                  data-title='Meta Keywords' 
                                  data-body='{{ $genericbrand->meta_keywordsRU }}' 
                                  >
                                    Show Full  
                                  </a>
                                @endif
                            </p>
                          </td>

                          <td>

                            <p style="word-break: break-all;">
                              {{strlen($genericbrand->meta_description)>200?substr($genericbrand->meta_description, 0, 200): $genericbrand->meta_description }}
                              @if (strlen($genericbrand->meta_description)>200)
                                <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                                data-title='Meta Keywords' 
                                data-body='{{ $genericbrand->meta_description }}' 
                                >
                                  Show Full  
                                </a>
                              @endif
                            </p><br> <hr>
                            <p style="word-break: break-all;">
                                {{strlen($genericbrand->meta_descriptionCN)>200?substr($genericbrand->meta_descriptionCN, 0, 200): $genericbrand->meta_descriptionCN }}
                                @if (strlen($genericbrand->meta_descriptionCN)>200)
                                  <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                                  data-title='Meta Description' 
                                  data-body='{{ $genericbrand->meta_descriptionCN }}' 
                                  >
                                    Show Full  
                                  </a>
                                @endif
                            </p><br> <hr>
                            <p style="word-break: break-all;">
                                {{strlen($genericbrand->meta_descriptionRU)>200?substr($genericbrand->meta_descriptionRU, 0, 200): $genericbrand->meta_descriptionRU }}
                                @if (strlen($genericbrand->meta_descriptionRU)>200)
                                  <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                                  data-title='Meta Keywords' 
                                  data-body='{{ $genericbrand->meta_descriptionRU }}' 
                                  >
                                    Show Full  
                                  </a>
                                @endif
                            </p>


                        
                          </td>


                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Generic Brand form table --}}
{{-- Generic Brand form table --}}






<!-- Generic brand  Save Modal -->
<!-- Generic brand  Save Modal -->
<div class="modal fade" id="genericBrandSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="genericBrandSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="genericBrandSaveConfirmationModal">Add A Generic Brand</h5>

      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              

              <form class="form-horizontal" method="POST"  action="{{ route('generic.settings.brand.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Generic Brand</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericBrand" name="genericBrand" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic Brand (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericBrandCN" name="genericBrandCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic Brand (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericBrandRU" name="genericBrandRU" >
                                </div>
                              </div>
                            </div>


                            <button data-toggle="modal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>

                </form>
      </div>
    </div>
  </div>
</div>
<!-- Generic brand  Save Modal -->
<!-- Generic brand  Save Modal -->





<script type='text/javascript'> 
  function readMoreindicationanddosage(genericbrandid) {
    console.log('called')
    console.log('genericbrandid = '+ genericbrandid )


    var indicationanddosage= $('#genericbrandid-'+genericbrandid+'-indicationanddosage').data('indicationanddosage');
    console.log(indicationanddosage)

    document.getElementById('genericbrandid-'+genericbrandid+'-indicationanddosage').innerHTML=indicationanddosage;
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-btn').innerHTML='Read Less';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-indicationanddosage').innerHTML=indicationanddosage+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readLessindicationanddosage("+genericbrandid+")'>Read Less...</button>";
    }

  }

  function readLessindicationanddosage(genericbrandid) {
    var indicationanddosage= $('#genericbrandid-'+genericbrandid+'-indicationanddosage').data('indicationanddosage');
    document.getElementById('genericbrandid-'+genericbrandid+'-indicationanddosage').innerHTML=indicationanddosage.substr(0,200);
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-btn').innerHTML='Read More';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-indicationanddosage').innerHTML=indicationanddosage.substr(0,200)+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readMoreindicationanddosage("+genericbrandid+")'>Read More...</button>";
    }

  }
</script>



{{-- sideeffects --}}

<script type='text/javascript'> 
  function readMoresideeffects(genericbrandid) {
    console.log('called')
    console.log('genericbrandid = '+ genericbrandid )


    var sideeffects= $('#genericbrandid-'+genericbrandid+'-sideeffects').data('sideeffects');
    console.log(sideeffects)

    document.getElementById('genericbrandid-'+genericbrandid+'-sideeffects').innerHTML=sideeffects;
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-sideeffects-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-sideeffects-btn').innerHTML='Read Less';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-sideeffects').innerHTML=sideeffects+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-sideeffects-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readLesssideeffects("+genericbrandid+")'>Read Less...</button>";
    }

  }

  function readLesssideeffects(genericbrandid) {
    var sideeffects= $('#genericbrandid-'+genericbrandid+'-sideeffects').data('sideeffects');
    document.getElementById('genericbrandid-'+genericbrandid+'-sideeffects').innerHTML=sideeffects.substr(0,200);
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-sideeffects-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-sideeffects-btn').innerHTML='Read More';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-sideeffects').innerHTML=sideeffects.substr(0,200)+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-sideeffects-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readMoresideeffects("+genericbrandid+")'>Read More...</button>";
    }

  }
</script>


{{-- prescribinginformation --}}
<script type='text/javascript'> 
  function readMoreprescribinginformation(genericbrandid) {
    console.log('called')
    console.log('genericbrandid = '+ genericbrandid )


    var prescribinginformation= $('#genericbrandid-'+genericbrandid+'-prescribinginformation').data('prescribinginformation');
    console.log(prescribinginformation)

    document.getElementById('genericbrandid-'+genericbrandid+'-prescribinginformation').innerHTML=prescribinginformation;
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-prescribinginformation-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-prescribinginformation-btn').innerHTML='Read Less';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-prescribinginformation').innerHTML=prescribinginformation+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-prescribinginformation-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readLessprescribinginformation("+genericbrandid+")'>Read Less...</button>";
    }

  }

  function readLessprescribinginformation(genericbrandid) {
    var prescribinginformation= $('#genericbrandid-'+genericbrandid+'-prescribinginformation').data('prescribinginformation');
    document.getElementById('genericbrandid-'+genericbrandid+'-prescribinginformation').innerHTML=prescribinginformation.substr(0,200);
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-prescribinginformation-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-prescribinginformation-btn').innerHTML='Read More';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-prescribinginformation').innerHTML=prescribinginformation.substr(0,200)+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-prescribinginformation-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readMoreprescribinginformation("+genericbrandid+")'>Read More...</button>";
    }

  }
</script>


{{-- additionalinformation --}}
<script type='text/javascript'> 
  function readMoreadditionalinformation(genericbrandid) {
    console.log('called')
    console.log('genericbrandid = '+ genericbrandid )


    var additionalinformation= $('#genericbrandid-'+genericbrandid+'-additionalinformation').data('additionalinformation');
    console.log(additionalinformation)

    document.getElementById('genericbrandid-'+genericbrandid+'-additionalinformation').innerHTML=additionalinformation;
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-additionalinformation-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-additionalinformation-btn').innerHTML='Read Less';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-additionalinformation').innerHTML=additionalinformation+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-additionalinformation-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readLessadditionalinformation("+genericbrandid+")'>Read Less...</button>";
    }

  }

  function readLessadditionalinformation(genericbrandid) {
    var additionalinformation= $('#genericbrandid-'+genericbrandid+'-additionalinformation').data('additionalinformation');
    document.getElementById('genericbrandid-'+genericbrandid+'-additionalinformation').innerHTML=additionalinformation.substr(0,200);
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-additionalinformation-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-additionalinformation-btn').innerHTML='Read More';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-additionalinformation').innerHTML=additionalinformation.substr(0,200)+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-additionalinformation-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readMoreadditionalinformation("+genericbrandid+")'>Read More...</button>";
    }

  }
</script>





<script type='text/javascript'> 
  function readMoremeta_keywords(genericbrandid) {
    console.log('called')
    console.log('genericbrandid = '+ genericbrandid )


    var meta_keywords= $('#genericbrandid-'+genericbrandid+'-meta_keywords').data('meta_keywords');
    console.log(meta_keywords)

    document.getElementById('genericbrandid-'+genericbrandid+'-meta_keywords').innerHTML=meta_keywords;
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-btn').innerHTML='Read Less';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-meta_keywords').innerHTML=meta_keywords+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readLessMeta_keywords("+genericbrandid+")'>Read Less...</button>";
    }

  }

  function readLessMeta_keywords(genericbrandid) {
    var meta_keywords= $('#genericbrandid-'+genericbrandid+'-meta_keywords').data('meta_keywords');
    document.getElementById('genericbrandid-'+genericbrandid+'-meta_keywords').innerHTML=meta_keywords.substr(0,50);
    var btn = document.getElementById('genericbrandid-'+genericbrandid+'-btn');
    if (btn) {
      document.getElementById('genericbrandid-'+genericbrandid+'-btn').innerHTML='Read More';
    }
    else{
      document.getElementById('genericbrandid-'+genericbrandid+'-meta_keywords').innerHTML=meta_keywords.substr(0,50)+'<br>'+
      "<button id='genericbrandid-'+genericbrandid+'-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readMoremeta_keywords("+genericbrandid+")'>Read More...</button>";
    }

  }
</script>


@endsection