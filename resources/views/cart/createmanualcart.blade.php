@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Manual Cart')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 


@section('page_content')

<style type="text/css" media="screen">
    fieldset{
     border:1px solid #cccc;
     padding: 8px;
  }
</style>


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

            <h4 class="card-title text-center">Create Manual Cart</h4>


            <form class="form-sample"  method="POST" enctype="multipart/form-data" action="{{ route('createmanualcart.save') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                {{ csrf_field() }}

                <br>

                    {{-- cart information --}}
                    {{-- cart information --}}
                    <input type="number" value="1" id="isManualCart" name="isManualCart" hidden>
                    <input type="number" value="1" id="cartStatusId" name="cartStatusId" hidden>
                    <input type="number" value="1" id="isCartApproved" name="isCartApproved" hidden>
                    {{-- cart information --}}
                    {{-- cart information --}}



                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-2 col-form-label control-label">Customer</label>
                            <div class="col-sm-9">

                                {{-- dynamic select/dropdown --}}
                                <select class="form-control m-bot15" name="customerId" id="customerId" required >
                                    <option value="">--Select Customer--</option>
                                    @foreach($usersData as $customer)
                                        <option value="{{ $customer->id }}" 
                                            data-customerid="{{ $customer->id }}" 
                                            data-name="{{ $customer->name }}" 
                                            data-email="{{ $customer->email }}" 
                                            data-phone="{{ $customer->phone }}" 
                                            data-countryid="{{ $customer->countryId }}" 
                                            data-country="{{ $customer->country }}" 
                                            data-citytowndivision="{{ $customer->cityTownDivision }}" 
                                            data-stateprovinceregiondistrict="{{ $customer->stateProvinceRegionDistrict }}" 
                                            data-postalcode="{{ $customer->postalCode }}" 
                                            data-photopath="{{ $customer->photoPath }}" 
                                            data-phonecode="{{ $customer->phoneCode }}" 
                                            data-streethouse="{{ $customer->streethouse }}" 

                                            >
                                            {{ $customer->email.' ('.title_case($customer->name).') '.$customer->country.' '.$customer->phone.' '.\Carbon\Carbon::parse($customer->created_at)->format('d-M-Y') }}
                                        </option> 
                                    @endforeach   
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <a href="javascript:void(0)">
                                    <i class=" icon-plus text-success" style="font-size:25px;" data-toggle="modal" data-target="#createUserSaveConfirmationModal"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row ">
                            <label class="col-sm-2 col-form-label control-label">Assign product prices</label>
                            <div class="col-sm-10">
                                <a class="btn btn-primary pt-2 pb-2 disabled" target="_blank" href="#" role="button" id="assign_price_btn">Assign Prices</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row ">
                            <label class="col-sm-2 col-form-label control-label required">Patient Name</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" name="patientName"  class="form-control" placeholder="patientName"   id="patientName" required> --}}
                                <textarea name="patientName" id="patientName"  rows="5" class="form-control"   id="patientName" ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row ">
                            <label class="col-sm-2 col-form-label control-label">Taking For Relationship</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" name="takingForRelationship"  class="form-control" placeholder="takingForRelationship"   id="takingForRelationship" required> --}}
                                <textarea name="takingForRelationship" id="takingForRelationship"  rows="5" class="form-control" id="takingForRelationship" ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row ">
                            <label class="col-sm-2 col-form-label control-label">Social Media</label>
                            <div class="col-sm-10">
                                {{-- <input type="text" name="socialMedia"  class="form-control" placeholder="socialMedia"   id="socialMedia" > --}}
                                <textarea name="socialMedia" id="socialMedia"  rows="5" class="form-control"  id="socialMedia"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-md-2 col-form-label control-label">Currency</label>
                            <div class="col-md-10">
                                <select class="form-control m-bot15 "  id="currency"  name="currency" >
                                    <option value="">--Select Currency--</option>
                                    @foreach ($countryData->where('currency', '!=', null) as $country)
                                        <option  value="{{ $country->currency }}"> 
                                            {{ $country->currency }}
                                        </option> 
                                    @endforeach   
                                </select>
                          </div>
                        </div>
                    </div>



                <div class="col-md-12">
                    <div class="form-group row required">
                      <label class="col-md-2 col-form-label control-label">Generic Pack Size</label>
                      <div class="col-md-10">
                        <select class="form-control m-bot15"  id="genericPackSizeIdGenerator"  >
                        </select>
                      </div>
                    </div>
                </div>


                <input type="button" class="btn btn-primary add-row  mb-5 float-right" value="Add to cart" id="add_to_cart_btn">

                <div class="row table-responsive" id="cart-item">
                    <fieldset  class=" mb-4">
                        <legend>Cart Items</legend>
                        <table id="cart-item-table" class="table table-striped table-bordered table-hover" width="100%">
                            <thead >
                                <tr class="bg-primary text-light">
                                    <th>Select</th>                                            

                                    <th class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Discount</th>

                                    <th class="text-center">Min Qty</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>

                            <tbody id="cart_item_table_tbody">
                                

                            </tbody>
                        </table>

                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger  mt-2" id="delete_cart_item">Delete Item</button>
                        </div>

                    </fieldset>

                </div>



                <!-- ===========================checkout======================= -->
                <!-- ===========================checkout======================= -->
                <fieldset>
                    <legend style="border-bottom: none;">Delivery Details</legend>
        
        
                        <div class="form-group row col-sm-10 required">
                            <label for="name" class="col-sm-4 col-form-label text-md-right control-label">Name (In English)</label>
                            <div class="col-sm-8">
                                <textarea name="takingFor" id="takingFor"  rows="5" class="form-control" required ></textarea>

                            </div>
                        </div>
        
                        <div class="form-group row col-sm-10 ">
                            <label for="name" class="col-sm-4 col-form-label text-md-right control-label">Name (In Local Language)</label>
                            <div class="col-sm-8">
                                <textarea name="takingForLocalLang" id="takingForLocalLang"  rows="5" class="form-control"  ></textarea>
                            </div>
                        </div>
        
        
                        <div class="form-group row col-sm-10 required">
                            <label for="email" class="col-sm-4 col-form-label text-md-right control-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" name="email"  class="form-control" placeholder="Email"   id="email" required>
                            </div>
                        </div>
        
        
                        <div class="form-group row col-sm-10 required">
                            <label for="phone" class="col-sm-4 col-form-label text-md-right control-label">Phone</label>
                            <div class="col-sm-8 row">
                                <div class="col-sm-6">
                                                        
                                    <select class="form-control m-bot15" id="phoneCode" name="phoneCode" required >
        
                                        <option value="">--Select Phone Code--</option>}
                                        @foreach($countryData->sortBy('country') as $country)
                                            <option value="{{ '+'.$country->phoneCode }}">
                                                {{ '+'.$country->phoneCode.' ('.$country->country.')'  }}
                                            </option> 
                                        @endforeach   
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="tel" id="phone" type="phone" class="form-control" name="phone"  required>
                                </div>
                            </div>
                        </div>
        
                        <div class="form-group row col-sm-10 ">
                            <label for="phonenumber2" class="col-sm-4 col-form-label text-md-right control-label">Phone 2</label>
                            <div class="col-sm-8">
                                <input type="tel" id="phonenumber2" name="phonenumber2"  class="form-control"   >
                            </div>
                        </div>
        
                        <div class="form-group row col-sm-10 required">
                            <label for="streethouse" class="col-sm-4 col-form-label text-md-right control-label">House/Street Info (In English)</label>
                            <div class="col-sm-8">
                                <textarea name="streethouse" id="streethouse"  rows="5" class="form-control" required ></textarea>
                            </div>
                        </div>
        
                        <div class="form-group row col-sm-10 ">
                            <label for="streethouseLocalLang" class="col-sm-4 col-form-label text-md-right control-label">House/Street Info (In Local Language)</label>
                            <div class="col-sm-8">
                                <textarea name="streethouseLocalLang" id="streethouseLocalLang"  rows="5" class="form-control"  ></textarea>
                            </div>
                        </div>
        
                        <div class="col-sm-10">
                            <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label text-md-right">Country</label>
                            <div class="col-sm-8">
                                <select class="form-control m-bot15" name="countryId" id="countryId" required >
                                    <option value="">--Select Country--</option>
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
        
        
                        <div class="form-group row col-sm-10 required">
                            <label for="cityTownDivision" class="col-sm-4 col-form-label text-md-right control-label">City (In English)</label>
                            <div class="col-sm-8">
                                <textarea name="city" id="cityTownDivision"  rows="5" class="form-control" required ></textarea>
                            </div>
                        </div>
        
                        <div class="form-group row col-sm-10 ">
                            <label for="cityLocalLang" class="col-sm-4 col-form-label text-md-right control-label">City (In Local Language)</label>
                            <div class="col-sm-8">
                                <textarea name="cityLocalLang" id="cityLocalLang"  rows="5" class="form-control"  ></textarea>

                            </div>
                        </div>
        
                        <div class="form-group row col-sm-10 required">
                            <label for="postalCode" class="col-sm-4 col-form-label text-md-right control-label">Post Code</label>
                            <div class="col-sm-8">
                                <input type="number" id="postalCode" name="postalCode"  class="form-control" placeholder="Post Code"   required>
                            </div>
                        </div>
        
                        <div class="col-sm-10">
                            <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label text-md-right">Delivery Method</label>
                                <div class="col-sm-8">
                                <select class="form-control m-bot15" name="deliveryMethodId" id="deliveryMethodId" required >
                                    
                                </select>
                                </div>
                            </div>
                        </div>
        
                        
        
                        <div class="form-group row col-sm-10 "  id="deliveryComment-root-container">
                            <label for="deliveryComment" class="col-sm-4 col-form-label text-md-right control-label">Delivery Comment</label>
                            <div class="col-sm-8"   id="deliveryComment-container">
                                <textarea id="deliveryComment" name="deliveryComment" value="" class="form-control" placeholder="Delivery Comment"    rows="3"></textarea>
                            </div>
                        </div>
        
        
        
        
        
                        <div class="col-sm-12">
                            <fieldset class="cart-tab" style="margin-top: 60px; padding: 2%;">
                            <legend style="border-bottom: none;">Payment Method</legend>
        
                                    <div class="col-sm-10">
                                    <div class="form-group row required">
                                        <label class="col-sm-4 col-form-label control-label text-md-right">Payment Country </label>
                                        <div class="col-sm-8">
                                        <select class="form-control m-bot15" name="paymentCountryId" id="paymentCountryId" required >
                                            <option value="">--Select Country--</option>
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
                                        <label class="col-sm-4 col-form-label control-label text-md-right">Payment Method</label>
                                        <div class="col-sm-8">
                                        <select class="form-control m-bot15" name="paymentMethodId" id="paymentMethodId" required >
                                            <option value="">--Select payment Method--</option>
                                            
                                        </select>
                                        </div>
                                    </div>
                                    </div>
        
        
        
                                    <div class="form-group row col-sm-10 "  id="paymentComment-root-container">
                                        <label for="paymentComment" class="col-sm-4 col-form-label text-md-right control-label">Payment Comment</label>
                                        <div class="col-sm-8"   id="paymentComment-container">
                                            <textarea id="paymentComment" name="paymentComment" value="" class="form-control" placeholder="Payment comment"    rows="3"> </textarea>
                                        </div>
                                    </div>
        
        
        
                            </fieldset>
                        </div>
        
        
                    
                </fieldset>
                <!-- ===========================checkout======================= -->
                <!-- ===========================checkout======================= -->



                <div class="col-md-12 text-center ">
                    <input type="submit" class="btn btn-success mr-2"  value="Save">
                </div>
            </form>            
        </div>
    </div>
