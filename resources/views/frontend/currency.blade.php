@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Currency')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 





@section('page_content')



<script type="text/javascript">

    $(function(){

        $('#currencyRatelUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var countryId = button.data('countryid') ;
              var country = button.data('country') ;
              var currency = button.data('currency') ;
              var hexcode = button.data('hexcode') ;
              var usdToCurrencyRate = button.data('usdtocurrencyrate') ;

              var modal = $(this);

              modal.find('.modal-body #countryId').val(countryId);
              modal.find('.modal-body #country').val(country);
              modal.find('.modal-body #currency').val(currency);
              modal.find('.modal-body #hexcode').val(hexcode);
              modal.find('.modal-body #usdToCurrencyRate').val(usdToCurrencyRate);
              
        });

    });
</script>









<div class="content-wrapper" style="min-height: 0px; ">
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


        <h4 class="card-title" style="text-align: center;">Currency Rates</h4>



    <table id="datatablewithscrollwithsort" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  <th scope="col">Action</th>
                  <th scope="col">Country</th>
                  <th scope="col">Currency</th>
                  <th scope="col">Currency Hexa Code</th>
                  <th scope="col">USD To Currency Rate</th>
                  <th scope="col">Updated at</th>
              </tr>
          </thead>
          

          <tbody>
               @foreach ($currencyData as $currency)
                  <tr>
                      <td id="tdtableaction">
                  
                        <div class="d-inline-block">
                            <a role="button" href="#"   data-toggle="modal" data-target="#currencyRatelUpdateModal"  

                            data-countryid='{{ $currency->countryId }}' 
                            data-country='{{ $currency->country }}' 
                            data-currency='{{ $currency->currency }}' 
                            data-hexcode='{{ $currency->hexcode }}' 
                            data-usdtocurrencyrate='{{ $currency->usdToCurrencyRate }}' 

                            ><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                        </div>

                        @if ($currency->isDeletable)
                          <div class="d-inline-block">
                            <form  method="post" action="{{ route('currencyDelete', $currency->countryId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
                                {{ csrf_field() }}
                                  <input type="hidden" name="_method" value="DELETE">
                                  <a>
                                    <button type="submit" value="DELETE" class="btn btn-link" >
                                      <i class="fa fa-trash tooltipster" style="font-size:25px; color:red" title="Delete Record?"></i>
                                    </button>
                                  </a>
                            </form>
                          </div>
                        @endif

                    </td>
                      <td>{{$currency->country}}</td>
                      <td>{{$currency->currency}}</td>
                      <td>{{$currency->hexcode}}</td>
                      <td>{{$currency->usdToCurrencyRate}}</td>
                      <td>{{YmdTodmYPm($currency->updated_at)}}</td>
                      
                      
                  </tr>
                @endforeach

             
             
          </tbody>
      </table>



    </div>
  </div>
</div>





<!-- currency rate Edit Modal -->
<!-- currency rate Edit Modal -->
<div class="modal fade" id="currencyRatelUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Update Currency Rate</h5>

      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              

              <form id="currency_update_form" class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('currencyUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                        <input type="hidden" name="countryId" id="countryId" value="">

                      



                    

                          <div class="col-md-12">
                              <div class="form-group row ">
                                <label  for="testimonial"  class="col-sm-4 col-form-label control-label">Country</label>
                                <div class="col-sm-8">
                                    <input type="text" id="country" name="country" value="" placeholder="Country" readonly class="form-control">
                                </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group row required">
                                <label  for="testimonialRU"  class="col-sm-4 col-form-label control-label">Currency</label>
                                <div class="col-sm-8">
                                    <input type="text" id="currency" name="currency" value="" placeholder="Currency"  class="form-control" required>
                                </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group row required">
                                <label  for="testimonialRU"  class="col-sm-4 col-form-label control-label">Currency Hexa Code</label>
                                <div class="col-sm-8">
                                    <input type="text" id="hexcode" name="hexcode" value="" placeholder="Hexa Code for currency sign"  class="form-control" required>
                                </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group row required">
                                <label  for="testimonialCN"  class="col-sm-4 col-form-label control-label">USD To Currency Rate</label>
                                <div class="col-sm-8">
                                    <input type="number" step="0.0001" id="usdToCurrencyRate" name="usdToCurrencyRate" value="" placeholder="USD To Currency Rate"  class="form-control" required>
                                </div>
                              </div>
                          </div>



                      



                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4 mt-2">
                                <button type="submit" class="btn btn-success float-right">
                                    Update
                                </button>
                                <a >
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
<!-- currency rate Edit Modal -->
<!-- currency rate Edit Modal -->


{{-- "order": [[ 3, "desc" ]] --}}


<script>

  $(document).ready(function() {

      // with sxrol-x
      $('#datatablewithscrollwithsort').DataTable( {
          "pagingType": "simple_numbers",
          language: {
              search: "_INPUT_",
              searchPlaceholder: "Search..."
          },
          "order": [[ 1, "desc" ]],
          "scrollX": true,
          // "ordering": false,
          "responsive": true,
          "autoWidth": false

      } );


      
  } );


</script>


@endsection