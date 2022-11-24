@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Suppliers')
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





    
    







  <div class="card">
    <div class="card-body">

        <h4 class="card-title" style="text-align: center;">Suppliers</h4>

        <a href="{{ route('supplier.settings.supplier.create') }}"  class="btn btn-default " style="margin-bottom: 10px; "  ><span>+ Create New Supplier</span></a>
        
        

        <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">Supplier Id</th>
                      <th scope="col">Action</th>
                      <th scope="col">Supplier</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Email</th>
                      <th scope="col">Position</th>
                      <th scope="col">Address</th>
                      <th scope="col">Country</th>
                      <th scope="col">Generic Company</th>
                      <th scope="col">Third Party Company</th>
                      <th scope="col">Comment</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($supplierData as $supplier)
                      <tr>
                          <td>{{$supplier->supplierId}}</td>
                          <td id="tdtableaction">

                            <div class="d-inline-block">
                                 <a role="button" href="{{ route('supplier.settings.supplier.edit', $supplier->supplierId ) }}"   title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                             </div>

                             <div class="d-inline-block tooltipster" title="Delete selected record?">
                                 <form  method="post" action="{{ route('supplier.settings.supplier.delete', $supplier->supplierId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                          <td>{{$supplier->supplier}}</td>
                          <td>{{$supplier->phone}}</td>
                          <td>{{$supplier->email}}</td>
                          <td>{{$supplier->position}}</td>
                          <td>{{$supplier->address}}</td>
                          <td>{{$supplier->country}}</td>
                          <td>{{$supplier->genericCompany}}</td>
                          <td>{{$supplier->thirdPartyCompany}}</td>
                          <td>{{$supplier->comment}}</td>
                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Supplier table --}}
{{-- Supplier table --}}













@endsection