</div>





<!-- user create  Save Modal -->
<!-- user create  Save Modal -->
<div class="modal fade modal-xl" id="createUserSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="createUserSaveConfirmationModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header d-block text-center">
          <h5 class="modal-title"  id="createUserSaveConfirmationModal">Add a user</h5>
        </div>
        <div class="modal-body" style="margin-top: -4vw;">
  
            <form class="form-horizontal" method="POST"  action="{{ route('createmanualcartcustomerRegistration.save') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}
                <br>

                <input type="number" name="isCustomer" value="1" hidden>
                <input type="number" value="1" id="isCreatedByAdmin" name="isCreatedByAdmin" hidden>

                <div class="form-group row col-md-12 required">
                    <label for="name" class="col-md-4 col-form-label text-md-right control-label">Name</label>
                    <div class="col-md-8">
                        <textarea name="name" id="name"  rows="5" class="form-control" required autofocus></textarea>
                    </div>
                </div>

                <div class="form-group row col-md-12 required">
                    <label for="email" class="col-md-4 col-form-label text-md-right control-label">Email</label>
                    <div class="col-md-8">
                        <input id="email" type="email" class="form-control" name="email"  required>
                    </div>
                </div>

                <div class="form-group row col-md-12 required">
                    <label for="password" class="col-md-4 col-form-label text-md-right  control-label">Password</label>
                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                </div>

                {{-- <div class="form-group row col-md-12 required">
                    <label for="confirmpassword" class="col-md-4 col-form-label text-md-right control-label">Confirm password</label>
                    <div class="col-md-8">
                        <input id="confirmpassword" type="password" class="form-control" name="confirmpassword" required>
                    </div>
                </div> --}}

                <div class="form-group row col-md-12 required">
                    <label for="phone" class="col-md-4 col-form-label text-md-right  control-label">Phone</label>
                    <div class="col-md-8">
                        <div class="col-md-12">
                            <select class="form-control m-bot15" id="phoneCode" name="phoneCode" required >
                                <option value="">--Select Phone Code--</option>}
                                @foreach($countryData->sortBy('country') as $country)
                                    <option value="{{ '+'.$country->phoneCode }}">
                                        {{ '+'.$country->phoneCode.' ('.$country->country.')'  }}
                                    </option> 
                                @endforeach   
                            </select>
                        </div>
                        <div class="col-md-12">
                            <input type="tel" id="phone" type="phone" class="form-control" name="phone"  required>
                        </div>
                    </div>
                </div>

                <div class="form-group row col-md-12 required">
                    <label for="cityTownDivision" class="col-md-4 col-form-label text-md-right control-label">City</label>

                    <div class="col-md-8">
                        <textarea name="cityTownDivision" id="cityTownDivision"  rows="5" class="form-control" required ></textarea>
                    </div>
                </div>

                <div class="form-group row col-md-12 required">
                    <label for="streethouse" class="col-md-4 col-form-label text-md-right  control-label">Street/House</label>
                    <div class="col-md-8">
                        <textarea name="streethouse" id="streethouse"  rows="5" class="form-control" required ></textarea>
                    </div>
                </div>

                <div class="form-group row col-md-12 required">
                    <label for="postalCode" class="col-md-4 col-form-label text-md-right control-label">Postcode</label>

                    <div class="col-md-8">
                        <input id="postalCode" type="number" class="form-control" name="postalCode" required  >
                    </div>
                </div>

                <div class="form-group row col-md-12 required">
                    <label for="countryId" class="col-md-4 col-form-label text-md-right  control-label">Country</label>

                    <div class="col-md-8">
                        <select class="form-control m-bot15" name="countryId" id="countryId" required >

                            <option  value="">--Select Country--</option>
                            @foreach($countryData->sortBy('country') as $country)
                                <option value="{{ $country->countryId }}">
                                    {{ title_case($country->country)}}
                                </option> 
                            @endforeach   
                        </select>
                    </div>
                </div>

                {{-- <div class="form-group row col-md-12">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Photo</label>

                    <div class="col-md-8">
                      
                        <input id="photoPath" name="photoPath" type="file" class="file" data-show-upload="true" data-show-caption="true" >
                            
                    </div>
                </div> --}}
                
                <button data-toggle="modal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>
                <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- user create  Save Modal -->
  <!-- user create  Save Modal -->
  


