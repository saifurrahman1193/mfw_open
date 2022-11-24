<!DOCTYPE html>

@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Mail Settings')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script>	

<script type="text/javascript">
    $(function(){
        $('#emailbodyUpdateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;

            var emailBodyId = button.data('emailbodyid') ;
            var emailBodyTitle = button.data('emailbodytitle') ;
            var emailBody = button.data('emailbody') ;

            var modal = $(this);

            modal.find('.modal-body #emailBodyId').val(emailBodyId);
            modal.find('.modal-body #emailBodyTitle').val(emailBodyTitle);
            modal.find('.modal-body #emailBody').val(emailBody);
        });
    });
</script>

<div class="content-wrapper" style="min-height: 0px;">

    <div class="card">
        <div class="card-title mt-4">
                <h4 class="text-center mt-2">Mail Settings</h4>
        </div>
        <div class="card-body">
            
            <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('mail.settings.update') }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
                @method('put')
                {{ csrf_field() }}
                
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Email Address</label>
                            <div class="col-sm-8">
                                <input type="text" id="mail" name="mail" value="{{ $mailData->mail }}" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Contact Email Addresses</label>
                            <div class="col-sm-8">
                                <textarea id="contactMails" name="contactMails" class="form-control"  rows="5" required >{{ $mailData->contactMails }}</textarea>
                              </div>
                        </div>
                    </div>

                </div> 

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Website</label>
                            <div class="col-sm-8">
                                <input type="text" id="website" name="website" value="{{ ($mailData->website==null ||  preg_match("/127.0/", Request::ip()) ) ? url('/') : $mailData->website }}" class="form-control">
                              </div>
                        </div>
                    </div>

                </div> 

                <div class="row">
                    {{-- <div class="col-md-6">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Number Title</label>
                            <div class="col-sm-8">
                                <textarea id="numberTitle" name="numberTitle" class="form-control"  rows="5" required >{{ $mailData->numberTitle }}</textarea>
                              </div>
                        </div>
                    </div> --}}

                    <div class="col-md-12">
                        <div class="form-group row required">
                            <label class="col-sm-2 col-form-label control-label">Social Media</label>
                            <div class="col-sm-10">
                                <textarea id="number" name="number" class="form-control  tinymce-editor"  rows="10" required >{{ $mailData->number }}</textarea>
                            </div>
                        </div>
                    </div>

                </div> 

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">Logo</label>
                            <div class="col-sm-8">
                                <input type="file" name="logo" value="logo" class="form-control" placeholder="logo"   id="logo"    style="margin-bottom: 10px; padding-bottom: 40px;">
                                @if ($errors->has('logo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                                @if ($mailData->logo)
                                    <table class="table table-responsive table-striped table-bordered table-hover mb-5 ml-2 mr-2">
                                        <tr>
                                            <td>
                                                <img id="photoUploadPreview" data-src="{{ empty($mailData->logo) ? '#' : url('/').$mailData->logo }}" alt="your image" class="lozad magnificPopup"  data-mfp-src="{{ empty($mailData->logo) ? '#' : url('/').$mailData->logo }}" 
                                                    style=" min-width: 50px !important; min-height: 50px !important; max-width: 100px !important; max-height: 100px !important;   border-radius: 0% !important; "  alt="image"/>
                                            </td>
                                            <td>
                                                <a href="{{ route('mailsettingslogodelete') }}" class=" tooltipster" title="Delete selected file?" >
                                                    <i class="fa fa-trash fa-lg " style="color : red;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>                                                
                                @endif
                            </div>
                        </div>
                    </div>

                </div> 
                

                <div class="row offset-sm-5">
                    <button   type="submit"   class="btn btn-success mr-2 ">Save</button>
                </div>

            </form>

        </div>
    </div>
    
</div>



{{-- Email body table --}}
{{-- Email body table --}}
<div class="content-wrapper" style="min-height: 0px;" id="emailbodytable">
    <div class="card">
      <div class="card-body" style="overflow-x:auto !important; ">
  
  
          <h4 class="card-title" style="text-align: center;">Email Body</h4>
  
          <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#emailBodySaveConfirmationModal" ><span>+ Create New Email Body</span></a>
          
  
          {{-- data table start --}}
          {{-- data table start --}}
          <table id="datatable2" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">S/L</th>
                        <th scope="col">Email Body Title</th>
                        <th scope="col">Email Body</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                     @foreach ($emailbodyData as $emailbody)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$emailbody->emailBodyTitle}}</td>
                            <td>{{$emailbody->emailBody}}</td>
                            <td id="tdtableaction">
  
                               <div class="d-inline-block">
                                    <a role="button" href="#"   data-toggle="modal" data-target="#emailbodyUpdateModal"  
  
                                        data-emailbodyid='{{ $emailbody->emailBodyId }}' 
                                        data-emailbodytitle='{{ $emailbody->emailBodyTitle }}' 
                                        data-emailbody='{{ $emailbody->emailBody }}' 
  
                                     title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                                </div>
  
  
                                <div class="d-inline-block tooltipster" title="Delete selected record?">
                                    <form  method="post" action="{{ route('emailbodyDelete', $emailbody->emailBodyId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
  {{-- Email body table --}}
  {{-- Email body table --}}



  

