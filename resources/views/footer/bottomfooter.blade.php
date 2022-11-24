<!DOCTYPE html>

@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Bottom Footer')

@section('page_content')

{{-- <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}"> --}}
<script src="{{ asset('js/jquery.min.js') }}"></script>	
{{-- <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>	 --}}

{{-- indication and dosage --}}
{{-- indication and dosage --}}
{{-- indication and dosage --}}
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

		<div class="card col-md-12">
			<div class="card-body">
		        <h4 class="card-title" style="text-align: center;">Bottom Footer</h4>
			
			    <div class="row">
			        <div class="col-md-12 col-md-offset-2">
			            <div class="panel panel-default">
			                {{-- <div class="panel-heading">Add New User</div> --}}

			                <div class="panel-body">
			                    <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('footer.bottomFooterUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
					                          {{method_field('put')}}
					                          {{ csrf_field() }}	
					                            <div class="col-md-12">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Bottom Footer</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor"  rows="4" id="bottomfooter" name="bottomfooter"  contenteditable="false" required>{{ $bottomfooterData->bottomfooter }} </textarea>

					                                </div>
					                              </div>
					                            </div>

					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Bottom Footer (CN)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="bottomfooterCN" name="bottomfooterCN" >{{ $bottomfooterData->bottomfooterCN }} </textarea>

					                                </div>
					                              </div>
					                            </div>

					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Bottom Footer (RU)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="bottomfooterRU" name="bottomfooterRU" >{{ $bottomfooterData->bottomfooterRU }} </textarea>
					                                </div>
					                              </div>
					                            </div>	

												<div class="form-group">
												  <div class="col-md-12 col-md-offset-4 mt-2">

												      <button type="submit" class="btn btn-success float-right" id="bottomfooterUpdateSubmit">
												          Save
												      </button>

												      <a href="{{ route('pages') }}">
												      	<button type="button" class="btn btn-danger float-right mr-2">
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
		    </div>
	    </div>
</div>

@endsection