
@extends('layouts.app')

@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Roles')


@section('page_content')
<script src="{{ asset('js/jquery.min.js') }}"></script>

  <style type="text/css" media="screen">
        .content-wrapper{
              padding: 0 40px;
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


        {{-- top side of the table --}}

            <h4 class="card-title" style="text-align: center;">Roles</h4>

            <a href="{{ route('roles.role.addrollandmodule') }}"  class="btn btn-default " style="margin-bottom: 10px; "  ><span>+ Create New Role</span></a>



              {{-- data table start --}}
              {{-- data table start --}}
              <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
                    <thead>
                        <tr class="bg-primary text-light">
                            <th scope="col">#</th>
                            <th scope="col">Action</th>
                            <th scope="col">Role</th>
                            <th scope="col">Role Description</th>
                            <th scope="col">Modules</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach (DB::table('role_modules_view')->get() as $roles)

                          <tr>
                              <td>{{$loop->index+1}}</td>
                              <td id="tdtableaction">

                                <div class="d-inline-block tooltipster" title="Edit The Role ?">
                                    <a href=" {{ route('role.edit', $roles->roleId) }}"><i class="fa fa-edit"></i></a>

                                </div>
                                <div class="d-inline-block  tooltipster" title="Delete The Role ?">
                                    <form  method="post" action="{{ route('role.destroy', $roles->roleId) }}"   onsubmit="return confirm('Do you really want to proceed?');">
                                        {{ csrf_field() }}

                                          <input type="hidden" name="_method" value="DELETE">

                                        

                                          <a  data-target="#deleteConfirmModal" >
                                            <button type="submit" value="DELETE" id="deleteBtn" class="btn btn-link" >
                                              <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                            </button>
                                          </a>
                                    </form>
                                  </div>

                              </td>
                              
                              <td>{{$roles->role}}</td>
                              <td>{{$roles->description}}</td>
                              <td>{{$roles->modules}}</td>
                              
                          </tr>

                      @endforeach


                       
                    </tbody>
              </table>
              {{-- data table end --}}
              {{-- data table end --}}



        </div>





    </div>

</div>


{{-- https://www.youtube.com/watch?v=w3EYwxlcSbE&index=5&list=PLB4AdipoHpxYmPdyI3e-yH58-3CS4qoAf --}}


<!-- Save Modal -->
<!-- Save Modal -->
<div class="modal fade" id="saveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Add A Role</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              



              {{-- top side of the table --}}
              {{-- <h4 class="card-title offset-4" style="text-align: center;">Add A Role </h4> --}}

              <form class="form-horizontal" method="POST"  action="{{ route('role.store') }}"    >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Role Name</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="role" name="role" required>
                                </div>
                              </div>
                            </div>

                        


                            <div class="col-md-12">
                                <div class="form-group row required">
                                  <label class="col-sm-4 col-form-label control-label">Role Description</label>
                                  <div class="col-sm-8">
                                    <input type="text" class="form-control" id="description" name="description" required>
                                  </div>
                                </div>
                            </div>

                              <button data-toggle="modal" data-target="#saveConfirmationModal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>


                              <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>


                </form>

               
      


      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save</button>
      </div> --}}
    </div>
  </div>
</div>
<!-- Save Modal -->
<!-- Save Modal -->




<!-- Delete Confirm Modal -->
<!-- Delete Confirm Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteLabel">Delete !</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure ?</p>
                <p>
                    You won't be able to revert this !
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                @isset ($roles->roleId)
                    <form  method="post" action="{{ route('role.destroy', $roles->roleId ) }}"  onsubmit="return confirm('Do you really want to proceed?');">
                                              {{ csrf_field() }}

                                                <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" id="deleteConfirm">Delete</button>
                    </form>
                @endisset
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirm Modal -->
<!-- Delete Confirm Modal -->









@endsection

