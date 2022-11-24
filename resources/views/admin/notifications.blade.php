@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Notifications')

@section('page_content')

<script src="{{ asset('js/jquery.min.js') }}"></script>


<div class="content-wrapper" style="min-height: 0px;">

    <div class="card pt-3">
        <h4 class="card-title" style="text-align: center;">Notifications</h4>
        <div class="card-body" style="overflow-x: scroll;">
            
            <table id="datatable1" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">S/L</th>
                        <th scope="col">Notification</th>
                        <th scope="col">Read?</th>
                        <th scope="col">Date-Time</th>
                    </tr>
                </thead>
                
                <tbody>
                     @foreach ($notifications_admin->sortByDesc('created_at') as $notification)
                        <tr >
                            <td>{{$loop->index+1}}</td>
                            <td>
                                <a href="@if(isset($notification->customer_to_admin_contact) && $notification->customer_to_admin_contact != null )
                                  {{ route('customer_to_admin_contacts', ['customer_to_admin_contact'=>1, 'customer_to_admin_contactRequesterId'=>$notification->customer_to_admin_contactRequesterId]) }}
                                
                                @elseif($notification->contact_with_product_reviewer_request != null && $notification->contact_with_product_reviewer_requesterId != null && $notification->reviewId != null   )
                                  {{ route('contact_with_product_reviewer_requests', ['contact_with_product_reviewer_request'=>1, 'contact_with_product_reviewer_requesterId'=>$notification->contact_with_product_reviewer_requesterId, 'reviewId'=>$notification->reviewId]) }}
                                  
                                @elseif($notification->testimonialAdminToClientContactRequest != null && $notification->testimonialClientContactRequesterId != null && $notification->testimonialId != null   )
                                  {{ route('testimonial_client_contact_request', ['testimonialAdminToClientContactRequest'=>1, 'testimonialClientContactRequesterId'=>$notification->testimonialClientContactRequesterId, 'testimonialId'=>$notification->testimonialId]) }}
                
                                @elseif($notification->testimonialClientContactRequest != null && $notification->testimonialClientContactRequesterId != null && $notification->testimonialId != null   )
                                  {{ route('testimonial_client_contact_request', ['testimonialClientContactRequest'=>1, 'testimonialClientContactRequesterId'=>$notification->testimonialClientContactRequesterId, 'testimonialId'=>$notification->testimonialId]) }}
                
                                @elseif($notification->loginLimitCrosserId != null  )
                                  {{ route('customers.customers', ['customerId'=>$notification->loginLimitCrosserId, 'loginLimitCrosser'=>1]) }}
                                
                                @elseif($notification->passwordChagerId != null  )
                                  {{ route('customers.customers', ['customerId'=>$notification->passwordChagerId, 'passwordChagerId'=>$notification->passwordChagerId]) }}
                                
                                @elseif($notification->profileDeleterId != null  )
                                  {{ route('customers.customers', ['customerId'=>$notification->profileDeleterId, 'profileDeleterId'=>$notification->profileDeleterId]) }}
                
                                @elseif($notification->reviewId != null  )
                                  {{ route('customerReviews',['reviewId'=>$notification->reviewId]) }}
                                @elseif ($notification->inquirerId != null )
                                  {{ route('notifications.productPricesForUsers.assign', $notification->inquirerId) }}
                                @elseif($notification->cartId != null )
                                  {{ route('notifications.CartCreatedByCustomer', $notification->cartId) }}
                                  
                                @elseif($notification->registerUserId != null  )
                                  {{ route('customers.customers', ['customerId'=>$notification->registerUserId, 'registerUser'=>1]) }}
                                @elseif($notification->priceAddUpdateDeletedForUserId != null  )
                                  {{ route('admin.notifications.productPricesForUsers.assign', $notification->priceAddUpdateDeletedForUserId) }}
                
                                @elseif($notification->profileUpdaterId != null  )
                                  {{ route('profileUpdateNotificationsForAdmin', $notification->profileUpdaterId) }}
                
                                @elseif($notification->documentAdderId != null  )
                                  {{ route('documentAddedNotificationsForAdmin', $notification->documentAdderId) }}
                
                                @endif"  style="padding-left: 2%; padding-right: 2%;"
                                    target="_blank">
                                    {{$notification->message}}
                                    </a>
                            </td>
                            <td>
                                <span class="{{ ($notification->read_at != null) ? 'text-success': 'text-danger' }}">{{$notification->read_at ? 'Yes' : 'No'}}</span>
                            </td>
                            <td>
                                {{YmdTodmYPm($notification->created_at) }}
                            </td>
      
                        </tr>
                      @endforeach
                </tbody>
            </table>

            

        </div>
    </div>
</div>

@endsection