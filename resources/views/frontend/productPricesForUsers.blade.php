@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Product Prices For Users')


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



      

          <h4 class="card-title" style="text-align: center;">Assign prodduct prices to users</h4>



           <table id="datatable1WScroll" class="table table-bordered  table-striped table-hover " width="100%">
              <thead >
              <tr class="bg-primary text-light">
                <th class="text-center">#</th>
                <th class="text-center">Name</th>
                <th   class="text-center">Assign Product & Prices</th>
                <th   class="text-center">Customer Data Report</th>
                <th class="text-center">Email</th>
                <th class="text-center">Created by</th>
                <th class="text-center">Is deleted account</th>
              </tr>
              </thead>
              <tbody>

                @foreach ($usersData->sortByDesc('created_at') as $user)
                    <tr>
                        <td>{{$loop->index+1}}</td> 
                        <td><a href="{{route('customerProfileUpdate', $user->id)}}" target="_blank" >{{ $user->name }}</a></td>                        
                        <td id="tdtableaction" >
                            <div class="d-inline-block tooltipster" title="Assign Products and Prices for this client ?">
                              <a class="btn btn-primary pt-2 pb-2" href="{{ route('productPricesForUsers.assign', $user->id) }}" role="button">Assign Prices</a>
                            </div>
                        </td>
                        <td>
                          <a class="btn btn-success p-2" href="/report/allcustomersdata?customerId={{$user->id}}" target="_blank"><i class="fa fa-bar-chart"></i> Customer Data Report</a>
                        </td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->isCreatedByAdmin==1? 'Admin':''}}</td>
                        <td><strong style="color:red;">{{$user->isDeleted ? 'Deleted Account' : ''}}</strong></td>
                    </tr>
                @endforeach
              
              </tbody>
            </table>



      </div>
    </div>
  </div>



@endsection

