<!DOCTYPE html>


<style type="text/css">
	.uploaded-pic{
		position: relative;
		display: inline-block;
	}

	.uploaded-pic:hover .pic-delete {
		display: block;
		color: red !important;
		
	}

	.pic-delete {
		padding-top: 7px;	
		padding-right: 15px !important;
		position: absolute;
		right: 0;
		top: 0;
		display: none;

	}

	.pic-delete a {
		color: red !important;
	}


</style>



@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Edit Generic Brand')

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
{{-- <style>
  .progress-container {
  width: 100%;
  height: 8px;
  background: #ccc;
}

.progress-bar {
  height: 8px;
  background: #aa045f;
  width: 0%;
}
</style> --}}

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
            <div class="progress-container">
              <div class="progress-bar" id="myBar"></div>
            </div> 

			    @endif


{{-- SCroll progress bar --}}
{{-- <div class="progress-container" style="position: fixed; z-index:100;">
  <div class="progress-bar" id="myBar"></div>
</div> --}}
{{-- SCroll progress bar --}}

{{-- Indicator --}}


<style>
  @media (max-width: 400px) {
      #indicator_generic_brand {
        position: fixed; 
        z-index:10; 
        margin-left:0%; 
        margin-right:0%;
      }
  }  
  @media (min-width: 800px) {
      #indicator_generic_brand {
        position: fixed; 
        z-index:10; 
        margin-left:5%; 
        margin-right:5%;  
      }
  }  
</style>

<div id=indicator_generic_brand>
  <a href="#first_section"><button type="button" id="b1" class="btn btn-danger">Basic Info Section</button></a>
  <a href="#meta_section"><button type="button" id="b2" class="btn btn-danger">SEO Section</button></a>
  <a href="#Indication"><button type="button" id="b3" class="btn btn-danger">Indication & Dosage</button></a>  
  <a href="#side_effects"><button type="button" id="b4" class="btn btn-danger">Side effects</button></a>  
  <a href="#Prescribing_information"><button id="b5" type="button" class="btn btn-danger">Prescribing Information</button></a>  
  <a href="#additional_information"><button id="b6" type="button" class="btn btn-danger">Additional Information</button></a>  
  <a href="#faq"><button type="button" id="b7" class="btn btn-danger">FAQ</button></a>  
  <a href="#suggestions"><button type="button" id="b8" class="btn btn-danger">Suggestions</button></a>  
</div>
<script>
  $("#b1").click(function() {
    $('html,body').animate({
        scrollTop: $("#first_section").offset().top -120 },
        'slow');
  });
  $("#b2").click(function() {
    $('html,body').animate({
        scrollTop: $("#meta_section").offset().top -120 },
        'slow');
  });
  $("#b3").click(function() {
    $('html,body').animate({
        scrollTop: $("#Indication").offset().top -100 },
        'slow');
  });
  $("#b4").click(function() {
    $('html,body').animate({
        scrollTop: $("#side_effects").offset().top -100 },
        'slow');
  });
  $("#b5").click(function() {
    $('html,body').animate({
        scrollTop: $("#Prescribing_information").offset().top -100 },
        'slow');
  });
  $("#b6").click(function() {
    $('html,body').animate({
        scrollTop: $("#additional_information").offset().top -100 },
        'slow');
  });
  $("#b7").click(function() {
    $('html,body').animate({
        scrollTop: $("#faq").offset().top -100 },
        'slow');
  });
  $("#b8").click(function() {
    $('html,body').animate({
        scrollTop: $("#suggestions").offset().top -100 },
        'slow');
  });  
