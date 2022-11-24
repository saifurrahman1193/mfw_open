@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')


{{-- fb og section --}}
@section('pageTitle', 'Cart Update')
@section('og_url', url()->current())
@section('og_type', 'Website')
{{-- @section('og_title', ($specifiedGenericbrandData->genericBrand).' ( '.( $genericstrengthData->where('genericBrandId', $specifiedGenericbrandData->genericBrandId )->sortBy('genericStrength'))->pluck('genericStrength')->first() . ' )') --}}

{{-- @section('og_image',  asset((($genericbrandpicData->where('genericBrandId', $specifiedGenericbrandData->genericBrandId))->first())->picPath ) ) --}}


{{-- fb og section --}}
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@section('page_content')


 <div class="container text-success" id="path-section" style="padding-top: 50px; font-weight: bold;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ app()->getLocale()?action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}" >{{ __('header.Home') }}</a></li>

        <li class="breadcrumb-item"><a href="{{ route('customerOrderHistory', [ app()->getLocale() ]) }}" >{{ __('header.orderhistory') }}</a></li>

        <li class="breadcrumb-item active" aria-current="page">{{ __('header.Cart') }}</li>

      </ol>
    </nav>

</div>
<!--main-sec-->
<div class="container cart-sec padd-50">

  <div class="card-title text-center text-success font-weight-bold mb-5"><h2>{{ __('header.Cart') }}</h2></div>

    <div id="msform">
    
         <!-- progressbar -->
        {{--  <ul id="progressbar">
             <li class="active">Cart</li>
             <li>Delivery</li>
             <li>Payment</li>
             <li>Conformation</li>
         </ul> --}}
         
         <!-- fieldsets -->
            <fieldset class="cart-tab">
            
            <div class="col-md-12 element-table">
                <div class="row">
                    <table id="cart-table">
                    <tr>
                        <th colspan="2">{{ __('cart.product') }}</th>
                        <th>{{ __('cart.price') }}</th>
                        <th>{{ __('cart.discount') }}</th>
                        <th>{{ __('cart.minqty') }}</th>
                        <th>{{ __('cart.quantity') }}</th>
                        <th>{{ __('cart.total') }}</th>
                        <th></th>
                    </tr>


                    
                    @foreach ($cartdetailsData as $cartdetail)
                        <tr id="row-{{ $cartdetail->cartDetailId }}"
                            
                            @if ($cartdetail->moq > $cartdetail->qty )
                              class="bg-warning" 
                            @else
                              class="" 
                            @endif
                          >
                           

                                <td>
                                  <img data-src="{{ asset($genericbrandpicData->where('genericBrandId', $cartdetail->genericBrandId )->pluck('picPath')->first() ) }}" data-mfp-src="{{ asset($genericbrandpicData->where('genericBrandId', $cartdetail->genericBrandId )->pluck('picPath')->first() ) }}"  alt="" class="lozad img-responsive cart-qty-update-image" style="max-width: 100px; "/>
                                </td>
                                <td>
                                  <p>
                                      @if (app()->getLocale()=='en')
                                          {{ $cartdetail->genericBrand.' ('.$cartdetail->genericStrength.') ' }}
                                      @elseif (app()->getLocale()=='cn')
                                          {{ $cartdetail->genericBrandCN.' ('.$cartdetail->genericStrengthCN.') ' }}
                                      @elseif (app()->getLocale()=='ru')
                                          {{ $cartdetail->genericBrandRU.' ('.$cartdetail->genericStrengthRU.') ' }}
                                      @endif
                                  </p>
                                  <h5>
                                      @if (app()->getLocale()=='en')
                                          {{ $cartdetail->genericCompany}}
                                      @elseif (app()->getLocale()=='cn')
                                          {{ $cartdetail->genericCompanyCN }}
                                      @elseif (app()->getLocale()=='ru')
                                          {{ $cartdetail->genericCompanyRU }}
                                      @endif
                                  </h5>
                                  <h5>
                                      @if (app()->getLocale()=='en')
                                          {{ $cartdetail->genericPackSize.' \'s '.$cartdetail->packType.' | '.$cartdetail->dosageForm}}
                                      @elseif (app()->getLocale()=='cn')
                                          {{ $cartdetail->genericPackSize.' \'s '.$cartdetail->packTypeCN.' | '.$cartdetail->dosageFormCN}}
                                      @elseif (app()->getLocale()=='ru')
                                          {{ $cartdetail->genericPackSize.' \'s '.$cartdetail->packTypeRU.' | '.$cartdetail->dosageFormRU}}
                                      @endif
                                  </h5>
                                  <h5>
                                      @if (app()->getLocale()=='en')
                                          {{ $genericbrandData->where('genericBrandId',  $cartdetail->genericBrandId)->pluck('genericName')->first()}}
                                      @elseif (app()->getLocale()=='cn')
                                          {{ $genericbrandData->where('genericBrandId',  $cartdetail->genericBrandId)->pluck('genericNameCN')->first()}}
                                      @elseif (app()->getLocale()=='ru')
                                          {{ $genericbrandData->where('genericBrandId',  $cartdetail->genericBrandId)->pluck('genericNameRU')->first()}}
                                      @endif
                                  </h5>
                                </td>




                            
                            <td>
                                <font color="ababab">
                                        {!! $countryData->where('currency', $cartData->currency)->pluck('hexcode')->first() !!}

                                        {{ $cartdetail->price * $cartData->usdToCurrencyRate  }}
                                </font>
                            </td>

                            <td >
                              <span id="discount-{{ $cartdetail->cartDetailId }}">
                                {!! $countryData->where('currency', $cartData->currency)->pluck('hexcode')->first() !!}

                                {{ $cartdetail->discount * $cartData->usdToCurrencyRate }}</span>
                            </td>

                            <td>
                                <font color="ababab">
                                        {{ $cartdetail->moq }}
                                </font>
                            </td>

                            <td class="user">
                        
                                <div id='quantity-{{$cartdetail->cartDetailId }}' class="quantity {{ $cartdetail->moq > $cartdetail->qty ? 'bg-red': 'bg-green'}}">

                                      <button type="button"  class='subtracting' {{-- class=sub --}}
                                            data-cartdetailid='{{ $cartdetail->cartDetailId }}'
                                            data-price='{{ $cartdetail->price  * $cartData->usdToCurrencyRate  }}'
                                            data-discount='{{ $cartdetail->discount * $cartData->usdToCurrencyRate  }}'
                                            data-moq='{{ $cartdetail->moq }}'

                                      ><i class="fa fa-minus" aria-hidden="true"></i></button>

                                      <input type="text" id="{{ $cartdetail->cartDetailId }}" value={{ $cartdetail->qty }} class="field qty-field" readonly>

                                      <button type="button" class='adding' {{-- class=add --}}
                                            data-cartdetailid='{{ $cartdetail->cartDetailId }}'
                                            data-price='{{ $cartdetail->price * $cartData->usdToCurrencyRate  }}'
                                            data-discount='{{ $cartdetail->discount * $cartData->usdToCurrencyRate }}'
                                            data-moq='{{ $cartdetail->moq }}'
                                      ><i class="fa fa-plus" aria-hidden="true"></i></button>

                                </div>
                            
                            </td>


                            


                            <td >{!! $countryData->where('currency', $cartData->currency)->pluck('hexcode')->first() !!}

                              <span id="totalprice-{{ $cartdetail->cartDetailId }}">
                                {{ ( ($cartdetail->qty *   $cartdetail->price) -  ($cartdetail->qty *  $cartdetail->discount) ) * $cartData->usdToCurrencyRate }}</span></td>
                            
                        </tr>
                    @endforeach
                    
                   
                    
                   
                    
                   
                    
                </table>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="shp-cart-btn">
            </div>
            

            <div class="clearfix"></div>
    
            <div class="col-md-6 col-sm-6 col-xs-6 shp-coupon pay-faq checkout">
               <a href="{{ app()->getLocale()?action('UserController_F@customerOrderHistory' , array( 'lang'=>app()->getLocale()  ) ) : action('UserController_F@customerOrderHistory',  array( 'lang'=>app()->getLocale()  ) ) }}" class="next shp-btn pull-left"> <i class="fa fa-chevron-circle-left"></i> {{ __('header.orderhistory') }}</a>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-6 shp-checkout checkout pay-faq">
                <a href="{{ route('customerOrderEdit', [app()->getLocale(), Crypt::encrypt($cartData->cartId) ]) }}"
                class="next shp-btn pull-right">
                    {{ __('orderhistory.processtoorderupdate') }}  <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                </a>
            </div>

            <div class="clearfix"></div>
            
         </fieldset>
         
            
          
                                          
    </div>