<!-- Email Body  Save Modal -->
<!-- Email Body  Save Modal -->
<div class="modal fade" id="emailBodySaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="emailBodySaveConfirmationModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title offset-5" id="emailBodySaveConfirmationModal">Add An Email Body</h5>
        </div>
        <div class="modal-body" style="margin-top: -4vw;">
  
                <form class="form-horizontal" method="POST"  action="{{ route('emailbodyInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                  {{ csrf_field() }}
  
                      <br>
                        <p class="card-description">
                        </p>
                          <div>
                              <div class="col-md-12">
                                <div class="form-group row required">
                                  <label class="col-sm-4 col-form-label control-label"> Email Body Title</label>
                                  <div class="col-sm-8">
                                    <textarea id="emailBodyTitle" name="emailBodyTitle" class="form-control"  rows="5" required ></textarea>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-12">
                                <div class="form-group row required">
                                  <label class="col-sm-4 col-form-label control-label"> Email Body</label>
                                  <div class="col-sm-8">
                                    <textarea id="emailBody" name="emailBody" class="form-control"  rows="5" required ></textarea>
                                  </div>
                                </div>
                              </div>
  
                              
  
  
                              <button data-toggle="modal"   type="submit"   class="btn btn-success mr-2 float-right">Save</button>
  
                              <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                          </div>
  
                  </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Email Body  Save Modal -->
  <!-- Email Body  Save Modal -->
  
  
  
  
  <!-- Email Body Edit Modal -->
  <!-- Email Body Edit Modal -->
  <div class="modal fade" id="emailbodyUpdateModal" tabindex="-1" role="dialog" aria-labelledby="emailbodyUpdateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title offset-5" id="emailbodyUpdateModal">Update Email Body</h5>
        </div>
        <div class="modal-body" style="margin-top: -2vw;">
                <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('emailbodyUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                            {{method_field('put')}}
                            {{ csrf_field() }}
  
                            <input type="hidden" name="emailBodyId" id="emailBodyId" value="">
  
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Email Body Title</label>
                                <div class="col-sm-8">
                                    <textarea id="emailBodyTitle" name="emailBodyTitle" class="form-control"  rows="5" required ></textarea>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group row required">
                                  <label class="col-sm-4 col-form-label control-label">Email Body</label>
                                  <div class="col-sm-8">
                                    <textarea id="emailBody" name="emailBody" class="form-control"  rows="5" required ></textarea>
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
  <!-- Email Body Edit Modal -->
  <!-- Email Body Edit Modal -->
  
  
  


<script type="text/javascript">
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
  
    $("#logo").change(function() 
    {
      readURL(this);
    });
  
</script>

<style>
  @media (max-width: 767px) {
        h2{
            font-size: 22px !important;
        }
        h3{
            font-size: 20px !important;
        }
    }
</style>




@endsection