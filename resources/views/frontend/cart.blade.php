{{-- FORNT END --}}
@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')


{{-- fb og section --}}
@section('pageTitle', 'Cart')
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
                            
                            @if ($genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('moq')->first() > $cartdetail->qty )
                              class="bg-warning" 
                            @else
                              class="" 
                            @endif
                          >
                            {{-- <td class="width"> --}}
                                {{-- <div class="image"> --}}



                                   {{--  
                                   <div  style="display: inline-block; padding-left: 5px;">
                                        <img data-src="{{ asset($genericbrandpicData->where('genericBrandId', $cartdetail->genericBrandId )->pluck('picPath')->first() ) }}" alt="" class="lozad img-responsive" style="max-width: 100px; "/>
                                    </div>
                                    <div  style="display: inline-block; padding-left: 5px;">
                                        <p>
                                            {{ $genericbrandData->where('genericBrandId',  $cartdetail->genericBrandId)->pluck('genericBrand')->first().' (' }}
                                            {{ $genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('genericStrength')->first().' )' }}
                                             
                                        </p>
                                        <h5>
                                            {{ $genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('genericPackSize')->first() }}
                                            {{ ' '.$genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('packType')->first() }}
                                        </h5>
                                        <h5>{{ $genericbrandData->where('genericBrandId',  $cartdetail->genericBrandId)->pluck('genericName')->first()}}</h5>
                                    </div> 
                                    --}}

                                      <td>
                                        <img data-src="{{ asset($genericbrandpicData->where('genericBrandId', $cartdetail->genericBrandId )->pluck('picPath')->first() ) }}" alt="" class="lozad img-responsive" style="max-width: 100px; "/>
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




                                {{-- </div> --}}
                            {{-- </td> --}}
                            <td>
                                <font color="ababab">
                                        {!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}

                                        {{ ($genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('customerPrice')->first()) * ($usdToCurrencyRate ) }}
                                </font>
                            </td>

                            <td >
                              <span id="discount-{{ $cartdetail->cartDetailId }}">
                                {!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}

                                {{ 
                                ( $genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('discount')->first() )
                               * 
                              ($usdToCurrencyRate ) }}</span>
                            </td>

                            <td>
                                <font color="ababab">
                                        {{ $genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('moq')->first() }}
                                </font>
                            </td>

                            <td class="user">
                        
                                <div id='quantity-{{$cartdetail->cartDetailId }}' class="quantity {{ $genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('moq')->first() > $cartdetail->qty ? 'bg-red': 'bg-green'}}">

                                      <button type="button"  class='subtracting' {{-- class=sub --}}
                                            data-cartdetailid='{{ $cartdetail->cartDetailId }}'
                                            data-price='{{ 
                                              ($genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('customerPrice')->first()) 
                                            * 
                                              ($usdToCurrencyRate )  }}'
                                            data-discount='{{ 
                                              ($genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('discount')->first()) 
                                              * 
                                              ($usdToCurrencyRate )  }}'
                                            data-moq='{{ $genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('moq')->first() }}'

                                      ><i class="fa fa-minus" aria-hidden="true"></i></button>

                                      <input type="text" id="{{ $cartdetail->cartDetailId }}" value={{ $cartdetail->qty }} class="field qty-field" readonly>

                                      <button type="button" class='adding' {{-- class=add --}}
                                            data-cartdetailid='{{ $cartdetail->cartDetailId }}'
                                            data-price='{{ 
                                              ($genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('customerPrice')->first())
                                              * 
                                              ($usdToCurrencyRate ) }}'
                                            data-discount='{{ 
                                              ( $genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('discount')->first() )  
                                              * 
                                              ($usdToCurrencyRate ) }}'
                                            data-moq='{{ $genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('moq')->first() }}'
                                      ><i class="fa fa-plus" aria-hidden="true"></i></button>

                                </div>
                            
                            </td>


                            


                            <td >{!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}

                              <span id="totalprice-{{ $cartdetail->cartDetailId }}">{{ $cartdetail->qty * 
                              (
                                ($genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('customerPrice')->first())
                              * ($usdToCurrencyRate ) ) 
                                - 
                                $cartdetail->qty * 
                                (
                                  ($genericpacksizes_with_customer_price_data->where('genericPackSizeId',  $cartdetail->genericPackSizeId)->pluck('discount')->first())

                                  * 
                                  ($usdToCurrencyRate ))}}</span></td>
                            <td>
                                <a href="#" class="removefromcart tooltipster" title="Delete item ?" 
                                        data-cartdetailid='{{ $cartdetail->cartDetailId }}'
                                >
                                    <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    
                   
                    
                   
                    
                   
                    
                </table>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="shp-cart-btn">
                {{-- <a href="#" class="cart-btn">Clear shopping cart</a> --}}
            </div>
            {{-- <div class="promo-input">
                <i class="flaticon-percentage"></i>
                <input type="text" placeholder="Promo code" />
                <a href="#" class="promo-i"><i class="flaticon-5-thin-right-arrow"></i></a>
            </div> --}}
            {{-- <div class="pull-right">
                <a href="#" class="cart-btn upd-btn">Update cart</a>
                <a href="#" class="shp-btn">Continue shopping</a>
            </div> --}}

            <div class="clearfix"></div>
    
            <div class="col-md-6 col-sm-6 col-xs-6 shp-coupon pay-faq checkout">
                {{-- <h2>Estimate shipping and tax</h2>
                <p>Enter your destinations to get a shipping estimate</p>
                <select class="form-control">
                                <option>Country</option>
                                <option>India</option>
                                <option>England</option>
                                <option>China</option>
                                <option>Sri Lanka</option>
               </select>
               <div class="state">
               <input class="code" type="text" placeholder="State/Province*">
               <input type="text" placeholder="Zip code*">
               <a href="#" class="shp-btn pull-right">Estimate</a>
               </div> --}}
               <a href="{{ route('productlistPage', [app()->getLocale(), 'diseaseCategoryId'=>0,'categoryId'=>0]) }}" class="next shp-btn pull-left"> <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>  {{ __('cart.continuepurchasing') }}  </a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6  shp-checkout checkout pay-faq">
                {{-- <h2>Cart Total</h2>
                <div class="element-table">
                <table class="text-uppercase">
                    <tr>
                        <td><b>Subtotal</b></td>
                        <td class="text-right">$<span id="cart-sub-total">{{ $cartSubTotal }} </span></td>
                    </tr>

                    <tr>
                        <td><b>Discount</b></td>
                        <td class="text-right">$<span id="cart-discount">{{ $genericpacksizes_with_customer_price_data->min('discount') }} </span></td>
                    </tr>

                    <tr>
                        <td><b>Tax</b></td>
                        <td class="text-right">$<span id="cart-tax">{{ $genericpacksizes_with_customer_price_data->min('tax') }} </span></td>
                    </tr>

                    <tr>
                        <td><b>Shipping Cost</b></td>
                        <td class="text-right">$<span id="cart-shippinCost">{{ $genericpacksizes_with_customer_price_data->min('shippingCost') }} </span></td>
                    </tr>
                  
                    
                    <tr>
                        <td><b>Total</b></td>
                        <td class="total text-right" >$<span id="cart-total">{{ $cartTotal }} </span></td>
                    </tr>
                </table>
                </div> --}}
                
                {{-- <a href="{{ route('checkout') }}" class="next shp-btn pull-right">{{ __('cart.processtocheckout') }}</a> --}}
                <a href="@if ( app()->getLocale() && app()->getLocale() ) 
                        {{ action('ProductController_F@checkout', array('lang'=>app()->getLocale() ) ) }}
                      @elseif ( app()->getLocale() ) 
                        {{ action('ProductController_F@checkout', array('lang'=>app()->getLocale() ) ) }}
                      @elseif ( app()->getLocale() )
                        {{ action('ProductController_F@checkout', array('lang'=>app()->getLocale() ) ) }}
                      @else
                        {{ action('ProductController_F@checkout', array('lang'=>'en' ) ) }}
                      @endif"  class="next shp-btn pull-right">
                    {{ __('cart.processtocheckout') }}  <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
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



          console.log('cartDetailId = '+ cartDetailId);
          console.log('price = '+ price);


              $.ajax(
              {
          
                url: '/{{ app()->getLocale() }}/productDetailsAddtoCartAddQty/'+cartDetailId,
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

                    $('#totalprice-'+cartDetailId).text((parseInt(data.qty)*parseInt(price))-(parseInt(discount)*parseInt(data.qty)));

                    // $('#cart-sub-total').text(parseInt(data.cartSubTotal));
                    //     $('#cart-total').text(parseInt(data.cartTotal));

                    var qty = parseInt(data.qty) ;
                    if (moq>qty) 
                    {
                         $('#row-'+cartDetailId).addClass('bg-warning');
                         $('#quantity-'+cartDetailId).addClass('bg-red').removeClass('bg-green');

                         // alert('Minimum quantity for this product is = '+moq+'!')
                         console.log('add')
                    }
                    else {
                         $('#row-'+cartDetailId).removeClass('bg-warning');
                         $('#quantity-'+cartDetailId).addClass('bg-green').removeClass('bg-red');
                         console.log('remove')
                    }

                    console.log('moq = '+moq+' qty = '+qty)
                 
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



          console.log('cartDetailId = '+ cartDetailId);
          console.log('price = '+ price);


              if (qty>1) {
                $.ajax(
                  {
              
                    url: '/{{ app()->getLocale() }}/productDetailsAddtoCartSubQty/'+cartDetailId,
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

                        $('#totalprice-'+cartDetailId).text( (parseInt(data.qty)*parseInt(price))-(parseInt(discount)*parseInt(data.qty)) );

                        // $('#cart-sub-total').text(parseInt(data.cartSubTotal));
                        // $('#cart-total').text(parseInt(data.cartTotal));
                        
                        // alert('Product successfully  added to the cart!')

                         var qty = parseInt(data.qty) ;
                        if (moq>qty) 
                        {
                              $('#row-'+cartDetailId).addClass('bg-warning');
                             $('#quantity-'+cartDetailId).addClass('bg-red').removeClass('bg-green');

                              // alert('Minimum quantity for this product is = '+moq+'!')
                              console.log('add')
                        }
                        else {
                              $('#row-'+cartDetailId).removeClass('bg-warning');
                             $('#quantity-'+cartDetailId).removeClass('bg-red').addClass('bg-green');

                              console.log('remove')
                        }
                        console.log('moq = '+moq+' qty = '+qty)
                     
                    })
                    .fail(function() {
                      console.log("error");
                    })
                    .always(function() {
                      console.log("complete");

                    });
              }
      });

  });
 
</script>





<script type="text/javascript">
 
  $(document).ready(function()
  {
      $('.removefromcart').on('click', function(event) {

          event.preventDefault();

          var cartDetailId = $(this).data('cartdetailid');

          console.log('cartDetailId = '+ cartDetailId);


                $.ajax(
                  {
              
                    url: '/en/removefromcart_1/'+cartDetailId,
                    type: 'post',
                    // dataType: "JSON",
                    data: {
                      "_token": "{{ csrf_token() }}",
                      "_method": 'post',
                    },
                  })
                    .done(function(data) {

                        $('.addtocart-round-icon').attr('data-count', data.sumQty);

                        $('#row-'+cartDetailId).remove();

                        $('#cart-sub-total').text(parseInt(data.cartSubTotal));
                        $('#cart-total').text(parseInt(data.cartTotal));

                        
                        // alert('Product successfully  added to the cart!')
                     
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
@endsection