</script>
{{-- Indicator --}}



     <br>   
     <br>   
     <br>   

     {{-- @php
         dd($genericbrandData);

        //  dd($genericbranddiseasecategoryData->where('genericBrandId', $genericbrandData->genericBrandId ));
     @endphp --}}
		<div class="card col-md-12">
      
		<div class="card-body">      
        <h4 class="card-title" style="text-align: center;" id=first_section>Update Generic Brand</h4>

        
        
	    <div class="row">
	        <div class="col-md-12 col-md-offset-2">
	            <div class="panel panel-default">
	                {{-- <div class="panel-heading">Add New User</div> --}}

	                <div class="panel-body">
	                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('generic.settings.brand.update', $genericbrandData->genericBrandId) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
			                
			                {{method_field('put')}}
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
				                                  <input type="text" class="form-control" id="genericBrand" name="genericBrand" value="{{ $genericbrandData->genericBrand }}" required>
				                                </div>
				                              </div>
				                            </div>

                                    <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic </label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="genericId" id="genericId" required >
				                                      <option value="{{ $genericbrandData->genericId }}">{{ $genericbrandData->genericName }}</option>
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
				                                  <input type="text" class="form-control" id="genericBrandCN" name="genericBrandCN" value="{{ $genericbrandData->genericBrandCN }}" >
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Generic Company</label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="genericCompanyId" id="genericCompanyId" required >
				                                      <option value="{{ $genericbrandData->genericCompanyId }}">{{ $genericbrandData->genericCompany }}</option>
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
				                                  <input type="text" class="form-control" id="genericBrandRU" name="genericBrandRU" value="{{ $genericbrandData->genericBrandRU }}" >
				                                </div>
				                              </div>
				                            </div>

				                            <div class="col-md-6">
				                              <div class="form-group row required">
				                                <label class="col-sm-4 col-form-label control-label">Is Rx Applicable </label>
				                                <div class="col-sm-8">
				                                  <select class="form-control m-bot15" name="isRxApplicable" id="isRxApplicable" required >
				                                  		<option value="">--Select--</option> 
				                                          <option value="0" {{ $genericbrandData->isRxApplicable == 0 ? 'selected' : '' }}>No</option> 
				                                          <option value="1" {{ $genericbrandData->isRxApplicable == 1 ? 'selected' : '' }}>Yes</option> 
				                                  </select>
				                                </div>
				                              </div>
				                            </div>


			                        	</div>

			                        	<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                          <label class="col-sm-4 col-form-label control-label">Video URL(.mp4)</label>
                                          <div class="col-sm-8">
                                         
                                            <input id="videourl" name="videourl" type="file" class="file"  data-show-upload="true" data-show-caption="true" >

                                            @if ($genericbrandData->videourl)
                                              <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                                <tr>
                                                  <td>
                                                    <a href="{{asset($genericbrandData->videourl)}}" target="_blank" >{{asset($genericbrandData->videourl)}}</a>
                                                  </td>
                                                  <td>
                                                    <a href="{{ route('generic.brand.video.delete', $genericbrandData->genericBrandId) }}" class=" tooltipster" title="Delete selected file?" >
                                                      <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                    </a>
                                                  </td>
                                                </tr>
                                              </table>                                                
                                            @endif
                                            

                                          </div>
                                        </div>
				                            </div>

				                            <div class="form-group row col-md-6">
                                        <label for="videothumb" class="col-md-4 col-form-label ">Video Thumbnail Pic (300x300)</label>
                                        <div class="col-md-8">
                                              <input type="file" id="videothumb" name="videothumb" value="videothumb" class="form-control" placeholder="videothumb"   id="photoUploadInput"    style="margin-bottom: 10px; padding-bottom: 40px;">
                                              
                                              @if ($genericbrandData->videothumb)
                                                <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                                  <tr>
                                                    <td>
                                                      <img id="photoUploadPreview"  src="{{ empty($genericbrandData->videothumb) ? '#' : asset($genericbrandData->videothumb) }}"   style="max-width: 200px; max-height: 200px;" />
                                                    </td>
                                                    <td>
                                                      <a href="{{ route('genericBrandVideoThumbnailDelete', $genericbrandData->genericBrandId) }}" class=" tooltipster" title="Delete selected file?" >
                                                        <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                      </a>
                                                    </td>
                                                  </tr>
                                                </table>                                                
                                              @endif
                                        </div>
                                    </div>

			                        	</div>


			                        	<div class="row">
			                        		<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Youtube Video URL (Embed src url)</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="youtubevideourl" name="youtubevideourl" value="{{ $genericbrandData->youtubevideourl }}" placeholder="https://www.test.com/test.mp4">
				                                </div>
				                              </div>
				                            </div>

				                            <div class="form-group row col-md-6">
	                                            <label for="videothumb" class="col-md-4 col-form-label ">Video Thumbnail Pic (300x300)</label>

	                                            <div class="col-md-8">
	                                                <input type="file" name="youtubevideothumb" value="youtubevideothumb" class="form-control" placeholder="youtube video thumb"   id="youtubephotoUploadInput"    style="margin-bottom: 10px; padding-bottom: 40px;">
	                                                  
                                                    
                                                    @if ($genericbrandData->youtubevideothumb)
                                                      <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                                        <tr>
                                                          <td>
                                                            <img id="youtubephotoUploadPreview"  src="{{ empty($genericbrandData->youtubevideothumb) ? '#' : asset($genericbrandData->youtubevideothumb) }}"   style="max-width: 200px; max-height: 200px;" />
                                                          </td>
                                                          <td>
                                                            <a href="{{ route('genericBrandyoutubevideothumbDelete', $genericbrandData->genericBrandId) }}" class=" tooltipster" title="Delete selected file?" >
                                                              <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                            </a>
                                                          </td>
                                                        </tr>
                                                      </table>                                                
                                                    @endif
	                                            </div>
	                                        </div>


			                        	</div>


			                        	<div class="row">
			                        		<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Dailymotion Video URL (Embed src url)</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="dailymotionvideourl" name="dailymotionvideourl" value="{{ $genericbrandData->dailymotionvideourl }}" placeholder="https://www.test.com/test.mp4">
				                                </div>
				                              </div>
				                            </div>

				                            <div class="form-group row col-md-6">
                                        <label for="videothumb" class="col-md-4 col-form-label ">Video Thumbnail Pic  (300x300)</label>

                                        <div class="col-md-8">
                                            <input type="file" id="dailymotionvideothumb" name="dailymotionvideothumb" value="dailymotionvideothumb" class="form-control" placeholder="videothumb"   id="dailymotionphotoUploadInput"    style="margin-bottom: 10px; padding-bottom: 40px;">
                                              
                                              
                                              @if ($genericbrandData->dailymotionvideothumb)
                                                <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                                  <tr>
                                                    <td>
                                                      <img id="dailymotionphotoUploadPreview"  src="{{ empty($genericbrandData->dailymotionvideothumb) ? '#' : asset($genericbrandData->dailymotionvideothumb) }}"   style="max-width: 200px; max-height: 200px;" />
                                                    </td>
                                                    <td>
                                                      <a href="{{ route('genericBranddailymotionvideothumbDelete', $genericbrandData->genericBrandId) }}" class=" tooltipster" title="Delete selected file?" >
                                                        <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                      </a>
                                                    </td>
                                                  </tr>
                                                </table>                                                
                                              @endif
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
			                        		<div class="col-md-6">
				                              <div class="form-group row ">
				                                <label class="col-sm-4 col-form-label control-label">Vimeo Video URL (Embed src url)</label>
				                                <div class="col-sm-8">
				                                  <input type="text" class="form-control" id="vimeovideourl" name="vimeovideourl" value="{{ $genericbrandData->vimeovideourl }}" placeholder="https://www.test.com/test.mp4">
				                                </div>
				                              </div>
				                            </div>

				                            <div class="form-group row col-md-6">
                                        <label for="videothumb" class="col-md-4 col-form-label ">Video Thumbnail Pic  (300x300)</label>

                                        <div class="col-md-8">
                                            <input type="file" id="vimeovideothumb" name="vimeovideothumb" value="vimeovideothumb" class="form-control" placeholder="videothumb"   id="vimeophotoUploadInput"    style="margin-bottom: 10px; padding-bottom: 40px;">
                                              
                                              
                                              @if ($genericbrandData->vimeovideothumb)
                                                <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                                  <tr>
                                                    <td>
                                                      <img id="vimeophotoUploadPreview"  src="{{ empty($genericbrandData->vimeovideothumb) ? '#' : asset($genericbrandData->vimeovideothumb) }}"   style="max-width: 200px; max-height: 200px;" />
                                                    </td>
                                                    <td>
                                                      <a href="{{ route('genericBrandvimeovideothumbDelete', $genericbrandData->genericBrandId) }}" class=" tooltipster" title="Delete selected file?" >
                                                        <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                      </a>
                                                    </td>
                                                  </tr>
                                                </table>                                                
                                              @endif
                                        </div>
                                    </div>


                                </div>
                                
                                <div class="row"> 
                                  <div class="col-md-6">
                                    <div class="form-group row ">
                                      <label  for="text2"  class="col-sm-4 col-form-label control-label">Is Frontend Visible ?</label>
                                      <div class="col-sm-8">
                                          <div class="col-sm-6 d-inline">
                                            <input type="radio" name="isFrontendVisible" value="1"  {{$genericbrandData->isFrontendVisible==1? 'checked':''}}> Visible
                                          </div>
                
                                          <div class="col-sm-6 d-inline">
                                              <input type="radio" name="isFrontendVisible" value="0"  {{$genericbrandData->isFrontendVisible!=1? 'checked':''}}> Invisible
                                          </div>
                
                                      </div>
                
                                    </div>
                                  </div>
                                </div>


                                @php
                                    $extracted_globalTradeName = explode("by ", $genericbrandData->globalTradeNameCompany);
                                    $extracted_globalTradeNameCN = explode("by ", $genericbrandData->globalTradeNameCompanyCN);
                                    $extracted_globalTradeNameRU = explode("by ", $genericbrandData->globalTradeNameCompanyRU);

                                    $extracted_genericStrength = explode(" / ", $genericbrandData->genericStrength);
                                    $extracted_genericStrengthCN = explode(" / ", $genericbrandData->genericStrengthCN);
                                    $extracted_genericStrengthRU = explode(" / ", $genericbrandData->genericStrengthRU);

                                    // dd($genericbrandData->genericStrengthRU);

                                    $imporvised_genericStrength = "";
                                    $imporvised_genericStrength_count = 0; 
                                    foreach ($extracted_genericStrength as $key) {
                                      # code...
                                      if($imporvised_genericStrength_count == 0){
                                        $imporvised_genericStrength = $imporvised_genericStrength.$key;
                                        // array_push($imporvised_genericStrength, $key);
                                      }else{
                                        $imporvised_genericStrength = $imporvised_genericStrength."- ".$key;
                                        // array_push($imporvised_genericStrength, "- ".$key);
                                      }
                                      $imporvised_genericStrength_count++;
                                    }


                                    $imporvised_genericStrengthCN = "";
                                    $imporvised_genericStrength_countCN = 0; 
                                    foreach ($extracted_genericStrengthCN as $keyCN) {
                                      # code...
                                      if($imporvised_genericStrength_countCN == 0){
                                        $imporvised_genericStrengthCN = $imporvised_genericStrengthCN.$keyCN;
                                        // array_push($imporvised_genericStrength, $key);
                                      }else{
                                        $imporvised_genericStrengthCN = $imporvised_genericStrengthCN."- ".$keyCN;
                                        // array_push($imporvised_genericStrength, "- ".$key);
                                      }
                                      $imporvised_genericStrength_countCN++;
                                    }

                                    $imporvised_genericStrengthRU = "";
                                    $imporvised_genericStrength_countRU = 0; 
                                    foreach ($extracted_genericStrengthRU as $keyRU) {
                                      # code...
                                      if($imporvised_genericStrength_countRU == 0){
                                        $imporvised_genericStrengthRU = $imporvised_genericStrengthRU.$keyRU;
                                        // array_push($imporvised_genericStrength, $key);
                                      }else{
                                        $imporvised_genericStrengthRU = $imporvised_genericStrengthRU."- ".$keyRU;
                                        // array_push($imporvised_genericStrength, "- ".$key);
                                      }
                                      $imporvised_genericStrength_countRU++;
                                    }
                                @endphp  
                                
                                {{-- {{dd($imporvised_genericStrength)}} --}}
                                {{-- dd(count($extracted_genericStrength))}}
                                {{dd($genericbrandData)}} --}}
                                {{-- {{dd($genericbrandData->genericBrandId)}} --}}
                                {{-- <button type="button" id="meta_section" class="btn btn-danger btn-lg btn-block" title="Click here to update all the meta tags of all Brands"> <a href="{{route('generic.settings.meta.updateall',$genericbrandData->genericBrandId)}}"> <h3 style="color: black"> Update Full Meta Section of all brands</h3></a></button> --}}
                                <br>

                                <button type="button" id="meta_section" class="btn btn-warning btn-lg btn-block" title="Click here to update all the meta tags"> <a href="{{route('generic.settings.meta.update',$genericbrandData->genericBrandId)}}"> <h3 style="color: black"> Update Full Meta Section</h3></a></button>
                                <br>                                

                                <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group row ">                                        
                                          <label class="col-sm-4 col-form-label control-label">Page Title
                                          <button type="button" class="btn btn-xs btn-warning" title="Meta Title Update">                                          
                                            <a href="{{route('generic.settings.meta_title.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                              </a>
                                          </button>
                                        </label>
                                        
                                        <div class="col-sm-8">

                                          @if ($genericbrandData->pageTitle)
                                            <textarea id="pageTitle" name="pageTitle"  rows="5" class="form-control" >{{$genericbrandData->pageTitle}} </textarea>
                                          @else
                                            <textarea id="pageTitle" name="pageTitle"  rows="5" class="form-control" >{{ "Buy ".$genericbrandData->genericBrand." ".$imporvised_genericStrength. " online- Generic ".$genericbrandData->genericName."- ".$genericbrandData->genericCompany }} </textarea>
                                          @endif 
                                                                                   
                                        </div>                                       
                                      </div>
                                  </div>


                                  <div class="col-md-6">
                                    <div class="form-group row ">
                                      <label class="col-sm-4 col-form-label control-label">Page Title (CN)
                                        <button type="button" class="btn btn-xs btn-warning" title="Meta Title CN Update">                                          
                                          <a href="{{route('generic.settings.meta_title.cn.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                            </a>
                                        </button>
                                      </label>
                                      <div class="col-sm-8">

                                        @if ($genericbrandData->pageTitleCN)
                                          <textarea id="pageTitleCN" name="pageTitleCN"  rows="5" class="form-control" >{{$genericbrandData->pageTitleCN}} </textarea>
                                        @else
                                          <textarea id="pageTitleCN" name="pageTitleCN"  rows="5" class="form-control" >{{ "买 ".$genericbrandData->genericBrandCN." ".$imporvised_genericStrengthCN. " 联机- 通用的 ".$genericbrandData->genericNameCN."- ".$genericbrandData->genericCompanyCN }} </textarea>
                                        @endif 

                                      </div>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group row ">
                                      <label class="col-sm-4 col-form-label control-label">Page Title (RU)
                                        <button type="button" class="btn btn-xs btn-warning" title="Meta Title Update">                                          
                                          <a href="{{route('generic.settings.meta_title.ru.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                            </a>
                                        </button>
                                      </label>
                                      <div class="col-sm-8">
                                        @if ($genericbrandData->pageTitleRU)
                                          <textarea id="pageTitleRU" name="pageTitleRU"  rows="5" class="form-control" >{{$genericbrandData->pageTitleRU}} </textarea>
                                        @else
                                          <textarea id="pageTitleRU" name="pageTitleRU"  rows="5" class="form-control" >{{ "купить ".$genericbrandData->genericBrandRU." ".$imporvised_genericStrengthRU. " онлайн- Родовое ".$genericbrandData->genericNameRU."- ".$genericbrandData->genericCompanyRU }}</textarea>
                                        @endif 
                                        
                                      </div>
                                    </div>
                                  </div>
                                  
                              
                              </div>

                              @php
                                  // dd($genericbranddiseasecategoryData->where('genericBrandId', $genericbrandData->genericBrandId ));
                                  $improvised_disease_category = "";                                  
                                  $improvised_disease_categoryCN = "";                                  
                                  $improvised_disease_categoryRU = "";                                  
                                  foreach($genericbranddiseasecategoryData->where('genericBrandId', $genericbrandData->genericBrandId ) as $diseasecategory){

                                    if($diseasecategory->diseaseCategory){
                                    $improvised_disease_category .= " ".$diseasecategory->diseaseCategory; 
                                    $extracted_disease_category_from_DB = DB::table('diseasecategory')
                                    ->where('diseaseCategory',$diseasecategory->diseaseCategory) 
                                    ->first(); 
                                    $improvised_disease_categoryCN .= $extracted_disease_category_from_DB->diseaseCategoryCN;
                                    $improvised_disease_categoryRU .= $extracted_disease_category_from_DB->diseaseCategoryRU;
                                  }
                                  }
                                  // dd($genericbrandData->category);
                                  // dd($improvised_disease_categoryCN);
                                  // dd($genericbrandData);
                                  $extracted_category = DB::table('category')->where('category', $genericbrandData->category)->first();
                                  $extracted_categoryEN = "";
                                  $extracted_categoryCN = "";
                                  $extracted_categoryRU = "";
                                  if($extracted_category){
                                    $extracted_categoryEN = $extracted_category->category;
                                    $extracted_categoryCN = $extracted_category->categoryCN;
                                    $extracted_categoryRU = $extracted_category->categoryRU;
                                  }
                                  // dd($extracted_categoryEN);
                                  // dd($extracted_categoryCN);
                                  // dd($extracted_categoryRU);


                              @endphp
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row ">
                                          <label class="col-sm-4 col-form-label control-label">Meta keywords
                                            <button type="button" class="btn btn-xs btn-warning" title="Meta Keywords Update">                                          
                                              <a href="{{route('generic.settings.meta_keywords.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                                </a>
                                            </button>
                                          </label>
                                          <div class="col-sm-8">
                                            @if ($genericbrandData->meta_keywords)
                                              <textarea id="meta_keywords" name="meta_keywords"  rows="5" class="form-control" >{{$genericbrandData->meta_keywords}}
                                              </textarea>
                                            @else                                                
                                              <textarea id="meta_keywords" name="meta_keywords"  rows="5" class="form-control" >{{ $genericbrandData->genericBrand.",".$genericbrandData->genericBrand.$imporvised_genericStrength.",".$genericbrandData->genericBrand." Price / Cost,".$genericbrandData->genericBrand." Price / Cost in Bangladesh / India,".$genericbrandData->genericName.","."Generic ".$genericbrandData->genericName.","."Generic ".$genericbrandData->genericName." Cost / Price,Generic ".$genericbrandData->genericName." Cost / Price in India / Bangladesh,Generic ". $extracted_globalTradeName[0].",Generic ". $extracted_globalTradeName[0]." Price / Cost,Generic ".$extracted_globalTradeName[0]." Price / Cost in India / Bangladesh,".$genericbrandData->category." Drugs / Medicine,".$genericbrandData->category." Generic Medicine / Drugs,".$improvised_disease_category." Medicine / Drugs,".$improvised_disease_category." Generic Drugs / Medicine,".$improvised_disease_category." Treatment in Bangladesh/ India,".$genericbrandData->genericCompany." ".$genericbrandData->genericBrand.",".$genericbrandData->genericBrand." ".$genericbrandData->genericCompany.",Online Medicine Order / Purchase From Bangladesh/ India,MedicineForWorld,Medicine For World,MFW" }}
                                              </textarea>
                                            @endif

                                          </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Meta keywords (CN)
                                          <button type="button" class="btn btn-xs btn-warning" title="Meta Keywords CN Update">                                          
                                            <a href="{{route('generic.settings.meta_keywords.cn.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                              </a>
                                          </button>
                                        </label>
                                        <div class="col-sm-8">
                                          @if ($genericbrandData->meta_keywordsCN)
                                              <textarea id="meta_keywordsCN" name="meta_keywordsCN"  rows="5" class="form-control" >{{$genericbrandData->meta_keywordsCN}}
                                              </textarea>
                                          @else                                                
                                            <textarea id="meta_keywordsCN" name="meta_keywordsCN"  rows="5" class="form-control" >{{ $genericbrandData->genericBrandCN.",".$genericbrandData->genericBrandCN.$imporvised_genericStrengthCN.",".$genericbrandData->genericBrandCN." 价格,".$genericbrandData->genericBrandCN."成本,".$genericbrandData->genericBrandCN."价格/成本在印度,".$genericbrandData->genericBrandCN."成本/价格在孟加拉,".$genericbrandData->genericNameCN.",通用的".$genericbrandData->genericNameCN.",通用的".$genericbrandData->genericNameCN."价格,通用的".$genericbrandData->genericNameCN."成本, 通用的".$genericbrandData->genericNameCN."成本/价格在印度,通用的".$genericbrandData->genericNameCN."价格/成本在孟加拉,通用的".$extracted_globalTradeNameCN[0].",通用的".$extracted_globalTradeNameCN[0]."价格,通用的".$extracted_globalTradeNameCN[0]."成本,通用的".$extracted_globalTradeNameCN[0]."价格/成本在印度,通用的".$extracted_globalTradeNameCN[0]."成本/价格在孟加拉,".$extracted_categoryCN."药物,".$extracted_categoryCN."药,".$extracted_categoryCN."通用的药物,".$extracted_categoryCN."通用的药,".$improvised_disease_categoryCN."药物,".$improvised_disease_categoryCN."药".$improvised_disease_categoryCN."通用的药物,".$improvised_disease_categoryCN."通用的药".$improvised_disease_categoryCN."在孟加拉治疗,".$improvised_disease_categoryCN."在印度治疗,".$genericbrandData->genericCompanyCN." ".$genericbrandData->genericBrandCN.",".$genericbrandData->genericBrandCN." ".$genericbrandData->genericCompanyCN.",从孟加拉国网上订购/购买药品, 网上订购/从印度购买药品, 世界医学, MFW "}}
                                            </textarea>
                                          @endif                                          
                                          
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Meta keywords (RU)
                                          <button type="button" class="btn btn-xs btn-warning" title="Meta Keywords RU Update">                                          
                                            <a href="{{route('generic.settings.meta_keywords.ru.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                              </a>
                                          </button>
                                        </label>
                                        <div class="col-sm-8">
                                          @if ($genericbrandData->meta_keywordsRU)
                                              <textarea id="meta_keywordsRU" name="meta_keywordsRU"  rows="5" class="form-control" >{{$genericbrandData->meta_keywordsRU}}
                                              </textarea>
                                          @else                                                
                                            <textarea id="meta_keywordsRU" name="meta_keywordsRU"  rows="5" class="form-control" >{{ $genericbrandData->genericBrandRU.",".$genericbrandData->genericBrandRU.$imporvised_genericStrengthRU.",".$genericbrandData->genericBrandRU." Цена / Стоимость,".$genericbrandData->genericBrandRU." Цена / Стоимость в России / Индия / Бангладеш,".$genericbrandData->genericNameRU.",Родовое ".$genericbrandData->genericNameRU.",Родовое ".$genericbrandData->genericNameRU." Стоимость / Цена,Родовое ".$genericbrandData->genericNameRU." Стоимость / Цена в Бангладеш / России / Индия,Родовое ".$extracted_globalTradeNameRU[0].",Родовое ".$extracted_globalTradeNameRU[0]." Цена / Стоимость,Родовое ".$extracted_globalTradeNameRU[0]." Стоимость / Цена в  России / Индия / Бангладеш,".$extracted_categoryRU." Препарат / Медицина,".$extracted_categoryRU." Родовое Медицина / Препарат,".$improvised_disease_categoryRU." Препарат / Медицина,".$improvised_disease_categoryRU." Родовое Препарат / Медицина,".$improvised_disease_categoryRU." Лечение в Бангладеш / России / Индия,".$genericbrandData->genericCompanyRU." ".$genericbrandData->genericBrandRU.",".$genericbrandData->genericBrandRU." ".$genericbrandData->genericCompanyRU.", Онлайн Препарат / Медицина Заказ / Покупка Из Бангладеш / Индия / России, МЕДИЦИНУ ДЛЯ МИРА,MFW"}}
                                            </textarea>
                                          @endif                                         
                                          
                                        </div>
                                      </div>
                                    </div>                                    

                                </div>                                

                                <div class="row">

                                  <div class="col-md-6">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Meta description
                                          <button type="button" class="btn btn-xs btn-warning" title="Meta Description Update">                                          
                                            <a href="{{route('generic.settings.meta_description.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                              </a>
                                          </button>
                                        </label>
                                        <div class="col-sm-8">
                                          @if ($genericbrandData->meta_description)
                                            <textarea id="meta_description" name="meta_description"  rows="5" class="form-control" >{{$genericbrandData->meta_description}} </textarea>
                                          @else
                                            <textarea id="meta_description" name="meta_description"  rows="5" class="form-control" >{{"Buy Generic ".$extracted_globalTradeName[0]."prescription medicine for ".$genericbrandData->diseaseCategory.". ".$genericbrandData->genericBrand." (".$genericbrandData->genericName.") online price- ".$genericbrandData->dosageForm."- Bangladesh. medicineforworld@gmail.com"  }} </textarea>
                                          @endif
                                          </div>
                                      </div>
                                  </div>


                                  <div class="col-md-6">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Meta description (CN)
                                          <button type="button" class="btn btn-xs btn-warning" title="Meta Description CN Update">                                          
                                            <a href="{{route('generic.settings.meta_description.cn.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                              </a>
                                          </button>
                                        </label>
                                        <div class="col-sm-8">
                                          @if ($genericbrandData->meta_descriptionCN)
                                            <textarea id="meta_descriptionCN" name="meta_descriptionCN"  rows="5" class="form-control" >{{$genericbrandData->meta_descriptionCN}} </textarea>
                                          @else
                                            <textarea id="meta_descriptionCN" name="meta_descriptionCN"  rows="5" class="form-control" >{{ "买通用的 ".$extracted_globalTradeNameCN[0]." 处方药物为 ".$improvised_disease_categoryCN.". ".$genericbrandData->genericBrandCN." (".$genericbrandData->genericNameCN.") 联机价格- ".$genericbrandData->dosageFormCN."-  孟加拉国. 微信: medicineforworld_mfw."  }} </textarea>
                                          @endif                                            
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Meta description (RU)
                                          <button type="button" class="btn btn-xs btn-warning" title="Meta Description RU Update">                                          
                                            <a href="{{route('generic.settings.meta_description.ru.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                              </a>
                                          </button>
                                        </label>
                                        <div class="col-sm-8">
                                          @if ($genericbrandData->meta_descriptionRU)
                                            <textarea id="meta_descriptionRU" name="meta_descriptionRU"  rows="5" class="form-control" >{{$genericbrandData->meta_descriptionRU}} </textarea>
                                          @else
                                            <textarea id="meta_descriptionRU" name="meta_descriptionRU"  rows="5" class="form-control" >{{ "купить Родовое ".$extracted_globalTradeNameRU[0]."рецептурное Препарат для ".$improvised_disease_categoryRU.". ".$genericbrandData->genericBrandRU." (".$genericbrandData->genericNameRU.") онлайн цена- ".$genericbrandData->dosageFormRU."- Бангладеш. medicineforworld@gmail.com"  }} </textarea>
                                          @endif  
                                            
                                          </div>
                                      </div>
                                  </div>
                                  {{-- {{dd($genericbrandData)}} --}}

                                </div>

                                {{-- {{dd($genericbrandData)}} --}}

                                <div class="row">

                                  <div class="col-md-6">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Alt Tag For Image
                                          <button type="button" class="btn btn-xs btn-warning" title="Alt Tag Update">                                          
                                            <a href="{{route('generic.settings.alt_tag.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                              </a>
                                          </button>
                                        </label>
                                        <div class="col-sm-8">
                                          @if ($genericbrandData->alt_tag)
                                            <textarea id="alt_tag" name="alt_tag"  rows="2" class="form-control" >{{$genericbrandData->alt_tag}}</textarea>
                                          @else
                                            <textarea id="alt_tag" name="alt_tag"  rows="2" class="form-control" >{{ $genericbrandData->genericBrand."- Generic ".$genericbrandData->genericName."- ".$genericbrandData->genericCompany }}</textarea>
                                          @endif
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Alt Tag For Image (CN)
                                          <button type="button" class="btn btn-xs btn-warning" title="Alt Tag CN Update">                                          
                                            <a href="{{route('generic.settings.alt_tag_CN.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                              </a>
                                          </button>
                                        </label>
                                        <div class="col-sm-8">
                                          @if ($genericbrandData->alt_tag_CN)
                                            <textarea id="alt_tag_CN" name="alt_tag_CN"  rows="2" class="form-control" >{{$genericbrandData->alt_tag_CN}}</textarea>
                                          @else
                                            <textarea id="alt_tag_CN" name="alt_tag_CN"  rows="2" class="form-control" >{{ $genericbrandData->genericBrandCN."- 通用的 ".$genericbrandData->genericNameCN."- ".$genericbrandData->genericCompanyCN }}</textarea>
                                          @endif                                            
                                          </div>
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Alt Tag For Image (RU)
                                          <button type="button" class="btn btn-xs btn-warning" title="Alt Tag RU Update">                                          
                                            <a href="{{route('generic.settings.alt_tag_RU.update',$genericbrandData->genericBrandId)}}"><i class="fa fa-arrow-up" aria-hidden="true"></i>
                                              </a>
                                          </button>
                                        </label>
                                        <div class="col-sm-8">
                                          @if ($genericbrandData->alt_tag_RU)
                                            <textarea id="alt_tag_RU" name="alt_tag_RU"  rows="2" class="form-control" >{{$genericbrandData->alt_tag_RU}}</textarea>
                                          @else
                                            <textarea id="alt_tag_RU" name="alt_tag_RU"  rows="2" class="form-control" >{{ $genericbrandData->genericBrandRU."- Родовое ".$genericbrandData->genericNameRU."- ".$genericbrandData->genericCompanyRU }}</textarea>
                                          @endif
                                            
                                          </div>
                                      </div>
                                  </div>

                                </div>









                                {{-- Generic Brand Videos start --}}
                                {{-- Generic Brand Videos start --}}

			                            <fieldset  class=" mb-4 mt-5">
                                      <legend>Add Generic Brand Videos</legend>

											
			                                <div class="row ">
                                          <input type="button" class="btn btn-primary add-genericbrandvideos-row  ml-2 mb-3" value="Add Generic Brand Video" id="add-genericbrandvideos-row">
			                                </div>
			                                


			                                <table id="genericbrandvideos_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Picture</th>
			                                            <th class="text-center">Generic Brand Video </th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>

                                            @foreach ($genericbrandvideosData as $genericbrandvideo)
                                              <tr>
                                                <td>
                                                  <input type="checkbox" name="record">
                                                    <input type="text" name="oldthumbnailUrl[]" value="{{$genericbrandvideo->thumbnailUrl}}" hidden readonly multiple>
                                                    <input type="text" name="oldvideoUrl[]" value="{{$genericbrandvideo->videoUrl}}" hidden readonly multiple>
                                                  </td>
                                                <td>
                                                  <input id="thumbnailUrl"  class='file' type="file"  multiple data-show-upload="true" data-show-caption="true" >
																
                                                  @if ($genericbrandvideo->thumbnailUrl)
                                                        <img class="img-fluid img-thumbnail lozad" data-src="{{ asset($genericbrandvideo->thumbnailUrl) }}" data-mfp-src="{{ asset($genericbrandvideo->thumbnailUrl) }}" alt="" style="max-width: 100px; max-height: 200px;">

                                                        {{--  <a href="{{ route('genericbrandvideothumbnaildeletenew', $genericbrandvideo->genericbrandVideoId) }}" class=" tooltipster" title="Delete selected file?" >
                                                          <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                        </a>  --}}
                                                  @endif
                                                </td>

                                                <td>
                                                  <input id="videoUrl"  class='file' type="file"  multiple data-show-upload="true" data-show-caption="true" >
																
                                                  @if ($genericbrandvideo->videoUrl)
                                                        
                                                      <span class="fr-video fr-deletable fr-fvc fr-dvi fr-draggable" contenteditable="false">
                                                          <video  controls  style="max-width:250px;  display:inline-table;"  class="img-gallary-problem"  >
                                                              <source src="{{ $genericbrandvideo->videoUrl }}"  type="video/mp4">
                                                              <source src="{{ $genericbrandvideo->videoUrl }}"  type="video/webm">
                                                              <source src="{{ $genericbrandvideo->videoUrl }}"  type="video/ogg">
                                                          </video>
                                                      </span>
                                                        
                                                  @endif
                                                </td>


                                              </tr>
                                            @endforeach
			                                    </tbody>

			                                </table>

			                              
                                      <button type="button" class="btn btn-danger genericbrandvideos_table_delete_row mt-2" id="delete_social_media">Delete Generic Brand Video</button>

			                            </fieldset>

                                {{-- Generic Brand Videos --}}
                                {{-- Generic Brand Videos --}}
                    






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

			                                    	 @foreach ($genericbranddiseasecategoryData->where('genericBrandId', $genericbrandData->genericBrandId ) as $diseasecategory)
			                                            <tr>
			                                              <td><input type="checkbox" name="record"></td>
			                                              <td>
			                                                
			                                                <input  class="form-control" type="number" name="diseaseCategoryId[]"  value="{{ $diseasecategory->diseaseCategoryId }}" readonly multiple hidden>
	                                                  		<input  class="form-control" type="text"  value="{{ $diseasecategory->diseaseCategory }}" readonly multiple >
			                                              	
			                                              </td>
			                                              
			                                              
			                                            </tr>
			                                        @endforeach




			                                    </tbody>

			                                </table>


			                              <button type="button" class="btn btn-danger disease_category_table_delete_row mt-2" id="delete_social_media">Delete Disease Category</button>
			                              

			                            </fieldset>

                                {{-- disease category end --}}
                                {{-- disease category end --}}






			                           


			                            

			                            <fieldset  class=" mb-4 mt-5"  id="genericBrandPic-fieldset">
			                              <legend>Add Generic Brand Pictures</legend>

			                              <div class="row mb-5">
			                              	<div class="container">

                                        <h4 class="font-weight-light text-center text-lg-left mt-4 mb-0">Uploaded Pictures</h4>

                                        <hr class="mt-2 mb-5">

                                        <div class="row text-center text-lg-left" id="genericBrandPic-delete">

                                          @foreach ($genericbrandpicData->where('genericBrandId', $genericbrandData->genericBrandId ) as $genericbrandpic)

                                            <div class="col-lg-3 col-md-4 col-6 uploaded-pic" id="uploaded-pic-{{ $genericbrandpic->genericBrandPicId }}">
                                              <a href="#" class="d-block mb-4 h-100">
                                                  
                                                    <img class="img-fluid img-thumbnail" src="{{asset($genericbrandpic->picPath) }}" alt="" >
                                                    <div class="pic-delete " data-genericbrandpicid='{{ $genericbrandpic->genericBrandPicId }}'>
                                                      <a href="#" class=" tooltipster" title="Delete selected picture ?" >
                                                        <i class="fa fa-trash fa-lg"></i>
                                                      </a>
                                                    </div>
                                                  </a>
                                            </div>
                                        @endforeach
                                          
                                        </div>
				                            </div>
			                              </div>

			                                {{-- <div class="row ">
												
				                                <div class="col-md-6">
					                                <input type="button" class="btn btn-primary add-picture-row  mb-5 float-left" value="Add Row" id="add_brandPicture">
				                                </div>
			                                </div> --}}
			                                


			                                {{-- <table id="brandpic_table" width="100%">
			                                    <thead>
			                                        <tr>
			                                            <th>Select</th>
			                                            <th class="text-center">Picture</th>
			                                        </tr>
			                                    </thead>

			                                    <tbody>

			                                    


			                                    </tbody>

			                                </table> --}}


                                    {{-- <button type="button" class="btn btn-danger delete-picture-row mt-2" id="delete_item">Delete Picture</button> --}}
                                    
                                   

                                    <div class="col-md-12">
                                      <div class="form-group row required">
                                        <label class="col-sm-4 col-form-label control-label">Images (400x400)</label>
                                        <div class="col-sm-8">
                                          <input id='picPath' class='form-control' type='file' data-show-upload='true' name='picPath[]'   data-show-caption='true'   multiple  >
                                          <div >
                                              <p style="margin:0px; font-size: 11px;"><strong>Note:</strong> </p>
                                              <p style="margin:0px; font-size: 11px;">1. Only  jpeg, png format can be uploaded.</p>
                                              <p style="margin:0px; font-size: 11px;">2. File size limit 10mb.</p>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
			                              


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








