@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Payment Settings')
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


  





{{-- Payment Method table --}}
{{-- Payment Method table --}}
  
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Payment Methods</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#paymentMethodSaveConfirmationModal" ><span>+ Add New Payment Method</span></a>
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable2WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">Payment Method</th>
                     
                      <th scope="col">Payment Instruction</th>
                      <th scope="col">is Comment Applicable?</th>
                      
                      <th scope="col">Action</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($paymentmethodData as $paymentmethod)
                      <tr>
                          <td>{{$paymentmethod->paymentMethod}} <br> <hr>
                              {{$paymentmethod->paymentMethodCN}} <br> <hr>
                              {{$paymentmethod->paymentMethodRU}}
                          </td>

                          

                          <td>
                              
                              <ul class="list-group">
                                  @foreach ($paymentsummaryData->where('paymentMethodId', $paymentmethod->paymentMethodId) as $paymentsummary)
                                        <li class="list-group-item">{!! $paymentsummary->paymentSummary !!}</li>
                                  @endforeach
                              </ul>

                              <hr>

                              <ul class="list-group">
                                  @foreach ($paymentsummaryData->where('paymentMethodId', $paymentmethod->paymentMethodId) as $paymentsummary)
                                        <li class="list-group-item">{!! $paymentsummary->paymentSummaryCN !!}</li>
                                  @endforeach
                              </ul>

                              <hr>

                              <ul class="list-group">
                                  @foreach ($paymentsummaryData->where('paymentMethodId', $paymentmethod->paymentMethodId) as $paymentsummary)
                                        <li class="list-group-item">{!! $paymentsummary->paymentSummaryRU !!}</li>
                                  @endforeach
                              </ul>

                             
                          </td>

                          <td>
                            @if ($paymentmethod->isCommentApplicable==1)
                              Yes
                            @else
                              No
                            @endif
                          </td>



                          <td id="tdtableaction">

                             <div class="d-inline-block">
                                  <a role="button" href="{{ route('paymentMethodEdit', $paymentmethod->paymentMethodId) }}"  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                              </div>


                              @if ($paymentmethod->isDeleteable>0 || !(isset($paymentmethod->isDeleteable)) )


                                  <div class="d-inline-block tooltipster" title="Delete selected record?">
                                      <form  method="post" action="{{ route('paymentMethodDelete', $paymentmethod->paymentMethodId) }}" onsubmit="return confirm('Do you really want to proceed?');">
                                          {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a>
                                              <button type="submit" value="DELETE" class="btn btn-link" >
                                                <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                              </button>
                                            </a>
                                      </form>
                                  </div>

                              @endif

                          </td>
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Payment Method table --}}
{{-- Payment Method table --}}












{{-- Payment Price table --}}
{{-- Payment Price table --}}
<div class="content-wrapper">
  
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Assign Payment Methods</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#paymentPriceSaveConfirmationModal" ><span>+ Add New Country</span></a>
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable3WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">Country</th>

                      <th scope="col">Payment Methods</th>
                      
                      <th scope="col">Action</th>
                  </tr>
              </thead>


              <tbody>
                   @foreach ($paymentpriceData->groupBy('countryId') as $paymentprice)
                      <tr>
                          <td>{{ $paymentprice[0]->country }}</td>

                          <td>

                                <table class="table table-bordered table-hover table-striped ">
                                    <thead>
                                        <th>Payment Method</th>
                                        <th>Transaction Fee (%)</th>
                                    </thead>
                                    <tbody>
                                          @foreach ( $paymentprice as $paymentpriceIndv)
                                              <tr>
                                                  <td>{{ $paymentpriceIndv->paymentMethod  }}</td>
                                                  <td>{{ $paymentpriceIndv->transactionFee  }}</td>
                                              </tr>
                                          @endforeach
                                    </tbody>
                                </table>
                              
                              

                          </td>

                          <td id="tdtableaction">

                              <div class="d-inline-block">
                                  <a role="button" href="{{ route('paymentPriceEdit',  (int) $paymentprice[0]->countryId) }}"  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                              </div>


                              <div class="d-inline-block tooltipster" title="Delete selected record?">
                                  <form  method="post" action="{{ route('paymentPriceDelete',  (int) $paymentprice[0]->countryId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
{{-- Payment Price table --}}
{{-- Payment Price table --}}












<!-- Payment Methods  Save Modal -->
<!-- Payment Methods  Save Modal -->
<div class="modal fade" id="paymentMethodSaveConfirmationModal" style="overflow:hidden" role="dialog" aria-labelledby="paymentMethodSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="paymentMethodSaveConfirmationModal">Add A Payment Method</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('paymentMethodInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            

                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Payment Method</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="paymentMethod" name="paymentMethod" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Payment Method (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="paymentMethodCN" name="paymentMethodCN" >
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Payment Method (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="paymentMethodRU" name="paymentMethodRU" >
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
<!-- Payment Methods  Save Modal -->
<!-- Payment Methods  Save Modal -->







<!-- Payment price  Save Modal -->
<!-- Payment price  Save Modal -->
<div class="modal fade" id="paymentPriceSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="paymentPriceSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="paymentPriceSaveConfirmationModal">Add A Country</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('paymentPriceInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
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
                                        @foreach($countryData as $country)
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
<!-- Payment price  Save Modal -->
<!-- Payment price  Save Modal -->


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