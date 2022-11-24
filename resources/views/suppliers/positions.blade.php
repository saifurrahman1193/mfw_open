@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Positions')
@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>




<script type="text/javascript">
    $(function(){
        $('#positionUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var positionId = button.data('positionid') ;
              var position = button.data('position') ;

              var modal = $(this);

              modal.find('.modal-body #positionId').val(positionId);
              modal.find('.modal-body #position').val(position);
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



    {{-- Position table --}}
    {{-- Position table --}}
      <div class="card" id="positiontable">
        <div class="card-body">

            {{-- top side of the table --}}

            <h4 class="card-title" style="text-align: center;">Position</h4>

            <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#positionSaveConfirmationModal" ><span>+ Create New Position</span></a>


        <table id="datatable1" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">Position</th>
                      <th scope="col">Action</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($positionsData as $position)
                      <tr>
                          <td>{{$position->position}}</td>
                          <td id="tdtableaction">

                             <div class="d-inline-block">
                                  <a role="button" href="#"   data-toggle="modal" data-target="#positionUpdateModal"  
                                      data-positionid='{{ $position->positionId }}' 
                                      data-position='{{ $position->position }}' 
                                   title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                              </div>

                              @if ( !($position->isPositionUsed>0) )

                                  <div class="d-inline-block tooltipster" title="Delete selected record?">
                                      <form  method="post" action="{{ route('supplier.settings.position.delete', $position->positionId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
    {{-- Position table --}}
    {{-- Position table --}}



    
    



</div>










<!-- Position Save Modal -->
<!-- Position Save Modal -->
<div class="modal fade" id="positionSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="positionSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="positionSaveConfirmationModal">Add A Position</h5>

      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              

              <form class="form-horizontal" method="POST"  action="{{ route('supplier.settings.position.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">position</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="position" name="position" required>
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
<!-- Position Save Modal -->
<!-- Position Save Modal -->





<!-- Position Edit Modal -->
<!-- Position Edit Modal -->
<div class="modal fade" id="positionUpdateModal" tabindex="-1" role="dialog" aria-labelledby="positionUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="positionUpdateModal">Update Position</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('supplier.settings.position.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="positionId" id="positionId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Position</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="position" name="position" required>
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
<!-- Position Edit Modal -->
<!-- Position Edit Modal -->







@endsection