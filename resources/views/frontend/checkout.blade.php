@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')


{{-- fb og section --}}
@section('pageTitle', 'Checkout')
@section('og_url', url()->current())
@section('og_type', 'Website')
{{-- @section('og_title', ($specifiedGenericbrandData->genericBrand).' ( '.( $genericstrengthData->where('genericBrandId', $specifiedGenericbrandData->genericBrandId )->sortBy('genericStrength'))->pluck('genericStrength')->first() . ' )') --}}

{{-- @section('og_image',  asset((($genericbrandpicData->where('genericBrandId', $specifiedGenericbrandData->genericBrandId))->first())->picPath ) ) --}}


{{-- fb og section --}}



@section('page_content')

<style type="text/css" media="screen">
  fieldset{
   border:1px solid #cccc;
   padding: 8px;
}
</style>

<style type="text/css">
 input[type=submit]{
      border-radius: 50px;
      text-transform: uppercase;
      border: 2px solid #25bb2b;
      font-weight: 700;
      padding: 12px 40px;
      background-color: #25bb2b;
      color: #fff;
 }
</style>

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

<!--main-sec-->

 <div class="container text-success"  id="path-section"  style="padding-top: 50px; font-weight: bold;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ app()->getLocale()?action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}" >{{ __('header.Home') }}</a></li>

        <li class="breadcrumb-item"><a href="{{ app()->getLocale()?action('ProductController_F@goToCartPage', array('lang'=>app()->getLocale() ) ) : action('ProductController_F@goToCartPage', array('lang'=>app()->getLocale() ) ) }}" >{{ __('header.Cart') }}</a></li>

        <li class="breadcrumb-item active" aria-current="page">{{ __('header.Checkout') }}</li>
      </ol>
    </nav>
</div>

