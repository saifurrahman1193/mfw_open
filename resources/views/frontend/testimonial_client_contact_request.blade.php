@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Testimonial Client Contact Requests')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script> 



@section('page_content')


<script type="text/javascript">
  $(function(){
      $('#sendingMailModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) ;

          var testimonial_contact_request_id = button.data('testimonial_contact_request_id') ;
          var testimonialClientName = button.data('testimonialclientname') ;
          var requesterName = button.data('requestername') ;
          var requesterEmail = button.data('requesteremail') ;
          

          var modal = $(this);

          modal.find('.modal-body #testimonial_contact_request_id').val(testimonial_contact_request_id);
          modal.find('.modal-body #testimonialClientName').val(testimonialClientName);
          modal.find('.modal-body #requesterName').val(requesterName);
          modal.find('.modal-body #requesterEmail').val(requesterEmail);
      });
  });
</script>



<div class="content-wrapper" style="min-height: 0px; margin-top: -20px">
  <div class="card">
    <div class="card-body">


      <h4 class="card-title" style="text-align: center;">Testimonial Client Contact Requests</h4>



      <table id="datatable1WScrollcustom" class="table table-striped table-bordered table-hover " >
            <thead>
                <tr class="bg-primary text-light">
                    <th scope="col">S/L</th>
                    <th scope="col">Requester</th>
                    <th scope="col">Registered?</th>
                    <th scope="col">Testimonial Client</th>
                    <th scope="col">Testimonial</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            

            <tbody>
                @foreach ($testimonial_contact_request_data->sortByDesc('testimonial_contact_request_id') as $testimonial_contact_request)
                  <tr>
                    <td>{{ $testimonial_contact_request->testimonial_contact_request_id }}</td>

                    <td>
                      <ul class="list-group ">
                          <li class="list-group-item  list-group-item-action">
                            @if ($testimonial_contact_request->requesterId != null)
                              <a href="{{'/customers/customerProfileUpdate/'.$testimonial_contact_request->requesterId}}" target="_blank" rel="noopener noreferrer">
                                {{ $testimonial_contact_request->requesterName }}
                              </a>
                            @else
                              {{ $testimonial_contact_request->requesterName }}
                            @endif
                          </li>
                          <li class="list-group-item  list-group-item-action">{{ $testimonial_contact_request->requesterEmail }}</li>
                          @if ($testimonial_contact_request->requesterId != null)
                            <li class="list-group-item  list-group-item-action">
                                <a class="btn btn-success p-2" href="{{'/report/allcustomersdata?customerId='.$testimonial_contact_request->requesterId}}" target="_blank"><i class="fa fa-bar-chart"></i> Customer Data Report</a>
                            </li>
                          @endif

                          <li class="list-group-item  list-group-item-action">
                            {{ YmdTodmYPm($testimonial_contact_request->created_at) }}
                          </li>
                      </ul>
                    </td>

                    <td>
                      @if ($testimonial_contact_request->requesterId != null)
                        <span class="text-success">Registered</span>
                        @else
                        <span class="text-danger">Unregistered</span>
                      @endif
                    </td>

                    <td>
                      <ul class="list-group ">
                          <li class="list-group-item  list-group-item-action">{{ $testimonial_contact_request->testimonialClientName }}</li>
                          <li class="list-group-item  list-group-item-action">{{ $testimonial_contact_request->testimonialClientEmail }}</li>
                      </ul>
                    </td>

                    <td>
                      <ul class="list-group ">
                          <li class="list-group-item  list-group-item-action {{ $testimonial_contact_request->visibility==1 ? 'list-group-item-success': 'list-group-item-danger' }}">
                            {{ $testimonial_contact_request->visibility_type }}
                          </li>
                          <li class="list-group-item  list-group-item-action">  {{ $testimonial_contact_request->testimonial }}</li>
                          <li class="list-group-item  list-group-item-action">  {{ $testimonial_contact_request->testimonialCN }}</li>
                          <li class="list-group-item  list-group-item-action">  {{ $testimonial_contact_request->testimonialRU }}</li>
                      </ul>
                    </td>
                    <td>

                      <ul class="list-group ">
                          @if ($testimonial_contact_request->isMailSent)
                            <li class="list-group-item  list-group-item-action">Email Already Sent</li>
                          @endif
                          <li class="list-group-item  list-group-item-action">
                            <a href="#"  class="btn btn-primary p-2" data-toggle="modal"  data-target="#sendingMailModal" data-testimonial_contact_request_id="{{ $testimonial_contact_request->testimonial_contact_request_id }}" data-testimonialclientname="{{ $testimonial_contact_request->testimonialClientName }}" data-requestername="{{ $testimonial_contact_request->requesterName }}" data-requesteremail="{{ $testimonial_contact_request->requesterEmail }}" >Send Email
                              <i class="fa fa-paper-plane" aria-hidden="true"></i>
                            </a>
                          </li>
                          <li class="list-group-item  list-group-item-action text-center">
                            <div class="d-inline-block tooltipster" title="Delete The request?" style="cursor: pointer;">
                                <form  method="post" 
                                action="{{ route('testimonial_client_contact_request_delete',  $testimonial_contact_request->testimonial_contact_request_id)}}"  onsubmit="return confirm('Do you really want to proceed?');">
                                  {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" value="approved" class="btn btn-link" >
                                        <i class="fa fa-trash text-danger fa-lg" ></i>
                                    </button>
                                </form>
                            </div>
                          </li>

                          <li class="list-group-item  list-group-item-action text-center">
                            

                            @if ($testimonial_contact_request->isBlocked == 1)
                              <span class="text-danger font-weight-bold ">Blocked</span>
                            @else
                              <div class="d-inline-block tooltipster" title="Block this person?" style="cursor: pointer;">
                                  <form  method="post" 
                                  action="{{ route('block_a_person_by_mail_W_redirect')}}"  onsubmit="return confirm('Do you really want to proceed?');">
                                      {{ csrf_field() }}
                                      <input type="text" name="name" value="{{ $testimonial_contact_request->requesterName }}" hidden>
                                      <input type="text" name="email" value="{{ $testimonial_contact_request->requesterEmail }}" hidden>
                                      <input type="number" name="blockTypeId" value="3" hidden>
                                      <button type="submit" value="approved" class="btn btn-link" >
                                          <i class="fa fa-ban text-danger fa-lg" ></i>
                                      </button>
                                  </form>
                              </div>
                            @endif
                          </li>

                      </ul>
                      
                    </td>
                  </tr>
                @endforeach
            </tbody>
      </table>

    </div>
  </div>
</div>





<!-- sending mail Modal -->
<!-- sending mail Modal -->
<div class="modal fade" id="sendingMailModal" tabindex="-1" role="dialog" aria-labelledby="sendingMailModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title offset-5" >Sending Mail</h5>
        </div>
        <div class="modal-body" style="margin-top: -2vw;">
                <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('testimonial_send_mail_to_requester') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                            {{ csrf_field() }}
  
                            <input type="hidden"  name="testimonial_contact_request_id" id="testimonial_contact_request_id" value="">
                            <input type="hidden"  name="testimonialClientName" id="testimonialClientName" value="">
                            <input type="hidden"  name="requesterName" id="requesterName" value="">
                            <input type="hidden"  name="requesterEmail" id="requesterEmail" value="">
                            
  
                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Email Body Title</label>
                                <div class="col-sm-8">
                                    <select class="form-control m-bot15" name="emailBodyId" id="emailBodyId"  >
                                        <option value="">--Select Email Body--</option>
                                        @foreach(DB::table('emailbody')->get() as $emailbody)
                                            <option value="{{ $emailbody->emailBodyId }}"
                                                    data-emailbody="{{ $emailbody->emailBody }}"
                                                >
                                              {{ title_case($emailbody->emailBodyTitle)}}
                                            </option> 
                                        @endforeach   
                                    </select>
                                </div>
                              </div>
                            </div>
  
  
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Email Body</label>
                                <div class="col-sm-8">
                                  <textarea name="emailBody" id="emailBody"  rows="10" class="form-control" required></textarea>
                                </div>
                              </div>
                            </div>
  
  
  
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4 mt-2">
  
                                    <button type="submit" class="btn btn-success float-right">
                                        Send Mail
                                    </button>
                                    
                                    <a>
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
  <!-- sending mail Modal -->
  <!-- sending mail Modal -->



<script>
    $(document).ready(function(){
        $('select[name="emailBodyId"]').on('change', function(){
            var emailBodyId = $("#emailBodyId").val();
            var emailBody =  $('select#emailBodyId').find(':selected').data('emailbody');
            // console.log(emailBody);
            $('#emailBody').val(emailBody);
        });
    });  
</script>
  

<script>
  $(document).ready(function() {
      // with sxrol-x
      $('#datatable1WScrollcustom').DataTable( {
          "pagingType": "simple_numbers",
          "order": [[ 0, "desc" ]],
          language: {
              search: "_INPUT_",
              searchPlaceholder: "Search..."
          },
          "scrollX": true,
          "scrollY": false,
          // "ordering": false,
          "responsive": true,
          "autoWidth": false
      } );
  } );
</script>


@endsection