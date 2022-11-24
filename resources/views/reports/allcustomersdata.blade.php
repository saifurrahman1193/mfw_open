@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'All Customers Data Report')


<script src="{{ asset('js/jquery.min.js') }}"></script> 
@section('page_content')


<script type="text/javascript">
    $(function(){
        $('#sendingMailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;

            var userGenericInquiryId = button.data('usergenericinquiryid') ;

            var modal = $(this);

            modal.find('.modal-body #userGenericInquiryId').val(userGenericInquiryId);
        });
    });
</script>


<div class="content-wrapper" style="min-height: 0px;">
    @if (session('successMsg'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('successMsg') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center;">All Cusomers Data Report</h4>

            <div class="col-md-12" >
                <div class="form-group row">
                    <div class="col-sm-6">
                        <select class="form-control m-bot15 " name="customerId" id="customerId"  onchange ="location = this.options[this.selectedIndex].value;">
                            
                            <option value="?">--Select Customer--</option>
                            <option value="?">All</option>
                            @foreach (DB::table('users')->get() as $user)
                                <option  value="?customerId={{ $user->id }}" {{request('customerId')==$user->id ? "selected":""}}>
                                    {{ $user->name.' '.$user->email.' '.$user->phone }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <table id="datatableAllCustomersDataWScroll" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">Serials</th>
                        <th scope="col">Client Information</th>
                        <th scope="col">Price Inquiry</th>
                        <th scope="col">Cart</th>
                        <th scope="col">Complete Orders</th>
                        <th scope="col">Incomplete Orders</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<!-- Sending Mail Modal -->
<!-- Sending Mail Modal -->
<div class="modal fade" id="sendingMailModal" tabindex="-1" role="dialog" aria-labelledby="sendingMailModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title offset-5" >Sending Mail</h5>
        </div>
        <div class="modal-body" style="margin-top: -2vw;">
                <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('allcustomersdatareportpriceinquireremidermailsend') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                            {{ csrf_field() }}
  
                            <input type="hidden" name="userGenericInquiryId" id="userGenericInquiryId" value="">
  
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Email Body Title</label>
                                <div class="col-sm-8">
                                    <select class="form-control m-bot15" name="emailBodyId" id="emailBodyId" required >
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
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Email Body</label>
                                <div class="col-sm-8">
                                  <textarea name="emailBody" id="emailBody"  rows="10" class="form-control"></textarea>
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
  <!-- Sending Mail Modal -->
  <!-- Sending Mail Modal -->


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
    // var exportableColumns = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28,30 ];
    $(document).ready( function () {
        $('#datatableAllCustomersDataWScroll').removeAttr('width').DataTable({
            // fixedHeader: {
            //     header: true,
            // },
            processing: true,
            serverSide: true,
            "bSort": true,
            "responsive": true,
            // "autoWidth": false,
            "scrollX": true,
            "scrollY": false,
            language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                },
            "pagingType": "simple_numbers",
            dom: 'lBfrtip',
            buttons: [
                // 'excel',
                {
                    extend: 'excelHtml5',
                    // exportOptions: {
                    //     columns: exportableColumns
                    // }
                },
                //  'csv' ,
                {
                    extend: 'csvHtml5',
                    // exportOptions: {
                    //     columns: exportableColumns
                    // }
                },
                'print',
             ],
            columnDefs: [
                { targets: 1 ,width: 150 },
                { targets: 2 ,width: 1000 },
                { targets: 3 ,width: 300 },
                { targets: 4 ,width: 300 },
                { targets: 5 ,width: 300 },
            ],

            ajax: "{{url('/')}}"+"/api/report/allcustomersdatagenerator"+"{{request()->has('customerId')? '?customerId='.request('customerId'): '' }}",

            datatype:'json',
            type: 'get',
            lengthMenu: [
            [ 10, 25, 50, 100, 500,-1 ],
                [ '10 rows', '25 rows', '50 rows','100 rows', '500 rows','Show all' ]
            ],
            columns: [
                        { data: 'id', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return data;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'clientInfo', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let customerId=dataArray[0];
                                    let name=dataArray[1];
                                    let email=dataArray[2];
                                    let country=dataArray[3];
                                    let phone=dataArray[4];
                                    let registrationDate=dataArray[5];
                                    let isCreatedByAdmin=dataArray[6];
                                    let isDeleted=dataArray[7];

                                    if (isCreatedByAdmin==1) {
                                        isCreatedByAdmin='Admin';
                                    } else {
                                        isCreatedByAdmin='';
                                    }
                                    if (isDeleted==1) {
                                        isDeleted='Deleted Account';
                                    } else {
                                        isDeleted='';
                                    }

                                    return   '<a href="/customers/customerProfileUpdate/'+customerId+'" target="_blank" >'+name+'</a>'+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            email+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            'Created by : <strong>'+ isCreatedByAdmin+'</strong>'+
                                            '<br><br>'+
                                            '<strong style="color:red;">'+ isDeleted+'</strong>'+
                                            '<br><br>'+
                                            country+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            phone+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            registrationDate+
                                            '<br><br>'
                                     ;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },

                         { data: 'priceInquiryDetails', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let priceinquirylist = '';

                                    let userId = '';
                                    let genericbrand = '';
                                    let priceinquirydate = '';
                                    let genericname = '';
                                    let genericcompany = '';


                                    let priceInquiryArray=data.split('::::');
                                    // console.log(priceInquiryArray)

                                    
                                    priceInquiryArray.forEach(priceInquiry => {
                                        let priceinquiry=priceInquiry.split('::');

                                        userId=priceinquiry[0];
                                        genericbrand=priceinquiry[1];
                                        priceinquirydate=priceinquiry[2];
                                        genericname=priceinquiry[3];
                                        genericcompany=priceinquiry[4];
                                        userGenericInquiryId=priceinquiry[5];
                                        sendingMailCount=priceinquiry[6];
                                        dosageForm=priceinquiry[7];
                                        priceinquirydateHour=priceinquiry[8];
                                        priceinquirydateMinute=priceinquiry[9];
                                        priceinquirydatePM=priceinquiry[10];
                                         
                                        priceinquirylist = priceinquirylist+ "<tr>"+

                                                        "<td>"+"<a href='/customers/productPricesForUsersAssign/"+userId+"' target='_blank'>"+genericbrand+"</a>"+'<span style="color:white;"> || </span>'+"</td>"+
                                                        "<td>"+priceinquirydate+'<span style="color:white;"> || </span>'+"</td>"+
                                                        "<td>"+priceinquirydateHour+':'+priceinquirydateMinute+' '+priceinquirydatePM+'<span style="color:white;"> || </span>'+"</td>"+
                                                        "<td>"+genericname+'<span style="color:white;"> || </span>'+"</td>"+
                                                        "<td>"+genericcompany+'<span style="color:white;"> || </span>'+"</td>"+
                                                        "<td>"+dosageForm+'<span style="color:white;"> || </span>'+"</td>"+
                                                        "<td>"+

                                                            "<a href='#'  class='btn btn-primary p-2' data-toggle='modal'  data-target='#sendingMailModal' "+

                                                            "data-usergenericinquiryid='"+userGenericInquiryId+"'"

                                                            +">Send Email <i class='fa fa-paper-plane' aria-hidden='true'></i></a>"

                                                        +'<span style="color:white;"> || </span>'+"</td>"+
                                                        "<td>"+(sendingMailCount>0?("Sent "+sendingMailCount+" times"):"")+"</td>"+
                                                        "<td>"+'<a class="btn btn-primary p-2" href="/customers/productPricesForUsersAssign/'+userId+'" target="_blank">Assign Price</a>'+"</td>"+

                                                        "</tr>";

                                    });   

                                    return "<table class='table table-bordered'>  <thead><tr> <th scope='col'>Generic Brand</th> <th scope='col'>Inquiry Date</th> <th scope='col'>Time</th>  <th scope='col'>Generic Name</th> <th scope='col'>Generic Company</th> <th scope='col'>Dosage Form</th> <th scope='col'>Sending Mail</th> <th scope='col'>Is Sent ?</th> <th scope='col'>Assign Price</th> </tr> </thead> <tbody>"+
                                    priceinquirylist
                                    +" </tbody></table>";
                                     
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },

                         { data: 'cartDeatails', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let cartId='';
                                    let cartlist='';
                                    
                                    let cartArray=data.split(':::');
                                    // console.log(cartArray)

                                    
                                    cartArray.forEach(cart => {
                                        let cartDetailsArray=cart.split('::');

                                        let cartId=cartDetailsArray[0];
                                        let cartnumber=cartDetailsArray[1];
                                        let created_at=cartDetailsArray[2];
                                        let cartDetails=cartDetailsArray[3];
                                         
                                        cartlist = cartlist+ "<li class='list-group-item list-group-item-primary'>"+"<a href='/cart/cartListAdmin?cartId="+cartId+"' target='_blank'>"+cartnumber+"</a>"+
                                            " ("+created_at+")"
                                            +'<span style="color:white;"> || </span>'+"</li>";

                                        let cartDetailItem = '';

                                        let cartDetailItemsArray=cartDetails.split(':');
                                        cartDetailItemsArray.forEach(item => {
                                            cartDetailItem =cartDetailItem+ "<li class='list-group-item list-group-item-action'>"+item+'<span style="color:white;"> || </span>'+"</li>";
                                        });
                                        cartlist = cartlist+ cartDetailItem;

                                    });   

                                    return "<h4>Total orders : "+cartArray.length+"</h4>"+'<span style="color:white;"> || </span>'+"<br><br>"
                                                    +"<ul class='list-group'>"+cartlist+"</ul>";
                                     
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },



                         { data: 'cartDeatailsOfPaymentCompleted', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let cartId='';
                                    let cartlist='';
                                    let totalPurchasedAmountSum=0;
                                    
                                    let cartArray=data.split(':::');
                                    // console.log(cartArray)

                                    let totalPurchasedProductsCalculated = 0;
                                    
                                    cartArray.forEach(cart => {
                                        let cartDetailsArray=cart.split('::');

                                        let cartId=cartDetailsArray[0];
                                        let cartnumber=cartDetailsArray[1];
                                        let created_at=cartDetailsArray[2];
                                        let cartDetails=cartDetailsArray[3];
                                        let totalPurchasedAmount=cartDetailsArray[4];
                                        totalPurchasedAmountSum +=parseInt(totalPurchasedAmount);
                                         
                                        cartlist = cartlist+ "<li class='list-group-item list-group-item-primary'>"+"<a href='/cart/cartListAdmin?cartId="+cartId+"' target='_blank'>"+cartnumber+"</a>"+
                                            " ("+created_at+")"
                                            +'<span style="color:white;"> || </span>'+"</li>";

                                        let cartDetailItem = '';

                                        let cartDetailItemsArray=cartDetails.split(':');
                                        cartDetailItemsArray.forEach(item => {
                                            cartDetailItem =cartDetailItem+ "<li class='list-group-item list-group-item-action'>"+item+'<span style="color:white;"> || </span>'+"</li>";
                                            totalPurchasedProductsCalculated += 1;
                                        });
                                        cartlist = cartlist+ cartDetailItem;

                                    });   

                                    return  "<h4>Total completed orders: "+cartArray.length+"</h4>"+'<span style="color:white;"> || </span>'+"<br><br>"
                                            +"<h4>Total purchased products : "+totalPurchasedProductsCalculated+"</h4>"+'<span style="color:white;"> || </span>'+"<br><br>"
                                            +"<h4>Total purchased amount : USD "+totalPurchasedAmountSum+"</h4>"+'<span style="color:white;"> || </span>'+"<br><br>"
                                                    +"<ul class='list-group'>"+cartlist+"</ul>";
                                     
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },

                         { data: 'cartDeatailsOfPaymentInCompleted', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let cartId='';
                                    let cartlist='';
                                    
                                    let cartArray=data.split(':::');
                                    // console.log(cartArray)

                                    
                                    cartArray.forEach(cart => {
                                        let cartDetailsArray=cart.split('::');

                                        let cartId=cartDetailsArray[0];
                                        let cartnumber=cartDetailsArray[1];
                                        let created_at=cartDetailsArray[2];
                                        let cartDetails=cartDetailsArray[3];
                                         
                                        cartlist = cartlist+ "<li class='list-group-item list-group-item-primary'>"+"<a href='/cart/cartListAdmin?cartId="+cartId+"' target='_blank'>"+cartnumber+"</a>"+
                                            " ("+created_at+")"
                                            +'<span style="color:white;"> || </span>'+"</li>";

                                        let cartDetailItem = '';

                                        let cartDetailItemsArray=cartDetails.split(':');
                                        cartDetailItemsArray.forEach(item => {
                                            cartDetailItem =cartDetailItem+ "<li class='list-group-item list-group-item-action'>"+item+'<span style="color:white;"> || </span>'+"</li>";
                                        });
                                        cartlist = cartlist+ cartDetailItem;

                                    });   

                                    return  "<h4>Total incomplete orders : "+cartArray.length+"</h4>"+'<span style="color:white;"> || </span>'+"<br><br>"
                                                    +"<ul class='list-group'>"+cartlist+"</ul>";
                                     
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         


                         

                         
                    ],
        });
     });
</script>




{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
    $(document).ready(function() {
  
       $('#customerId').select2({
          placeholder: {
            id: '123', // the value of the option
            text: '--Select Date--'
          },
          // placeholder : "--Select Employee--",
          allowClear: true
       });
    });
</script>

<style>
    .table td, .table th {
        vertical-align: top;
    }
</style>
@endsection