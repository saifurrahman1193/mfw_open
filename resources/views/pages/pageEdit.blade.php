<!DOCTYPE html>


@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Edit Page')

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
		        <h4 class="card-title" style="text-align: center;">Page Edit</h4>


			
			    <div class="row">
			        <div class="col-md-12 col-md-offset-2">
			            <div class="panel panel-default">
			                {{-- <div class="panel-heading">Add New User</div> --}}

			                <div class="panel-body">
			                    <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('pageUpdate', $pageData->pageId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
					                          {{method_field('put')}}
					                          {{ csrf_field() }}
												


					                            <div class="col-md-12">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Title</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control "  rows="4" id="pageTitle" name="pageTitle"  contenteditable="false" required>{{ $pageData->pageTitle }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Title (CN)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control " rows="4" id="pageTitleCN" name="pageTitleCN" >{{ $pageData->pageTitleCN }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Title (RU)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control " rows="4" id="pageTitleRU" name="pageTitleRU" >{{ $pageData->pageTitleRU }} </textarea>
					                                </div>
					                              </div>
												</div>
												


													<div class="col-md-12">
														<div class="form-group row ">
														  <label class="col-sm-4 col-form-label control-label">Meta keywords</label>
														  <div class="col-sm-8">
															<textarea id="meta_keywords" name="meta_keywords"  rows="5" class="form-control" >{{ $pageData->meta_keywords }} </textarea>
														  </div>
														</div>
													</div>
				
				
													<div class="col-md-12">
													  <div class="form-group row ">
														<label class="col-sm-4 col-form-label control-label">Meta keywords (CN)</label>
														<div class="col-sm-8">
														  <textarea id="meta_keywordsCN" name="meta_keywordsCN"  rows="5" class="form-control" >{{ $pageData->meta_keywordsCN }} </textarea>
														</div>
													  </div>
													</div>
				
													<div class="col-md-12">
													  <div class="form-group row ">
														<label class="col-sm-4 col-form-label control-label">Meta keywords (RU)</label>
														<div class="col-sm-8">
														  <textarea id="meta_keywordsRU" name="meta_keywordsRU"  rows="5" class="form-control" >{{ $pageData->meta_keywordsRU }} </textarea>
														</div>
													  </div>
													</div>
													
				
				
												
				
				
												  <div class="col-md-12">
													  <div class="form-group row ">
														<label class="col-sm-4 col-form-label control-label">Meta description</label>
														<div class="col-sm-8">
															<textarea id="meta_description" name="meta_description"  rows="5" class="form-control" >{{ $pageData->meta_description }} </textarea>
														  </div>
													  </div>
												  </div>
				
												  <div class="col-md-12">
													  <div class="form-group row ">
														<label class="col-sm-4 col-form-label control-label">Meta description (CN)</label>
														<div class="col-sm-8">
															<textarea id="meta_descriptionCN" name="meta_descriptionCN"  rows="5" class="form-control" >{{ $pageData->meta_descriptionCN }} </textarea>
														  </div>
													  </div>
												  </div>
				
												  <div class="col-md-12">
													  <div class="form-group row ">
														<label class="col-sm-4 col-form-label control-label">Meta description (RU)</label>
														<div class="col-sm-8">
															<textarea id="meta_descriptionRU" name="meta_descriptionRU"  rows="5" class="form-control" >{{ $pageData->meta_descriptionRU }} </textarea>
														  </div>
													  </div>
												  </div>
				




					                            <div class="col-md-12">
					                              <div class="form-group row required">
					                                <label class="col-sm-4 col-form-label control-label">Page Description</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor"  rows="4" id="pageDesc" name="pageDesc"  contenteditable="false" required>{{ $pageData->pageDesc }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Page Description (CN)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="pageDescCN" name="pageDescCN" >{{ $pageData->pageDescCN }} </textarea>

					                                </div>
					                              </div>
					                            </div>


					                            <div class="col-md-12">
					                              <div class="form-group row ">
					                                <label class="col-sm-4 col-form-label control-label">Page Description (RU)</label>
					                                <div class="col-sm-8">
					                                  <textarea class="form-control tinymce-editor" rows="4" id="pageDescRU" name="pageDescRU" >{{ $pageData->pageDescRU }} </textarea>
					                                </div>
					                              </div>
					                            </div>


					                           


												<div class="form-group">
												  <div class="col-md-12 col-md-offset-4 mt-2">

												      <button type="submit" class="btn btn-success float-right" id="termsconditionsUpdateSubmit">
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
{{-- indication and dosage --}}
{{-- indication and dosage --}}
{{-- indication and dosage --}}





@endsection