{{-- indication and dosage --}}
{{-- indication and dosage --}}
{{-- indication and dosage --}}
<div class="content-wrapper" style="min-height: 0px;" id="Indication">

		<div class="card col-md-12">
			<div class="card-body">
		        <h4 class="card-title" style="text-align: center;">Indication & Dosage</h4>


			
			    <div class="row">
			        <div class="col-md-12 col-md-offset-2">
			            <div class="panel panel-default">
			                {{-- <div class="panel-heading">Add New User</div> --}}

			                <div class="panel-body">
			                    <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generic.settings.brand.update2', $genericbrandData->genericBrandId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
					                          {{method_field('put')}}
					                          {{ csrf_field() }}



					                            <div class="col-md-12">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Indication & Dosage</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor"  rows="4" id="indicationanddosage" name="indicationanddosage"  contenteditable="false" required>{{ $genericbrandData->indicationanddosage }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Indication & Dosage (CN)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="indicationanddosageCN" name="indicationanddosageCN" >{{ $genericbrandData->indicationanddosageCN }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Indication & Dosage (RU)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="indicationanddosageRU" name="indicationanddosageRU" >{{ $genericbrandData->indicationanddosageRU }} </textarea>
					                                </div>
					                              </div>
					                            </div>


					                           


												<div class="form-group">
												  <div class="col-md-12 col-md-offset-4 mt-2">

												      <button type="submit" class="btn btn-success float-right" id="indicationanddosageUpdateSubmit">
												          Update
												      </button>
												      
												      
												  </div>
												</div>

					            </form>
			                </div>
			            </div>
			        </div>
			    </div>
		    </div>
	    </div>