<script >
    $(document).ready(function() {
        
        $('select[id="customerId"]').on('change', function(){
            var customerId = $(this).val();
            if (customerId>0) {
                $('#assign_price_btn').removeClass("disabled");
                $('#assign_price_btn').attr("href", "/customers/productPricesForUsersAssign/"+customerId);

                // loading delivery details 
                
                var customerId = $('select#customerId').find(':selected').data('customerid');
                var takingFor = $('select#customerId').find(':selected').data('name');
                var email = $('select#customerId').find(':selected').data('email');
                var phone = $('select#customerId').find(':selected').data('phone');
                var countryId = $('select#customerId').find(':selected').data('countryId');
                var country = $('select#customerId').find(':selected').data('country');
                var cityTownDivision = $('select#customerId').find(':selected').data('citytowndivision');
                var stateProvinceRegionDistrict = $('select#customerId').find(':selected').data('stateprovinceregiondistrict');
                var postalCode = $('select#customerId').find(':selected').data('postalcode');
                // var photoPath = $('select#customerId').find(':selected').data('photopath');
                var phoneCode = $('select#customerId').find(':selected').data('phonecode');
                var streethouse = $('select#customerId').find(':selected').data('streethouse');
                $('#takingFor').val(takingFor);
                $('#email').val(email);
                $('#phoneCode').val(phoneCode).trigger('change');
                $('#phone').val(phone);
                $('#streethouse').val(streethouse);
                $('#countryId').val(countryId);
                $('#cityTownDivision').val(cityTownDivision);
                $('#postalCode').val(postalCode);

                console.log(streethouse)

            } else {
                $('#assign_price_btn').addClass(" disabled");
                $('#assign_price_btn').attr("href", "#");
                $('select[id="genericPackSizeIdGenerator"]').empty();
            }

            $.ajax({
                url: '/getGenericPackSizesUsingCustomerId/'+customerId,
                type:"GET",
                dataType:"json",
               

                success:function(genericpacksizesData) {
                //   console.log(genericpacksizesData);
                //   console.log(genericpacksizesData.genericpacksizesData);

                  // 1. clear table================================
                //   $("#cart_item_table_tbody").empty();
                   // 2. empty dependent drop down=================
                    $('select[id="genericPackSizeIdGenerator"]').empty();
                  // 3. add rows to table==========================
                  $.each(genericpacksizesData.genericpacksizesData, function(index, el) {


                    // adding data to drop down select
                      $('select[id="genericPackSizeIdGenerator"]').append('<option '+

                        ' data-genericpacksizeid="'+el.genericPackSizeId+'" '+
                        ' data-genericname="'+el.genericName+'" '+
                        ' data-category="'+el.category+'" '+
                        ' data-diseasecategory="'+el.diseaseCategory+'" '+
                        ' data-globaltradenamecompany="'+el.globalTradeNameCompany+'" '+
                        ' data-genericcompany="'+el.genericCompany+'" '+
                        ' data-genericbrandid="'+el.genericBrandId+'" '+
                        ' data-genericbrand="'+el.genericBrand+'" '+
                        ' data-dosageform="'+el.dosageForm+'" '+
                        ' data-genericstrength="'+el.genericStrength+'" '+
                        ' data-genericpacksize="'+el.genericPackSize+'" '+
                        ' data-packtype="'+el.packType+'" '+
                        ' data-dosindetails="'+el.dosingDetails+'" '+
                        ' data-ptsellingprice="'+el.ptSellingPrice+'" '+
                        ' data-ptmoq="'+el.ptMOQ+'" '+
                        ' data-dealersellingprice="'+el.dealerSellingPrice+'" '+
                        ' data-dealermoq="'+el.dealerMOQ+'" '+
                        ' data-vipsellingprice="'+el.vipSellingPrice+'" '+
                        ' data-compptsellingprice="'+el.compPtSellingPrice+'" '+
                        ' data-complocalsellingprice="'+el.compLocalSellingPrice+'" '+
                        ' data-globalmarketprices="'+el.globalMarketPrices+'" '+
                        ' data-avgpriceoforiginator="'+el.avgPriceOfOriginator+'" '+
                        ' data-buyingprices="'+el.buyingPrices+'" '+
                        ' data-customerprice="'+el.customerPrice+'" '+
                        ' data-discount="'+el.discount+'" '+
                        ' data-moq="'+el.moq+'" '+
                        ' data-customerid="'+el.customerId+'" '+

                        ' value="'+ el.genericPackSizeId +'">' + el.genericName+'-' +el.category+'-' +el.diseaseCategory+'-' +el.globalTradeNameCompany+'-' +el.genericCompany+'-' +el.genericBrand+'-' +el.dosageForm+'-' +el.genericPackSize+'(Size)'+'-'+el.genericStrength+'-' +el.packType+ 

                        '</option>');
                  });

                },
                complete: function(){
                    // $('#loader').css("visibility", "hidden");
                }
            });
        });
    });
