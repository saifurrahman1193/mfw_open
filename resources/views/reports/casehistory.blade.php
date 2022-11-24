@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Case History')


<script src="{{ asset('js/jquery.min.js') }}"></script> 
@section('page_content')



<script type="text/javascript">
    $(function(){
        $('#sendingMailModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;

            var cartId = button.data('cartid') ;

            var modal = $(this);

            modal.find('.modal-body #cartId').val(cartId);
        });
    });
</script>




<script type="text/javascript">

    $(function(){
      $('#remindingAlarmEditModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) ;
            var cartId = button.data('cartid') ;
            console.log('cartId = '+ cartId)
            var modal = $(this);
            modal.find('.modal-body #remindingAlarmEditModalcartId').val(cartId);
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
            <h4 class="card-title" style="text-align: center;">Case History</h4>

            <a href="{{ route('report.casehistory')}}" class="btn btn-secondary float-right ml-2">Reset</a>
            <a href="{{ route('report.casehistory').'?date='.date('Y-m-d') }}" class="btn btn-primary float-right">Today</a>

            <table id="datatableCaseHistoryWScroll" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">Serials</th>
                        <th scope="col">Cart #</th>
                        <th scope="col">Website</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Patient</th>
                        <th scope="col">Taking For</th>
                        <th scope="col">Country</th>
                        <th scope="col">Shipping Address</th>
                        <th scope="col">Phone</th>
                        <th scope="col">WhatsApp/ Wechat/ Viber/ Facebook</th>
                        <th scope="col">Email</th>
                        <th scope="col">Is Created by Admin</th>
                        <th scope="col">Is Deleted?</th>
                        
                        <th scope="col">Medicines</th>
                        <th scope="col">Quantities</th>
                        <th scope="col">Price Offer</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Transaction Fee</th>
                        <th scope="col">Shipping Amount</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date of orders</th>
                        <th scope="col">Courier</th>
                        <th scope="col">Tracking No.</th>
                        <th scope="col">Sending Date</th>
                        <th scope="col">Delivery Status</th>
                        <th scope="col">Delivery Date</th>
                        <th scope="col">Payment Method</th>


                        <th scope="col">Prescription/Document</th>
                        <th scope="col">Proforma Invoice</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Duplicate Invoice</th>
                        <th scope="col">3rd party data link</th>

                        <th scope="col">Product Batch</th>
                        <th scope="col">Number of orders</th>
                        <th scope="col">Special notes</th>
                        <th scope="col">Reminding alarm</th>
                        <th scope="col">Edit Reminding alarm</th>
                        <th scope="col">Email</th>
                        <th scope="col">Is Sent ?</th>

                    </tr>
                </thead>

            </table>
        </div>
    </div>
</div>


<script>
    var exportableColumns = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28,30 ];
    $(document).ready( function () {
        $('#datatableCaseHistoryWScroll').removeAttr('width').DataTable({
            // fixedHeader: {
            //     header: true,
            // },
            processing: true,
            serverSide: true,
            "bSort": true,
            "responsive": true,
            // "autoWidth": false,
            "scrollX": true,
            // "scrollY": false,
            scrollY:        500,
            deferRender:    true,
            scroller:       true,
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
                    exportOptions: {
                        columns: exportableColumns
                    }
                },
                'print',
             ],
            columnDefs: [
                { width: 150, targets: 2 },
                { width: 150, targets: 3 },
                { width: 120, targets: 4 },
                { width: 200, targets: 5 },
                { width: 150, targets: 6 },
                { width: 200, targets: 7 },
                { width: 250, targets: 8 },
                { width: 200, targets: 9 },
                { width: 80, targets: 10 },
                { width: 100, targets: 11 },
                { width: 100, targets: 15 },
                { width: 100, targets: 17 },
                { width: 200, targets: 23 },
                { width: 300, targets: 24 },
                { width: 450, targets: 25 },
                { width: 400, targets: 26 },
                { width: 70, targets: 30 },
            ],

            // ajax: "{{url('/')}}"+"/api/report/casehistoryreportgenerator"+"{{request()->has('date')? '?date='.request('date'): '' }}",

            ajax: {
                url: "{{url('/')}}"+"/api/report/casehistoryreportgenerator"+"{{request()->has('date')? '?date='.request('date'): '' }}",
                type: 'POST',
                headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },

            datatype:'json',
            // type: 'get',
            // method: 'POST',

            lengthMenu: [
            [ 10, 25, 50, 100, 500,-1 ],
                [ '10 rows', '25 rows', '50 rows','100 rows', '500 rows','Show all' ]
            ],
            columns: [
                        { data: 'cartId', 
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
                         { data: 'cartNumber', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let cartId=dataArray[0];
                                    let cartNumber=dataArray[1];
                                    return "<a href='"+"{{url('/').'/cart/cartListAdmin?cartId='}}"+cartId+"' target='_blank'> "+cartNumber+"</a>";
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'website', 
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
                         { data: 'clientName', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let clientName=dataArray[0];
                                    let customerId=dataArray[1];
                                    let isDeleted=dataArray[2];
                                    let isCreatedByAdmin=dataArray[3];

                                    var str = '<a href="/customers/customerProfileUpdate/'+customerId+'" target="_blank" >'+clientName+'</a>' ;

                                    if(isDeleted==1)
                                    {
                                        str += '<br><br> <strong style="color:red;">Deleted Account</strong>'
                                    }

                                    if(isCreatedByAdmin==1)
                                    {
                                        str += '<br><br> <strong>Created by Admin</strong>'
                                    }

                                    return  str ;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'patientName', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return   data ;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'takingForRelationship', 
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
                         { data: 'country', 
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
                         { data: 'shippingAddress', 
                            render: function(data, type, full, meta){

                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let takingFor=dataArray[0];
                                    let takingForLocalLang=dataArray[1];
                                    let streethouse=dataArray[2];
                                    let streethouseLocalLang=dataArray[3];
                                    let postalCode=dataArray[4];
                                    let country=dataArray[5];
                                    let phone=dataArray[6];
                                    return   'Name : '+takingFor+' ('+takingForLocalLang+')'+'<span style="color:white;"> || </span>'+'<br>'+'<br>'+
                                        'Address : '+streethouse+' ('+streethouseLocalLang+')'+'<span style="color:white;"> || </span>'+'<br>'+'<br>'+
                                        'post Code : '+postalCode+'<span style="color:white;"> || </span>'+'<br>'+'<br>'+
                                        'country : '+country+'<span style="color:white;"> || </span>'+'<br>'+'<br>'+
                                        'phone : '+phone
                                    ;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'shippingAddress', 
                            render: function(data, type, full, meta){

                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let takingFor=dataArray[0];
                                    let takingForLocalLang=dataArray[1];
                                    let streethouse=dataArray[2];
                                    let streethouseLocalLang=dataArray[3];
                                    let postalCode=dataArray[4];
                                    let country=dataArray[5];
                                    let phone=dataArray[6];
                                    return phone
                                    ;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'socialMedia', 
                            render: function(data, type, full, meta){
                                if (data) {
                                    return data;
                                }
                                else {
                                    return " ";
                                }
                            },
                         },
                         { data: 'email', 
                            render: function(data, type, full, meta){
                                if (data) {
                                    return 'Email : '+data;
                                }
                                else {
                                    return " ";
                                }
                            },
                         },
                         { data: 'isCreatedByAdmin', 
                            render: function(data, type, full, meta){
                                if (data && data==1) {
                                    return 'Admin';
                                }
                                else {
                                    return " ";
                                }
                            },
                         },
                         { data: 'isDeleted', 
                            render: function(data, type, full, meta){
                                if (data && data==1) {
                                    return 'Deleted Account';
                                }
                                else {
                                    return " ";
                                }
                            },
                         },
                         { data: 'cartDetails', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let str = " ";
                                    dataArray.forEach(element => {
                                        str = str+element+'<span style="color:white;"> || </span>'+'<br><br>'
                                    });                                    
                                    return str;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'quantities', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let str = " ";
                                    dataArray.forEach(element => {
                                        str = str+element+'<span style="color:white;"> || </span>'+'<br><br>'
                                    });                                    
                                    return str;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'priceOffer', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let str = " ";
                                    dataArray.forEach(element => {
                                        str = str+element+'<span style="color:white;"> || </span>'+'<br><br>'
                                    });                                    
                                    return str;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'discounts', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    // console.log(dataArray)

                                    let str = " ";
                                    dataArray.forEach(element => {
                                        str = str+element+'<span style="color:white;"> || </span>'+'<br><br>'
                                    });                                    
                                    return str;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'transactionFeeAmount', 
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
                         { data: 'shippingAmount', 
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
                         { data: 'totalAmount', 
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
                         { data: 'paymentConfirmDateWithDot', 
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
                         { data: 'courier', 
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
                         { data: 'tracking', 
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
                         { data: 'sendingDateWithDot', 
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
                         { data: 'isCartComplete', 
                            render: function(data, type, full, meta){

                                var str1 = '<span class="font-weight-bold ' ;
                                var str2 = '">' ;
                                var str3 = '</span>' ;

                                if (data==1)
                                {
                                    return str1+'text-success'+str2+'Complete'+str3;
                                }
                                else{
                                    return   str1+'text-danger'+str2+'Pending'+str3;
                                }
                            },
                         },

                         
                         { data: 'deliveryCompleteDateWithDot', 
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

                         { data: 'paymentMethodAndDetails', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split('::::');

                                    let paymentMethod=dataArray[0];
                                    let paymentAccountDetailsTitle=dataArray[1];
                                    let paymentAccountDetails=dataArray[2];

                                    return paymentMethod+'<span style="color:white;"> || </span>'+"<br><br>"+paymentAccountDetailsTitle+'<span style="color:white;"> || </span>'+"<br><br>"+paymentAccountDetails;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },

                         { data: 'prescriptionDocumentPaths', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let filesArray=data.split(':');
                                    var list = ''
                                    filesArray.forEach(file => {
                                        list = list+"<li class='list-group-item list-group-item-action'>"+"<a href='"+file+"' target='_blank'>"+"{{url('/')}}"+file+"</a>"+'<span style="color:white;"> || </span>'+"</li>"
                                    });                                    
                                    return "<ul class='list-group'>"+list+"</ul>";
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },




                        { data: 'cartinvoice', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');

                                    let cartId=dataArray[0];
                                    let isCartApproved=dataArray[1];
                                    let isInvoiceVisible=dataArray[2];
                                    let fakeTotalPrice=dataArray[3];
                                    let paymentConfirmCompanyId=dataArray[4];
                                    let totalAmount=dataArray[5];

                                    if(parseInt(isCartApproved) == 2){
                                        str = '<a href="/en/dynamicproformainvoice/'+cartId+'" role="button" target="_blank">'+'{{url('/')}}'+'/en/dynamicproformainvoice/'+cartId+'</a>'+ "<br> <br>"+" Amount : "+totalAmount;
                                    }
                                    else{
                                         str = " ";
                                    }
                                    return str;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'cartinvoice', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');

                                    let cartId=dataArray[0];
                                    let isCartApproved=dataArray[1];
                                    let isInvoiceVisible=dataArray[2];
                                    let fakeTotalPrice=dataArray[3];
                                    let paymentConfirmCompanyId=dataArray[4];
                                    let totalAmount = dataArray[5];

                                    if(isCartApproved==2 && isInvoiceVisible==1 && paymentConfirmCompanyId ){
                                        str = '<a href="/en/dynamicinvoice/'+cartId+'" role="button" target="_blank">'+'{{url('/')}}'+'/en/dynamicinvoice/'+cartId+'</a>'+'<span style="color:white;"> || </span>'+ "<br> <br>"+" Amount : "+totalAmount;
                                    }
                                    else{
                                         str = " ";
                                    }
                                    return str;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'cartinvoice', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');

                                    let cartId=dataArray[0];
                                    let isCartApproved=dataArray[1];
                                    let isInvoiceVisible=dataArray[2];
                                    let fakeTotalPrice=dataArray[3];
                                    let paymentConfirmCompanyId=dataArray[4];
                                    let totalAmount = dataArray[5];
                                    let duplicateInvoiceCompanyId=dataArray[6];

                                    if(duplicateInvoiceCompanyId && isCartApproved==2 && isInvoiceVisible==1 && paymentConfirmCompanyId && fakeTotalPrice){
                                        str = '<a href="/en/dynamicfakeInvociePrint/'+cartId+'" role="button" target="_blank">'+'{{url('/')}}'+'/en/dynamicfakeInvociePrint/'+cartId+'</a>' +'<span style="color:white;"> || </span>'+ "<br> <br>"+
                                                " Amount : "+fakeTotalPrice;
                                    }
                                    else{
                                         str = " ";
                                    }
                                    return str;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },



                         { data: 'thirdpartydata', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let thirdpartyDataArray=data.split('::');

                                    let purchasingDate = thirdpartyDataArray[0];
                                    let supplier = thirdpartyDataArray[1];
                                    let files = thirdpartyDataArray[2];
                                    let purchaseAmount = thirdpartyDataArray[3];
                                    


                                    let list = "<li class='list-group-item list-group-item-action'>"+purchasingDate+"</li>";
                                    list = list + "<li class='list-group-item list-group-item-action'>"+supplier+"</li>";
                                    list = list + "<li class='list-group-item list-group-item-action'>Amount: "+purchaseAmount+"</li>";

                                    let filesArray=files.split(':');
                                    filesArray.forEach(file => {
                                        list = list+"<li class='list-group-item list-group-item-action'>"+"<a href='"+file+"' target='_blank'>"+"{{url('/')}}"+file+"</a>"+'<span style="color:white;"> || </span>'+"</li>"
                                    });                                    
                                    return "<ul class='list-group'>"+list+"</ul>";
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         







                         { data: 'productbatches', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let productbatches=data.split('::');

                                    let str = " ";
                                    productbatches.forEach(element => {

                                        element=element.split(':');
                                        let batch = element[0];
                                        let batchPicPath = element[1];

                                        str = str+'<a href="'+"{{url('/')}}"+batchPicPath+'" target="_blank">'+batch+'</a>'+'<span style="color:white;"> || </span>'+'<br><br>'
                                    });                                    
                                    return str;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },

                         { data: 'noOfCompletedOrders', 
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
                         { data: 'specialNote', 
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

                         { data: 'remindingAlarmDateWithDot', 
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

                         { data: 'cartId', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return "<a href='#'  role='button' class='btn btn-default p-2' data-toggle='modal'  data-target='#remindingAlarmEditModal' "+

                                    "data-cartid='"+data+"'"
                                    
                                    +" title='Edit reminding alarm date ?'>Edit reminding alarm</a>";
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },

                         { data: 'cartId', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return "<a href='#'  class='btn btn-primary p-2' data-toggle='modal'  data-target='#sendingMailModal' "+

                                    "data-cartid='"+data+"'"
                                    
                                    +">Send Email  <i class='fa fa-paper-plane' aria-hidden='true'></i></a>";
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },

                         { data: 'remindingAlarmCount', 
                            render: function(data, type, full, meta){
                                if (data>0)
                                {
                                    return "Sent "+data+" times";
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



<!-- sending mail Modal -->
<!-- sending mail Modal -->
<div class="modal fade" id="sendingMailModal" tabindex="-1" role="dialog" aria-labelledby="sendingMailModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title offset-5" >Sending Mail</h5>
        </div>
        <div class="modal-body" style="margin-top: -2vw;">
                <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('report.casehistory.mailsend') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                            {{ csrf_field() }}
  
                            <input type="hidden"  name="cartId" id="cartId" value="">
  
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
  <!-- sending mail Modal -->
  <!-- sending mail Modal -->


  


<!-- Reminding alarm date update modal -->
<!-- Reminding alarm date update modal -->
<div class="modal fade" id="remindingAlarmEditModal" tabindex="-1" role="dialog" aria-labelledby="remindingAlarmEditModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title offset-5" id="remindingAlarmEditModal">Edit Reminding Alarm</h5>
        </div>
        <div class="modal-body" style="margin-top: -4vw;">
  
                <form class="form-horizontal" method="POST"  action="{{ route('casehistoryremindingalarmedit') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                  {{ csrf_field() }}
                      <input type="hidden" name="cartId" id="remindingAlarmEditModalcartId"  value="" > 
                      <br>
                        <p class="card-description">
                        </p>
                          <div>
  
                              <div class="col-md-12">
                                <div class="form-group row ">
                                  <label class="col-sm-4 col-form-label control-label"> Reminding Alarm Date</label>
                                  <div class="col-sm-8">
                                    <input  type="text" id="remindingAlarmDate" name="remindingAlarmDate" class="form-control"   data-date-format="dd-mm-yyyy"  >
  
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
  <!-- Reminding alarm date update modal -->
  <!-- Reminding alarm date update modal -->


  
<script type="text/javascript">
    $(function() {
       
       $( "#remindingAlarmDate" ).datepicker(
           { 
             // maxDate:0,
             dateFormat: 'dd-mm-yy' 
         }
       );
       
    });
  
  
  </script>



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

<style>
    #ui-datepicker-div{
      top: 220px !important;
    }
  </style>

@endsection