</div>
{{-- indication and dosage --}}
{{-- indication and dosage --}}
{{-- indication and dosage --}}





















{{-- side effects --}}
{{-- side effects --}}
{{-- side effects --}}
<div class="content-wrapper" style="min-height: 0px;" id="side_effects">

		<div class="card col-md-12">
			<div class="card-body">
		        <h4 class="card-title" style="text-align: center;">Side Effects</h4>


			
			    <div class="row">
			        <div class="col-md-12 col-md-offset-2">
			            <div class="panel panel-default">
			                {{-- <div class="panel-heading">Add New User</div> --}}

			                <div class="panel-body">
			                    <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generic.settings.brand.update2', $genericbrandData->genericBrandId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
					                          {{method_field('put')}}
					                          {{ csrf_field() }}



					                            <div class="col-md-12">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Side Effects</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor"  rows="4" id="sideeffects" name="sideeffects"  contenteditable="false" required>{{ $genericbrandData->sideeffects }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Side Effects (CN)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="sideeffectsCN" name="sideeffectsCN" >{{ $genericbrandData->sideeffectsCN }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Side Effects (RU)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="sideeffectsRU" name="sideeffectsRU" >{{ $genericbrandData->sideeffectsRU }} </textarea>
					                                </div>
					                              </div>
					                            </div>


					                           


												<div class="form-group">
												  <div class="col-md-12 col-md-offset-4 mt-2">

												      <button type="submit" class="btn btn-success float-right" id="sideeffectsUpdateSubmit">
												          Update
												      </button>
												      
												      
												  </div>
												</div>

					            </form>
			                </div>
			            </div>
			        </div>
			    </div>
		    </div>
	    </div>
