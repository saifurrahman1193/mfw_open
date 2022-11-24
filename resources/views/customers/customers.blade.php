@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Customers')


@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>




<style type="text/css" media="screen">
  fieldset{
   border:1px solid #cccc;
   padding: 8px;
}
</style>




   <div class="content-wrapper" style="min-height: 0px;">
    <div class="card">
      <div class="card-body">
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



      

          <h4 class="card-title" style="text-align: center;">Customers</h4>

            {{-- <a href="{{ route('user.create') }}"  class="btn btn-default " style="margin-bottom: 10px; "  ><span>+ Create New User</span></a> --}}


           <table id="datatable1WScroll" class="table table-bordered  table-striped table-hover " width="100%">
              <thead >
              <tr class="bg-primary text-light">
                <th class="text-center">Serial</th>
                <th class="text-center">Action</th>
                <th class="text-center">Name</th>
                <th class="text-center">Send Mail</th>
                <th class="text-center">Registry Date</th>
                <th class="text-center">Photo</th>
                <th class="text-center">Website</th>
                <th class="text-center">Email</th>
                <th class="text-center">Email Verified?</th>
                <th class="text-center">Phone</th>
                <th class="text-center">Country</th>
                <th class="text-center">City</th>
                <th class="text-center">Street/House</th>
                <th class="text-center">Postal Code</th>
                <th class="text-center">Patient Name</th>
                <th class="text-center">Taking For Relationship</th>
                <th class="text-center">Social Media</th>


                <th class="text-center">User Agent</th>
                <th class="text-center">IP</th>
                <th class="text-center">Country Based on IP</th>
                
                <th class="text-center"># Cahnged password</th>
                <th class="text-center">Enable Customer</th>
                <th class="text-center">Created by</th>
                
   
                
              </tr>
              </thead>
              <tbody>

              @foreach ($users->sortByDesc('created_at') as $user)
              

                  <tr >
                      <td>{{$loop->index+1}}</td> 
                      <td id="tdtableaction"  style="width: 100px !important;">

                        <div class="d-inline-block tooltipster" title="Edit User Information?">
                            <a role="button" href="{{ route('customerProfileUpdate', $user->id) }}" ><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                        </div>

                        @if ($user->isDeletable>0)
                          <div class="d-inline-block tooltipster" title="Delete The User?">
                              <form  method="post" action="/superadmin/user/{{$user->id}}"  onsubmit="return confirm('Do you really want to proceed?');">
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
                    <td>
                      <ul class="list-group">
                        <li class="list-group-item list-group-item-action"><a href="{{route('customerProfileUpdate', $user->id)}}" target="_blank" > {{$user->name}}</a></li>
                        @if ($user->isDeleted)
                          <li class="list-group-item list-group-item-action"><strong style="color:red;">{{$user->isDeleted ? 'Deleted Account' : ''}}</strong></li>
                        @endif
                        <li class="list-group-item list-group-item-action"><a class="btn btn-success p-2" href="/report/allcustomersdata?customerId={{$user->id}}" target="_blank"><i class="fa fa-bar-chart"></i> Customer Data Report</a></li>
                      </ul>
                    </td>
                    <td>
                      <ul class="list-group ">
                          @if ($user->isEmailSent)
                            <li class="list-group-item  list-group-item-action">Email Already Sent</li>
                          @endif
                          <li class="list-group-item  list-group-item-action">
                            <a href="#"  class="btn btn-primary p-2" data-toggle="modal"  data-target="#sendingMailModal" data-userid="{{ $user->id }}" >Send Email
                              <i class="fa fa-paper-plane" aria-hidden="true"></i>

                            </a>
                          </li>
                      </ul>
                    </td>
                      <td>
                        {{\Carbon\Carbon::parse($user->created_at)->format('d-m-Y g:i A')}}
                      </td>
                      <td>
                        @if ($user->photoPath)
                          <img src="{{ asset($user->photoPath) }}" >
                        @endif
                      </td>
                      
                      <td>{{$user->website}}</td>
                      <td>{{$user->email}}</td>
                      <td> <span class="{{ $user->isEmailVerified==1? 'text-success' : 'text-danger'}} font-weight-bold">{{$user->isEmailVerified==1? "Verified" : "Not Verified"}}</span></td>
                      <td>{{$user->phoneCode.$user->phone}}</td>
                      <td>{{$user->country}}</td>
                      <td>{{$user->cityTownDivision}}</td>
                      <td>{{$user->streethouse}}</td>
                      <td>{{$user->postalCode}}</td>
                      <td>{{$user->patientName}}</td>
                      <td>{{$user->takingForRelationship}}</td>
                      <td>{{$user->socialMedia}}</td>
                      <td>{{$user->userAgent}}</td>
                      <td>{{$user->ip}}</td>
                      <td>{{$user->countrybasedonip}}</td>
                      
                      <td  class="{{ $user->passwordChangedCount>0 ? 'text-danger font-weight-bold' : ''}}">{{$user->passwordChangedCount}}</td>
                      <td>
                        @if ($user->passwordChangedCount)
                          <a role="button" href="{{ route('customersEnable', $user->id) }}" >Enable Customer</a>
                          <br>
                          <br>
                          <span class="tooltipster"  style="color: #7DCCFC;" title="<li>If user change password 3 or more times then user is disabled. </li><li>Click to enable the user.</li>">
                            <i class="fa fa-info-circle"></i>
                          </span>
                        @endif
                      </td>

                      <td>{{$user->isCreatedByAdmin==1? 'Admin':''}}</td>

                      
                      

                      

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
                  <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('admin_to_customer_send_mail') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                      {{ csrf_field() }}

                      <input type="hidden"  name="userId" id="userId" value="">
                      

                      <div class="col-md-12">
                        <div class="form-group row ">
                          <label class="col-sm-4 col-form-label control-label">Email Body Title</label>
                          <div class="col-sm-8">
                              <select class="form-control m-bot15" name="emailBodyId" id="emailBodyId"  >
                                  <option value="">--Select Email Body--</option>
                                  @foreach(DB::table('emailbody')->get() as $emailbody)
                                      <option value="{{ $emailbody->emailBodyId }}"
                                              data-emailbodytitle="{{ $emailbody->emailBodyTitle }}"
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
                          <label class="col-sm-4 col-form-label control-label">Email Subject</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" id="emailSubject" name="emailSubject" required>
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
              var emailSubject =  $('select#emailBodyId').find(':selected').data('emailbodytitle');
              var emailBody =  $('select#emailBodyId').find(':selected').data('emailbody');
              // console.log(emailBody);
              $('#emailSubject').val(emailSubject);
              $('#emailBody').val(emailBody);
          });
      });  
  </script>



  <script type="text/javascript">
    $(function(){
        $('#sendingMailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;
  
            var userId = button.data('userid') ;
            
  
            var modal = $(this);
  
            modal.find('.modal-body #userId').val(userId);
        });
    });
  </script>


@endsection

