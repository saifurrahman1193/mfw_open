<!DOCTYPE html>

@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Main Slider')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 





@section('page_content')



<script type="text/javascript">

    $(function(){

        $('#sliderUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var mainsliderId = button.data('mainsliderid') ;
              var photoPath = button.data('photopath') ;
              var text1 = button.data('text1') ;
              var text1RU = button.data('text1ru') ;
              var text1CN = button.data('text1cn') ;
              var text2 = button.data('text2') ;
              var text2RU = button.data('text2ru') ;
              var text2CN = button.data('text2cn') ;

              var modal = $(this);

              modal.find('.modal-body #photoPath').val(photoPath);

              if (photoPath.length>5) {
                  modal.find('.modal-body #photoUpdateUploadPreview').attr("src", '/../'+photoPath)
              }
              
              modal.find('.modal-body #mainsliderId').val(mainsliderId);
              modal.find('.modal-body #photoPath').val(photoPath);

              modal.find('.modal-body #text1').val(text1);
              modal.find('.modal-body #text1RU').val(text1RU);
              modal.find('.modal-body #text1CN').val(text1CN);

              modal.find('.modal-body #text2').val(text2);
              modal.find('.modal-body #text2RU').val(text2RU);
              modal.find('.modal-body #text2CN').val(text2CN);
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

				<h4 class="card-title" style="text-align: center;">Add Slider</h4>





				


          <form class="form-sample" id="slider_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('main_sliderInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    

                    <div class="row">

                        <div class="col-md-6">
                          <div class="form-group row required" >
                            <label  for="photoPath"  class="col-sm-4 col-form-label control-label">Slider Image (1331x450)</label>
                            <div class="col-sm-8">
                              <input type="file" name="photoPath" value="photoPath" class="form-control" placeholder="photoPath"   id="photoUploadInput" required>
                                @if ($errors->has('photoPath'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photoPath') }}</strong>
                                    </span>
                                @endif
                                <img id="photoUploadPreview"  alt="image"  style="max-width: 200px; max-height: 200px;" />
                            </div>
                          </div>
                        </div>


                        
                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label  for="text1"  class="col-sm-4 col-form-label control-label">Text 1 (HTML)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text1" id="text1" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control tinymce-editor"  rows="4" id="text1" name="text1"  > </textarea>
                              </div>
                          </div>
                      </div>

                    </div>

                    <div class="row">
                       <div class="col-md-6">
                          <div class="form-group row ">
                            <label  for="text1RU"  class="col-sm-4 col-form-label control-label">Text 1 (Ru) (HTML)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text1RU" id="text1RU" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control tinymce-editor"  rows="4" id="text1RU" name="text1RU"  > </textarea>
                              </div>
                          </div>
                      </div>

                       <div class="col-md-6">
                          <div class="form-group row ">
                            <label  for="text1CN"  class="col-sm-4 col-form-label control-label">Text 1 (CN) (HTML)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text1CN" id="text1CN" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control tinymce-editor"  rows="4" id="text1CN" name="text1CN"  > </textarea>
                              </div>
                          </div>
                      </div>

                    </div>

                    <div class="row">

                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label  for="text2"  class="col-sm-4 col-form-label control-label">Text 2</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text2" id="text2" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control "  rows="4" id="text2" name="text2"  > </textarea>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label  for="text2RU"  class="col-sm-4 col-form-label control-label">Text 2 (RU)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text2RU" id="text2RU" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control "  rows="4" id="text2RU" name="text2RU"  > </textarea>
                              </div>
                          </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label  for="text2CN"  class="col-sm-4 col-form-label control-label">Text 2 (CN)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text2CN" id="text2CN" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control "  rows="4" id="text2CN" name="text2CN"  > </textarea>
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


        <h4 class="card-title" style="text-align: center;">Main Sliders</h4>



    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  <th scope="col">Action</th>
                  <th scope="col">Photo</th>
                  <th scope="col">Text 1</th>
                  <th scope="col">Text 2</th>
              </tr>
          </thead>
          

          <tbody>
               @foreach ($mainslidersData as $mainslider)
                  <tr>
                      <td id="tdtableaction">
                  
                        <div class="d-inline-block">
                            <a role="button" href="#"   data-toggle="modal" data-target="#sliderUpdateModal"  

                            data-mainsliderid='{{ $mainslider->mainsliderId }}' 
                            data-photopath='{{ $mainslider->photoPath }}' 
                            data-text1='{{ $mainslider->text1 }}' 
                            data-text1ru='{{ $mainslider->text1RU }}' 
                            data-text1cn='{{ $mainslider->text1CN }}' 
                            data-text2='{{ $mainslider->text2 }}' 
                            data-text2ru='{{ $mainslider->text2RU }}' 
                            data-text2cn='{{ $mainslider->text2CN }}' 

                            ><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                        </div>

                        <div class="d-inline-block">
                          <form  method="post" action="{{ route('main_sliderDelete', $mainslider->mainsliderId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
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
                      <td>
                          <img  src="{{ empty($mainslider->photoPath) ? '#' : asset($mainslider->photoPath) }}" alt="your image" class="sliderImage"  data-mfp-src="{{ empty($mainslider->photoPath) ? '#' : asset($mainslider->photoPath) }}" 
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
                        {{$mainslider->text1}}<br> <hr>
                        {{$mainslider->text1RU}}<br> <hr>
                        {{$mainslider->text1CN}}
                      </td>
                      <td>
                        {{$mainslider->text2}}<br> <hr>
                        {{$mainslider->text2RU}}<br> <hr>
                        {{$mainslider->text2CN}}
                      </td>
                      
                      
                  </tr>
                @endforeach

             
             
          </tbody>
      </table>



    </div>
  </div>
</div>





<!-- Main Slider Edit Modal -->
<!-- Main Slider Edit Modal -->
<div class="modal fade" id="sliderUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Update Slider</h5>

      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              

              <form id="main_slider_update_form" class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('main_sliderUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                        <input type="hidden" name="mainsliderId" id="mainsliderId" value="">

                      



                      <div class="col-md-12">
                          <div class="form-group row required" >
                            <label class="col-sm-4 col-form-label control-label">Slider Image (1331x450)</label>
                            <div class="col-sm-8">
                              <input type="file" name="photoPath"  class="form-control" placeholder="photoPath"   id="photoUpdateUploadInput">
                                <img id="photoUpdateUploadPreview"   style="max-width: 200px; max-height: 200px;"  alt="image"/>
                            </div>
                          </div>
                        </div>



                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="text1"  class="col-sm-4 col-form-label control-label">Text 1 (HTML)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text1" id="text1" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control "  rows="4" id="text1" name="text1"  > </textarea>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="text1RU"  class="col-sm-4 col-form-label control-label">Text 1 (RU) (HTML)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text1RU" id="text1RU" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control "  rows="4" id="text1RU" name="text1RU"  > </textarea>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="text1CN"  class="col-sm-4 col-form-label control-label">Text 1 (CN) (HTML)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text1CN" id="text1CN" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control "  rows="4" id="text1CN" name="text1CN"  > </textarea>
                              </div>
                          </div>
                      </div>



                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="text2"  class="col-sm-4 col-form-label control-label">Text 2</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text2" id="text2" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control "  rows="4" id="text2" name="text2"  > </textarea>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="text2RU"  class="col-sm-4 col-form-label control-label">Text 2 (RU)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text2RU" id="text2RU" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control "  rows="4" id="text2RU" name="text2RU"  > </textarea>
                              </div>
                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="text2CN"  class="col-sm-4 col-form-label control-label">Text 2 (CN)</label>
                            <div class="col-sm-8">
                              {{-- <input type="text" name="text2CN" id="text2CN" class="form-control"  placeholder=""> --}}
                                <textarea class="form-control "  rows="4" id="text2CN" name="text2CN"  > </textarea>
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
<!-- Main Slider Edit Modal -->
<!-- Main Slider Edit Modal -->







<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("slider_insert_form").reset();
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



<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("slider_insert_form").reset();
    }
</script>



<script type="text/javascript">
  $(document).ready(function() {
    $('.sliderImage').magnificPopup({type:'image'});
  });
</script>








@endsection