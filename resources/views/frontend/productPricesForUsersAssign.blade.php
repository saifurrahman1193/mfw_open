
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Assign product prices')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 


<style type="text/css" media="screen">
  fieldset{
   border:1px solid #cccc;
   padding: 8px;
}
</style>

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}




{{-- Prescription table --}}
{{-- Prescription table --}}
<div class="content-wrapper" style="min-height: 0px;" id="prescriptiontable">
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Prescriptions & Inquiries</h4>

        
            <table>
           
              <tbody>
                <tr>
                  <td>
                    @if ( isset($usersData->photoPath) &&  $usersData->photoPath != null)
                      <ul class="list-group">
                        <li class="list-group-item list-group-item-action">
                          <img class="lozad img-thumbnail" data-src="{{ asset($usersData->photoPath ) }}" data-mfp-src="{{ asset($usersData->photoPath ) }}" alt="no image"  
                          style="max-height: 220px;max-width: 220px;"  />
                        </li>
                      </ul>
                    @endif
                  </td>
                  <td>
                    <li class="list-group-item list-group-item-action">
                    <a href="{{ route('customerProfileUpdate', $usersData->id ) }}" target="_blank" >{{ $usersData->name }}</a>
                    </li>
                    <li class="list-group-item list-group-item-action">
                      {{ $usersData->email }}
                    </li>

                    <li class="list-group-item list-group-item-action">
                      <a href="#"  class="btn btn-primary p-2" data-toggle="modal"  data-target="#sendingMailModal" data-userid="{{ $usersData->id }}" >Send Email
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                      </a>
                    </li>

                    @if ($usersData->isCreatedByAdmin)
                      <li class="list-group-item list-group-item-action">
                        {{$usersData->isCreatedByAdmin==1? 'Created by  Admin':''}}
                      </li>
                    @endif
                    @if ($usersData->isDeleted)
                      <li class="list-group-item list-group-item-action">
                          <strong style="color:red;">{{$usersData->isDeleted ? 'Deleted Account' : ''}}</strong>
                      </li>
                    @endif
                    <li class="list-group-item list-group-item-action">
                      {{ $usersData->country }}
                    </li>
                    <li class="list-group-item list-group-item-action">
                      {{ $usersData->phoneCode.$usersData->phone }}
                    </li>
                    <li class="list-group-item list-group-item-action">
                      {{ \Carbon\Carbon::parse($usersData->created_at)->format('d-M-Y') }}
                    </li>
                    <li class="list-group-item list-group-item-action">
                      <a class="btn btn-success p-2" href="/report/allcustomersdata?customerId={{$usersData->id}}" target="_blank">
                        <i class="fa fa-bar-chart"></i> 
                        Customer Data Report 
                      </a>
                    </li>
                  </td>
                </tr>
              </tbody>
            </table>
       


        {{-- <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#diseaseCategorySaveConfirmationModal" ><span>+ Create New Disease Category</span></a> --}}
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " style="width: 100%;">
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">#</th>
                      <th scope="col">Date-Time</th>
                      <th scope="col">Prescription</th>
                      <th scope="col">Generic Brand</th>
                      <th scope="col">Generic Name</th>
                      <th scope="col">Generic Strengths</th>
                      <th scope="col">Pack Size</th>
                      <th scope="col">Pack Types</th>
                      <th scope="col">Dosage Form</th>
                      <th scope="col">Generic Company</th>
                      <th scope="col">Originator</th>
                      <th scope="col" style="min-width: 300px;">Message</th>
                      <th scope="col">Is Prescription?</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($usergenericinquiryData->sortByDesc('created_at') as $usergenericinquiry)
                      <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>
                          {{   \Carbon\Carbon::parse($usergenericinquiry->created_at)->format('d-m-Y g:i A') }}
                        </td>
                        <td>
                            {{-- <img class="lozad" data-src="{{ asset($usergenericinquiry->prescriptionPath ) }}" data-mfp-src="{{ asset($usergenericinquiry->prescriptionPath ) }}" alt="no image"  
                              style="
                                      min-width: 50px !important;
                                      min-height: 50px !important;
                                      max-width: 100px !important;
                                      max-height: 100px !important;
                                      border-radius: 0% !important;
                              " 
                            /> --}}

                            @if (isset($usergenericinquiry->prescriptionPath) and $usergenericinquiry->prescriptionPath!=null)
                              <a href="{{ asset($usergenericinquiry->prescriptionPath ) }}" target="_blank">{{asset($usergenericinquiry->prescriptionPath )}}</a>
                            @endif

                        </td>
                        <td> 
                          @if ($usergenericinquiry->genericBrandId)
                            <a href="{{ route('productDetailsPageCaller', array(app()->getLocale(), $usergenericinquiry->genericBrandId)) }}" target="_blank">{{ $usergenericinquiry->genericBrand  }}</a>
                          @endif
                        </td>

                        <td>
                          {{ $usergenericinquiry->genericName  }}
                        </td>

                        <td> {{ $usergenericinquiry->genericStrength }}  </td>
                        <td> {{ $usergenericinquiry->genericPackSize}}  </td>
                        <td> {{ $usergenericinquiry->packType}}  </td>

                        <td>
                          {{ $usergenericinquiry->dosageForm  }}
                        </td>
                        
                        <td>
                          {{ $usergenericinquiry->genericCompany  }}
                        </td>
                        <td>
                          {{ $usergenericinquiry->globalTradeNameCompany  }}
                        </td>
                        

                        <td> {{ $usergenericinquiry->message }} </td>
                        <td> {{ $usergenericinquiry->isPrescription==1 ? 'Yes' : 'No'  }} </td>
                          
                      </tr>
                    @endforeach
              </tbody>
          </table>
          

    </div>
  </div>
</div>
{{-- Prescription table --}}
{{-- Prescription table --}}






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

          @endif
    <div class="card col-md-12">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center;">Assign product prices</h4>


    
      <div class="row">
          <div class="col-md-12 col-md-offset-2">
              <div class="panel panel-default">
                  {{-- <div class="panel-heading">Add New User</div> --}}

                  <div class="panel-body">
                      {{-- <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('customerPriceSetup', Request('userId')) }}"  onsubmit="return confirm('Do you really want to proceed?');"   > --}}
                      {{-- {{method_field('put')}} --}}
                            {{-- {{ csrf_field() }} --}}

                          <br>
                            <p class="card-description">
                            </p>
                              <div>

                                <div class="row">

                                  <div class="col-md-6">
                                      <div class="form-group row ">
                                        <label class="col-sm-4 col-form-label control-label">User Email</label>
                                        <div class="col-sm-8">
                                          <input type="email" class="form-control" id="email"  value="{{ $usersData->email }}" readonly>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="col-md-6">
                                      <div class="form-group row required">
                                        <label class="col-sm-4 col-form-label control-label">Generic Brand</label>
                                        <div class="col-sm-8">
                                          <select class="form-control m-bot15"  id="genericBrandId"  >
                                              @foreach($genericbrandData->sortBy('genericBrand') as $genericbrand)
                                              <option value="">--Select Generic Brand--</option>
                                                  <option value="{{ $genericbrand->genericBrandId }}" 
                                                      data-genericbrandid="{{ $genericbrand->genericBrandId }}"
                                                      data-genericbrand="{{ $genericbrand->genericBrand }}"
                                                    >
                                                    {{ $genericbrand->genericBrand}}
                                                  </option> 
                                              @endforeach   
                                          </select>
                                        </div>
                                      </div>
                                    </div>


                                </div>

                                <div class="row table-responsive" id="product-pack-sizes">

                                  <h4 class="card-title mt-2" >Pack Sizes</h4>
                                  <table id="product-pack-sizes-table" class="table table-striped table-bordered table-hover" width="100%">
                                          <thead >
                                              <tr class="bg-primary text-light">
                                                  <th class="text-center">Generic Brand</th>
                                                  <th class="text-center">Generic Name</th>
                                                  <th class="text-center">Generic Strength</th>
                                                  <th class="text-center">Generic Pack Size </th>
                                                  <th class="text-center">Pack Type</th>
                                                  <th class="text-center">Dosage Form</th>
                                                  <th class="text-center">Generic Company</th>
                                                  <th class="text-center">Global Trade  Name & Company</th>
                                                  <th class="text-center">Category</th>
                                                  <th class="text-center">Disease Category</th>
                                                  <th class="text-center">Availability</th>
                                                  <th class="text-center">Uses For</th>
                                                  <th class="text-center">Dosing Details</th>
                                                  <th class="text-center">MFW Selling price (Patitnet) (USD/ box)</th>
                                                  <th class="text-center">MOQ</th>
                                                  <th class="text-center">MFW Selling price (Dealer) (USD/ box)</th>
                                                  <th class="text-center">MOQ</th>
                                                  <th class="text-center">MFW Selling price (VIP) (USD/ box)</th>
                                                  <th class="text-center">Company's Patient selling  price (USD/Box) </th>
                                                  <th class="text-center">Company's Patient selling  price old (USD/Box) </th>
                                                  <th class="text-center">Company's MRP (Local)</th>

                                                  <th class="text-center">Indian/ Global Market Prices(USD)</th>
                                                  <th class="text-center">Avg. Price of Origantor (Global market) (USD/ pill)</th>

                                                  <th class="text-center">Supplier Buying Price</th>
                                              </tr>
                                          </thead>

                                          <tbody id="product-pack-sizes-table-tbody">
                                             

                                          </tbody>

                                      </table>
                                </div>

                               


                                  


                                  

                                  <fieldset  class=" mb-4 mt-5">
                                    <legend>Assign pack size & price</legend>

                                    <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('customerPriceSetupAdd', Request('userId')) }}"  onsubmit="return confirm('Do you really want to proceed?');"   >

                                      @csrf


                                        <div class="col-md-12">
                                          <div class="form-group row required">
                                            <label class="col-md-2 col-form-label control-label">Generic Pack Size</label>
                                            <div class="col-md-10">
                                              <select class="form-control m-bot15"  id="genericPackSizeId" name="genericPackSizeId"  required>
                                                 
                                              </select>
                                            </div>
                                          </div>
                                        </div>



                                        <div class="col-md-12">
                                          <div class="form-group row required">
                                            <label class="col-md-2 col-form-label control-label">Price</label>
                                            <div class="col-md-10">
                                              <input type="number" class="form-control" id="price" name="price" required>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="col-md-12">
                                          <div class="form-group row required">
                                            <label class="col-md-2 col-form-label control-label">Min Qty</label>
                                            <div class="col-md-10">
                                              <input type="number" class="form-control" id="moq"  name="moq" required>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group row required">
                                              <label class="col-md-2 col-form-label control-label">Discount</label>
                                              <div class="col-md-10">
                                                  <input type="number" name="discount" id="discount" value="" placeholder="Discount" step="0.1" min="0" class="form-control" required>
                                              </div>
                                            </div>
                                          </div>


                                        
                                      

                                          {{-- <input type="button" class="btn btn-primary add-row  mb-5 float-right" value="Add pack size & price" id="add_global_market_price"> --}}
                                          <input type="submit" class="btn btn-primary  mb-5 float-right" value="Add pack size & price"  >
                                      </form>

                                      <div class="row table-responsive" id="customer_generic_pack_sizes_price">
                                        <table id="customer_generic_pack_sizes_price_table" width="100%"  class="table table-striped table-bordered table-hover" >
                                            <thead>
                                                <tr class="bg-secondary text-dark">
                                                    {{-- <th>Select</th>                                             --}}
                                                    <th class="text-center">Generic Brand</th>
                                                    <th class="text-center">Generic Name</th>
                                                    <th class="text-center">Generic Strength</th>
                                                    <th class="text-center">Generic Pack Size </th>
                                                    <th class="text-center">Pack Type</th>
                                                    <th class="text-center">Dosage Form</th>
                                                    <th class="text-center">Generic Company</th>
                                                    <th class="text-center text-success" style="min-width: 120px;">Price</th>
                                                    <th class="text-center text-success" style="min-width: 120px;">MOQ</th>
                                                    <th class="text-center text-success" style="min-width: 120px;">Discount</th>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Disease Category</th>
                                                    <th class="text-center">Global Trade  Name & Company</th>


                                                    <th class="text-center">Availability</th>
                                                    <th class="text-center">Uses For</th>

                                                    
                                                    <th class="text-center">Dosing Details</th>
                                                    <th class="text-center">MFW Selling price (Patitnet) (USD/ box)</th>
                                                    <th class="text-center">MOQ</th>
                                                    <th class="text-center">MFW Selling price (Dealer) (USD/ box)</th>
                                                    <th class="text-center">MOQ</th>
                                                    <th class="text-center">MFW Selling price (VIP) (USD/ box)</th>
                                                    <th class="text-center">Company's Patient selling  price (USD/Box) </th>
                                                    <th class="text-center">Company's MRP (Local)</th>

                                                    <th class="text-center">Indian/ Global Market Prices(USD)</th>
                                                    <th class="text-center">Avg. Price of Origantor (Global market) (USD/ pill)</th>

                                                    <th class="text-center">Supplier-Buying Price-MOQ</th>

                                                    <th class="text-center">Update</th>
                                                    <th class="text-center">Delete</th>

                                                </tr>
                                            </thead>

                                            <tbody>

                                              {{-- existing records --}}
                                              @foreach ($genericpacksizes_with_customer_price_data as $genericpacksizes_with_customer_price)
                                                  <tr>
                                                    {{-- <td><input type='checkbox' name='record'></td> --}}
                                                      <td>{{ $genericpacksizes_with_customer_price->genericBrand }}</td>
                                                      <td>
                                                        <input  class='form-control' type='number'   name='genericPackSizeId[]' value='{{ $genericpacksizes_with_customer_price->genericPackSizeId }}' readonly multiple hidden >  {{ $genericpacksizes_with_customer_price->genericName }} 
                                                      </td>
                                                      <td>{{ $genericpacksizes_with_customer_price->genericStrength }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->genericPackSize }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->packType }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->dosageForm }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->genericCompany }}</td>
                                                      <td>
                                                        <input type='number' min='0' class='form-control' id="price-{{$genericpacksizes_with_customer_price->genericPackSizeId }}" name='price[]' value='{{ $genericpacksizes_with_customer_price->customerPrice }}' multiple>
                                                      </td>

                                                      <td>
                                                          <input type='number' min='0' class='form-control' id="moq-{{$genericpacksizes_with_customer_price->genericPackSizeId }}" name='moq[]' value='{{ $genericpacksizes_with_customer_price->moq }}' multiple>
                                                      </td>

                                                      <td>
                                                          <input type='number' min='0' class='form-control' id="discount-{{$genericpacksizes_with_customer_price->genericPackSizeId }}" name='discount[]' value='{{ $genericpacksizes_with_customer_price->discount }}' multiple>
                                                      </td>
                                                      <td>{{ $genericpacksizes_with_customer_price->category }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->diseaseCategory }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->globalTradeNameCompany }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->availabilityType }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->usesFor }}</td>
                                                      <td>{!! $genericpacksizes_with_customer_price->dosingDetails !!}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->ptSellingPrice }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->ptMOQ }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->dealerSellingPrice }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->dealerMOQ }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->vipSellingPrice }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->compPtSellingPrice }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->compLocalSellingPrice }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->globalMarketPrices }}</td>
                                                      <td>{{ $genericpacksizes_with_customer_price->avgPriceOfOriginator }}</td>


                                                      
                                                      




                                                     
                                                      
                                                      
                                                      
                                                      <td>
                                                        {{-- {{dd($genericpacksizes_with_customer_price->genericPackSizeId)}} --}}
                                                        {{-- {{dd($sppliergenericprices_data->where('genericPackSizeId', $genericpacksizes_with_customer_price->genericPackSizeId)->count())}} --}}
                                                        @if ($sppliergenericprices_data->where('genericPackSizeId', $genericpacksizes_with_customer_price->genericPackSizeId)->count()>0)
                                                          <table>
                                                            <thead>
                                                              <tr>
                                                                <th>Supplier</th>
                                                                <th>MOQ</th>
                                                                <th>Buying Price</th>
                                                                <th>Date</th>
                                                                <th>Note</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                              @foreach ($sppliergenericprices_data->where('genericPackSizeId', $genericpacksizes_with_customer_price->genericPackSizeId) as $item)
                                                                  <tr>
                                                                    <td><a href="{{ route('supplier.index', ['supplierId'=>$item->supplierId]) }}" target="_blank">{{$item->supplier}}</a></td>
                                                                    <td>{{$item->moq}}</td>
                                                                    <td>{{$item->buyingPrice}}</td>
                                                                    <td>{{$item->buyingDate}}</td>
                                                                    <td>{{$item->note}}</td>
                                                                  </tr>
                                                              @endforeach
                                                            </tbody>
                                                          </table>
                                                        @endif
                                                      </td>

                                                      <td>
                                                        <button class="btn btn-primary" onclick="customerPriceSetupUpdate({{$genericpacksizes_with_customer_price->genericPackSizeId}})" onsubmit="return confirm('Do you really want to proceed?');" >Update</button>
                                                      </td>

                                                      <td>
                                                        <button class="btn btn-danger" onclick="customerPriceSetupDelete({{$genericpacksizes_with_customer_price->genericPackSizeId}})" onsubmit="return confirm('Do you really want to proceed?');"  >Delete</button>
                                                      </td>
                                                    
                                                    
                                                  </tr>
                                              @endforeach


                                            </tbody>

                                        </table>
                                      </div>


                                    {{-- <button type="button" class="btn btn-danger delete-row mt-2" id="delete_global_market_price">Delete</button> --}}
                                    


                                  </fieldset>



                                  






                                  <div class="row offset-sm-5">
                                    {{-- <button   type="submit"   class="btn btn-success mr-2 ">Save</button> --}}

                                    <a href="{{ route('productPricesForUsers') }}"><button type="button" class="btn btn-danger  mr-1" >Cancel</button></a>
                                  </div>


                              </div>


                      {{-- </form> --}}
                  </div>
              </div>
          </div>
      </div>
      </div>
      </div>
      </div>

  {{-- </div> --}}
  {{-- end add new user  --}}