</div>


<link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">





{{-- Add to/remove from cart dynamic  --}}

<script type="text/javascript">
 
  $(document).ready(function()
  {
      $('.adding').on('click', function(event) {

          var cartDetailId = $(this).data('cartdetailid');
          var price = $(this).data('price');
          var discount = $(this).data('discount');

          var moq = $(this).data('moq');

          var cartId = {{ $cartData->cartId }};
          var usdToCurrencyRate = {{ $cartData->usdToCurrencyRate }};
          var deliveryPriceInitial = {{ $cartData->deliveryPriceInitial }};
          var deliveryPriceIncrement = {{ $cartData->deliveryPriceIncrement }};
          var transactionFee = {{ $cartData->transactionFee }};



          console.log('cartDetailId = '+ cartDetailId);
          console.log('price = '+ price);


              $.ajax(
              {
          
                url: '/{{ app()->getLocale() }}/cartUpdateAddQty/'+cartDetailId+'/'+cartId+'/'+usdToCurrencyRate+'/'+deliveryPriceInitial+'/'+deliveryPriceIncrement+'/'+transactionFee,
                type: 'post',
                // dataType: "JSON",
                data: {
                  "_token": "{{ csrf_token() }}",
                  "_method": 'post',
                },
              })
                .done(function(data) {

                    $('.addtocart-round-icon').attr('data-count', data.sumQty);
                    $('#'+cartDetailId).val( data.qty);

                    $('#totalprice-'+cartDetailId).text( data.cartdetailsubtotalwithdiscount );

                   

                    var qty = parseInt(data.qty) ;
                    

                    console.log('moq = '+moq+' qty = '+qty+' data.cartdetailsubtotalwithdiscount = '+data.cartdetailsubtotalwithdiscount)
                 
                })
                .fail(function() {
                  console.log("error");
                })
                .always(function() {
                  console.log("complete");

                });
      });

  });
 