</script>


{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
    $(document).ready(function() {
  
       $('#customerId').select2({
        // dropdownAutoWidth : true,
          placeholder: {
            id: '12', // the value of the option
            text: '--Select Customer--'
          },
          // placeholder : "--Select Employee--",
          allowClear: true,
          language: {
            noResults: function (params) {
              return "No Data Found!";
            }
          },
       });

       $('#countryId').select2({
        // dropdownAutoWidth : true,
          placeholder: {
            id: '12', // the value of the option
            text: '--Select Country--'
          },
          allowClear: true,
          language: {
            noResults: function (params) {
              return "No Data Found!";
            }
          },
       });

       $('#paymentCountryId').select2({
        // dropdownAutoWidth : true,
          placeholder: {
            id: '12', // the value of the option
            text: '--Select Payment Country--'
          },
          allowClear: true,
          language: {
            noResults: function (params) {
              return "No Data Found!";
            }
          },
       });

       $('#genericPackSizeIdGenerator').select2({
          placeholder: {
            id: '12', // the value of the option
            text: '--Select Generic Pack Size--'
          },
          allowClear: true,
          language: {
            noResults: function (params) {
              return "No Data Found!";
            }
          },
       });

        $('#currency').select2({
            placeholder: {
                id: '12', // the value of the option
                text: '--Select Currency--'
            },
            allowClear: true,
            language: {
                noResults: function (params) {
                return "No Data Found!";
                }
            },
        });

        $('#phoneCode').select2({
            placeholder: {
                id: '12', // the value of the option
                text: '--Select Phone Code--'
            },
            allowClear: true,
            language: {
                noResults: function (params) {
                return "No Data Found!";
                }
            },
        });
    });
</script>




{{-- generic price adding, deleting code --}}

<script type="text/javascript">

    var add_cart_items = [];

    $(document).ready(function(){
        $("#add_to_cart_btn").click(function(){
            console.log('clicked');

            // getting generic pack sizes and price and values values


            var genericPackSizeId = $('select#genericPackSizeIdGenerator').find(':selected').val();
            var genericName = $('select#genericPackSizeIdGenerator').find(':selected').data('genericname');

            var category = $('select#genericPackSizeIdGenerator').find(':selected').data('category');
            var diseaseCategory = $('select#genericPackSizeIdGenerator').find(':selected').data('diseasecategory');
            var globalTradeNameCompany = $('select#genericPackSizeIdGenerator').find(':selected').data('globaltradenamecompany');
            var genericCompany = $('select#genericPackSizeIdGenerator').find(':selected').data('genericcompany');
            var genericBrandId = $('select#genericPackSizeIdGenerator').find(':selected').data('genericbrandid');
            var genericBrand = $('select#genericPackSizeIdGenerator').find(':selected').data('genericbrand');
            var dosageForm = $('select#genericPackSizeIdGenerator').find(':selected').data('dosageform');
            var genericStrength = $('select#genericPackSizeIdGenerator').find(':selected').data('genericstrength');
            var genericPackSize = $('select#genericPackSizeIdGenerator').find(':selected').data('genericpacksize');
            var packType = $('select#genericPackSizeIdGenerator').find(':selected').data('packtype');
            var dosingDetails = $('select#genericPackSizeIdGenerator').find(':selected').data('dosingdetails');
            var ptSellingPrice = $('select#genericPackSizeIdGenerator').find(':selected').data('ptsellingprice');
            var ptMOQ = $('select#genericPackSizeIdGenerator').find(':selected').data('ptmoq');
            var dealerSellingPrice = $('select#genericPackSizeIdGenerator').find(':selected').data('dealersellingprice');
            var dealerMOQ = $('select#genericPackSizeIdGenerator').find(':selected').data('dealermoq');
            var vipSellingPrice = $('select#genericPackSizeIdGenerator').find(':selected').data('vipsellingprice');
            var compPtSellingPrice = $('select#genericPackSizeIdGenerator').find(':selected').data('compptsellingprice');
            var compLocalSellingPrice = $('select#genericPackSizeIdGenerator').find(':selected').data('complocalsellingprice');
            var globalMarketPrices = $('select#genericPackSizeIdGenerator').find(':selected').data('globalmarketprices');
            var avgPriceOfOriginator = $('select#genericPackSizeIdGenerator').find(':selected').data('avgpriceoforiginator');
            var buyingPrices = $('select#genericPackSizeIdGenerator').find(':selected').data('buyingprices');
            var customerPrice = $('select#genericPackSizeIdGenerator').find(':selected').data('customerprice');
            var discount = $('select#genericPackSizeIdGenerator').find(':selected').data('discount');
            var moq = $('select#genericPackSizeIdGenerator').find(':selected').data('moq');
            var customerId = $('select#genericPackSizeIdGenerator').find(':selected').data('customerid');

            
            if ( genericPackSizeId>0 ) 
            {  
                console.log('hitted');

                if (add_cart_items.includes(parseInt(genericPackSizeId)) ) 
                {
                    alert('Duplicate record!');
                    return false;
                }
                else 
                {
                    var markup = "<tr><td><input type='checkbox' name='record'></td>"

                                +"<td> <input  class='form-control' type='number'   name='genericPackSizeId[]' value='" +genericPackSizeId+ "' readonly multiple hidden >   <input  class='form-control' type='number'   name='genericBrandId[]' value='" +genericBrandId+ "' readonly multiple hidden >" +genericBrand+" ( "+genericStrength+" )"
                                    +"<br>"+genericPackSize+" "+packType
                                    +"<br>"+dosageForm+" | "+genericCompany
                                    +"<br>"+genericName+" </td>"

                                +"<td>  <input type='number' min='0' class='form-control' name='price[]' value='" +customerPrice+ "' multiple readonly></td>"
                                
                                +"<td>  <input type='number' min='0' class='form-control' name='discount[]' value='" +discount+ "' id='discount-"+genericPackSizeId+"' multiple readonly></td>"

                                +"<td>  <input type='number' min='1' class='form-control' name='moq[]' value='" +moq+ "'  multiple readonly></td>"

                                +"<td>  <input type='number' min='1' class='form-control' name='qty[]' value='"+moq+"' onChange='itemQtyChange("+genericPackSizeId+","+customerPrice+","+discount+")' id='qty-"+genericPackSizeId+"'  multiple></td>"
                                
                                +"<td>  <input type='number' min='0' class='form-control' name='subTotal[]' value='"+(customerPrice*moq)+"' id='subTotal-"+genericPackSizeId+"' multiple readonly hidden>    <input type='number' min='0' class='form-control' name='subTotalWtihDiscount[]' value='"+((customerPrice*moq)-(moq*discount))+"' id='subTotalWtihDiscount-"+genericPackSizeId+"' multiple readonly></td>"

                                

                                +"  </tr>";
                    $("#cart_item_table_tbody").append(markup);
                    console.log(markup);

                    add_cart_items.push(parseInt(genericPackSizeId));
                    alert('Item added');
                }
            }
            else 
            {
                alert('Please add required fields!');
                return false;
            }
        });


        
        // Find and remove selected table rows
        $("#delete_cart_item").click(function(){
            $("#cart_item_table_tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);

                    var genericPackSizeId = $("input[name='genericPackSizeId[]']").map(function(){return $(this).val();}).get();
                    var genericPackSizeId = genericPackSizeId[rowindex-1];
                    console.log(add_cart_items)

                    removeAllElements(add_cart_items, parseInt(genericPackSizeId));

                    $(this).parents("tr").remove();
                    console.log(add_cart_items)
                }
            });
        });

    });   

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