<div class="container cart-sec padd-30">
         
      <div class="card-title text-center text-success font-weight-bold ">
          <h2>{{ __('header.Checkout') }}</h2>
          <h4 style="color: black;">( <span style="color: red;">*</span> {{ __('checkout.markedfieldsmandatory') }}  )</h4>
      </div>

      <form class="form-horizontal" id="delivery-form" method="POST"  enctype="multipart/form-data" action="{{ app()->getLocale()? action('ProductController_F@checkoutConfirm', array('lang'=>app()->getLocale() ) ) : action('ProductController_F@checkoutConfirm', array('lang'=>app()->getLocale() ) ) }}"   onsubmit="return confirm('{!!__('productdetails.confirmalert')!!}');"   >
        {{-- onsubmit="return confirm('{!!__('productdetails.confirmalert')!!}');" --}}

          {{ csrf_field() }}

         <!-- ===========================checkout======================= -->
         <!-- ===========================checkout======================= -->
        <fieldset class="cart-tab " style="padding: 2%;">
          <legend style="border-bottom: none;">{{ __('checkout.deliverydetails') }}</legend>

               

                <div class="form-group row col-sm-10 ">
                    <div class="col-sm-4">
                      
                    </div>
                     <div class="btn-group col-sm-8 " >
                          <input type="checkbox" name="fancy-checkbox-success" id="fancy-checkbox-success" autocomplete="off" />
                          <div class="btn-group col-sm-12">
                              <div class="row">
                                <label for="fancy-checkbox-success" class="btn btn-success col-xs-2 col-sm-1" id="fancy-checkbox-success-tick" >
                                    <span class="fa fa-check"></span>
                                    <span> </span>
                                </label>

                                <label for="fancy-checkbox-success" class="btn btn-light active col-xs-10 col-sm-11" style="white-space: normal; text-align: left;">
                                    {{ __('checkout.markshippingaddress') }}
                                </label>
                              </div>
                          </div>
                      </div>
                </div>
            

                <div class="form-group row col-sm-10 required">
                    <label for="name" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.name').' ('.__('checkout.inenglish').')' }}</label>
                    <div class="col-sm-8">
                        {{-- <input type="text" name="takingFor" value="{{ $userData->name }}" class="form-control" placeholder="Name"   id="name" required> --}}
                        <textarea id="name" name="takingFor"  class="form-control"      rows="2" required>{{ $userData->name }}</textarea>
                    </div>
                </div>

                <div class="form-group row col-sm-10 ">
                    <label for="name" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.name').' ('.__('checkout.inlocallanguage').')' }}</label>
                    <div class="col-sm-8">
                        {{-- <input type="text"  id="takingForLocalLang" name="takingForLocalLang"  class="form-control" placeholder="Name"   > --}}
                        <textarea id="takingForLocalLang" name="takingForLocalLang"  class="form-control"    rows="2" ></textarea>
                      </div>
                </div>


                <div class="form-group row col-sm-10  hidden">
                    <label for="email" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.email') }}</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" value="{{ $userData->email }}" class="form-control" placeholder="Email"   id="email"   hidden>
                        <input type="text" name="website" value="{{ url('/') }}" class="form-control"    hidden  >
                    </div>
                </div>


                <div class="form-group row col-sm-10 required">
                    <label for="phone" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.phone') }}</label>
                    <div class="col-sm-8">
                        <div class="col-sm-6">
                                              
                           <select class="form-control m-bot15" id="phoneCode" name="phoneCode" required >

                                {{-- <option  value="{{ $userData->phoneCode }}" selected="">
                                  {{ $userData->phoneCode.' ('.$countryData->where('phoneCode', substr($userData->phoneCode, 1) )->pluck('country')->first().')' }}
                                </option> --}}

                                <option >--Select Phone Code--</option>}
                                @foreach($countryData->sortBy('country') as $country)
                                    <option value="{{ '+'.$country->phoneCode }}" {{$userData->phoneCode=='+'.$country->phoneCode? 'selected':''}}>
                                      {{ '+'.$country->phoneCode.' ('.$country->country.')'  }}
                                    </option> 
                                @endforeach   
                            </select>
                         </div>
                         <div class="col-sm-6">
                            <input type="tel" id="phone" type="phone" class="form-control" name="phone" value="{{ $userData->phone }}" required>
                         </div>
                        {{-- <input type="text" id="phone" name="phone" value="{{ $userData->phone }}" class="form-control" placeholder="Phone"   required> --}}
                    </div>
                </div>

                <div class="form-group row col-sm-10 ">
                    <label for="phonenumber2" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.phonenumber2') }}</label>
                    <div class="col-sm-8">
                        <input type="tel" id="phonenumber2" name="phonenumber2"  class="form-control" value=""  >
                    </div>
                </div>


                <div class="form-group row col-sm-10 required">
                    <label for="streethouse" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.housestreet').' ('.__('checkout.inenglish').')' }}</label>
                    <div class="col-sm-8">
                        {{-- <input type="text" id="streethouse" name="streethouse" value="{{ $userData->streethouse }}" class="form-control"   required> --}}
                        <textarea id="streethouse" name="streethouse"  class="form-control"    rows="2"  required ></textarea>
                      </div>
                </div>

                <div class="form-group row col-sm-10 ">
                    <label for="streethouseLocalLang" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.housestreet').' ('.__('checkout.inlocallanguage').')' }}</label>
                    <div class="col-sm-8">
                        {{-- <input type="text" id="streethouseLocalLang" name="streethouseLocalLang"  class="form-control"    > --}}
                        <textarea id="streethouseLocalLang" name="streethouseLocalLang"  class="form-control"    rows="2" ></textarea>
                      </div>
                </div>



                <div class="col-sm-10">
                  <div class="form-group row required">
                    <label class="col-sm-4 col-form-label control-label">{{ __('checkout.country') }} </label>
                    <div class="col-sm-7">
                      <select class="form-control m-bot15" name="countryId" id="countryId" required >

                          <option >--Select Country--</option>
                          @foreach($countryData as $country)
                              <option value="{{ $country->countryId }}"
                                  data-countryid ="{{ $country->countryId }}"
                                  data-country ="{{ $country->country }}"
                                  {{$country->countryId==$userData->countryId?'selected':''}}
                                >
                                {{ title_case($country->country)}}
                              </option> 
                          @endforeach   
                      </select>
                    </div>
                  </div>
                </div>

                


            


                <div class="form-group row col-sm-10 required">
                    <label for="cityTownDivision" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.city').' ('.__('checkout.inenglish').')' }}</label>
                    <div class="col-sm-8">
                        {{-- <input type="text" id="cityTownDivision" name="city" value="{{ $userData->cityTownDivision }}" class="form-control" placeholder="City"   required> --}}
                        <textarea id="cityTownDivision" name="city"  class="form-control"    rows="2" required>{{ $userData->cityTownDivision }}</textarea>
                      </div>
                </div>

                <div class="form-group row col-sm-10 ">
                    <label for="cityLocalLang" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.city').' ('.__('checkout.inlocallanguage').')' }}</label>
                    <div class="col-sm-8">
                        {{-- <input type="text" id="cityLocalLang" name="cityLocalLang" class="form-control" placeholder="City"   > --}}
                        <textarea id="cityLocalLang" name="cityLocalLang"  class="form-control"    rows="2" ></textarea>
                      </div>
                </div>


                <div class="form-group row col-sm-10 required">
                    <label for="postalCode" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.postcode') }}</label>
                    <div class="col-sm-8">
                        <input type="number" id="postalCode" name="postalCode" value="{{ $userData->postalCode }}" class="form-control" placeholder="Post Code"   required>
                    </div>
                </div>

             


              <div class="col-sm-10">
                <div class="form-group row required">
                  <label class="col-sm-4 col-form-label control-label  ">{{ __('checkout.deliverymethod') }}</label>
                  <div class="col-sm-7">
                    <select class="form-control m-bot15" name="deliveryMethodId" id="deliveryMethodId" required >
                        <option >--Select Delivery Method--</option>
                        @foreach($deliverypriceData->where('countryId' , $userData->countryId) as $deliverymethod)
                            <option  value="{{ $deliverymethod->deliveryMethodId }}"
                                data-deliverymethodid ="{{ $deliverymethod->deliveryMethodId }}"
                                data-iscommentapplicable ="{{ $deliverymethod->isCommentApplicable }}"
                                data-iscommentrequired ="{{ $deliverymethod->isCommentRequired }}"
                                data-deliverymethod ="{{ $deliverymethod->deliveryMethod }}"
                                data-deliverypriceinitial="{{ $deliverymethod->deliveryPriceInitial }}"
                                data-deliverypriceincrement="{{ $deliverymethod->deliveryPriceIncrement }}"
                              >
                              {{ title_case($deliverymethod->deliveryMethod)}}
                            </option> 
                        @endforeach   
                    </select>
                  </div>
                </div>
              </div>


              <div class="col-sm-10">
                <div class="form-group row ">
                  <label class="col-sm-4 col-form-label "></label>
                  <div class="col-sm-8">
                    <hr>
                    <div >
                        <ol class="">
                          <li>{{ __('checkout.fee') }} - {{ session('currency') }} <span id="deliveryfee"></span></li>
                          <div id="deliverysummary">
                              
                          </div>
                        </ol>
                    </div>
                    
                  </div>
                </div>
              </div>

              <div class="form-group row col-sm-10 "  id="deliveryComment-root-container">
                  <label for="deliveryComment" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.deliveryComment') }}</label>
                  <div class="col-sm-8"   id="deliveryComment-container">
                      <textarea id="deliveryComment" name="deliveryComment"  class="form-control" placeholder="{{ __('checkout.deliveryComment') }}"    rows="3"></textarea>
                  </div>
              </div>





              <div class="col-sm-12">
                  <fieldset class="cart-tab" style="margin-top: 60px; padding: 2%;">
                    <legend style="border-bottom: none;">{{ __('checkout.paymentmethod') }}</legend>

                          <div class="col-sm-10">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">{{ __('checkout.paymentcountry') }} </label>
                              <div class="col-sm-7">
                                <select class="form-control m-bot15" name="paymentCountryId" id="paymentCountryId" required >
                                    <option >--Select Country--</option>
                                    @foreach($countryData as $country)
                                        <option value="{{ $country->countryId }}"
                                            data-countryid ="{{ $country->countryId }}"
                                            data-country ="{{ $country->country }}"
                                          >
                                          {{ title_case($country->country)}}
                                        </option> 
                                    @endforeach   
                                </select>
                              </div>
                            </div>
                          </div>


                          <div class="col-sm-10">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">{{ __('checkout.paymentmethod') }}</label>
                              <div class="col-sm-7">
                                <select class="form-control m-bot15" name="paymentMethodId" id="paymentMethodId" required >
                                    <option >--Select payment Method--</option>
                                     
                                </select>
                              </div>
                            </div>
                          </div>


                          
                           


                          <div class="col-sm-10">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label "></label>
                                <div class="col-sm-8">
                                  <hr>
                                  <div >
                                      <ol class="">
                                        <li>{{ __('checkout.fee') }} - {{-- {{ session('currency') }} --}}  <span id="paymentFee"></span> %</li>
                                        <div id="paymentsummary">
                                            
                                        </div>
                                      </ol>
                                  </div>
                                  
                                </div>
                              </div>
                            </div>


                            <div class="form-group row col-sm-10 "  id="paymentComment-root-container">
                                <label for="paymentComment" class="col-sm-4 col-form-label text-md-right control-label">{{ __('checkout.paymentComment') }}</label>
                                <div class="col-sm-8"   id="paymentComment-container">
                                    <textarea id="paymentComment" name="paymentComment"  class="form-control" placeholder="{{ __('checkout.paymentComment') }}"    rows="3"> </textarea>
                                </div>
                            </div>



                  </fieldset>
              </div>






            {{-- ===================other information=================== --}}
            {{-- ===================other information=================== --}}
            <input type="number"  name="customerId"  value="{{ Auth::user()->id }}"  hidden  >
            <input type="number"  name="tax"  value="{{ $cartTax }}" step="0.1" hidden  >
            <input type="number" id="discount" name="discount"  value="{{ $cartDiscount }}"  step="0.1" hidden >
            <input type="number" id="shippingAmount"  name="shippingAmount"  value="{{ $cartShippingCost }}" step="0.1" hidden  >
            <input type="number" id="totalAmount"  name="totalAmount"  value="{{ $cartTotal }}" step="0.01" hidden  >
            <input type="number"  name="totalQty"  value="{{ $cartdetailsData->sum('qty') }}" step="0.1" hidden  >
            <input type="number"  name="totalProducts"  value="{{ $cartdetailsData->count('qty') }}" step="0.1" hidden  >
            <input type="number" id="subTotalAmount"  name="subTotalAmount"  value="{{ $cartSubTotal }}" step="0.1" hidden  >
            <input type="number" id="usdToCurrencyRate" name="usdToCurrencyRate"  value="{{ $usdToCurrencyRate }}" step="0.1" hidden  >
            <input type="text" id="currencyname" name="currency"  value="{{ session('currency') }}"  hidden  >
            <input type="number" id="cartWeightGM"  name="cartWeightGM"  value="0"   hidden  >
            
            <input type="number" step="0.01" id="deliveryPriceInitial"  name="deliveryPriceInitial"   value="0" hidden  >
            <input type="number" step="0.01" id="deliveryPriceIncrement"  name="deliveryPriceIncrement"   value="0" hidden  >

            <input type="number" step="0.01" id="transactionFee" name="transactionFee"  value="0"  hidden  >
            <input type="number" step="0.01" id="transactionFeeAmount" name="transactionFeeAmount"  value="0"  hidden  >

            <input type="text"  id="offer" name="offer" value=""   hidden  >

            {{-- ===================other information=================== --}}
            {{-- ===================other information=================== --}}

            
           

            
        </fieldset>
         <!-- ===========================checkout======================= -->
         <!-- ===========================checkout======================= -->





         <!-- ===========================checkout Confirm======================= -->
         <!-- ===========================checkout Confirm======================= -->
        <fieldset class="cart-tab" style="margin-top: 60px; padding: 2%;">
          <legend style="border-bottom: none;">{{ __('checkout.checkoutconfirmation') }}</legend>

          
          {{-- oreder Details --}}
          <div class="row ">
            <div class="col-sm-6">
              <fieldset class="cart-tab" style="margin-top: 10px;">
                <legend style="border-bottom: none;">{{ __('checkout.orderdetails') }}</legend>
                      
                      <table class="table table-hover table-responsive ">
                        
                        <thead >
                          <tr class="bg-success">
                            <th>{{ __('checkout.products') }}</th>
                            <th>{{ __('checkout.qty') }}</th>
                            <th>{{ __('checkout.total') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($cartdetailsData as $cartdetail)
                            <tr>
                              <td>
                                  @if (app()->getLocale()=='en')
                                          {{$cartdetail->genericBrand.' '. '('.$cartdetail->genericName.' '.$cartdetail->genericStrength.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packType.' | '. $cartdetail->dosageForm.', '.$cartdetail->genericCompany }}
                                  @elseif (app()->getLocale()=='cn')
                                        {{$cartdetail->genericBrandCN.' '. '('.$cartdetail->genericNameCN.' '.$cartdetail->genericStrength.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packTypeCN.' | '. $cartdetail->dosageFormCN.', '.$cartdetail->genericCompanyCN }}
                                        
                                  @elseif (app()->getLocale()=='ru')
                                        {{$cartdetail->genericBrandRU.' '. '('.$cartdetail->genericNameRU.' '.$cartdetail->genericStrength.'), '.$cartdetail->genericPackSize.'\'s '.$cartdetail->packTypeRU.' | '. $cartdetail->dosageFormRU.', '.$cartdetail->genericCompanyRU }}
                                  @endif
                              </td>
                              <td>{{ $cartdetail->qty }}</td>
                              <td>{!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}  {{ $cartdetail->subtotal * $usdToCurrencyRate }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                        <tfoot class="text-success">

                          <tr>
                            <th>{{ __('checkout.subtotal') }}</th>
                            <th>{{ $cartdetailsData->sum('qty') }}</th>
                            <th>{!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}  {{ $cartSubTotal * $usdToCurrencyRate }}</th>
                          </tr>
                          <tr>
                            <th>{{ __('checkout.discount') }}</th>
                            <td></td>
                            <td>{!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}  {{ $cartDiscount * $usdToCurrencyRate }}</td>
                          </tr>
                          <tr>
                            <th>{{ __('checkout.tax') }}</th>
                            <td></td>
                            <td>{!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}  {{ $cartTax * $usdToCurrencyRate }}</td>
                          </tr>
                          <tr>
                            <th>{{ __('checkout.shippingcost') }}</th>
                            <td></td>
                            <td >{!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}  <span id="cartShippingCostSpan">{{ $cartShippingCost * $usdToCurrencyRate }}</span> </td>
                          </tr>

                          <tr>
                            <th>{{ __('checkout.transactionFee') }}</th>
                            <td></td>
                            <td >{!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}  <span id="transactionAmountSpan"></span> </td>
                          </tr>


                          <tr>
                            <th>{{ __('checkout.netpayable') }}</th>
                            <td></td>
                            <th >{!! $countryData->where('currency', session('currency'))->pluck('hexcode')->first() !!}  <span id="cartTotalSpan">{{ $cartTotal * $usdToCurrencyRate }}</span> </th>
                          </tr>

                        </tfoot>
                      </table>


              </fieldset>
            </div>

            <div class="col-sm-6">
              <fieldset class="cart-tab" style="margin-top: 10px;">
                <legend style="border-bottom: none;">{{ __('checkout.customerdetails') }}</legend>
                  
                  <table class="table table-hover table-responsive ">
                        
                        
                        <tbody>
                            <tr>
                              <td>{{ __('checkout.name') }}</td>
                              <td>{{ $userData->name }}</td>
                            </tr>
                            <tr>
                              <td>{{ __('checkout.email') }}</td>
                              <td>{{ $userData->email }}</td>
                            </tr>
                            <tr>
                              <td>{{ __('checkout.phone') }}</td>
                              <td>{{ $userData->phoneCode.$userData->phone }}</td>
                            </tr>
                        </tbody>
                      
                  </table>



              </fieldset>
            </div>
          </div>

          <div class="row ">
            <div class="col-sm-12">
              <fieldset class="cart-tab" style="margin-top: 25px;">
                <legend style="border-bottom: none;">{{ __('checkout.deliverydetails') }}</legend>


                <table class="table table-hover table-responsive ">
                        
                        
                        <tbody>
                            <tr>
                              <th>{{ __('checkout.name').' ('.__('checkout.inenglish').')' }}</th>
                              <td id="name2"></td>
                            </tr>


                            <tr>
                              <th>{{ __('checkout.name').' ('.__('checkout.inlocallanguage').')' }}</th>
                              <td id="takingForLocalLangView"></td>
                            </tr>



                            <tr>
                              <th>{{ __('checkout.email') }}</th>
                              <td id="email2"></td>
                            </tr>

                            <tr>
                              <th>{{ __('checkout.phone') }}</th>
                              <td id="phone2"></td>
                            </tr>

                            <tr>
                              <th>{{ __('checkout.alternativephone') }}</th>
                              <td id="phonenumber2view"></td>
                            </tr>

                            <tr>
                              <th>{{ __('checkout.house_street').' ('.__('checkout.inenglish').')' }} </th>
                              <td id="streethouse2"></td>
                            </tr>

                            <tr>
                              <th>{{ __('checkout.house_street').' ('.__('checkout.inlocallanguage').')' }} </th>
                              <td id="streethouselocalview"></td>
                            </tr>


                            <tr>
                              <th>{{ __('checkout.country') }}</th>
                              <td id="country2"></td>
                            </tr>


                            <tr>
                              <th>{{ __('checkout.city').' ('.__('checkout.inenglish').')'  }}</th>
                              <td id="cityTownDivision2"></td>
                            </tr>

                            <tr>
                              <th>{{ __('checkout.city').' ('.__('checkout.inlocallanguage').')'  }}</th>
                              <td id="cityTownDivisionlocalview"></td>
                            </tr>

                            

                            <tr>
                              <th>{{ __('checkout.postcode') }}</th>
                              <td id="postalCode2"></td>
                            </tr>

                            

                            

                            <tr>
                              <th >{{ __('checkout.deliverymethod') }} </th>
                              <td id="deliveryMethodId2"></td>
                            </tr>

                            <tr>
                              <th>{{ __('checkout.paymentmethod') }} </th>
                              <td id="paymentMethodView"></td>
                            </tr>


                        </tbody>
                      
                  </table>
                


              </fieldset>
            </div>

            

          </div>
          


            

        </fieldset>
         <!-- ===========================checkout Confirm======================= -->
         <!-- ===========================checkout Confirm======================= -->

        <div class="row col-md-12 col-sm-12 col-xs-11" style="margin-top: 30px;" id="byclick">

           <div class="form-group" style="margin-left: 5px;">
              <div class="form-check">
                <input class="form-check-input" type="checkbox"  id="invalidCheck2" checked >
                <label class="form-check-label" for="invalidCheck2" style="color: red; text-align: justify !important;">
                  {{ __('checkout.byclick') }}  
                  <u><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),1 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),1 ) ) }}" target="_blank" style="padding: 0 px; color: red !important; float: none;">{{  __('checkout.termsconditions')}}</a></u>
                   {{ __('checkout.and') }} 
                   <u><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),8 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),8 ) ) }}" target="_blank" style="padding: 0 px; color: red !important; float: none;">{{  __('checkout.shippingpolciy')}}</a></u> {{ __('checkout.and') }} 
                   {{--  <u><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),3 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),3 ) ) }}" target="_blank" style="padding: 0 px; color: red !important; float: none;">{{  __('checkout.paymentmethodUPPER')}}</a></u>  {{ __('checkout.and') }}   --}}
                   <u><a href="{{ app()->getLocale()?action('PageController@dynamicPageFront', array(app()->getLocale(),7 ) ) : action('PageController@dynamicPageFront', array(app()->getLocale(),7 ) ) }}" target="_blank" style="padding: 0 px; color: red !important; float: none;">{{ __('checkout.privacypolicy') }}</a></u>
                </label>
              </div>
            </div>

        </div>



        <div class="row col-md-12" id="checkout-holder">
          <div class="col-md-6 col-xs-6"  style="padding: 25px;" id="continue-purchasing-button-head-div">
            <a id="continue-purchasing-button" href="{{ route('productlistPage', [ app()->getLocale(), 'diseaseCategoryId'=>0,'categoryId'=>0 ]) }}" class="next shp-btn pull-left" style="border-radius: 50px; text-transform: uppercase;   font-weight: bold;  padding: 12px 40px;    color: #25bb2b !important; text-decoration: underline;">
            {{ __('cart.continuepurchasing') }}</a>
          </div>

          <div class="col-md-6  col-xs-6">
              <input type="submit"  value="{{ __('checkout.confirm') }}" class="pull-right" style="margin-top: 25px;" id="confirm-button">
          </div>
        </div>

     </form>