</div>
{{-- side effects --}}
{{-- side effects --}}
{{-- side effects --}}



















{{-- Prescribing Information --}}
{{-- Prescribing Information --}}
{{-- Prescribing Information --}}
<div class="content-wrapper" style="min-height: 0px;" id="Prescribing_information">

		<div class="card col-md-12">
			<div class="card-body">
		        <h4 class="card-title" style="text-align: center;">Prescribing Information</h4>


			
			    <div class="row">
			        <div class="col-md-12 col-md-offset-2">
			            <div class="panel panel-default">
			                {{-- <div class="panel-heading">Add New User</div> --}}

			                <div class="panel-body">
			                    <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generic.settings.brand.update2', $genericbrandData->genericBrandId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
					                          {{method_field('put')}}
					                          {{ csrf_field() }}



					                            <div class="col-md-12">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Prescribing Information</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor"  rows="4" id="prescribinginformation" name="prescribinginformation"  contenteditable="false" required>{{ $genericbrandData->prescribinginformation }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Prescribing Information (CN)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="prescribinginformationCN" name="prescribinginformationCN" >{{ $genericbrandData->prescribinginformationCN }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Prescribing Information (RU)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="prescribinginformationRU" name="prescribinginformationRU" >{{ $genericbrandData->prescribinginformationRU }} </textarea>
					                                </div>
					                              </div>
					                            </div>


					                           


												<div class="form-group">
												  <div class="col-md-12 col-md-offset-4 mt-2">

												      <button type="submit" class="btn btn-success float-right" id="prescribinginformationUpdateSubmit">
												          Update
												      </button>
												      
												      
												  </div>
												</div>

					            </form>
			                </div>
			            </div>
			        </div>
			    </div>
		    </div>
	    </div>