<script>
    function itemQtyChange(genericPackSizeId, price , discount) {
        // console.log('changed '+genericPackSizeId);
        var qty = $('#qty-'+genericPackSizeId).val();
        // console.log(qty)

        $('#subTotal-'+genericPackSizeId).val(price*qty);
        $('#subTotalWtihDiscount-'+genericPackSizeId).val(((price*qty)-(qty*discount)));
    }
</script>



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
            }  
  
      });
  
  });
  </script>
  
  
  {{-- delivery comment show/hide  --}}
  {{-- delivery comment show/hide  --}}

  

{{-- payment comment show/hide  --}}
{{-- payment comment show/hide  --}}

<script type="text/javascript">
    $(document).ready(function() {
  
      $('#paymentComment-root-container').hide();
      $('#paymentComment').prop('required',false);
  
      $('select').on('change', function(){
  
            var paymentMethodId = $('#paymentMethodId').val();
            var isCommentApplicable =  $('select#paymentMethodId').find(':selected').data('iscommentapplicable');
            var isCommentRequired =  $('select#paymentMethodId').find(':selected').data('iscommentrequired');

            console.log('paymentMethodId = '+paymentMethodId)
            console.log('isCommentApplicable = '+isCommentApplicable)

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
                  url: '/en/getDeliveryMethods/'+countryId,
                  type:"GET",
                  dataType:"json",
                  beforeSend: function(){
                      $('#loader').css("visibility", "visible");
                  },
  
                  success:function(data) {
  
                      $('select[name="deliveryMethodId"]').empty();
  
                      console.log(data);
                    // console.log(data.data);
                      
  
                      $('select[name="deliveryMethodId"]').append('<option value="">' + '--Select Delivery Method--' + '</option>');
                      $(data.deliverymethodsData).each(function(index, el) {
  
                            $('select[name="deliveryMethodId"]').append('<option data-iscommentapplicable="'+el.isCommentApplicable+'" data-iscommentrequired="'+el.isCommentRequired+'"    data-deliverymethodid="'+el.deliveryMethodId+'" data-deliverymethod="'+el.deliveryMethod+'"  data-deliverypriceinitial="'+el.deliveryPriceInitial+'"  data-deliverypriceincrement="'+el.deliveryPriceIncrement+'"   value="'+ el.deliveryMethodId +'">' + el.deliveryMethod + '</option>');
                              
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
  
{{-- Delivery Methods --}}
{{-- Delivery Methods --}}
  

{{-- Payment Methods --}}
{{-- Payment Methods --}}

<script type="text/javascript">
    $(document).ready(function() {
  
      $('select[name="paymentCountryId"]').on('change', function(){
  
  
          var paymentCountryId = $(this).val();
          if(paymentCountryId) {
              $.ajax({
                  url: '/en/getPaymentMethods/'+paymentCountryId,
                  type:"GET",
                  dataType:"json",
                  beforeSend: function(){
                      $('#loader').css("visibility", "visible");
                  },
  
                  success:function(data) {
  
                      $('select[name="paymentMethodId"]').empty();
  
                    //   console.log(data);
                    // console.log(data.data);
                      $('select[name="paymentMethodId"]').append('<option value="">' + '--Select Payment Method--' + '</option>');
                      $(data.paymentmethodsData).each(function(index, el) {
  
                            $('select[name="paymentMethodId"]').append('<option data-iscommentapplicable="'+el.isCommentApplicable+'" data-iscommentrequired="'+el.isCommentRequired+'"   data-paymentmethodid="'+el.paymentMethodId+'" data-paymentmethod="'+el.paymentMethod+'"  data-transactionfee="'+el.transactionFee+'"    value="'+ el.paymentMethodId +'">' + el.paymentMethod + '</option>');
                        });
  
                  },
                  complete: function(){
                      $('#loader').css("visibility", "hidden");
                  }
              });
          } else {
              $('select[name="paymentMethodId"]').empty();
  
          }
  
      });
  
  });
</script>
  
{{-- Payment Methods --}}
{{-- Payment Methods --}}


{{-- <script type="text/javascript">
    $(document).ready(function() {
        $("#photoPath").fileinput({
            theme : 'fa',
            overwriteInitial:false,
            // uploadUrl: "/site/image-upload",
            allowedFileExtensions: ["jpg","jpeg", "png", "gif", "webp"],
            // maxImageWidth: 2000,                                                                                                                                                                        
            maxFileCount: 1,
            // resizeImage: true
        });        
    });
</script> --}}



  
@endsection