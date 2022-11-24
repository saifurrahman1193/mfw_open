<!DOCTYPE html>

@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Testimonials')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 



@section('page_content')

<script type="text/javascript">
    $(function(){
        $('#testimonialUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var testimonialId = button.data('testimonialid') ;
              var testimonial = button.data('testimonial') ;
              var testimonialRU = button.data('testimonialru') ;
              var testimonialCN = button.data('testimonialcn') ;
              var manual_name = button.data('manual_name') ;
              var manual_email = button.data('manual_email') ;
              var manual_picpath = button.data('manual_picpath') ;
              var visibility = button.data('visibility') ;
              var clientContact = button.data('clientcontact') ;

              var modal = $(this);
              modal.find('.modal-body #manual_picpath').val(manual_picpath);

              if (manual_picpath.length>5) {
                  modal.find('.modal-body #photoUpdateUploadPreview').attr("src", manual_picpath)
              }


              modal.find('.modal-body #testimonialId').val(testimonialId);
              modal.find('.modal-body #testimonial').val(testimonial);
              modal.find('.modal-body #testimonialRU').val(testimonialRU);
              modal.find('.modal-body #testimonialCN').val(testimonialCN);
              modal.find('.modal-body #manual_name').val(manual_name);
              modal.find('.modal-body #manual_email').val(manual_email);
              modal.find('.modal-body #manual_picpath').val(manual_picpath);
              modal.find('.modal-body #visibility').val(visibility);
              modal.find('.modal-body #clientContact').val(clientContact);
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

				<h4 class="card-title" style="text-align: center;">Add Testimonial</h4>





				


          <form class="form-sample" id="testimonial_insert_form" method="POST" enctype="multipart/form-data" action="{{ route('testimonialInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');">

                          {{ csrf_field() }}

                  <br>
                    <p class="card-description">
                      {{-- Personal info --}}
                    </p>
                    

                    <div class="row">


                      <div class="col-md-6">
                          <div class="form-group row ">
                            <label  for="text2"  class="col-sm-4 col-form-label control-label">User</label>
                            <div class="col-sm-8">
                              <select class="form-control m-bot15" name="userId" id="userId"   >
                                      <option value="">--Select User--</option>
                                      @foreach($userData->whereNotIn('id',$testimonialData->pluck('userId')) as $user)
                                          <option value="{{ $user->id }}" 

                                            data-userid="{{ $user->id }}"  
                                            data-name="{{ title_case($user->name) }}"  
                                            data-email="{{ title_case($user->email) }}"  
                                            >
                                            {{ $user->email }}
                                          </option> 
                                      @endforeach   
                              </select>
                            </div>
                          </div>
                      </div>


                      

                        
                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="testimonial"  class="col-sm-2 col-form-label control-label">Testimonial (HTML) 
                              <br><br> <span style="font-size: 11px; margin-top: 1px;">(Please avoid using <code style="font-size: 13px; font-weight: bold;">&lt;br&gt;</code> tag )</span>
                            </label>
                            <div class="col-sm-10">
                              <textarea  name="testimonial" id="testimonial" class="form-control tinymce-editor" rows="3"></textarea>
                            </div>
                          </div>
                      </div>

                      </div>
                        
                      <div class="row">

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="testimonialRU"  class="col-sm-2 col-form-label control-label">Testimonial (RU) (HTML)
                              <br><br> <span style="font-size: 11px; margin-top: 1px;">(Please avoid using <code style="font-size: 13px; font-weight: bold;">&lt;br&gt;</code> tag )</span>
                                
                            </label>
                            <div class="col-sm-10">
                              <textarea  name="testimonialRU" id="testimonialRU" class="form-control tinymce-editor" rows="3"></textarea>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="testimonialCN"  class="col-sm-2 col-form-label control-label">Testimonial (CN) (HTML)
                              <br><br> <span style="font-size: 11px; margin-top: 1px;">(Please avoid using <code style="font-size: 13px; font-weight: bold;">&lt;br&gt;</code> tag )</span>
                                
                            </label>
                            <div class="col-sm-10">
                              <textarea  name="testimonialCN" id="testimonialCN" class="form-control tinymce-editor" rows="3"></textarea>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row ">
                            <label  for="manual_name"  class="col-sm-2 col-form-label control-label">Manual Name</label>
                            <div class="col-sm-10">
                              <input type="text"  name="manual_name" id="manual_name" class="form-control" >
                            </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row ">
                            <label  for="manual_email"  class="col-sm-2 col-form-label control-label">Manual Email</label>
                            <div class="col-sm-10">
                              <input type="text"  name="manual_email" id="manual_email" class="form-control" >
                            </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row ">
                            <label  for="visibility"  class="col-sm-2 col-form-label control-label">Visibility</label>
                            <div   class="col-sm-10" class="form-check form-switch">
                              <select class="form-control" name="visibility" id="visibility"   >
                                  <option value="0" >Private</option> 
                                  <option value="1" >Public</option> 
                              </select>
                            </div>
                            
                        </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="clientContact"  class="col-sm-2 col-form-label control-label">Client contact/Instruction (HTML)</label>
                            <div class="col-sm-10">
                              <textarea  name="clientContact" id="clientContact" class="form-control tinymce-editor" rows="3"></textarea>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="clientContactCN"  class="col-sm-2 col-form-label control-label">Client contact/Instruction (CN) (HTML)</label>
                            <div class="col-sm-10">
                              <textarea  name="clientContactCN" id="clientContactCN" class="form-control tinymce-editor" rows="3"></textarea>
                            </div>
                          </div>
                      </div>

                      <div class="col-md-12">
                          <div class="form-group row ">
                            <label  for="clientContactRU"  class="col-sm-2 col-form-label control-label">Client contact/Instruction (RU) (HTML)</label>
                            <div class="col-sm-10">
                              <textarea  name="clientContactRU" id="clientContactRU" class="form-control tinymce-editor" rows="3"></textarea>
                            </div>
                          </div>
                      </div>



                    </div>

                    <div class="row">


                      <div class="col-md-12">
                        <div class="form-group row " >
                          <label  for="manual_picpath"  class="col-md-2 col-form-label control-label"> Manual Image </label>
                          <div class="col-md-10">
                            <input type="file" name="manual_picpath" value="manual_picpath" class="form-control" placeholder="manual_picpath"   id="photoUploadInput" >
                              @if ($errors->has('manual_picpath'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('manual_picpath') }}</strong>
                                  </span>
                              @endif
                              <img id="photoUploadPreview"  alt="image"  style="max-width: 200px; max-height: 200px;" />
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


        <h4 class="card-title" style="text-align: center;">Testimonials</h4>



    <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                <th scope="col">Action</th>
                <th scope="col">Photo</th>
                <th scope="col">User Email</th>
                <th scope="col">Name</th>
                <th scope="col">Testimonial</th>
                <th scope="col">Client Contact/Instruction</th>
                <th scope="col">Visibility</th>
              </tr>
          </thead>
          

          <tbody>
               @foreach ($testimonialData as $testimonial)
                  <tr>
                    <td id="tdtableaction">
                 
                      <div class="d-inline-block">
                          <a role="button" href="#"   data-toggle="modal" data-target="#testimonialUpdateModal"  

                          data-testimonialid='{{ $testimonial->testimonialId }}' 
                          data-testimonial='{{ $testimonial->testimonial }}' 
                          data-testimonialru='{{ $testimonial->testimonialRU }}' 
                          data-testimonialcn='{{ $testimonial->testimonialCN }}' 
                          data-manual_name='{{ $testimonial->manual_name }}' 
                          data-manual_email='{{ $testimonial->manual_email }}' 
                          data-manual_picpath='{{ $testimonial->manual_picpath }}' 
                          data-visibility='{{ $testimonial->visibility }}' 
                          data-clientcontact='{{ $testimonial->clientContact }}' 
                          

                          ><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                      </div>

                      <div class="d-inline-block">
                        <form  method="post" action="{{ route('testimonialDelete', $testimonial->testimonialId) }}"  onsubmit="return confirm('Do you really want to proceed?');">
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
                        @if (strlen($testimonial->photoPath)>0)
                          <img  src="{{ strlen($testimonial->photoPath)==0 ? '#' : asset($testimonial->photoPath) }}" alt="your image" class="sliderImage"  data-mfp-src="{{ strlen($testimonial->photoPath)==0 ? '#' : asset($testimonial->photoPath) }}" 
                                style="
                                        min-width: 50px !important;
                                        min-height: 50px !important;
                                        max-width: 100px !important;
                                        max-height: 100px !important;
                                        border-radius: 0% !important;
                                " 
                          />
                        @elseif(strlen($testimonial->manual_picpath)>0)
                              <img  src="{{ strlen($testimonial->manual_picpath)==0 ? '#' : asset($testimonial->manual_picpath) }}" alt="your image" class="sliderImage"  data-mfp-src="{{ strlen($testimonial->manual_picpath)==0 ? '#' : asset($testimonial->manual_picpath) }}" 
                              style="
                                      min-width: 50px !important;
                                      min-height: 50px !important;
                                      max-width: 100px !important;
                                      max-height: 100px !important;
                                      border-radius: 0% !important;
                              " 
                              />
                        @endif
                      </td>
                      <td>{{strlen($testimonial->email)>0?$testimonial->email : (strlen($testimonial->manual_email)>0?'M.E.: ':'').$testimonial->manual_email}}</td>
                      <td>{{ $testimonial->name }}</td>
                      <td>
                        {!! $testimonial->testimonial !!} <br> <hr>
                        {!! $testimonial->testimonialRU !!} <br> <hr>
                        {!! $testimonial->testimonialCN !!} 
                      </td>
                      <td>
                        {!! $testimonial->clientContact !!} <br> <hr>
                        {!! $testimonial->clientContactRU !!} <br> <hr>
                        {!! $testimonial->clientContactCN !!} 
                      </td>
                      <td class="{{ $testimonial->visibility==1 ? 'text-success' : 'text-danger' }}">{{ $testimonial->visibility_type }}</td>
                      
                      
                  </tr>
                @endforeach

             
             
          </tbody>
      </table>



    </div>
  </div>
</div>





<!-- Testimonial Edit Modal -->
<!-- Testimonial Edit Modal -->
<div class="modal fade" id="testimonialUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="exampleModalLabel">Update Testimonial</h5>

      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              

              <form id="testimonial_update_form" class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('testimonialUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                        <input type="hidden" name="testimonialId" id="testimonialId" value="">

                      
                    

                          <div class="col-md-12">
                              <div class="form-group row ">
                                <label  for="testimonial"  class="col-sm-2 col-form-label control-label">Testimonial (HTML)
                                  <br><br> <span style="font-size: 11px; margin-top: 1px;">(Please avoid using <code style="font-size: 13px; font-weight: bold;">&lt;br&gt;</code> tag )</span>
                                </label>
                                
                                <div class="col-sm-10">
                                  <textarea  name="testimonial" id="testimonial" class="form-control" rows="5"></textarea>
                                </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group row ">
                                <label  for="testimonialRU"  class="col-sm-2 col-form-label control-label">Testimonial (RU) (HTML)
                                  <br><br> <span style="font-size: 11px; margin-top: 1px;">(Please avoid using <code style="font-size: 13px; font-weight: bold;">&lt;br&gt;</code> tag )</span>
                                
                                </label>
                                <div class="col-sm-10">
                                  <textarea  name="testimonialRU" id="testimonialRU" class="form-control" rows="5"></textarea>
                                </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group row ">
                                <label  for="testimonialCN"  class="col-sm-2 col-form-label control-label">Testimonial (CN) (HTML)
                                  <br><br> <span style="font-size: 11px; margin-top: 1px;">(Please avoid using <code style="font-size: 13px; font-weight: bold;">&lt;br&gt;</code> tag )</span>
                                
                                </label>
                                <div class="col-sm-10">
                                  <textarea  name="testimonialCN" id="testimonialCN" class="form-control" rows="5"></textarea>
                                </div>
                              </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                                <label  for="manual_name"  class="col-sm-2 col-form-label control-label">Manual Name</label>
                                <div class="col-sm-10">
                                  <input type="text"  name="manual_name" id="manual_name" class="form-control" >
                                </div>
                            </div>
                          </div>


                          <div class="col-md-12">
                            <div class="form-group row ">
                                <label  for="manual_email"  class="col-sm-2 col-form-label control-label">Manual Email</label>
                                <div class="col-sm-10">
                                  <input type="text"  name="manual_email" id="manual_email" class="form-control" >
                                </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                                <label  for="visibility"  class="col-sm-2 col-form-label control-label">Visibility</label>
                                <div   class="col-sm-10" class="form-check form-switch">
                                  <select class="form-control" name="visibility" id="visibility"   >
                                      <option value="0" >Private</option> 
                                      <option value="1" >Public</option> 
                                  </select>
                                </div>
                                
                            </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group row ">
                                <label  for="clientContact"  class="col-sm-2 col-form-label control-label">Client contact/Instruction (HTML)</label>
                                <div class="col-sm-10">
                                  <textarea  name="clientContact" id="clientContact" class="form-control" rows="3"></textarea>
                                </div>
                              </div>
                          </div>
    
                          <div class="col-md-12">
                              <div class="form-group row ">
                                <label  for="clientContactCN"  class="col-sm-2 col-form-label control-label">Client contact/Instruction (CN) (HTML)</label>
                                <div class="col-sm-10">
                                  <textarea  name="clientContactCN" id="clientContactCN" class="form-control" rows="3"></textarea>
                                </div>
                              </div>
                          </div>
    
                          <div class="col-md-12">
                              <div class="form-group row ">
                                <label  for="clientContactRU"  class="col-sm-2 col-form-label control-label">Client contact/Instruction (RU) (HTML)</label>
                                <div class="col-sm-10">
                                  <textarea  name="clientContactRU" id="clientContactRU" class="form-control" rows="3"></textarea>
                                </div>
                              </div>
                          </div>


                          <div class="col-md-12">
                            <div class="form-group row required" >
                              <label class="col-sm-2 col-form-label control-label">Manual Image</label>
                              <div class="col-sm-10">
                                <input type="file" name="manual_picpath"  class="form-control" placeholder="manual_picpath"   id="photoUpdateUploadInput">
                                  <img id="photoUpdateUploadPreview"   style="max-width: 200px; max-height: 200px;"  alt="image"/>
                              </div>
                            </div>
                          </div>

                      



                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4 mt-2">
                                <button type="submit" class="btn btn-success float-right">
                                    Update
                                </button>
                                <a >
                                  <button type="button" class="btn btn-danger float-right mr-2" data-dismiss="modal"  onclick="formClearFunction()" >
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
<!-- Testimonial Edit Modal -->
<!-- Testimonial Edit Modal -->







<script>
    // form clearing function
    function formClearFunction() {
        document.getElementById("testimonial_insert_form").reset();
        document.getElementById("testimonial_update_form").reset();
        // document.getElementById('photoUploadPreview').removeAttribute('src');
        // $('#photoUploadPreview').attr('src', '');
        // document.getElementById("photoUploadPreview").src = "";

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
        document.getElementById("testimonial_insert_form").reset();
    }
</script>



<script type="text/javascript">
  $(document).ready(function() {
    $('.sliderImage').magnificPopup({type:'image'});
  });
</script>


{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
  $(document).ready(function() {

     $('#userId').select2({
        placeholder: {
          id: '', // the value of the option
          text: '--Select User--'
        },
        // placeholder : "--Select Employee--",
        allowClear: true,
        language: {
          noResults: function (params) {
            return "No Data Found!";
          }
        },
     });



  });
</script>





@endsection