</div>
{{-- Prescribing Information --}}
{{-- Prescribing Information --}}
{{-- Prescribing Information --}}


















{{-- Additional Information --}}
{{-- Additional Information --}}
{{-- Additional Information --}}
<div class="content-wrapper" style="min-height: 0px;" id="additional_information">

		<div class="card col-md-12">
			<div class="card-body">
		        <h4 class="card-title" style="text-align: center;">Additional Information</h4>


			
			    <div class="row">
			        <div class="col-md-12 col-md-offset-2">
			            <div class="panel panel-default">
			                {{-- <div class="panel-heading">Add New User</div> --}}

			                <div class="panel-body">
			                    <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generic.settings.brand.update2', $genericbrandData->genericBrandId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
					                          {{method_field('put')}}
					                          {{ csrf_field() }}



					                            <div class="col-md-12">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Additional Information</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor"  rows="4" id="additionalinformation" name="additionalinformation"  contenteditable="false" required>{{ $genericbrandData->additionalinformation }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Additional Information (CN)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="additionalinformationCN" name="additionalinformationCN" >{{ $genericbrandData->additionalinformationCN }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Additional Information (RU)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="additionalinformationRU" name="additionalinformationRU" >{{ $genericbrandData->additionalinformationRU }} </textarea>
					                                </div>
					                              </div>
					                            </div>


					                           


												<div class="form-group">
												  <div class="col-md-12 col-md-offset-4 mt-2">

												      <button type="submit" class="btn btn-success float-right" id="additionalinformationUpdateSubmit">
												          Update
												      </button>
												      
												      
												  </div>
												</div>

					            </form>
			                </div>
			            </div>
			        </div>
			    </div>
		    </div>
	    </div>
