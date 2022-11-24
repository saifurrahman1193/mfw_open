@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Compare')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}


{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


@section('page_content')

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            <h2 class="card-title" style="text-align: center; font-weight: bold;">
                
                {{ __('header.compare') }}
                
            </h2>



            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td  scope="row"><strong>{{ __('compare.productsummary') }}</strong></td>
                            @foreach ($compareData as $comparedata)
                                <th scope="col">
                                    @isset ($comparedata)
                                        <ul class="list-group">
                                        <li class="list-group-item">
                                            
                                                <div class="row">
                                                <div class="col-md-9">
                                                    <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $comparedata->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $comparedata->genericBrandId ) ) }}" target="_blank">
                                                        <img class="lozad" data-src="{{ asset($genericbrandpicData->where('genericBrandId', $comparedata->genericBrandId )->pluck('picPath')->first() ) }}" alt="" class="img-responsive"   style="max-height: 150px; min-height:150px;"/>
                                                    </a>
                                                    
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{ app()->getLocale()?action('ProductController_F@productDetailsPageRemoveFromCompareCompare', array('lang'=>app()->getLocale(), 'userId'=>Auth::user()->id, 'genericBrandId'=>$comparedata->genericBrandId ) ) : action('ProductController_F@productDetailsPageRemoveFromCompareCompare', array('lang'=>app()->getLocale(), 'userId'=>Auth::user()->id, 'genericBrandId'=>$comparedata->genericBrandId ) ) }}" id="compare"  ><i id="compare-icon" class="fa fa-trash text-danger" aria-hidden="true" ></i></a>
                                                </div>
                                                </div>
                                            
                                        </li>
                                        <li class="list-group-item">
                                            @if (app()->getLocale()=='en') 
                                                {{ $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericBrand')->first() }} 
                                                {{ ' ('.$genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericName')->first().') ' }}
                                                {{ ' ('.$genericstrengthCompactData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericStrength')->first().')' }}   
                                            @elseif (app()->getLocale()=='ru')  
                                                {{ $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->plucK('genericBrandRU')->first() }} 
                                                {{ ' ('.$genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericNameRU')->first().') ' }}
                                                {{ ' ('.$genericstrengthCompactData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericStrengthRU')->first().')' }}
                                            @elseif (app()->getLocale()=='cn')   
                                                {{ $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericBrandCN')->first() }} 
                                                {{ ' ('.$genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericNameCN')->first().') ' }}
                                                {{ ' ('.$genericstrengthCompactData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericStrengthCN')->first().')' }}
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            @if (app()->getLocale()=='en')    
                                                {{ $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericCompany')->first() }}
                                            @elseif (app()->getLocale()=='ru')   
                                                {{ $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericCompanyRU')->first() }}
                                            @elseif (app()->getLocale()=='cn')    
                                                {{ $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('genericCompanyCN')->first() }} 
                                            @endif
                                        </li>
                                        <li class="list-group-item">
                                            @if (app()->getLocale()=='en')    
                                            {{$genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('dosageForm')->first() }}
                                            @elseif (app()->getLocale()=='ru')  
                                                {{$genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('dosageFormRU')->first() }}  
                                            @elseif (app()->getLocale()=='cn')  
                                                {{$genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('dosageFormCN')->first()}}  
                                            @endif
                                            |
                                            <strong>
                                            @if (app()->getLocale()=='en')    
                                                {{ $genericbrand_packsizes_data->where('genericBrandId', $comparedata->genericBrandId )->pluck('packSize')->first() }}
                                            @elseif (app()->getLocale()=='ru')   
                                                {{ $genericbrand_packsizes_data->where('genericBrandId', $comparedata->genericBrandId )->pluck('packSizeRU')->first() }} 
                                            @elseif (app()->getLocale()=='cn')   
                                                {{ $genericbrand_packsizes_data->where('genericBrandId', $comparedata->genericBrandId )->pluck('packSizeCN')->first() }}
                                            @endif
                                            </strong>
                                        </li>

                                        <li class="list-group-item">
                                            @if (app()->getLocale()=='en')    
                                                {{ $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('globalTradeNameCompany')->first() }}
                                            @elseif (app()->getLocale()=='ru')   
                                                {{ $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('globalTradeNameCompanyRU')->first() }} 
                                            @elseif (app()->getLocale()=='cn')   
                                                {{ $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('globalTradeNameCompanyCN')->first() }}
                                            @endif
                                        </li>
                                    </ul>
                                    @endisset
                                </th>
                            @endforeach
                            
                            
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th scope="row">{{ __('compare.price') }}</th>
                            @foreach ($compareData as $comparedata)
                                <td>
                                    @isset ($comparedata)
                                        <ul class="list-group">
                                            @if ($genericpacksizes_with_customer_price_view_data->where('genericBrandId', $comparedata->genericBrandId)->count('genericBrandId')==0)
                                                <li class="list-group-item">
                                                <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $comparedata->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $comparedata->genericBrandId ) ) }}" class="btn btn-success">{{ __('productdetails.priceinquiry') }}</a>
                                                </li>
                                            @endif
                                            @foreach ($genericpacksizes_with_customer_price_view_data->where('genericBrandId', $comparedata->genericBrandId) as $genericpacksize)
                                                <li class="list-group-item list-group-item-action">
                                                    <table class="table table-bordered table-hover">
                                                        <tbody>
                                                            <tr>
                                                                <th scope="row">
                                                                    {{ __('productdetails.strength') }}
                                                                </th>
                                                                <td>
                                                                @if (app()->getLocale()=='en')    
                                                                {{ $genericpacksize->genericStrength.' ('. $genericpacksize->genericPackSize.'\'s ' .$genericpacksize->packType.')' }} 
                                                                @elseif (app()->getLocale()=='ru')   
                                                                {{ $genericpacksize->genericStrengthRU.' ('. $genericpacksize->genericPackSize.'\'s ' .$genericpacksize->packTypeRU.')' }} 
                                                                @elseif (app()->getLocale()=='cn')   
                                                                {{ $genericpacksize->genericStrengthCN.' ('. $genericpacksize->genericPackSize.'\'s ' .$genericpacksize->packTypeCN.')' }} 
                                                                @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">{{ __('productdetails.minqty') }}</th>
                                                                <td>{{ $genericpacksize->moq }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">{{ __('productdetails.price') }}</th>
                                                                <td>
                                                                    {!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}

                                                                {{ $genericpacksize->customerPrice * ($countryData->where('currency', session('currency'))->pluck('usdToCurrencyRate')->first() )  }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">{{ __('compare.discount') }}</th>
                                                                <td>
                                                                {!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}
                                
                                                                {{ $genericpacksize->discount * ($countryData->where('currency', session('currency'))->pluck('usdToCurrencyRate')->first() ) }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">{{ __('productdetails.availability') }}</th>
                                                                <td
                                                                @if ($genericpacksize->availabilityTypeId==2)
                                                                    class="text-danger"
                                                                @endif
                                                                >

                                                                @if (app()->getLocale()=='en')    {{ $availabilitytypeData->where('availabilityTypeId', $genericpacksize->availabilityTypeId)->pluck('availabilityType')->first() }}
                                                                @elseif (app()->getLocale()=='ru')   {{ $availabilitytypeData->where('availabilityTypeId', $genericpacksize->availabilityTypeId)->pluck('availabilityTypeRU')->first() }} 
                                                                @elseif (app()->getLocale()=='cn')   {{ $availabilitytypeData->where('availabilityTypeId', $genericpacksize->availabilityTypeId)->pluck('availabilityTypeCN')->first() }} 
                                                                @endif
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row">{{ __('productdetails.addtocart') }}</th>
                                                                <td>
                                                                    <a class="btn btn-success addtocart1" onclick="addToCart( {{$comparedata->genericBrandId}}, {{$genericpacksize->genericPackSizeId}}, {{$genericpacksize->availabilityTypeId}})"

                                                                    
                                                                    data-genericpacksizeid='{{ $genericpacksize->genericPackSizeId }}'  
                                                                    data-availabilitytypeid='{{ $genericpacksize->availabilityTypeId }}'  

                                                                    href="#" style="padding: 8px; margin: 0; border-radius: 5%; font-size: 13px" >{{ __('productdetails.addtocart') }}</a>

                                                                    {{--  addToCart(genericBrandId, genericPackSizeId, availabilityTypeId )  --}}
                                                                    
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </li>
                                            @endforeach
                                        
                                        </ul>
                                    @endisset
                                </td>
                            @endforeach
                        </tr>

                        <tr>
                            <th scope="row">{{ __('compare.suggestion') }}</th>
                            @foreach ($compareData as $comparedata)
                                <td>
                                    @isset ($comparedata)
                                        @if (app()->getLocale()=='en')    
                                            {!! $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('suggestion')->first() !!}
                                        @elseif (app()->getLocale()=='ru')   
                                            {!!  $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('suggestionRU')->first() !!} 
                                        @elseif (app()->getLocale()=='cn')   
                                            {!!  $genericbrandData->where('genericBrandId', $comparedata->genericBrandId )->pluck('suggestionCN')->first() !!}
                                        @endif
                                    @endisset
                                </td>
                            @endforeach
                        </tr>

                        <tr>
                            <th scope="row">{{ __('compare.reviewrating') }}</th>
                            @foreach ($compareData as $comparedata)
                                <td>
                                    @isset ($comparedata)
                                            @if ( (round($reviewData->where('genericBrandId', $comparedata->genericBrandId)->pluck('rating')->first())) > 0)
                                            @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $comparedata->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                                <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                            @endfor

                                            @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $comparedata->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                                <i class="fa fa-star" style="color: #ddd !important;"></i>
                                            @endfor

                                        @endif
                                    @endisset
                                </td>
                            @endforeach
                        </tr>

                        <tr>
                            <th scope="row">{{ __('compare.comment') }}</th>
                            @foreach ($compareData as $comparedata)
                                <td>
                                    @isset ($comparedata)
                                        <ul class="list-group">
                                        @foreach ($reviewsData->where('genericBrandId', $comparedata->genericBrandId)->take(2) as $review)
                                                <li class="list-group-item">
                                                    <table>
                                                        <td class="col-md-2">
                                    
                                                        <img class="lozad" data-src="{{ asset($review->photoPath ) }}" alt="" class="img-responsive"   style="max-width: 75px; max-height: 75px;"/>
                                                        </td>
                                                        <td  class="col-md-10">
                                                            <p>
                                                                @for ($i = 1; $i <= (round($review->rating)); $i++) {{-- ratings --}}
                                                                    <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                                                @endfor

                                                                @for ($i = 1; $i <= 5-(round($review->rating)); $i++)  {{-- non ratings --}}
                                                                    <i class="fa fa-star" style="color: #ddd !important;"></i>
                                                                @endfor
                                                            </p>
                                                            <p>
                                                                {{ $review->name }}
                                                            </p>

                                                            <h5>
                                                                <i class="fa fa-envelope"></i> {{ partially_hide_email($review->email) }} ,   
                                                                <i class="fa fa-phone"></i> {{ '*****'.substr($review->phone,  -3) }}
                                                            </h5>
                                                            <h5>
                                                                {{ $review->comment }}  
                                                            </h5>
                                                        </td>
                                                    </table>
                                                </li>
                                        @endforeach

                                        @if ($reviewsData->where('genericBrandId', $comparedata->genericBrandId)->count('genericBrandId')>0)
                                            <li class="list-group-item">
                                                <a href="{{ app()->getLocale() ?  action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $comparedata->genericBrandId ) ) : action('ProductController_F@productDetailsPageCaller', array(app()->getLocale(), $comparedata->genericBrandId ) ) }}" class="btn btn-success">{{ __('compare.viewall') }}</a>
                                            </li>
                                        @endif
                                    </ul>
                                    @endisset
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


<script type="text/javascript">
    function addToCart(genericBrandId, genericPackSizeId, availabilityTypeId ){

        if (availabilityTypeId==2) {
            alert('{{ __('productdetails.productunavailable') }}');
            return false;
        }
        $.ajax(
        {
            url: '/productDetails/productDetailsAddtoCart/'+genericBrandId+'/'+genericPackSizeId,
            type: 'post',
            data: {
                "_token": "{{ csrf_token() }}",
                "_method": 'post',
            },
        })
        .done(function(data) {
            $('.addtocart-round-icon').attr('data-count', data.qty);
            alert('Product successfully  added to the cart!')
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
    }
</script>

{{-- Add to/remove from cart dynamic  --}}

{{--  <script type="text/javascript">
  $(document).ready(function()
  {
      @isset ($compareData[0])
          $('.addtocart1').on('click', function(event) {
            event.preventDefault();
          var genericBrandId = {{$compareData[0]->genericBrandId}};

          var genericPackSizeId = $(this).data('genericpacksizeid');
          var availabilityTypeId = $(this).data('availabilitytypeid');

          if (availabilityTypeId==2) {
            alert('{{ __('productdetails.productunavailable') }}');
            return false;
          }
          console.log('genericBrandId = '+ genericBrandId);
          console.log(genericPackSizeId);
              $.ajax(
              {
                url: '/productDetails/productDetailsAddtoCart/'+genericBrandId+'/'+genericPackSizeId,
                type: 'post',
                data: {
                  "_token": "{{ csrf_token() }}",
                  "_method": 'post',
                },
              })
                .done(function(data) {
                    $('.addtocart-round-icon').attr('data-count', data.qty);
                    alert('Product successfully  added to the cart!')
                })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");
                });
      });
      @endisset

      @isset ($compareData[1])
          $('.addtocart2').on('click', function(event) {
            event.preventDefault();
          var genericBrandId = {{$compareData[1]->genericBrandId}};
          var genericPackSizeId = $(this).data('genericpacksizeid');
          var availabilityTypeId = $(this).data('availabilitytypeid');
          if (availabilityTypeId==2) {
            alert('{{ __('productdetails.productunavailable') }}');
            return false;
          }
          console.log('genericBrandId = '+ genericBrandId);
          console.log(genericPackSizeId);
              $.ajax(
              {
                url: '/productDetails/productDetailsAddtoCart/'+genericBrandId+'/'+genericPackSizeId,
                type: 'post',
                data: {
                  "_token": "{{ csrf_token() }}",
                  "_method": 'post',
                },
              })
                .done(function(data) {
                    $('.addtocart-round-icon').attr('data-count', data.qty);
                    alert('Product successfully  added to the cart!')
                })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");

                });
      });
      @endisset
  });
</script>  --}}


@endsection
