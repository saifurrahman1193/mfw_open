@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Approve Reviews')
@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>

<script type="text/javascript">
  $(function(){
    $('#reviewCommentEditModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) ;
          var reviewId = button.data('reviewid') ;
          var comment = button.data('comment') ;
          var modal = $(this);
          modal.find('.modal-body #reviewId').val(reviewId);
          modal.find('.modal-body #comment').val(comment);
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

        <h4 class="card-title" style="text-align: center;">Reviews</h4>

        {{-- <a href="{{ route('createrequisition') }}" class="btn btn-info " style="margin-bottom: 10px; "><span>+ Create new</span></a> --}}



            {{-- data table start --}}
            {{-- data table start --}}
            <table id="datatable1WScroll" class="table table-striped table-bordered table-hover"  >
                  <thead>
                      <tr class="bg-primary text-light">
                          <th scope="col">#</th>
                          <th scope="col">Approval</th>
                          <th scope="col">Reviewer</th>
                          <th scope="col">Registered?</th>
                          <th scope="col">Product</th>
                          <th scope="col">Rating</th>
                          <th scope="col">Comment</th>
                          <th scope="col">Time</th>
                          <th scope="col">Approval Status</th>
                      </tr>
                  </thead>
                  <tbody>
                       @foreach ($reviewData->sortByDesc('created_at') as $review)
                       
                            <tr>
                                  <td>{{$loop->index+1}}</td>
                                  <td id="tdtableaction">
                                    @if ($review->isApproved!=1)
                                      <div class="d-inline-block tooltipster" title="Approve The review!" >
                                          <form  method="post" 
                                          action="{{ route('customerReviewApprove',  $review->reviewId)}}"  onsubmit="return confirm('Do you really want to proceed?');">
                                            {{ csrf_field() }}
                                              <input type="hidden" name="_method" value="put">
                                              <button type="submit" value="approved" class="btn btn-link " >
                                                  <i class="fa fa-check text-success fa-lg " ></i>
                                              </button>
                                          </form>
                                      </div>

                                    @elseif($review->isApproved==1)
                                        <div class="d-inline-block tooltipster" title="Disapprove The review!" style="cursor: pointer;">
                                          <form  method="post" 
                                          action="{{ route('customerReviewDisapprove',  $review->reviewId)}}"  onsubmit="return confirm('Do you really want to proceed?');">
                                            {{ csrf_field() }}
                                              <input type="hidden" name="_method" value="put">
                                              <button type="submit" value="approved" class="btn btn-link" >
                                                  <i class="fa fa-ban text-danger fa-lg" ></i>
                                              </button>
                                          </form>
                                      </div>
                                    @endif

                                    <div class="d-inline-block tooltipster" title="Delete The review!" style="cursor: pointer;">
                                        <form  method="post" 
                                        action="{{ route('customerReviewDelete',  $review->reviewId)}}"  onsubmit="return confirm('Do you really want to proceed?');">
                                          {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" value="approved" class="btn btn-link" >
                                                <i class="fa fa-trash text-danger fa-lg" ></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="d-inline-block tooltipster" title="Edit comment!">
                                      <a class="btn  p-2" role="button" href="#"   data-toggle="modal" data-target="#reviewCommentEditModal"  
                                          data-reviewid='{{ $review->reviewId }}' 
                                          data-comment='{{ $review->comment }}' 
                                          title="Edit comment!">
                                          <i class="fa fa-edit  fa-lg" ></i>
                                        </a>
                                    </div>
                                    
                                 </td>
                                  <td>
                                      <ul class="list-group">
                                        @if($review->photoPath)
                                          <li class="list-group-item list-group-item-action"> 
                                            <img   data-src="{{ asset($review->photoPath ) }}" data-mfp-src="{{ asset($review->photoPath ) }}" class="img-responsive lozad picPath" alt="" allow="fullscreen" />
                                          </li>
                                        @endif
                                          <li class="list-group-item list-group-item-action"> 
                                            @if ($review->reviewerId)
                                              <a href="{{ route('customerProfileUpdate', $review->reviewerId)}}" target="_blank" >{{ $review->name }}</a>
                                            @else
                                              {{ $review->name }}
                                            @endif
                                          </li>
                                         

                                          <li class="list-group-item list-group-item-action"> 
                                            {{ $review->phoneCode.$review->phone }}
                                          </li>

                                        <li class="list-group-item list-group-item-action"> {{ $review->email }}</li>
                                        @if ($review->isCreatedByAdmin)
                                          <li class="list-group-item list-group-item-action">
                                            {{$review->isCreatedByAdmin==1? 'Created by  Admin':''}}
                                          </li>
                                        @endif
                                        @if ($review->isDeleted)
                                          <li class="list-group-item list-group-item-action">
                                              <strong style="color:red;">{{$review->isDeleted ? 'Deleted Account' : ''}}</strong>
                                          </li>
                                        @endif

                                        @if ($review->reviewerId)
                                          <li class="list-group-item list-group-item-action"> 
                                            <a class="btn btn-success p-2" href="/report/allcustomersdata?customerId={{$review->reviewerId}}" target="_blank">Customer Data Report</a>
                                          </li>
                                        @endif


                                      </ul>
                                  </td>

                                  <td>
                                    @if ($review->reviewerId != null)
                                      <span class="text-success">Registered</span>
                                      @else
                                      <span class="text-danger">Unregistered</span>
                                    @endif
                                  </td>

                                  <td>
                                      <ul class="list-group">
                                        <li class="list-group-item list-group-item-action"> <img  data-mfp-src="{{ asset($genericbrandpicData->where('genericBrandId', $review->genericBrandId )->pluck('picPath')->first() ) }}"   data-src="{{ asset($genericbrandpicData->where('genericBrandId', $review->genericBrandId )->pluck('picPath')->first() ) }}" class="img-responsive lozad picPath" alt="" allow="fullscreen" /></li>
                                        <li class="list-group-item list-group-item-action"> {{ $review->genericBrand }}</li>
                                      </ul>
                                  </td>
                                  <td>{{$review->rating}}</td>
                                  <td>{{$review->comment}}</td>
                                  <td>{{Carbon\Carbon::parse($review->created_at)->format('d-M-Y g:i A')}}</td>
                                  <td class="{{ $review->isApproved ==1 ? 'text-success' : 'text-danger' }} font-weight-bold"  >{{$review->isApprovedStatus}}</td>
                                  
                              </tr>
                        @endforeach
                     
                  </tbody>
              </table>
            {{-- data table end --}}
            {{-- data table end --}}

            </div>
          </div>
</div>




<!-- Review comment edit modal -->
<!-- Review comment edit modal -->
<div class="modal fade" id="reviewCommentEditModal" tabindex="-1" role="dialog" aria-labelledby="reviewCommentEditModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="reviewCommentEditModal">Review comment edit</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

          <form class="form-horizontal" method="POST"  action="{{ route('customercommenteditfromadmin') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
              {{ csrf_field() }}
              <input type="number" name="cartId" id="cartId"  value="" hidden> 
              <br>
              <div>
                  <input type="number" class="form-control" id="reviewId" name="reviewId" value="" hidden>

                  <div class="col-md-12">
                    <div class="form-group row ">
                      <label class="col-sm-4 col-form-label control-label">Comment</label>
                      <div class="col-sm-8">
                        <textarea id="comment" name="comment" value="" class="form-control" placeholder="Delivery Comment"    rows="10"></textarea>
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
<!-- Review comment edit modal -->
<!-- Review comment edit modal -->

<script type="text/javascript">
  $(document).ready(function() {
    $('.picPath').magnificPopup({type:'image'});
  });
</script>



@endsection