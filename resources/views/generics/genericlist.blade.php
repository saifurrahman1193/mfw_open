@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Generics')
@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>




<script type="text/javascript">

    $(function(){


        $('#genericUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var genericId = button.data('genericid') ;
              var genericName = button.data('genericname') ;
              var genericNameCN = button.data('genericnamecn') ;
              var genericNameRU = button.data('genericnameru') ;
              var globalTradeNameCompany = button.data('globaltradenamecompany') ;
              var globalTradeNameCompanyCN = button.data('globaltradenamecompanycn') ;
              var globalTradeNameCompanyRU = button.data('globaltradenamecompanyru') ;
              var usesFor = button.data('usesfor') ;
              var usesForCN = button.data('usesforcn') ;
              var usesForRU = button.data('usesforru') ;
              var dosingDetails = button.data('dosingdetails') ;
              var dosingDetailsCN = button.data('dosingdetailscn') ;
              var dosingDetailsRU = button.data('dosingdetailsru') ;
              // var avgPriceOfOriginator = button.data('avgpriceoforiginator') ;

              var modal = $(this);

              modal.find('.modal-body #genericId').val(genericId);
              modal.find('.modal-body #genericName').val(genericName);
              modal.find('.modal-body #genericNameCN').val(genericNameCN);
              modal.find('.modal-body #genericNameRU').val(genericNameRU);
              modal.find('.modal-body #globalTradeNameCompany').val(globalTradeNameCompany);
              modal.find('.modal-body #globalTradeNameCompanyCN').val(globalTradeNameCompanyCN);
              modal.find('.modal-body #globalTradeNameCompanyRU').val(globalTradeNameCompanyRU);
              modal.find('.modal-body #usesFor').val(usesFor);
              modal.find('.modal-body #usesForCN').val(usesForCN);
              modal.find('.modal-body #usesForRU').val(usesForRU);
              modal.find('.modal-body #dosingDetails').val(dosingDetails);
              modal.find('.modal-body #dosingDetailsCN').val(dosingDetailsCN);
              modal.find('.modal-body #dosingDetailsRU').val(dosingDetailsRU);
              // modal.find('.modal-body #avgPriceOfOriginator').val(avgPriceOfOriginator);
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



{{-- generic table --}}
{{-- generic table --}}
  <div class="card">
    <div class="card-body">

        <h4 class="card-title" style="text-align: center;">Generics</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#genericSaveConfirmationModal" ><span>+ Create New Generic</span></a>
        

        <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">S/L</th>
                      <th scope="col">Action</th>
                      <th scope="col">Generic Name</th>
                      <th scope="col">Global Trade Name Company</th>
                      <th scope="col">Uses For</th>
                      <th scope="col">Dosing Details</th>
                      {{-- <th scope="col">Avg. Price Of Originator</th> --}}
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($genericsData->sortByDesc('genericId') as $generics)
                      <tr>
                          <td>{{$loop->index+1}}</td>
                          <td id="tdtableaction">

                            <div class="d-inline-block">
                                 <a role="button" href="#"   data-toggle="modal" data-target="#genericUpdateModal"  
                                     data-genericid='{{ $generics->genericId }}' 
                                     data-genericname='{{ $generics->genericName }}' 
                                     data-genericnamecn='{{ $generics->genericNameCN }}' 
                                     data-genericnameru='{{ $generics->genericNameRU }}' 
                                     data-globaltradenamecompany='{{ $generics->globalTradeNameCompany }}' 
                                     data-globaltradenamecompanycn='{{ $generics->globalTradeNameCompanyCN }}' 
                                     data-globaltradenamecompanyru='{{ $generics->globalTradeNameCompanyRU }}' 
                                     data-usesfor='{{ $generics->usesFor }}' 
                                     data-usesforcn='{{ $generics->usesForCN }}' 
                                     data-usesforru='{{ $generics->usesForRU }}' 
                                     data-dosingdetails='{!! $generics->dosingDetails !!}' 
                                     data-dosingdetailscn='{!! $generics->dosingDetailsCN !!}' 
                                     data-dosingdetailsru='{!! $generics->dosingDetailsRU !!}' 
                                     {{-- data-avgpriceoforiginator='{{ $generics->avgPriceOfOriginator }}'  --}}

                                  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                             </div>

                             @if ( !($generics->isGenericUsed>0) )

                                 <div class="d-inline-block tooltipster" title="Delete selected record?">
                                     <form  method="post" action="{{ route('generics.settings.generic.delete', $generics->genericId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                          <td>
                            {{$generics->genericName}} <br> <hr>  
                            {{ $generics->genericNameCN }} <br> <hr>
                            {{ $generics->genericNameRU }}

                          </td>
                          
                          <td>
                            {{$generics->globalTradeNameCompany}} <br> <hr>  
                            {{  $generics->globalTradeNameCompanyCN}} <br> <hr>  
                            {{  $generics->globalTradeNameCompanyRU}}
                          </td>

                          <td>
                            {{$generics->usesFor}} <br> <hr>  
                            {{$generics->usesForCN}} <br> <hr>  
                            {{$generics->usesForRU}}   <br> <hr>  
                          </td>

                          <td>
                            {!! $generics->dosingDetails !!}<br> <hr>  
                            {!! $generics->dosingDetailsCN !!} <br> <hr>  
                            {!! $generics->dosingDetailsRU !!}

                          </td>
                          {{-- <td>{{$generics->avgPriceOfOriginator}}</td> --}}
                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- generic table --}}
{{-- generic table --}}











<!-- Generic  Save Modal -->
<!-- Generic  Save Modal -->
<div class="modal fade" id="genericSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="genericSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="genericSaveConfirmationModal">Add A Generic</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('generics.settings.generic.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Generic Name</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericName" name="genericName" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic Name (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericNameCN" name="genericNameCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic Name (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericNameRU" name="genericNameRU" >
                                </div>
                              </div>
                            </div>


                            

                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Global Trade Name Company</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="globalTradeNameCompany" name="globalTradeNameCompany" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Global Trade Name Company (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="globalTradeNameCompanyCN" name="globalTradeNameCompanyCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Global Trade Name Company (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="globalTradeNameCompanyRU" name="globalTradeNameCompanyRU" >
                                </div>
                              </div>
                            </div>






                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Uses For</label>
                                <div class="col-sm-8">
                                  <textarea name="usesFor" id="usesFor"  rows="4" class="form-control" required></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Uses For (CN)</label>
                                <div class="col-sm-8">
                                  <textarea name="usesForCN" id="usesForCN"  rows="4" class="form-control"></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Uses For (RU)</label>
                                <div class="col-sm-8">
                                  <textarea name="usesForRU" id="usesForRU"  rows="4" class="form-control"></textarea>
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Dosing Details</label>
                                <div class="col-sm-8">
                                  <textarea class="form-control " rows="4" id="dosingDetails" name="dosingDetails" required></textarea>
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Dosing Details (CN)</label>
                                <div class="col-sm-8">
                                  <textarea class="form-control " rows="4" id="dosingDetailsCN" name="dosingDetailsCN" ></textarea>
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Dosing Details (RU)</label>
                                <div class="col-sm-8">
                                  <textarea class="form-control " rows="4" id="dosingDetailsRU" name="dosingDetailsRU" ></textarea>
                                </div>
                              </div>
                            </div>


                            {{-- <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Avg. Price Of Originator</label>
                                <div class="col-sm-8">
                                  <input type="number" step="0.1" class="form-control" id="avgPriceOfOriginator" name="avgPriceOfOriginator" required>
                                </div>
                              </div>
                            </div> --}}


                            <button data-toggle="modal"   type="submit"   class="btn btn-success mr-2 float-right" id="genericSaveSubmit">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>

                </form>
      </div>
    </div>
  </div>
</div>
<!-- Generic  Save Modal -->
<!-- Generic  Save Modal -->






<!-- Generic Edit Modal -->
<!-- Generic Edit Modal -->
<div class="modal fade" id="genericUpdateModal" tabindex="-1" role="dialog" aria-labelledby="genericUpdateModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="genericUpdateModal">Update Generic</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generics.settings.generic.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="genericId" id="genericId" value="">

                          <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Generic Name</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericName" name="genericName" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic Name (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericNameCN" name="genericNameCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic Name (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericNameRU" name="genericNameRU" >
                                </div>
                              </div>
                            </div>


                            

                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Global Trade Name Company</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="globalTradeNameCompany" name="globalTradeNameCompany" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Global Trade Name Company (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="globalTradeNameCompanyCN" name="globalTradeNameCompanyCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Global Trade Name Company (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="globalTradeNameCompanyRU" name="globalTradeNameCompanyRU" >

                                </div>
                              </div>
                            </div>






                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Uses For</label>
                                <div class="col-sm-8">
                                  <textarea name="usesFor" id="usesFor"  rows="4" class="form-control" required></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Uses For (CN)</label>
                                <div class="col-sm-8">
                                  <textarea name="usesForCN" id="usesForCN"  rows="4" class="form-control"></textarea>

                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Uses For (RU)</label>
                                <div class="col-sm-8">
                                  <textarea name="usesForRU" id="usesForRU"  rows="4" class="form-control"></textarea>

                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Dosing Details</label>
                                <div class="col-sm-8">
                                  <textarea class="form-control " rows="4" id="dosingDetails" name="dosingDetails" required></textarea>

                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Dosing Details (CN)</label>
                                <div class="col-sm-8">
                                  <textarea class="form-control " rows="4" id="dosingDetailsCN" name="dosingDetailsCN" ></textarea>

                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Dosing Details (RU)</label>
                                <div class="col-sm-8">
                                  <textarea class="form-control " rows="4" id="dosingDetailsRU" name="dosingDetailsRU" ></textarea>
                                </div>
                              </div>
                            </div>


                            {{-- <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Avg. Price Of Originator</label>
                                <div class="col-sm-8">
                                  <input type="number" step="0.1" class="form-control" id="avgPriceOfOriginator" name="avgPriceOfOriginator" required>
                                </div>
                              </div>
                            </div> --}}


                          <div class="form-group">
                              <div class="col-md-12 col-md-offset-4 mt-2">

                                  <button type="submit" class="btn btn-success float-right" id="genericUpdateSubmit">
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
<!-- Generic Edit Modal -->
<!-- Generic Edit Modal -->




@endsection