{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

   


     $('#genericBrandId').select2({

        placeholder: {
          id: '', // the value of the option
          text: '--Select Generic Brand--'
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






{{-- dynamic dependent based on generic to generic brand --}}
<script type="text/javascript">
  $(document).ready(function() {

    $('select[id="genericBrandId"]').on('change', function(){
        var genericBrandId = $(this).val();
        console.log('generic brand id = '+ genericBrandId);


            $.ajax({
                url: '/customers/getGenericPackSizes/'+genericBrandId,
                type:"GET",
                dataType:"json",
               

                success:function(genericpacksizesData) {
                  // console.log(response);
                  // console.log(response.data);
                  console.log(genericpacksizesData);
                  console.log(genericpacksizesData.genericpacksizesData);

                  // 1. clear table================================
                  $("#product-pack-sizes-table-tbody").empty();
                   // 2. empty dependent drop down=================
                    $('select[id="genericPackSizeId"]').empty();
                  // 3. add rows to table==========================
                  $.each(genericpacksizesData.genericpacksizesData, function(index, el) {

                    let tableData = '';
                    if (el.buyingPrices2) {
                      let dataArray=el.buyingPrices2.split('::');
                      let rowData = '';
                      dataArray.forEach(element => {
                        let rowDataArray=element.split(':');

                        let supplier=rowDataArray[0];
                        let buyingPrice=rowDataArray[1];
                        let moq=rowDataArray[2];
                        let buyingDate=rowDataArray[3];
                        let note=rowDataArray[4];
                        
                        rowData = rowData + '<tr>'+
                                                '<td>'+supplier+'</td>'+
                                                '<td>'+moq+'</td>'+
                                                '<td>'+buyingPrice+'</td>'+
                                                '<td>'+buyingDate+'</td>'+
                                                '<td>'+note+'</td>'+
                                          '</tr>';
                        
                      });

                      tableData = '<table><thead><tr><th>Supplier</th><th>MOQ</th><th>Buying Price</th><th>Date</th><th>Note</th><tr></thead><tbody>'+
                        rowData
                      +'</tbody></table>'
                    }

                    var markup = "<tr>"+

                                    "<td>"+el.genericBrand+"</td>"+
                                    "<td>"+el.genericName+"</td>"+
                                    "<td>"+el.genericStrength+"</td>"+
                                    "<td>"+el.genericPackSize+"</td>"+
                                    "<td>"+el.packType+"</td>"+
                                    "<td>"+el.dosageForm+"</td>"+
                                    "<td>"+el.genericCompany+"</td>"+
                                    "<td>"+el.globalTradeNameCompany+"</td>"+
                                    "<td>"+el.category+"</td>"+
                                    "<td>"+el.diseaseCategory+"</td>"+
                                    "<td>"+el.availabilityType+"</td>"+
                                    "<td>"+el.usesFor+"</td>"+
                                    "<td>"+el.dosingDetails+"</td>"+
                                    "<td>"+el.ptSellingPrice+"</td>"+
                                    "<td>"+el.ptMOQ+"</td>"+
                                    "<td>"+el.dealerSellingPrice+"</td>"+
                                    "<td>"+el.dealerMOQ+"</td>"+
                                    "<td>"+el.vipSellingPrice+"</td>"+
                                    "<td>"+el.compPtSellingPrice+"</td>"+
                                    "<td>"+el.compPtSellingPriceOld+"</td>"+
                                    "<td>"+el.compLocalSellingPrice+"</td>"+
                                    "<td>"+el.globalMarketPrices+"</td>"+
                                    "<td>"+el.avgPriceOfOriginator+"</td>"+
                                    "<td>"+tableData+"</td>"+
                                            
                                 "</tr>";

                    

                    $("#product-pack-sizes-table-tbody").append(markup);



                    // adding data to drop down select
                      $('select[id="genericPackSizeId"]').append('<option '+

                        // ' data-genericbrand="'+el.genericBrand+'" '+
                        // ' data-dosageform="'+el.dosageForm+'" '+
                        // ' data-genericstrength="'+el.genericStrength+'" '+
                        // ' data-genericpacksize="'+el.genericPackSize+'" '+
                        // ' data-packtype="'+el.packType+'" '+
                        // ' data-genericcompany="'+el.genericCompany+'" '+

                        ' data-genericpacksizeid="'+el.genericPackSizeId+'" '+
                        ' data-genericname="'+el.genericName+'" '+
                        ' data-category="'+el.category+'" '+
                        ' data-diseasecategory="'+el.diseaseCategory+'" '+
                        ' data-globaltradenamecompany="'+el.globalTradeNameCompany+'" '+
                        ' data-genericcompany="'+el.genericCompany+'" '+
                        ' data-genericbrandid="'+el.genericBrandId+'" '+

                        ' data-genericbrand="'+el.genericBrand+'" '+
                        
                        ' data-availabilitytype="'+el.availabilityType+'" '+
                        ' data-usesfor="'+el.usesFor+'" '+

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
                        ' data-buyingprices2="'+el.buyingPrices2+'" '+

                        // ' value="'+  el.genericPackSizeId +'">' + el.genericName+'-' +el.category+'-' +el.diseaseCategory+'-' +el.globalTradeNameCompany+'-' +el.genericCompany+'-' +el.genericBrand+'-' +el.dosageForm+'-' +el.genericStrength+'-' +el.genericPackSize+' '+el.packType+ 

                        ' value="' + el.genericPackSizeId +'">' +el.genericBrand+'-' +el.dosageForm+'-' +el.genericStrength+'-' +el.genericPackSize+' '+el.packType + '-' +el.genericCompany+'-' + el.genericName+'-' +el.category+'-' +el.diseaseCategory+'-' +el.globalTradeNameCompany+

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








{{-- generic price adding, deleting code --}}

<script type="text/javascript">

    var add_global_market_priceList = [];

    // already defined modules for that role is being enlisted in the array
    window.onload = function() {
      @foreach ($genericpacksizes_with_customer_price_data as $genericpacksizes_with_customer_price)
        add_global_market_priceList.push(parseInt({{ $genericpacksizes_with_customer_price->genericPackSizeId}}));
        // console.log(add_global_market_priceList)
      @endforeach
      // alert(add_global_market_priceList);
    };


    $(document).ready(function(){
        $("#add_global_market_price").click(function(){

            // getting generic pack sizes and price and values values

            var userId = {{ Request('userId') }};

            var price = $("#price").val();
            var moq = $("#moq").val();
            var discount = $("#discount").val();

            var genericPackSizeId = $('select#genericPackSizeId').find(':selected').val();
            var genericName = $('select#genericPackSizeId').find(':selected').data('genericname');

            var category = $('select#genericPackSizeId').find(':selected').data('category');
            var diseaseCategory = $('select#genericPackSizeId').find(':selected').data('diseasecategory');
            var globalTradeNameCompany = $('select#genericPackSizeId').find(':selected').data('globaltradenamecompany');
            var genericCompany = $('select#genericPackSizeId').find(':selected').data('genericcompany');
            var genericBrandId = $('select#genericPackSizeId').find(':selected').data('genericbrandid');
            var genericBrand = $('select#genericPackSizeId').find(':selected').data('genericbrand');

            var availabilityType = $('select#genericPackSizeId').find(':selected').data('availabilitytype');
            var usesFor = $('select#genericPackSizeId').find(':selected').data('usesfor');
            console.log('usesFor = '+usesFor)
            
            var dosageForm = $('select#genericPackSizeId').find(':selected').data('dosageform');
            var genericStrength = $('select#genericPackSizeId').find(':selected').data('genericstrength');
            var genericPackSize = $('select#genericPackSizeId').find(':selected').data('genericpacksize');
            var packType = $('select#genericPackSizeId').find(':selected').data('packtype');
            var dosingDetails = $('select#genericPackSizeId').find(':selected').data('dosingdetails');
            var ptSellingPrice = $('select#genericPackSizeId').find(':selected').data('ptsellingprice');
            var ptMOQ = $('select#genericPackSizeId').find(':selected').data('ptmoq');
            var dealerSellingPrice = $('select#genericPackSizeId').find(':selected').data('dealersellingprice');
            var dealerMOQ = $('select#genericPackSizeId').find(':selected').data('dealermoq');
            var vipSellingPrice = $('select#genericPackSizeId').find(':selected').data('vipsellingprice');
            var compPtSellingPrice = $('select#genericPackSizeId').find(':selected').data('compptsellingprice');
            var compLocalSellingPrice = $('select#genericPackSizeId').find(':selected').data('complocalsellingprice');
            var globalMarketPrices = $('select#genericPackSizeId').find(':selected').data('globalmarketprices');
            var avgPriceOfOriginator = $('select#genericPackSizeId').find(':selected').data('avgpriceoforiginator');
            var buyingPrices = $('select#genericPackSizeId').find(':selected').data('buyingprices');
            var buyingPrices2 = $('select#genericPackSizeId').find(':selected').data('buyingprices2');

            let tableData = '';
                    if (el.buyingPrices2) {
                      let dataArray=el.buyingPrices2.split('::');
                      let rowData = '';
                      dataArray.forEach(element => {
                        let rowDataArray=element.split(':');

                        let supplier=rowDataArray[0];
                        let buyingPrice=rowDataArray[1];
                        let moq=rowDataArray[2];
                        let buyingDate=rowDataArray[3];
                        let note=rowDataArray[4];
                        
                        rowData = rowData + '<tr>'+
                                                '<td>'+supplier+'</td>'+
                                                '<td>'+moq+'</td>'+
                                                '<td>'+buyingPrice+'</td>'+
                                                '<td>'+buyingDate+'</td>'+
                                                '<td>'+note+'</td>'+
                                          '</tr>';
                        
                      });

                      tableData = '<table><thead><tr><th>Supplier</th><th>MOQ</th><th>Buying Price</th><th>Date</th><th>Note</th><tr></thead><tbody>'+
                        rowData
                      +'</tbody></table>'
                    }



            if ( price>0 &&   genericPackSizeId>0) 
            {  
                  // console.log(add_global_market_priceList)


                  if (add_global_market_priceList.includes(parseInt(genericPackSizeId)) ) 
                  {
                    alert('Duplicate record!');
                    return false;
                  }
                  else 
                  {
                      var markup = "<tr><td><input type='checkbox' name='record'></td>"

                                    +"<td>  " +genericBrand+ " </td>"
                                    +"<td> <input  class='form-control' type='number'   name='genericPackSizeId[]' value='" +genericPackSizeId+ "' readonly multiple hidden >  " +genericName+ " </td>"
                                    +"<td>  " +genericStrength+ " </td>"
                                    +"<td>  " +genericPackSize+ " </td>"
                                    +"<td>  " +packType+ " </td>"
                                    +"<td>  " +dosageForm+ " </td>"
                                    +"<td>  " +genericCompany+ " </td>"
                                    +"<td>  <input type='number' min='0' class='form-control' name='price[]' value='" +price+ "' multiple></td>"
                                    +"<td>  <input type='number' min='0' class='form-control' name='moq[]' value='" +moq+ "' multiple></td>"
                                    +"<td>  <input type='number' min='0' class='form-control' name='discount[]' value='" +discount+ "' multiple></td>"
                                    +"<td>  " +category+ " </td>"
                                    +"<td>  " +diseaseCategory+ " </td>"
                                    +"<td>  " +globalTradeNameCompany+ " </td>"

                                    +"<td>  " +availabilityType+ " </td>"
                                    +"<td>  " +usesFor+ " </td>"

                                   
                                    +"<td>  " +dosingDetails+ " </td>"
                                    +"<td>  " +ptSellingPrice+ " </td>"
                                    +"<td>  " +ptMOQ+ " </td>"
                                    +"<td>  " +dealerSellingPrice+ " </td>"
                                    +"<td>  " +dealerMOQ+ " </td>"
                                    +"<td>  " +vipSellingPrice+ " </td>"
                                    +"<td>  " +compPtSellingPrice+ " </td>"
                                    +"<td>  " +compLocalSellingPrice+ " </td>"
                                    +"<td>  " +globalMarketPrices+ " </td>"
                                    +"<td>  " +avgPriceOfOriginator+ " </td>"
                                    +"<td>  " +tableData+ " </td>"


                                  +"  </tr>";
                      $("#customer_generic_pack_sizes_price_table tbody").append(markup);


                      add_global_market_priceList.push(parseInt(genericPackSizeId));
                      // console.log(add_global_market_priceList)



                      // after add generic price clearing fieldset=======
                      // $('select[name="genericId"]').reset();
                      $('#price').val('0');
                      $('#discount').val('0');
                       alert('Added');
                  }
              

            }
            else 
            {
                alert('Please add required fields!');
                return false;
            }

        });


        
        // Find and remove selected table rows
        $("#delete_global_market_price").click(function(){
            $("#customer_generic_pack_sizes_price_table tbody").find('input[name="record"]').each(function(){

              if($(this).is(":checked")){

                    var rowindex= parseInt($(this).parents("tr")[0].rowIndex);
                    console.log(rowindex);


                    var genericPackSizeId = $("input[name='genericPackSizeId[]']").map(function(){return $(this).val();}).get();
                    var genericPackSizeId = genericPackSizeId[rowindex-1];
                    removeAllElements(add_global_market_priceList, genericPackSizeId);

                    // removing the checked row
                    $(this).parents("tr").remove();
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



{{-- magnific popup for image --}}
<script type="text/javascript">
  $(document).ready(function() {
    $('.lozad').magnificPopup({type:'image'});
  });
</script>



<script>
  function customerPriceSetupUpdate(genericPackSizeId) {
      var price = $('#price-'+genericPackSizeId).val();
      var moq = $('#moq-'+genericPackSizeId).val();
      var discount = $('#discount-'+genericPackSizeId).val();

      console.log("{{url('/')}}"+"/customerPriceSetupUpdate/"+"{{$usersData->id}}"+"/"+genericPackSizeId+"/"+price+"/"+moq+"/"+discount);

      if (confirm('Do you really want to proceed?')) {
        window.location.href = "{{url('/')}}"+"/customers/customerPriceSetupUpdate/"+"{{$usersData->id}}"+"/"+genericPackSizeId+"/"+price+"/"+moq+"/"+discount;
      }

      
  }


  function customerPriceSetupDelete(genericPackSizeId) {
    if (confirm('Do you really want to proceed?')) {
      window.location.href = "{{url('/')}}"+"/customers/customerPriceSetupDelete/"+"{{$usersData->id}}"+"/"+genericPackSizeId;
    }
  }
</script>




<!-- sending mail Modal -->
<!-- sending mail Modal -->
<div class="modal fade" id="sendingMailModal" tabindex="-1" role="dialog" aria-labelledby="sendingMailModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title offset-5" >Sending Mail</h5>
        </div>
        <div class="modal-body" style="margin-top: -2vw;">
                <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('admin_to_customer_send_mail') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                    {{ csrf_field() }}

                    <input type="hidden"  name="userId" id="userId" value="">
                    

                    <div class="col-md-12">
                      <div class="form-group row ">
                        <label class="col-sm-4 col-form-label control-label">Email Body Title</label>
                        <div class="col-sm-8">
                            <select class="form-control m-bot15" name="emailBodyId" id="emailBodyId"  >
                                <option value="">--Select Email Body--</option>
                                @foreach(DB::table('emailbody')->get() as $emailbody)
                                    <option value="{{ $emailbody->emailBodyId }}"
                                            data-emailbodytitle="{{ $emailbody->emailBodyTitle }}"
                                            data-emailbody="{{ $emailbody->emailBody }}"
                                        >
                                      {{ title_case($emailbody->emailBodyTitle)}}
                                    </option> 
                                @endforeach   
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group row required">
                        <label class="col-sm-4 col-form-label control-label">Email Subject</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="emailSubject" name="emailSubject" required>
                        </div>
                      </div>
                    </div>


                    <div class="col-md-12">
                      <div class="form-group row required">
                        <label class="col-sm-4 col-form-label control-label">Email Body</label>
                        <div class="col-sm-8">
                          <textarea name="emailBody" id="emailBody"  rows="10" class="form-control" required></textarea>
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="col-md-12 col-md-offset-4 mt-2">
                        <button type="submit" class="btn btn-success float-right">
                            Send Mail
                        </button>
                        
                        <a>
                          <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal">
                              Cancel
                          </button>
                        </a>
                      </div>
                    </div>
  
              </form>
  
        </div>
      </div>
    </div>
  </div>
  <!-- sending mail Modal -->
  <!-- sending mail Modal -->


  
<script>
    $(document).ready(function(){
        $('select[name="emailBodyId"]').on('change', function(){

            var emailBodyId = $("#emailBodyId").val();
            var emailSubject =  $('select#emailBodyId').find(':selected').data('emailbodytitle');
            var emailBody =  $('select#emailBodyId').find(':selected').data('emailbody');
            // console.log(emailBody);
            $('#emailSubject').val(emailSubject);
            $('#emailBody').val(emailBody);
        });
    });  
</script>

<script type="text/javascript">
  $(function(){
      $('#sendingMailModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) ;

          var userId = button.data('userid') ;
          

          var modal = $(this);

          modal.find('.modal-body #userId').val(userId);
      });
  });
</script>


@endsection