</div>










{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#countryId').select2({
      // dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
      // dropdownAutoWidth : true,
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


     $('#paymentCountryId').select2({
      // dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
      // dropdownAutoWidth : true,
        placeholder: {
          id: '12', // the value of the option
          text: '--Select Payment Country--'
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
      // dropdownParent: $('#deliveryPriceSaveConfirmationModal'),
      // dropdownAutoWidth : true,
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



<style type="text/css" media="screen">
  .form-group input[type="checkbox"] {
    display: none;
}

.form-group input[type="checkbox"] + .btn-group > label span {
    width: 20px;
}

.form-group input[type="checkbox"] + .btn-group > label span:first-child {
    display: inline-block;   
}
.form-group input[type="checkbox"] + .btn-group > label span:last-child {
    display: none;
}

.form-group input[type="checkbox"]:checked + .btn-group > label span:first-child {
    display: none;   
}
.form-group input[type="checkbox"]:checked + .btn-group > label span:last-child {
    display: inline-block;
}
</style>

<script type="text/javascript">
  $(document).ready(function() {

      // ==============loading default delivery data===========
            var name = '{{ $userData->name }}';
            var email = '{{ $userData->email }}';
            var phoneCode = '{{ $userData->phoneCode }}';
            var phone = '{{ $userData->phone }}';
            var streethouse = '{{ $userData->streethouse }}';
            var cityTownDivision = '{{ $userData->cityTownDivision }}';
            var postalCode = '{{ $userData->postalCode }}';
            var countryId = '{{ $userData->countryId }}';

            // console.log(name)
      // ==============loading default delivery data===========

      $('#fancy-checkbox-success').on('click', function(event) 
      {
            if($(this).is(":checked"))
            {
                // alert("Checkbox is checked.");
                $('#name').val('');
                $('#email').val('');
                $('#streethouse').val('');
                $('#cityTownDivision').val('');
                $('#postalCode').val('');
                $('#deliveryMethodId').val('');
                $('#phone').val('');
               
                $("#phoneCode").val(null).trigger('change');
                $("#countryId").val(null).trigger('change');

                $('#fancy-checkbox-success-tick').removeClass('btn btn-success col-xs-2 col-sm-1');
                $('#fancy-checkbox-success-tick').addClass('btn btn-default col-xs-2 col-sm-1');



            }

            else if($(this).is(":not(:checked)"))
            {
                // alert("Checkbox is unchecked.");
                $('#name').val(name);
                $('#email').val(email);
                $('#streethouse').val(streethouse);
                $('#cityTownDivision').val(cityTownDivision);
                $('#postalCode').val(postalCode);
                $('#phone').val(phone);
                $("#phoneCode").val(phoneCode).change();
                $('#countryId').val(countryId).change();

                $('#fancy-checkbox-success-tick').removeClass('btn btn-default col-xs-2 col-sm-1');
                $('#fancy-checkbox-success-tick').addClass('btn btn-success col-xs-2 col-sm-1');

            }
      });


  });
</script>



<script type="text/javascript">
    $(document).ready(function() {

       
        $(document).on('keyup keydown load enter leave down mouseup mouseleave mouseover change ', function(event) {


            // loading data to varaibles===========
            var name = $('#name').val();
            var takingForLocalLangView = $('#takingForLocalLang').val();
            var email = $('#email').val();
            var phoneCode = $('#phoneCode').val();
            var phone = $('#phone').val();
            var phonenumber2view = $('#phonenumber2').val();


            var streethouse = $('#streethouse').val();
            var streethouselocalview = $('#streethouseLocalLang').val();
            var cityTownDivision = $('#cityTownDivision').val();
            var cityTownDivisionlocalview = $('#cityLocalLang').val();
            var postalCode = $('#postalCode').val();
            var countryId = $('#countryId').val();
            var country =  $('select#countryId').find(':selected').data('country');
            var deliveryMethodId = $('#deliveryMethodId').val();
            var deliveryMethod =  $('select#deliveryMethodId').find(':selected').data('deliverymethod');
            var paymentMethod =  $('select#paymentMethodId').find(':selected').data('paymentmethod');
            // console.log('countryId='+countryId)
            // console.log(country)


            // setting data=============
            $('#name2').text(name);
            $('#takingForLocalLangView').text(takingForLocalLangView);
            $('#email2').text(email);
            $('#phone2').text(phoneCode+phone);
            $('#phonenumber2view').text(phonenumber2view);
            
            $('#country2').text(country);
            $('#cityTownDivision2').text(cityTownDivision);
            $('#cityTownDivisionlocalview').text(cityTownDivisionlocalview);
            $('#postalCode2').text(postalCode);
            $('#streethouse2').text(streethouse);
            $('#streethouselocalview').text(streethouselocalview);
            $('#deliveryMethodId2').text(deliveryMethod);
            $('#paymentMethodView').text(paymentMethod);



            // console.log(deliveryMethodId)
        });



    });
</script>



{{-- Delivery Methods --}}
{{-- Delivery Methods --}}
{{-- Delivery Methods --}}

<script type="text/javascript">
  $(document).ready(function() {

    $('select[name="countryId"]').on('change', function(){

      $('#deliverysummary').empty();
      $('#deliveryfee').empty();


        var countryId = $(this).val();
        if(countryId) {
            $.ajax({
                url: '/{{ app()->getLocale() }}/getDeliveryMethods/'+countryId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('select[name="deliveryMethodId"]').empty();


                  //   console.log(data);
                  // console.log(data.data);
                    

                    $('select[name="deliveryMethodId"]').append('<option >' + '--Select Delivery Method--' + '</option>');
                    $(data.deliverymethodsData).each(function(index, el) {
                        @if (app()->getLocale()=='en')
                            $('select[name="deliveryMethodId"]').append('<option data-iscommentapplicable="'+el.isCommentApplicable+'"  data-iscommentrequired="'+el.isCommentRequired+'"  data-deliverymethodid="'+el.deliveryMethodId+'" data-deliverymethod="'+el.deliveryMethod+'"  data-deliverypriceinitial="'+el.deliveryPriceInitial+'"  data-deliverypriceincrement="'+el.deliveryPriceIncrement+'"   value="'+ el.deliveryMethodId +'">' + el.deliveryMethod + '</option>');
                        @elseif (app()->getLocale()=='cn')
                            $('select[name="deliveryMethodId"]').append('<option data-iscommentapplicable="'+el.isCommentApplicable+'"  data-iscommentrequired="'+el.isCommentRequired+'"  data-deliverymethod="'+el.deliveryMethodId+'" data-deliverymethod="'+el.deliveryMethodCN+'"  data-deliverypriceinitial="'+el.deliveryPriceInitial+'"  data-deliverypriceincrement="'+el.deliveryPriceIncrement+'"   value="'+ el.deliveryMethodId +'">' + el.deliveryMethodCN + '</option>');
                        @elseif (app()->getLocale()=='ru')
                            $('select[name="deliveryMethodId"]').append('<option data-iscommentapplicable="'+el.isCommentApplicable+'"  data-iscommentrequired="'+el.isCommentRequired+'"  data-deliverymethod="'+el.deliveryMethodId+'" data-deliverymethod="'+el.deliveryMethodRU+'"  data-deliverypriceinitial="'+el.deliveryPriceInitial+'"  data-deliverypriceincrement="'+el.deliveryPriceIncrement+'"   value="'+ el.deliveryMethodId +'">' + el.deliveryMethodRU + '</option>');
                        @endif
                    });

                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="deliveryMethodId"]').empty();

        }

    });

});
</script>



<script type="text/javascript">
  $(document).ready(function() {

    $('select[name="deliveryMethodId"]').on('change', function(){
        var deliveryMethodId = $(this).val();
        var countryId = $('#countryId').val();
        if(deliveryMethodId) {
            $.ajax({
                url: '/{{ app()->getLocale() }}/getDeliverySummary/'+deliveryMethodId+'/'+countryId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('#deliverysummary').empty();
                    $('#deliveryfee').empty();

                    // console.log( data);
                    // console.log(data.data);
                    
                    
                    $('#deliveryfee').text(data.cartshippingCostWeightForDeliverySummary);
                    

                    
                    $(data.deliverySummaryData).each(function(index, el) {

                            @if (app()->getLocale()=='en')
                              $('#deliverysummary').append('<li>' + el.deliverySummary + '</li>');
                            @elseif (app()->getLocale()=='cn')
                              $('#deliverysummary').append('<li>' + el.deliverySummaryCN + '</li>');
                            @elseif (app()->getLocale()=='ru')
                              $('#deliverysummary').append('<li>' + el.deliverySummaryRU + '</li>');
                            @endif
                      });



                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } 
        else {
            // $('select[name="deliveryMethodId"]').empty();
            $('#deliveryComment').val("");
            $('#deliveryComment').prop('required',false);
            $('#deliveryComment-root-container').hide();
            $('#deliveryComment-root-container').removeClass('required');

            $('#deliveryfee').empty();
            $('#deliverysummary').empty();
        }

    });

});
</script>


{{-- Delivery Methods --}}
{{-- Delivery Methods --}}
{{-- Delivery Methods --}}








{{-- Payment Methods --}}
{{-- Payment Methods --}}
{{-- Payment Methods --}}

<script type="text/javascript">
  $(document).ready(function() {

    $('select[name="paymentCountryId"]').on('change', function(){

      $('#paymentsummary').empty();
      $('#paymentFee').empty();


        var paymentCountryId = $(this).val();
        if(paymentCountryId) {
            $.ajax({
                url: '/{{ app()->getLocale() }}/getPaymentMethods/'+paymentCountryId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('select[name="paymentMethodId"]').empty();


                  // console.log(data);
                  // console.log(data.data);
                    

                    $('select[name="paymentMethodId"]').append('<option >' + '--Select Payment Method--' + '</option>');
                    $(data.paymentmethodsData).each(function(index, el) {

                            @if (app()->getLocale()=='en')
                              $('select[name="paymentMethodId"]').append('<option data-iscommentapplicable="'+el.isCommentApplicable+'"  data-iscommentrequired="'+el.isCommentRequired+'" data-paymentmethodid="'+el.paymentMethodId+'" data-paymentmethod="'+el.paymentMethod+'"  data-transactionfee="'+el.transactionFee+'"    value="'+ el.paymentMethodId +'">' + el.paymentMethod + '</option>');
                            @elseif (app()->getLocale()=='cn')
                                $('select[name="paymentMethodId"]').append('<option  data-iscommentapplicable="'+el.isCommentApplicable+'"  data-iscommentrequired="'+el.isCommentRequired+'"  data-paymentmethod="'+el.paymentMethodId+'" data-paymentmethod="'+el.paymentMethodCN+'"  data-transactionfee="'+el.transactionFee+'"    value="'+ el.paymentMethodId +'">' + el.paymentMethodCN + '</option>');
                            @elseif (app()->getLocale()=='ru')
                                $('select[name="paymentMethodId"]').append('<option  data-iscommentapplicable="'+el.isCommentApplicable+'"  data-iscommentrequired="'+el.isCommentRequired+'"  data-paymentmethod="'+el.paymentMethodId+'" data-paymentmethod="'+el.paymentMethodRU+'"  data-transactionfee="'+el.transactionFee+'"    value="'+ el.paymentMethodId +'">' + el.paymentMethodRU + '</option>');
                            @endif
                      });

                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="paymentMethodId"]').empty();
            $('#paymentsummary').empty();
            $('#paymentFee').empty();

        }

    });

});
</script>



<script type="text/javascript">
  $(document).ready(function() {

    $('select[name="paymentMethodId"]').on('change', function(){
        var paymentMethodId = $(this).val();
        var paymentCountryId = $('#paymentCountryId').val();
        console.log(paymentMethodId)
        if(paymentMethodId>0) {
            $.ajax({
                url: '/{{ app()->getLocale() }}/getPaymentSummary/'+paymentMethodId+'/'+paymentCountryId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    $('#paymentsummary').empty();
                    $('#paymentFee').empty();


                    $('#paymentFee').text((data.transactionFee.toFixed(2))||0);
                    $('#transactionFee').val((data.transactionFee.toFixed(2))||0);

                    $(data.paymentSummaryData).each(function(index, el) {

                            @if (app()->getLocale()=='en')
                              $('#paymentsummary').append('<li>' + el.paymentSummary + '</li>');
                            @elseif (app()->getLocale()=='cn')
                              $('#paymentsummary').append('<li>' + el.paymentSummaryCN + '</li>');
                            @elseif (app()->getLocale()=='ru')
                              $('#paymentsummary').append('<li>' + el.paymentSummaryRU + '</li>');
                            @endif
                      });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
          $('#paymentsummary').empty();
          $('#paymentFee').empty();
            
        }

    });

});
</script>


{{-- Payment Methods --}}
{{-- Payment Methods --}}
{{-- Payment Methods --}}








{{-- cart calculation  --}}
{{-- cart calculation  --}}
{{-- cart calculation  --}}
{{-- cart calculation  --}}
{{-- cart calculation  --}}

<script type="text/javascript">
  $(document).ready(function() {

    $('select').on('change', function(){
        var deliveryMethodId = $('#deliveryMethodId').val();
        var countryId = $('#countryId').val();

        var paymentMethodId = $('#paymentMethodId').val();
        var paymentCountryId = $('#paymentCountryId').val();

        console.log('deliveryMethodId = '+deliveryMethodId+' countryId = '+countryId)
        console.log('paymentMethodId = '+paymentMethodId+' paymentCountryId = '+paymentCountryId)

        if(deliveryMethodId>0 && countryId>0 && paymentMethodId>0 && paymentCountryId>0) {
            $.ajax({
                url: '/{{ app()->getLocale() }}/getCheckoutCalculation/'+deliveryMethodId+'/'+countryId+'/'+paymentMethodId+'/'+paymentCountryId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },

                success:function(data) {

                    
                    // $('#deliveryfee').text(data.cartshippingCostWeightForDeliverySummary);
                    $('#cartShippingCostSpan').text((data.shippingCost * data.usdToCurrencyRate).toFixed(2));
                    $('#cartTotalSpan').text(((data.cartTotal)).toFixed(2));
                    $('#transactionAmountSpan').text((data.transactionAmount).toFixed(2));


                    $('#discount').val(data.cartdiscount * data.usdToCurrencyRate);
                    $('#shippingAmount').val((data.shippingCost * data.usdToCurrencyRate).toFixed(2));
                    $('#totalAmount').val((data.cartTotal).toFixed(2)||0);
                    $('#subTotalAmount').val(data.cartsubtotal * data.usdToCurrencyRate);
                    $('#usdToCurrencyRate').val(data.usdToCurrencyRate);
                     $('#currencyname').val('{!! session('currency') !!}'); 
                    $('#cartWeightGM').val(data.cartWeight);

                    $('#deliveryPriceInitial').val(data.deliveryPriceInitial * data.usdToCurrencyRate);
                    $('#deliveryPriceIncrement').val(data.deliveryPriceIncrement * data.usdToCurrencyRate);
                    $('#transactionFeeAmount').val((data.transactionAmount ).toFixed(2) || 0);

                    $('#offer').val(data.offer);



                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        }
        


    });

});
</script>


{{-- cart calculation  --}}
{{-- cart calculation  --}}
{{-- cart calculation  --}}
{{-- cart calculation  --}}





{{-- payment comment show/hide  --}}
{{-- payment comment show/hide  --}}

<script type="text/javascript">
  $(document).ready(function() {

    $('#paymentComment-root-container').hide();
    $('#paymentComment').prop('required',false);

    $('select').on('change', function(){

        var paymentMethodId = $('#paymentMethodId').val();
        var isCommentApplicable =  ($('select#paymentMethodId').find(':selected').data('iscommentapplicable')) || 0;
        var isCommentRequired =  $('select#paymentMethodId').find(':selected').data('iscommentrequired') || 0;

        console.log('paymentMethodId = '+paymentMethodId)
        console.log('isCommentApplicable = '+ isCommentApplicable)

        if( isCommentApplicable==1 && isCommentRequired==1) 
        {
            $('#paymentComment-root-container').show();
            $('#paymentComment-root-container').addClass(' required');
            $('#paymentComment').prop('required',true);
        } 
        else if(isCommentApplicable==1 && isCommentRequired==0)
        {
            $('#paymentComment-root-container').show();
            $('#paymentComment-root-container').removeClass('required');
            $('#paymentComment').prop('required',false);
        }        
        else 
        {
            $('#paymentComment-root-container').hide();
            $('#paymentComment').val("");
            $('#paymentComment').prop('required',false);
        } 

    });

});
</script>


{{-- payment comment show/hide  --}}
{{-- payment comment show/hide  --}}




{{-- delivery comment show/hide  --}}
{{-- delivery comment show/hide  --}}

<script type="text/javascript">
  $(document).ready(function() {

    $('#deliveryComment-root-container').hide();
    $('#deliveryComment').prop('required',false);

    $('select').on('change', function(){

        var deliveryMethodId = $('#deliveryMethodId').val();
        var isCommentApplicable =  $('select#deliveryMethodId').find(':selected').data('iscommentapplicable');
        var isCommentRequired =  $('select#deliveryMethodId').find(':selected').data('iscommentrequired');


        console.log('deliveryMethodId = '+deliveryMethodId)
        console.log('isCommentApplicable = '+isCommentApplicable)

        if( isCommentApplicable==1 && isCommentRequired==1) 
        {
            $('#deliveryComment-root-container').show();
            $('#deliveryComment-root-container').addClass(' required');
            $('#deliveryComment').prop('required',true);
        } 
        else if( isCommentApplicable==1 && isCommentRequired==0) 
        {
            $('#deliveryComment-root-container').show();
            $('#deliveryComment-root-container').removeClass('required');
            $('#deliveryComment').prop('required',false);
        } 
        else 
        {
            $('#deliveryComment').val("");
            $('#deliveryComment').prop('required',false);
            $('#deliveryComment-root-container').hide();
            $('#deliveryComment-root-container').removeClass('required');
            
        } 

    });

});
</script>


{{-- delivery comment show/hide  --}}
{{-- delivery comment show/hide  --}}

<style>
  @media (max-width: 400px){
    .form-check-label{
      font-size: 11px;
      white-space: normal;
      word-break: break-all;
    }

    #confirm-button{
      padding: 10px;
      font-size: 11px;
    }

    #continue-purchasing-button{
      padding: 0px !important;
      font-size: 11px;
      margin-top: 35px !important;
    }

    #continue-purchasing-button-head-div{
      padding: 0px !important;
    }
  }
</style>


<style>
  @media (max-width: 991px) {
    #byclick{
      position: absolute !important;
    }

    #checkout-holder{
      margin-top: 66px !important;
    }
  }


</style>

@endsection
