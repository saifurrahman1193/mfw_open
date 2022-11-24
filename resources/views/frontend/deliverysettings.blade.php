@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Delivery Settings')
@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>

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


  




{{-- Delivery Method table --}}
{{-- Delivery Method table --}}
  
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Delivery Methods</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#deliveryMethodSaveConfirmationModal" ><span>+ Add New Delivery Method</span></a>
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable2WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">Delivery Method</th>
                      <th scope="col">Shipping Summary</th>
                      <th scope="col">is Comment Applicable ?</th>
                      
                      <th scope="col">Action</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($deliverymethodData as $deliverymethod)
                      <tr>
                          <td>{{$deliverymethod->deliveryMethod}} <br> <hr>
                              {{$deliverymethod->deliveryMethodCN}} <br> <hr>
                              {{$deliverymethod->deliveryMethodRU}}
                          </td>

                          <td>
                              
                              <ul class="list-group">
                                  @foreach ($deliverysummaryData->where('deliveryMethodId', $deliverymethod->deliveryMethodId) as $deliverysummary)
                                        <li class="list-group-item">{!! $deliverysummary->deliverySummary !!}</li>
                                  @endforeach
                              </ul>

                              <hr>

                              <ul class="list-group">
                                  @foreach ($deliverysummaryData->where('deliveryMethodId', $deliverymethod->deliveryMethodId) as $deliverysummary)
                                        <li class="list-group-item">{!! $deliverysummary->deliverySummaryCN !!}</li>
                                  @endforeach
                              </ul>

                              <hr>

                              <ul class="list-group">
                                  @foreach ($deliverysummaryData->where('deliveryMethodId', $deliverymethod->deliveryMethodId) as $deliverysummary)
                                        <li class="list-group-item">{!! $deliverysummary->deliverySummaryRU !!}</li>
                                  @endforeach
                              </ul>

                             
                          </td>

                          <td>
                            @if ($deliverymethod->isCommentApplicable==1)
                              Yes
                            @else
                              No
                            @endif
                          </td>


                          <td id="tdtableaction">

                             <div class="d-inline-block">
                                  <a role="button" href="{{ route('deliveryMethodEdit', $deliverymethod->deliveryMethodId) }}"  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                              </div>


                              <div class="d-inline-block tooltipster" title="Delete selected record?">
                                  <form  method="post" action="{{ route('deliveryMethodDelete', $deliverymethod->deliveryMethodId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Delivery Method table --}}
{{-- Delivery Method table --}}












{{-- Delivery Price table --}}
{{-- Delivery Price table --}}
<div class="content-wrapper">
  
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Delivery Prices</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#deliveryPriceSaveConfirmationModal" ><span>+ Add New Country</span></a>
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable3WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">Country</th>

                      <th scope="col">Delivery Prices</th>
                      
                      <th scope="col">Action</th>
                  </tr>
              </thead>


              <tbody>
                   @foreach ($deliverypriceData->groupBy('countryId') as $deliveryprice)
                      <tr>
                          <td>{{ $deliveryprice[0]->country }}</td>

                          <td>

                                <table class="table table-bordered table-hover table-striped ">
                                    <thead>
                                        <th>Delivery Method</th>
                                        <th>Delivery Price Initial (First 1 kg)</th>
                                        <th>Delivery Price Increment (>1 kg && Each Kg increment)</th>
                                    </thead>
                                    <tbody>
                                          @foreach ( $deliveryprice as $deliverypriceIndv)
                                              <tr>
                                                <td>{{ $deliverypriceIndv->deliveryMethod }}</td>
                                                <td>{{ $deliverypriceIndv->deliveryPriceInitial }}</td>
                                                <td>{{ $deliverypriceIndv->deliveryPriceIncrement }}</td>
                                              </tr>
                                          @endforeach
                                    </tbody>
                                </table>

                          </td>

                          

                          <td id="tdtableaction">

                             <div class="d-inline-block">
                                  <a role="button" href="{{ route('deliveryPriceEdit',  (int) $deliveryprice[0]->countryId) }}"  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                              </div>


                              <div class="d-inline-block tooltipster" title="Delete selected record?">
                                  <form  method="post" action="{{ route('deliveryPriceDelete',  (int) $deliveryprice[0]->countryId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Delivery Price table --}}
{{-- Delivery Price table --}}


















<!-- Delivery Methods  Save Modal -->
<!-- Delivery Methods  Save Modal -->
<div class="modal fade" id="deliveryMethodSaveConfirmationModal" style="overflow:hidden" role="dialog" aria-labelledby="deliveryMethodSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="deliveryMethodSaveConfirmationModal">Add A Delivery Method</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('deliveryMethodInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            

                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Delivery Method</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="deliveryMethod" name="deliveryMethod" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Delivery Method (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="deliveryMethodCN" name="deliveryMethodCN" >
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Delivery Method (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="deliveryMethodRU" name="deliveryMethodRU" >
                                </div>
                              </div>
                            </div>


                            <button data-toggle="modal"   type="submit"   class="btn btn-success mr-2 float-right">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>

                </form>
      </div>
    </div>
  </div>
</div>
<!-- Delivery Methods  Save Modal -->
<!-- Delivery Methods  Save Modal -->







<!-- Delivery price  Save Modal -->
<!-- Delivery price  Save Modal -->
<div class="modal fade" id="deliveryPriceSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deliveryPriceSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="deliveryPriceSaveConfirmationModal">Add A Country</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('deliveryPriceInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            

                            <div class="col-md-12">
                                <div class="form-group row required">
                                  <label class="col-md-4 col-form-label control-label">Country</label>
                                  <div class="col-md-8">
                                    <select class="form-control m-bot15" name="countryId" id="countryId" required >
                                        <option value="">--Select Country--</option>
                                        @foreach($countryData->sortBy('country') as $country)
                                            <option value="{{ $country->countryId }}">
                                              {{ title_case($country->country)}}
                                            </option> 
                                        @endforeach   
                                    </select>
                                  </div>
                                </div>
                              </div>


                            <button data-toggle="modal"   type="submit"   class="btn btn-success mr-2 float-right">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>

                </form>
      </div>
    </div>
  </div>
</div>
<!-- Delivery price  Save Modal -->
<!-- Delivery price  Save Modal -->


{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {
    // $.fn.modal.Constructor.prototype._enforceFocus = function() {};

     $('#countryId').select2({
      dropdownParent: $('#countryId').parent(),
      dropdownAutoWidth : true,
        placeholder: {
          id: '', // the value of the option
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




  });
</script>



@endsection