<!DOCTYPE html>
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Banner')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 



@section('page_content')




<script type="text/javascript">

  $(function(){

      $('#bannerUpdateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;

            var bannerId = button.data('bannerid') ;
            var picPath = button.data('picpath') ;
            var title = button.data('title') ;
            var titleRU = button.data('titleru') ;
            var titleCN = button.data('titlecn') ;
            var desc = button.data('desc') ;
            var descRU = button.data('descru') ;
            var descCN = button.data('desccn') ;

            var modal = $(this);

            modal.find('.modal-body #picPath').val(picPath);

            if (picPath.length>5) {
                modal.find('.modal-body #photoUpdateUploadPreview').attr("src", picPath)
            }
            
            modal.find('.modal-body #bannerId').val(bannerId);
            modal.find('.modal-body #picPath').val(picPath);

            modal.find('.modal-body #title').val(title);
            modal.find('.modal-body #titleRU').val(titleRU);
            modal.find('.modal-body #titleCN').val(titleCN);

            modal.find('.modal-body #desc').val(desc);
            modal.find('.modal-body #descRU').val(descRU);
            modal.find('.modal-body #descCN').val(descCN);
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

    
          <div class="card">
            <div class="card-body">

				

				{{-- top side of the table --}}

				<h4 class="card-title" style="text-align: center;">Add Banner</h4>


				


          <form class="form-sample banner_slider_insert_form" id="banner_slider_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('banner_insert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    

                    

                    <div class="row">


                      <div class="col-md-6">
                        <div class="form-group row required" >
                          <label  for="picPath"  class="col-sm-4 col-form-label control-label"> Image (980x150) </label>
                          <div class="col-sm-8">
                            <input type="file" name="picPath" value="picPath" class="form-control" placeholder="picPath"   id="photoUploadInput" required>
                              @if ($errors->has('picPath'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('picPath') }}</strong>
                                  </span>
                              @endif
                              <img id="photoUploadPreview"  alt="image"  style="max-width: 200px; max-height: 200px;" />
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row " >
                          <label  for="title"  class="col-sm-4 col-form-label control-label"> Title (html)</label>
                          <div class="col-sm-8">
                            <textarea name="title"  class="form-control tinymce-editor" placeholder="Title"   id="title" rows="3"></textarea>
                          </div>
                        </div>
                      </div>



                    </div>

                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group row " >
                          <label  for="titleCN"  class="col-sm-4 col-form-label control-label"> Title (CN)(html) </label>
                          <div class="col-sm-8">
                            <textarea name="titleCN"  class="form-control tinymce-editor" placeholder="Title Chinese"   id="titleCN" rows="3"></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row " >
                          <label  for="titleRU"  class="col-sm-4 col-form-label control-label"> Title (RU)(html)</label>
                          <div class="col-sm-8">
                            <textarea name="titleRU"  class="form-control tinymce-editor" placeholder="Description Russian"   id="titleRU" rows="3"></textarea>
                          </div>
                        </div>
                      </div>


                    </div>


                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group row " >
                          <label  for="desc"  class="col-sm-4 col-form-label control-label"> Description(html)</label>
                          <div class="col-sm-8">
                            <textarea name="desc"  class="form-control tinymce-editor" placeholder="Description Chinese"   id="desc" rows="3"></textarea>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row " >
                          <label  for="descCN"  class="col-sm-4 col-form-label control-label"> Description (CN)(html) </label>
                          <div class="col-sm-8">
                            <textarea name="descCN"  class="form-control tinymce-editor" placeholder="Description Chinese"   id="descCN" rows="3"></textarea>
                          </div>
                        </div>
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-md-6">
                        <div class="form-group row " >
                          <label  for="descRU"  class="col-sm-4 col-form-label control-label"> Description (RU)(html)</label>
                          <div class="col-sm-8">
                            <textarea name="descRU"  class="form-control tinymce-editor" placeholder="Description Russian"   id="descRU" rows="3"></textarea>

                          </div>
                        </div>
                      </div>


                    </div>



                  <div class="col-md-12 text-center mt-4">
                      <input type="submit" class="btn btn-success mr-2"  value="Save">
                      <input type="button" class="btn btn-danger" onclick="formClearFunction()" value="Clear">
                  </div>


                  </form>
        

            </div>
          </div>
        </div>







<div class="content-wrapper" style="min-height: 0px; margin-top: -20px">
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Banners</h4>



    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  <th scope="col">Photo</th>
                  <th scope="col">Title</th>
                  <th scope="col">Description</th>
                  <th scope="col">Action</th>
              </tr>
          </thead>
          

          <tbody>
               @foreach ($bannerData as $banner)
                  <tr>
                      <td>
                          <img  data-src="{{ asset($banner->picPath) }}" alt="image" class="bannerImage lozad"  data-mfp-src="{{  asset($banner->picPath) }}" 
                                style="
                                        min-width: 50px !important;
                                        min-height: 50px !important;
                                        max-width: 100px !important;
                                        max-height: 100px !important;
                                        border-radius: 0% !important;
                                " 
                           />
                      </td>
                      <td>
                        {!! $banner->title !!} <br><hr>
                        {!! $banner->titleCN !!} <br><hr>
                        {!! $banner->titleRU !!} 
                      </td>

                      <td>
                        {!! $banner->desc !!} <br><hr>
                        {!! $banner->descCN !!} <br><hr>
                        {!! $banner->descRU !!} 
                      </td>
                      
                      <td id="tdtableaction">

                            <div class="d-inline-block">
                                <a role="button" href="#"   data-toggle="modal" data-target="#bannerUpdateModal"  

                                data-bannerid='{{ $banner->bannerId }}' 
                                data-picPath='{{ $banner->picPath }}' 
                                data-title='{{ $banner->title }}' 
                                data-titleru='{{ $banner->titleRU }}' 
                                data-titlecn='{{ $banner->titleCN }}' 
                                data-desc='{{ $banner->desc }}' 
                                data-descru='{{ $banner->descRU }}' 
                                data-desccn='{{ $banner->descCN }}' 

                                ><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                            </div>
                           

                            <div class="d-inline-block">
                              <form  method="post" action="{{ route('banner_delete', $banner->bannerId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
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






<!-- Banner Edit Modal -->
<!-- Banner Edit Modal -->
<div class="modal fade" id="bannerUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Update Banner</h5>

      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              

              <form id="main_slider_update_form" class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('bannerupdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                        <input type="hidden" name="bannerId" id="bannerId" value="">

                      



                      <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Image (980x150)</label>
                            <div class="col-sm-8">
                              <input type="file" name="picPath"  class="form-control" placeholder="picPath"   id="photoUpdateUploadInput">
                                <img id="photoUpdateUploadPreview"   style="max-width: 200px; max-height: 200px;"  alt="image"/>
                            </div>
                          </div>
                        </div>



                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label  for="title"  class="col-sm-4 col-form-label control-label"> Title (html)</label>
                            <div class="col-sm-8">
                              <textarea name="title"  class="form-control" placeholder="Title"   id="title" rows="3"></textarea>
                            </div>
                          </div>
                        </div>
  
  
  
                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label  for="titleCN"  class="col-sm-4 col-form-label control-label"> Title (CN)(html) </label>
                            <div class="col-sm-8">
                              <textarea name="titleCN"  class="form-control" placeholder="Title Chinese"   id="titleCN" rows="3"></textarea>
                            </div>
                          </div>
                        </div>
  
                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label  for="titleRU"  class="col-sm-4 col-form-label control-label"> Title (RU)(html)</label>
                            <div class="col-sm-8">
                              <textarea name="titleRU"  class="form-control" placeholder="Description Russian"   id="titleRU" rows="3"></textarea>
                            </div>
                          </div>
                        </div>
  
  
  
                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label  for="desc"  class="col-sm-4 col-form-label control-label"> Description(html)</label>
                            <div class="col-sm-8">
                              <textarea name="desc"  class="form-control" placeholder="Description Chinese"   id="desc" rows="3"></textarea>
                            </div>
                          </div>
                        </div>
  
                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label  for="descCN"  class="col-sm-4 col-form-label control-label"> Description (CN)(html) </label>
                            <div class="col-sm-8">
                              <textarea name="descCN"  class="form-control" placeholder="Description Chinese"   id="descCN" rows="3"></textarea>
                            </div>
                          </div>
                        </div>
  
                        <div class="col-md-12">
                          <div class="form-group row " >
                            <label  for="descRU"  class="col-sm-4 col-form-label control-label"> Description (RU)(html)</label>
                            <div class="col-sm-8">
                              <textarea name="descRU"  class="form-control" placeholder="Description Russian"   id="descRU" rows="3"></textarea>
  
                            </div>
                          </div>
                        </div>



                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4 mt-2">
                                <button type="submit" class="btn btn-success float-right">
                                    Update
                                </button>
                                <a >
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
<!-- Banner Edit Modal -->
<!-- Banner Edit Modal -->




<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("banner_slider_insert_form").reset();
        document.getElementById("photoUploadPreview").src='';
        tinymce.get("title").setContent('');
        tinymce.get("titleCN").setContent('');
        tinymce.get("titleRU").setContent('');
        tinymce.get("desc").setContent('');
        tinymce.get("descCN").setContent('');
        tinymce.get("descRU").setContent('');
    }

</script>



<script type="text/javascript">
  {{-- image upload and preview --}}

  function readURL(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#photoUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#photoUploadInput").change(function() 
  {
    readURL(this);
  });


  function readURL2(input) 
  {

    if (input.files && input.files[0]) 
    {
      var reader = new FileReader();

      reader.onload = function(e) 
      {
        $('#photoUpdateUploadPreview').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#photoUpdateUploadInput").change(function() 
  {
    readURL2(this);
  });

</script>




<script type="text/javascript">
  $(document).ready(function() {
    $('.bannerImage').magnificPopup({type:'image'});
  });
</script>








@endsection