</div>
{{-- Additional Information --}}
{{-- Additional Information --}}
{{-- Additional Information --}}













{{-- FAQ --}}
{{-- FAQ --}}
{{-- FAQ --}}
<div class="content-wrapper" style="min-height: 0px;" id="faq">

		<div class="card col-md-12">
			<div class="card-body">
		        <h4 class="card-title" style="text-align: center;">FAQ</h4>


			
			    <div class="row">
			        <div class="col-md-12 col-md-offset-2">
			            <div class="panel panel-default">
			                {{-- <div class="panel-heading">Add New User</div> --}}

			                <div class="panel-body">
			                    <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generic.settings.brand.update2', $genericbrandData->genericBrandId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
					                          {{method_field('put')}}
					                          {{ csrf_field() }}



					                            <div class="col-md-12">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">FAQ</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor"  rows="4" id="faq" name="faq"  contenteditable="false" required>{{ $genericbrandData->faq }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">FAQ (CN)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="faqCN" name="faqCN" >{{ $genericbrandData->faqCN }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">FAQ (RU)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="faqRU" name="faqRU" >{{ $genericbrandData->faqRU }} </textarea>
					                                </div>
					                              </div>
					                            </div>


					                           


												<div class="form-group">
												  <div class="col-md-12 col-md-offset-4 mt-2">

												      <button type="submit" class="btn btn-success float-right" id="faqUpdateSubmit">
												          Update
												      </button>
												      
												      
												  </div>
												</div>

					            </form>
			                </div>
			            </div>
			        </div>
			    </div>
		    </div>
	    </div>
</div>
{{-- FAQ --}}
{{-- FAQ --}}
{{-- FAQ --}}












{{-- Suggestion --}}
{{-- Suggestion --}}
{{-- Suggestion --}}
<div class="content-wrapper" style="min-height: 0px;" id="suggestions">

		<div class="card col-md-12">
			<div class="card-body">
		        <h4 class="card-title" style="text-align: center;">Suggestion</h4>


			
			    <div class="row">
			        <div class="col-md-12 col-md-offset-2">
			            <div class="panel panel-default">
			                {{-- <div class="panel-heading">Add New User</div> --}}

			                <div class="panel-body">
			                    <form id="suggestion-form" class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generic.settings.brand.update2', $genericbrandData->genericBrandId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
					                          {{method_field('put')}}
					                          {{ csrf_field() }}



                                    <div class="col-md-12">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Suggestion</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control tinymce-editor"  id="suggestion" name="suggestion" >{{ $genericbrandData->suggestion }} </textarea>
                                        </div>
                                      </div>
                                    </div>


                                    <div class="col-md-12">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Suggestion (CN)</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control tinymce-editor"  id="suggestionCN" name="suggestionCN" >{{ $genericbrandData->suggestionCN }} </textarea>
                                        </div>
                                      </div>
                                    </div>


                                    <div class="col-md-12">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">Suggestion (RU)</label>
                                        <div class="col-sm-8">
                                          <textarea class="form-control tinymce-editor"  id="suggestionRU" name="suggestionRU" >{{ $genericbrandData->suggestionRU }} </textarea>
                                        </div>
                                      </div>
                                    </div>


                                    
                                      


					                           


												<div class="form-group">
												  <div class="col-md-12 col-md-offset-4 mt-2">

												      <button type="submit" class="btn btn-success float-right" id="suggestionUpdateSubmit">
												          Update
												      </button>
												      
												      
												  </div>
												</div>

					            </form>
			                </div>
			            </div>
			        </div>
			    </div>
		    </div>
	    </div>
</div>
{{-- Suggestion --}}
{{-- Suggestion --}}
{{-- Suggestion --}}








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

	                var markup = "<tr><td><input type='checkbox' name='record'></td><td> <input id='picPath' class='form-control' type='file' data-show-upload='true' name='picPath[]'   data-show-caption='true'  readonly multiple  > </td> " +"</tr>";


	                $("table tbody").append(markup);


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
    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
      @foreach ($genericbranddiseasecategoryData->where('genericBrandId', Request('genericBrandId')) as $genericbranddiseasecategory)
        diseaseCategoryList.push( "{{ $genericbranddiseasecategory->diseaseCategoryId}}" );
      @endforeach
      // console.log(diseaseCategoryList)
    };
    

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