</script>



{{-- Add to/remove from cart dynamic  --}}

<script type="text/javascript">
 
  $(document).ready(function()
  {
      $('.subtracting').on('click', function(event) {

          var cartDetailId = $(this).data('cartdetailid');
          var price = $(this).data('price');
          var moq = $(this).data('moq');
          var discount = $(this).data('discount');

          var qty = $('#'+cartDetailId).val();

          var cartId = {{ $cartData->cartId }};
          var usdToCurrencyRate = {{ $cartData->usdToCurrencyRate }};
          var deliveryPriceInitial = {{ $cartData->deliveryPriceInitial }};
          var deliveryPriceIncrement = {{ $cartData->deliveryPriceIncrement }};
          var transactionFee = {{ $cartData->transactionFee }};




          console.log('cartDetailId = '+ cartDetailId);
          console.log('price = '+ price);


              if (qty>moq) {
                $.ajax(
                  {
              
                    url: '/{{ app()->getLocale() }}/cartUpdateSubQty/'+cartDetailId+'/'+cartId+'/'+usdToCurrencyRate+'/'+deliveryPriceInitial+'/'+deliveryPriceIncrement+'/'+transactionFee,
                    type: 'post',
                    // dataType: "JSON",
                    data: {
                      "_token": "{{ csrf_token() }}",
                      "_method": 'post',
                    },
                  })
                    .done(function(data) {

                        $('.addtocart-round-icon').attr('data-count', data.sumQty);
                        $('#'+cartDetailId).val( data.qty);

                        $('#totalprice-'+cartDetailId).text( data.cartdetailsubtotalwithdiscount );

                       

                         var qty = parseInt(data.qty) ;
                        
                        console.log('moq = '+moq+' qty = '+qty)
                     
                    })
                    .fail(function() {
                      console.log("error");
                    })
                    .always(function() {
                      console.log("complete");

                    });
              }
              else {
                alert('Minimum quantity '+moq+' required!')
              }
      });

  });
 
</script>






<script type="text/javascript">
  $(document).ready(function() {
      @if (session('checkOutRejected')) 
          alert('Minimum quantity required!'); 
      @endif

  });
</script>


<style type="text/css" media="screen">
  .bg-red{
    background-color: #ff0000ab;
  }

   .bg-green{
    background-color: #25bb2b;
  }

  
</style>



<style>
  @media (max-width:576px){
    .shp-btn{
      padding: 0px !important;  
    }
  }
</style>


<script type="text/javascript">
  $(document).ready(function() {
    $('.cart-qty-update-image').magnificPopup({type:'image'});
  });
</script>


@endsection


