@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Generic Brand Prices')
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







{{-- Generic Pack Sizes form table --}}
{{-- Generic Pack Sizes form table --}}
  <div class="card">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center;">Generic Brand Pack Sizes & Prices</h4>


        <a href="{{ route('generic.pack.sizes.create') }}"  class="btn btn-default " style="margin-bottom: 10px; "  ><span>+ Create New Generic Brand Pack Sizes & Prices</span></a>
        
        <table id="datatable2WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">S/L</th>
                      <th scope="col">Action</th>
                      <th scope="col">Generic</th>
                      <th scope="col">Generic Brand</th>
                      <th scope="col">Generic Company</th>
                      <th scope="col">Generic Strength</th>
                      <th scope="col">Dosage Form</th>
                      <th scope="col">Pack Size</th>
                      <th scope="col">Pack Type</th>
                      <th scope="col">Available</th>
                      <th scope="col">Is Frontend Visible?</th>
                      
                      <th scope="col">Category</th>
                      <th scope="col">Disease Category</th>
                      <th scope="col">Global trade name & company </th>
                      <th scope="col" >Uses for </th>
                      <th scope="col">Dosing detail </th>
                      <th scope="col">Rx </th>
                      <th scope="col">Avg price of originator </th>
                      <th scope="col">Global market price & site </th>
                      <th scope="col">Picture link </th>
                      <th scope="col">Video link </th>
                      <th scope="col">Youtube</th>
                      <th scope="col">Dailymotion</th>
                      <th scope="col">Vimeo</th>


                      {{-- <th scope="col">Weight (GM)</th> --}}
                      <th scope="col">Patient Selling Price</th>
                      <th scope="col">Patient MOQ</th>
                      <th scope="col">Dealer Selling Price</th>
                      <th scope="col">Dealer MOQ</th>
                      <th scope="col">VIP Selling Price</th>
                      <th scope="col">Company Patient Selling Price</th>
                      <th scope="col">Company Patient Selling Price Old</th>
                      <th scope="col">Company Local Selling Price</th>
                      <th scope="col">Supplier Info</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($genericPackSizesData->sortByDesc('genericPackSizeId')  as $genericpacksize)
                      <tr>
                          <td>{{$loop->index+1}}</td>
                          <td id="tdtableaction">

                            <div class="d-inline-block">
                                 <a role="button" href="{{ route('generic.pack.sizes.edit', $genericpacksize->genericPackSizeId) }}"  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                             </div>

                             <div class="d-inline-block tooltipster" title="Delete selected record?">
                                 <form  method="post" action="{{ route('generics.settings.packSizes.delete', $genericpacksize->genericPackSizeId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                          <td>{{$genericpacksize->genericName}}</td>
                          <td><a href="{{ route('productDetailsPageCaller', array(app()->getLocale(), $genericpacksize->genericBrandId)) }}" target="_blank">{{$genericpacksize->genericBrand}}</a></td>

                          
                         


                          <td>{{$genericpacksize->genericCompany}}</td>
                          <td>{{$genericpacksize->genericStrength}}</td>
                          <td>{{$genericpacksize->dosageForm}}</td>
                          <td>{{$genericpacksize->genericPackSize}}</td>
                          <td>{{$genericpacksize->packType}}</td>
                          <td
                              @if ($genericpacksize->availabilityTypeId==1)
                                  class="text-success font-weight-bold"
                              @else
                                  class="text-danger font-weight-bold"
                              @endif
                            >{{$availabilitytypeData->where('availabilityTypeId', $genericpacksize->availabilityTypeId)->pluck('availabilityType')->first()}}
                          </td>

                          <td
                            @if ($genericpacksize->isFrontendVisible==1)
                                class="text-success font-weight-bold"
                            @else
                                class="text-danger font-weight-bold"
                            @endif
                              >
                              @if ($genericpacksize->isFrontendVisible==1)
                                Visible
                              @else
                                  Invisible
                              @endif
                          </td>



                          <td>{{$genericpacksize->category}}</td>
                          <td>{{$genericpacksize->diseaseCategory}}</td>
                          <td>{{$genericpacksize->globalTradeNameCompany}}</td>
                          <td >
                            
                          </td>
                          <td>
                            {!! strlen($genericpacksize->dosingDetails)>200?substr($genericpacksize->dosingDetails, 0, 200): $genericpacksize->dosingDetails !!}
                            @if (strlen($genericpacksize->dosingDetails)>200)
                              <a role="button" href="#"   data-toggle="modal" data-target="#hugeDataModal"   
                              data-title='Dosing Details' 
                              data-body='{{ $genericpacksize->dosingDetails }}' 
                              >
                                Show Full  
                              </a>
                            @endif

                          </td>
                          <td>{{ $genericpacksize->isRxApplicable ? 'Rx':'' }}</td>
                          <td>{{ $genericpacksize->avgPriceOfOriginator }}</td>

                          
                          <td>
                            @if ($genpacksizeglobalmarketpricesData->where('genericPackSizeId', $genericpacksize->genericPackSizeId)->count('genericPackSizeId') )
                              <table class="table table-striped table-bordered table-hover ">
                                <thead>
                                  <tr>
                                    <th>Site</th>
                                    <th>Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    
                                      @foreach ($genpacksizeglobalmarketpricesData->where('genericPackSizeId', $genericpacksize->genericPackSizeId) as $genpacksizeglobalmarketprice)
                                          <tr>
                                            <td>{{$genpacksizeglobalmarketprice->site}}</td>
                                            <td>{{$genpacksizeglobalmarketprice->price}}</td>
                                          </tr>
                                      @endforeach
                                </tbody>
                              </table>
                            @endif

                          </td>
                          <td>
                            <ul class="list-group" style="width: 500px;">
                                @foreach ($genericbrandpicData->where('genericBrandId', $genericpacksize->genericBrandId) as $genericbrandpic)
                                  <li class="list-group-item list-group-item-action"><a href="{{ asset($genericbrandpic->picPath) }}" target="_blank">{{ asset($genericbrandpic->picPath) }}</a></li>
                                @endforeach
                            </ul>
                          </td>
                          {{-- <td>
                            @if ($genericpacksize->videourl)
                              <a href="{{ asset($genericpacksize->videourl) }}" target="_blank">{{ asset($genericpacksize->videourl) }}</a>
                              <video  controls  style="width: 300px;">
                                  <source src="{{ $genericpacksize->videourl }}"  type="video/mp4">
                                  <source src="{{ $genericpacksize->videourl }}"  type="video/webm">
                                  <source src="{{ $genericpacksize->videourl }}"  type="video/ogg">
                              </video>
                            @endif
                          </td> --}}

                          <td>
                            @if ($genericpacksize->videourl)
                              <a href="{{ asset($genericpacksize->videourl) }}" target="_blank" >{{ asset($genericpacksize->videourl) }}</a>
                            @endif
                          </td>

                          <td>{{!empty($genericpacksize->youtubevideourl)?  'Yes' : 'No'}}</td>
                          <td>{{!empty($genericpacksize->dailymotionvideourl)?  'Yes' : 'No'}}</td>
                          <td>{{!empty($genericpacksize->vimeovideourl)?  'Yes' : 'No'}}</td>



                          {{-- <td>{{ $genericpacksize->weightGM }}</td> --}}
                          <td>{{$genericpacksize->ptSellingPrice}}</td>
                          <td>{{$genericpacksize->ptMOQ}}</td>
                          <td>{{$genericpacksize->dealerSellingPrice}}</td>
                          <td>{{$genericpacksize->dealerMOQ}}</td>
                          <td>{{$genericpacksize->vipSellingPrice}}</td>
                          <td>{{$genericpacksize->compPtSellingPrice}}</td>
                          <td>{{$genericpacksize->compPtSellingPriceOld}}</td>
                          <td>{{$genericpacksize->compLocalSellingPrice}}</td>

                          <td>
                            <table  class="table table-striped table-bordered table-hover ">
                                <thead>
                                  <tr>
                                    <th>Supplier</th>
                                    <th>Moq</th>
                                    <th>Buying price</th>
                                    <th>Date</th>
                                    <th>Note</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($sppliergenericpricesData->where('genericPackSizeId', $genericpacksize->genericPackSizeId) as $sppliergenericprice)
                                    <tr>
                                      <td>{{$sppliergenericprice->supplier}}</td>
                                      <td>{{$sppliergenericprice->moq}}</td>
                                      <td>{{$sppliergenericprice->buyingPrice}}</td>
                                      <td>{{YmdToDmy($sppliergenericprice->buyingDate)}}</td>
                                      <td>{{$sppliergenericprice->note}}</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                          </td>

                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Generic Pack Sizes form table --}}
{{-- Generic Pack Sizes form table --}}







@endsection