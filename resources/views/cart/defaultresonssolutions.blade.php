@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Default Reasons & Solutions')
@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>




<script type="text/javascript">

    $(function(){

        $('#defaultReasonUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var defaultReasonId = button.data('defaultreasonid') ;
              var defaultReason = button.data('defaultreason') ;
              var defaultReasonCN = button.data('defaultreasoncn') ;
              var defaultReasonRU = button.data('defaultreasonru') ;

              var modal = $(this);

              modal.find('.modal-body #defaultReasonId').val(defaultReasonId);
              modal.find('.modal-body #defaultReason').val(defaultReason);
              modal.find('.modal-body #defaultReasonCN').val(defaultReasonCN);
              modal.find('.modal-body #defaultReasonRU').val(defaultReasonRU);
        });


        $('#defaultSolutionUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var defaultSolutionId = button.data('defaultsolutionid') ;
              var defaultSolution = button.data('defaultsolution') ;
              var defaultSolutionCN = button.data('defaultsolutioncn') ;
              var defaultSolutionRU = button.data('defaultsolutionru') ;

              var modal = $(this);

              modal.find('.modal-body #defaultSolutionId').val(defaultSolutionId);
              modal.find('.modal-body #defaultSolution').val(defaultSolution);
              modal.find('.modal-body #defaultSolutionCN').val(defaultSolutionCN);
              modal.find('.modal-body #defaultSolutionRU').val(defaultSolutionRU);
        });

        $('#paymentreceiptdefaultmessagesUpdateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;

            var defaultReasonId = button.data('defaultreasonid') ;
            var defaultReason = button.data('defaultreason') ;
            var defaultReasonCN = button.data('defaultreasoncn') ;
            var defaultReasonRU = button.data('defaultreasonru') ;

            var modal = $(this);

            modal.find('.modal-body #defaultReasonId').val(defaultReasonId);
            modal.find('.modal-body #defaultReason').val(defaultReason);
            modal.find('.modal-body #defaultReasonCN').val(defaultReasonCN);
            modal.find('.modal-body #defaultReasonRU').val(defaultReasonRU);
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



{{-- default reason table --}}
{{-- default reason table --}}
  <div class="card" id="defaultreasons">
    <div class="card-body">

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Default Reasons</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#defaultReasonSaveModal" ><span>+ Create New Default Reason</span></a>


    <table id="datatable1" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  <th scope="col">S/L</th>
                  <th scope="col">Default Reason</th>
                  
                  <th scope="col">Action</th>
              </tr>
          </thead>
          
          <tbody>
               @foreach ($defaultreasonsData as $defaultreason)
                  <tr>
                      <td>{{$loop->index+1}}</td>
                      <td>{!! $defaultreason->defaultReason.' <br><hr>'.$defaultreason->defaultReasonCN.' <br><hr>'.$defaultreason->defaultReasonRU !!}</td>
                      
                      <td id="tdtableaction">

                         <div class="d-inline-block">
                              <a role="button" href="#"   data-toggle="modal" data-target="#defaultReasonUpdateModal"  
                                  data-defaultreasonid='{{ $defaultreason->defaultReasonId }}' 
                                  data-defaultreason='{{ $defaultreason->defaultReason }}' 
                                  data-defaultreasoncn='{{ $defaultreason->defaultReasonCN }}' 
                                  data-defaultreasonru='{{ $defaultreason->defaultReasonRU }}' 
                               title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                          </div>

                            <div class="d-inline-block tooltipster" title="Delete selected record?">
                                <form  method="post" action="{{ route('cart.default.reason.delete', $defaultreason->defaultReasonId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
{{-- default reason table --}}
{{-- default reason table --}}

</div>

{{-- default solution table --}}
{{-- default solution table --}}
<div class="content-wrapper" style="min-height: 0px;" id="solutiontable">
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Default Solution</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#defaultSolutionSaveModal" ><span>+ Create New Default Solution</span></a>
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable2" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">S/L</th>
                      <th scope="col">Default Solution</th>
                      <th scope="col">Action</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($defaultsolutionsData as $defaultsolution)
                      <tr>
                          <td>{{$loop->index+1}}</td>
                          <td>{!! $defaultsolution->defaultSolution.' <br><hr>'.$defaultsolution->defaultSolutionCN.' <br><hr>'.$defaultsolution->defaultSolutionRU !!}</td>
                          <td id="tdtableaction">

                             <div class="d-inline-block">
                                  <a role="button" href="#"   data-toggle="modal" data-target="#defaultSolutionUpdateModal"  

                                      data-defaultSolutionid='{{ $defaultsolution->defaultSolutionId }}' 
                                      data-defaultSolution='{{ $defaultsolution->defaultSolution }}' 
                                      data-defaultSolutioncn='{{ $defaultsolution->defaultSolutionCN }}' 
                                      data-defaultSolutionru='{{ $defaultsolution->defaultSolutionRU }}' 

                                   title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                              </div>


                                  <div class="d-inline-block tooltipster" title="Delete selected record?">
                                      <form  method="post" action="{{ route('cart.default.solution.delete', $defaultsolution->defaultSolutionId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
{{-- default solution table --}}
{{-- default solution table --}}

{{-- payment receipt default messages table --}}
{{-- payment receipt default messages table --}}
<div class="content-wrapper" style="min-height: 0px;" id="solutiontable">
  <div class="card" id="defaultreasons">
  <div class="card-body">

      {{-- top side of the table --}}

      <h4 class="card-title" style="text-align: center;">Cart Payment Receipt Unconfirmed Default Messages</h4>

      <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#paymentreceiptdefaultmessagesSaveModal" ><span>+ Create New Payment Receipt Unconfirmed Default Message</span></a>


  <table id="datatable3" class="table table-striped table-bordered table-hover " >
        <thead>
            <tr class="bg-primary text-light">
                <th scope="col">S/L</th>
                <th scope="col">Default Reason</th>
                
                <th scope="col">Action</th>
            </tr>
        </thead>
        
        <tbody>
             @foreach ($paymentreceiptdefaultmessagesData as $defaultreason)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{!! $defaultreason->defaultReason.'<br><hr>'.$defaultreason->defaultReasonCN.' <br><hr>'.$defaultreason->defaultReasonRU.' <br>' !!}</td>
                    
                    <td id="tdtableaction">

                       <div class="d-inline-block">
                            <a role="button" href="#"   data-toggle="modal" data-target="#paymentreceiptdefaultmessagesUpdateModal"  
                                data-defaultreasonid='{{ $defaultreason->defaultReasonId }}' 
                                data-defaultreason='{{ $defaultreason->defaultReason }}' 
                                data-defaultreasoncn='{{ $defaultreason->defaultReasonCN }}' 
                                data-defaultreasonru='{{ $defaultreason->defaultReasonRU }}' 
                             title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                        </div>

                          <div class="d-inline-block tooltipster" title="Delete selected record?">
                              <form  method="post" action="{{ route('paymentreceiptdefaultmessagesDelete', $defaultreason->defaultReasonId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
{{-- payment receipt default messages table --}}
{{-- payment receipt default messages table --}}

</div>














<!-- Default Reason  Save Modal -->
<!-- Default Reason  Save Modal -->
<div class="modal fade" id="defaultReasonSaveModal" tabindex="-1" role="dialog" aria-labelledby="defaultReasonSaveModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="defaultReasonSaveModal">Add A Default Reason</h5>

      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              

              <form class="form-horizontal" method="POST"  action="{{ route('cart.default.reason.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Default Reason (HTML)</label>
                                <div class="col-sm-8">
                                  <textarea id="defaultReason" name="defaultReason"  rows="5" class="form-control" required></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Default Reason (CN) (HTML)</label>
                                <div class="col-sm-8">
                                  <textarea id="defaultReasonCN" name="defaultReasonCN"  rows="5" class="form-control" ></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Default Reason (RU) (HTML)</label>
                                <div class="col-sm-8">
                                  <textarea id="defaultReasonRU" name="defaultReasonRU"  rows="5" class="form-control" ></textarea>
                                </div>
                              </div>
                            </div>


                            <button data-toggle="modal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>

                </form>
      </div>
    </div>
  </div>
</div>
<!-- Default Reason  Save Modal -->
<!-- Default Reason  Save Modal -->




<!-- Default Reason Edit Modal -->
<!-- Default Reason Edit Modal -->
<div class="modal fade" id="defaultReasonUpdateModal" tabindex="-1" role="dialog" aria-labelledby="defaultReasonUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="defaultReasonUpdateModal">Update Default Reason</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('cart.default.reason.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="defaultReasonId" id="defaultReasonId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Default Reason (HTML)</label>
                              <div class="col-sm-8">
                                  <textarea id="defaultReason" name="defaultReason"  rows="5" class="form-control" required></textarea>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Default Reason (CN) (HTML)</label>
                              <div class="col-sm-8">
                                  <textarea id="defaultReasonCN" name="defaultReasonCN"  rows="5" class="form-control" ></textarea>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Default Reason (RU) (HTML)</label>
                              <div class="col-sm-8">
                                  <textarea id="defaultReasonRU" name="defaultReasonRU"  rows="5" class="form-control" ></textarea>
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
<!-- Default Reason Edit Modal -->
<!-- Default Reason Edit Modal -->









<!-- default solution  Save Modal -->
<!-- default solution  Save Modal -->
<div class="modal fade" id="defaultSolutionSaveModal" tabindex="-1" role="dialog" aria-labelledby="defaultSolutionSaveModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="defaultSolutionSaveModal">Add A Default Solution</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('cart.default.solution.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label"> Default Solution (HTML)</label>
                                <div class="col-sm-8">
                                  <textarea id="defaultSolution" name="defaultSolution"  rows="5" class="form-control" required></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Default Solution (CN) (HTML)</label>
                                <div class="col-sm-8">
                                  <textarea id="defaultSolutionCN" name="defaultSolutionCN"  rows="5" class="form-control" ></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Default Solution (RU) (HTML)</label>
                                <div class="col-sm-8">
                                  <textarea id="defaultSolutionRU" name="defaultSolutionRU"  rows="5" class="form-control" ></textarea>
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
<!-- default solution  Save Modal -->
<!-- default solution  Save Modal -->




<!-- default solution Edit Modal -->
<!-- default solution Edit Modal -->
<div class="modal fade" id="defaultSolutionUpdateModal" tabindex="-1" role="dialog" aria-labelledby="defaultSolutionUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="defaultSolutionUpdateModal">Update Default Solution</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('cart.default.solution.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="defaultSolutionId" id="defaultSolutionId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Default Solution (HTML)</label>
                              <div class="col-sm-8">
                                  <textarea id="defaultSolution" name="defaultSolution"  rows="5" class="form-control" required></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Default Solution (CN) (HTML)</label>
                              <div class="col-sm-8">
                                  <textarea id="defaultSolutionCN" name="defaultSolutionCN"  rows="5" class="form-control" ></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Default solution (RU) (HTML)</label>
                              <div class="col-sm-8">
                                  <textarea id="defaultSolutionRU" name="defaultSolutionRU"  rows="5" class="form-control" ></textarea>
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
<!-- default solution Edit Modal -->
<!-- default solution Edit Modal -->









<!-- payment receipt unconfirmed Default default  Save Modal -->
<!-- payment receipt unconfirmed Default default  Save Modal -->
<div class="modal fade" id="paymentreceiptdefaultmessagesSaveModal" tabindex="-1" role="dialog" aria-labelledby="paymentreceiptdefaultmessagesSaveModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="paymentreceiptdefaultmessagesSaveModal">Add A Default Message</h5>

      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              

              <form class="form-horizontal" method="POST"  action="{{ route('paymentreceiptdefaultmessagesInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Default Message (HTML)</label>
                                <div class="col-sm-8">
                                  <input style="height: 120px;" type="text" class="form-control" id="defaultReason" name="defaultReason" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Default Message (CN) (HTML)</label>
                                <div class="col-sm-8">
                                  <input style="height: 120px;" type="text" class="form-control" id="defaultReasonCN" name="defaultReasonCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Default Message (RU) (HTML)</label>
                                <div class="col-sm-8">
                                  <input style="height: 120px;" type="text" class="form-control" id="defaultReasonRU" name="defaultReasonRU" >
                                </div>
                              </div>
                            </div>


                            <button data-toggle="modal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>

                </form>
      </div>
    </div>
  </div>
</div>
<!-- payment receipt unconfirmed Default default  Save Modal -->
<!-- payment receipt unconfirmed Default default  Save Modal -->




<!-- payment unconfirmed Default message Edit Modal -->
<!-- payment unconfirmed Default message Edit Modal -->
<div class="modal fade" id="paymentreceiptdefaultmessagesUpdateModal" tabindex="-1" role="dialog" aria-labelledby="paymentreceiptdefaultmessagesUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="paymentreceiptdefaultmessagesUpdateModal">Update Default Reason</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('paymentreceiptdefaultmessagesUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="defaultReasonId" id="defaultReasonId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Default Reason (HTML)</label>
                              <div class="col-sm-8">
                                  <textarea id="defaultReason" name="defaultReason"  rows="5" class="form-control" required></textarea>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Default Reason (CN) (HTML)</label>
                              <div class="col-sm-8">
                                  <textarea id="defaultReasonCN" name="defaultReasonCN"  rows="5" class="form-control" ></textarea>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Default Reason (RU) (HTML)</label>
                              <div class="col-sm-8">
                                  <textarea id="defaultReasonRU" name="defaultReasonRU"  rows="5" class="form-control" ></textarea>
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
<!-- payment unconfirmed Default message Edit Modal -->
<!-- payment unconfirmed Default message Edit Modal -->


@endsection