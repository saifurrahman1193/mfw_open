@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Social Medias')
@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>




<script type="text/javascript">

    $(function(){




        $('#socialMediaUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var socialMediaId = button.data('socialmediaid') ;
              var socialMedia = button.data('socialmedia') ;
              var iconclass = button.data('iconclass') ;
              var iconsrc = button.data('iconsrc') ;
              var link = button.data('link') ;
              var info = button.data('info') ;
              var picPath = button.data('picpath') ;

              var modal = $(this);

              modal.find('.modal-body #socialMediaId').val(socialMediaId);
              modal.find('.modal-body #socialMedia').val(socialMedia);
              modal.find('.modal-body #iconclass').val(iconclass);
              modal.find('.modal-body #iconsrc').val(iconsrc);
              modal.find('.modal-body #link').val(link);
              modal.find('.modal-body #info').val(info);

              modal.find('.modal-body #picPath').val(picPath);

              if (picPath.length>5) {
                  modal.find('.modal-body #photoUpdateUploadPreview').attr("src", "{{url('/')}}"+picPath)
              }

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




      <div class="card" id="socialmediatable">
        <div class="card-body">

            {{-- top side of the table --}}

            <h4 class="card-title" style="text-align: center;">Social Media </h4>

            <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#socialMediaSaveConfirmationModal" ><span>+ Create New Social Media</span></a>


        <table id="datatable1WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">Action</th>
                      <th scope="col">Social Media</th>
                      <th scope="col">Icon Class</th>
                      <th scope="col">Icon Src</th>
                      <th scope="col">Picture</th>
                      <th scope="col">Link</th>
                      <th scope="col">Info</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($socialmediaData as $socialmedia)
                      <tr>
                          <td id="tdtableaction">

                            <div class="d-inline-block">
                                <a role="button" href="#"   data-toggle="modal" data-target="#socialMediaUpdateModal"  
                                    data-socialmediaid='{{ $socialmedia->socialMediaId }}' 
                                    data-socialmedia='{{ $socialmedia->socialMedia }}' 
                                    data-iconclass='{{ $socialmedia->iconclass }}' 
                                    data-iconsrc='{{ $socialmedia->iconsrc }}' 
                                    data-link='{{ $socialmedia->link }}' 
                                    data-info='{{ $socialmedia->info }}' 
                                  data-picpath='{{ $socialmedia->picPath }}' 

                                  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                            </div>

                            @if ( !($socialmedia->isSocialMediaUsed>0) )

                            <div class="d-inline-block tooltipster" title="Delete selected record?">
                                <form  method="post" action="{{ route('supplier.settings.socialMedia.delete', $socialmedia->socialMediaId) }}" onsubmit="return confirm('Do you really want to proceed?');">
                                    {{ csrf_field() }}
                                      <input type="hidden" name="_method" value="DELETE">
                                      <a>
                                        <button type="submit" value="DELETE" class="btn btn-link" >
                                          <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                        </button>
                                      </a>
                                </form>
                              </div>
                            @endif

                        </td>
                          <td>{{$socialmedia->socialMedia}}</td>
                          <td>
                              <i class="{{$socialmedia->iconclass}}" ></i>
                          </td>
                          <td>
                            @if ($socialmedia->iconsrc != null)
                              <img src="{{$socialmedia->iconsrc}}" alt="" style="max-height: 15px; max-width: 15px; border-radius: 0% !important;">
                            @endif
                          </td>
                          <td>
                              @if ($socialmedia->picPath!=null)
                                    <img  src="{{ empty($socialmedia->picPath) ? '#' : asset($socialmedia->picPath) }}" alt="" class="picPath"  data-mfp-src="{{ empty($socialmedia->picPath) ? '#' : asset($socialmedia->picPath) }}" 
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
                          <td><a href="{{$socialmedia->link}}" target="_blank">{{$socialmedia->link}}</a></td>
                          <td>{{$socialmedia->info}}</td>

                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

        </div>
      </div>
</div>
    {{-- Social Media table --}}
    {{-- Social Media table --}}













<!-- Social Media Save Modal -->
<!-- Social Media Save Modal -->

<div class="modal fade" id="socialMediaSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="socailMediaSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="socialMediaSaveConfirmationModal">Add A Social Media</h5>

      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              

              <form class="form-horizontal" method="POST"  action="{{ route('supplier.settings.socialMedia.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Social Media</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="socialMedia" name="socialMedia" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Icon Class</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="iconclass" name="iconclass" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Icon Src</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="iconsrc" name="iconsrc" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Link</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="link" name="link" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Info</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="info" name="info" >
                              </div>
                            </div>
                          </div>

                          


                            <button data-toggle="modal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>

                </form>
      </div>
    </div>
  </div>
</div>
<!-- Social Media Save Modal -->
<!-- Social Media Save Modal -->





<!-- Social Media Edit Modal -->
<!-- Social Media Edit Modal -->
<div class="modal fade" id="socialMediaUpdateModal" tabindex="-1" role="dialog" aria-labelledby="socialMediaUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="socialMediaUpdateModal">Update Social Media</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('supplier.settings.socialMedia.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="socialMediaId" id="socialMediaId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Social Media</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="socialMedia" name="socialMedia" required>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Icon Class</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="iconclass" name="iconclass" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Icon Src</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="iconsrc" name="iconsrc" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Link</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="link" name="link" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Info</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="info" name="info" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row " >
                              <label class="col-sm-4 col-form-label control-label">Picture</label>
                              <div class="col-sm-8">
                                <input type="file" name="picPath"  class="form-control" placeholder="picPath"   id="photoUpdateUploadInput">
                                  <img id="photoUpdateUploadPreview"   style="max-width: 200px; max-height: 200px;" />
                              </div>
                            </div>
                          </div>


                          <div class="form-group">
                              <div class="col-md-12 col-md-offset-4 mt-2">

                                  <button type="submit" class="btn btn-success float-right">
                                      Update
                                  </button>
                                  
                                  <a {{-- href="{{ route('user.index') }}" --}}>
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
<!-- Social Media Edit Modal -->
<!-- Social Media Edit Modal -->




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
    $('.picPath').magnificPopup({type:'image'});
  });
</script>

@endsection