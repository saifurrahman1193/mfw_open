@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Users')


@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>




<style type="text/css" media="screen">
  fieldset{
   border:1px solid #cccc;
   padding: 8px;
}
</style>




   <div class="content-wrapper" style="min-height: 0px;">
    <div class="card">
      <div class="card-body">
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



          <h4 class="card-title" style="text-align: center;">Users</h4>

            <a href="{{ route('user.create') }}"  class="btn btn-default " style="margin-bottom: 10px; "  ><span>+ Create New User</span></a>


           <table id="datatable1WScroll" class="table table-bordered  table-striped table-hover " width="100%">
              <thead >
              <tr class="bg-primary text-light">
                {{-- <th class="text-center">#</th> --}}
                <th   class="text-center">Action</th>
                <th class="text-center">Name</th>
                <th class="text-center">Email</th>
                <th class="text-center">Roles</th>
                <th class="text-center">Modules</th>
   
              </tr>
              </thead>
              <tbody>

              @foreach ($users as $user)
                  <tr>
                      {{-- <td>{{$loop->index+1}}</td>  --}}
                      <td id="tdtableaction" >
                        <div class="d-inline-block tooltipster" title="Edit User Information?">
                            <a role="button" href="{{ route('users.user.edit', $user->userId) }}" ><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                        </div>
                        <div class="d-inline-block tooltipster" title="Delete The User ?">
                            <form  method="post" action="/user/{{$user->userId}}"  onsubmit="return confirm('Do you really want to proceed?');">
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
                      <td>{{$user->name}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->roles}}</td>
                      <td>{{$user->modules}}</td>

                      
                  </tr>
                  
              @endforeach
              
              </tbody>
            </table>

      </div>
    </div>
  </div>



@endsection