<script type="text/javascript">

  $('#genericBrandPic-delete').on('click', '.pic-delete', function () {
            if(!(confirm('Are you sure?'))) return false;

            $.ajaxSetup({
                headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
            });

            var genericBrandPicId = $(this).data('genericbrandpicid');
            console.log(genericBrandPicId)
           


            $.ajax({
                url: '/generics/settings/generic/genericBrandPicDelete/'+genericBrandPicId,
                method: 'DELETE',
                dataType:'JSON'
            })
            .done(function(response) {
              console.log('deleted')
              console.log(response.message)

              window.location.href = "?#genericBrandPic-fieldset";
              // alert(response.message)

              $("#uploaded-pic-"+genericBrandPicId).remove();


            })
            .fail(function() {
              console.log("error");
              alert('Could not find the record!')
            })
            .always(function() {
              console.log("complete");
            });
        });
</script>





{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#genericId').select2({
     	// dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
     	// dropdownAutoWidth : true,
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
     	// dropdownAutoWidth : true,
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
     	// dropdownAutoWidth : true,
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
     	// dropdownAutoWidth : true,
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





















<script type="text/javascript">
  $(document).ready(function() {
      $("#picPath").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          allowedFileExtensions: ["jpg","jpeg", "png"],
          // maxFileCount: 1,
          maxFileSize:1024*10,

      });     

      $("#vimeovideothumb").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          allowedFileExtensions: ["jpg","jpeg", "png"],
          maxFileCount: 1,
          maxFileSize:1024*10,

      });  

      $("#dailymotionvideothumb").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          allowedFileExtensions: ["jpg","jpeg", "png"],
          maxFileCount: 1,
          maxFileSize:1024*10,

      });   

      $("#videothumb").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          allowedFileExtensions: ["jpg","jpeg", "png"],
          maxFileCount: 1,
          maxFileSize:1024*10,

      }); 
  });
</script>













{{-- generic brand videos  adding, deleting code --}}

<script type="text/javascript">

  var genericBrandVideosList = [];   // checking if the module is already enlisted (part)
  // already defined modules for that role is being enlisted in the array
  {{--  window.onload = function() {
    @foreach ($paymentaccountdetailsData as $paymentaccountdetail)
      genericBrandVideosList.push( "{{ $paymentaccountdetail->paymentAccountDetailsTitle}}" );
    @endforeach
    // console.log(genericBrandVideosList)
  };  --}}
  

  $(document).ready(function(){
      $("#add-genericbrandvideos-row").on('click', function(){


                var markup = "<tr><td><input type='checkbox' name='record'></td> "+
                            "<td> <input  id='thumbnailUrl' name='thumbnailUrl[]'  type='file' class='file' multiple data-show-upload='true' data-show-caption='true'   > <img   style='max-width: 200px; max-height: 200px;' /> </td>" +   
                            
                            "<td> <input  id='videoUrl' name='videoUrl[]'  type='file' class='file' multiple data-show-upload='true' data-show-caption='true'   >  </td>" +
                            
                            "</tr>";
                $("#genericbrandvideos_table tbody").append(markup);

      });


      
      // Find and remove selected table rows
      $(".genericbrandvideos_table_delete_row").click(function(){
          $("#genericbrandvideos_table tbody").find('input[name="record"]').each(function(){

            if($(this).is(":checked")){

                  var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                  console.log(rowindex);

                   // remove/delete/pop array element before delete the row 
                   // checking if the module is already enlisted 
              
              // alert(genericBrandVideosList);
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


<script type="text/javascript">
  $(document).ready(function() {
      $("#thumbnailUrl").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          // uploadUrl: "/site/image-upload",
          allowedFileExtensions: ["jpg","jpeg", "png", "gif", "webp"],
          // maxImageWidth: 2000,                                                                                                                                                                        
          maxFileCount: 1,
          // resizeImage: true
      });   
      
      $("#oldthumbnailUrl").fileinput({
        theme : 'fa',
        overwriteInitial:false,
        // uploadUrl: "/site/image-upload",
        allowedFileExtensions: ["jpg","jpeg", "png", "gif", "webp"],
        // maxImageWidth: 2000,                                                                                                                                                                        
        maxFileCount: 1,
        // resizeImage: true
    });  
 
      $("#videourl").fileinput({
          theme : 'fa',
          overwriteInitial:false,
          maxFileCount: 1,
          allowedFileExtensions: ["mp4"],
          maxFileSize:1024*50,
      });   
      
      $("#oldvideourl").fileinput({
        theme : 'fa',
        overwriteInitial:false,
        maxFileCount: 1,
        allowedFileExtensions: ["mp4"],
        maxFileSize:1024*50,
    });
      
      
  });
</script>

{{-- Scroll progress Bar --}}
<script>
  // When the user scrolls the page, execute myFunction 
  window.onscroll = function() {myFunction()};
  
  function myFunction() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var scrolled = (winScroll / height) * 100;
    document.getElementById("myBar").style.width = scrolled + "%";
  }
  </script>




@endsection