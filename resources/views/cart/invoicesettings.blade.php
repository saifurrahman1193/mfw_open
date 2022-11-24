@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Invoice Settings')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 


@section('page_content')

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

            <h4 class="card-title text-center">Invoice Common Settings</h4>


            <form class="form-sample"  method="POST" enctype="multipart/form-data" action="{{ route('invoiceCommonSettingsSave') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                {{ csrf_field() }}

                <br>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label  for="invoiceTitle"  class="col-sm-4 col-form-label control-label">Invoice Title</label>
                            <div class="col-sm-8">
                            <input type="text" name="invoiceTitle" id="invoiceTitle" class="form-control"  placeholder="" required value="{{ $invoicecommonsettingsData->invoiceTitle }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row required">
                        <label  for="commentTitle"  class="col-sm-4 col-form-label control-label">Comment Title</label>
                        <div class="col-sm-8">
                            <input type="text" name="commentTitle" id="commentTitle" class="form-control"  placeholder="" required value="{{ $invoicecommonsettingsData->commentTitle }}">
                        </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-12">
                    <div class="form-group row required">
                        <label  for="declaration"  class="col-sm-2 col-form-label control-label">Declaration</label>
                        <div class="col-sm-10">
                        <textarea class="form-control "  rows="7" id="declaration" name="declaration"  required>{{ $invoicecommonsettingsData->declaration }}</textarea>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 text-center mt-4">
                    <input type="submit" class="btn btn-success mr-2"  value="Save">
                </div>


            </form>            


        </div>
    </div>
</div>

@endsection