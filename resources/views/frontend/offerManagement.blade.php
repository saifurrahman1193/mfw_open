@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Offer Management')
@section('page_content')


<script src="{{ asset('js/jquery.min.js') }}"></script>





<script type="text/javascript">

    $(function(){

        $('#offerUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var offerId = button.data('offerid') ;
              var offer = button.data('offer') ;
              var minAmount = button.data('minamount') ;

              var modal = $(this);

              modal.find('.modal-body #offerId').val(offerId);
              modal.find('.modal-body #offer').val(offer);
              modal.find('.modal-body #minAmount').val(minAmount);
        });



    });
</script>




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


        <h4 class="card-title" style="text-align: center;">Offer Management</h4>

        
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable2WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                    <th scope="col">Action</th>
                    <th scope="col">Offer</th>
                    <th scope="col">Minimum Amount</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($offerData as $offer)
                      <tr>
                          <td id="tdtableaction">
                            <div class="d-inline-block">
                                <a role="button" href="#"   data-toggle="modal" data-target="#offerUpdateModal"  
                                    data-offerid='{{ $offer->offerId }}' 
                                    data-offer='{{ $offer->offer }}' 
                                    data-minamount='{{ $offer->minAmount }}' 

                                      title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                            </div>
                          </td>
                          <td>{{$offer->offer}}</td>
                          <td>{{$offer->minAmount}}</td>
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Payment Method table --}}
{{-- Payment Method table --}}







<!-- offer Edit Modal -->
<!-- offer Edit Modal -->
<div class="modal fade" id="offerUpdateModal" tabindex="-1" role="dialog" aria-labelledby="offerUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="offerUpdateModal">Update Offer</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('offerUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="offerId" id="offerId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Offer</label>
                              <div class="col-sm-8">
                                <textarea name="offer" id="offer" class="form-control" required rows="5"></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Minimum Amount</label>
                              <div class="col-sm-8">
                                <input type="number" step="0.1" class="form-control" id="minAmount" name="minAmount" required>
                              </div>
                            </div>
                          </div>

                          

                          <div class="form-group">
                              <div class="col-md-12 col-md-offset-4 mt-2">

                                  <button type="submit" class="btn btn-success float-right">
                                      Update
                                  </button>
                                  
                                  <a {{-- href="{{ route('user.index') }}" --}}>
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
<!-- offer Edit Modal -->
<!-- offer Edit Modal -->








@endsection