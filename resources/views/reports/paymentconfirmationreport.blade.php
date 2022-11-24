@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Payment Confirmation Report')


<script src="{{ asset('js/jquery.min.js') }}"></script> 
@section('page_content')



<div class="content-wrapper" style="min-height: 0px;">
    @if (session('successMsg'))
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ session('successMsg') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h4 class="card-title" style="text-align: center;">Payment Confirmation Report</h4>

            <div class="col-md-12" >
                <div class="form-group row">
                    <div class="col-sm-4">
                        <select class="form-control m-bot15 " name="paymentConfirmDate" id="paymentConfirmDate"  onchange ="location = this.options[this.selectedIndex].value;">
                            
                            <option value="">--Select Date--</option>
                            <option value="?">All</option>
                            @foreach (DB::table('casehistory_view')->where('isPaymentConfirm', 1)->groupBy('paymentConfirmDateYear', 'paymentConfirmDateMonth', 'paymentConfirmDateDay')->orderBy('paymentConfirmDateYear', 'desc')->orderBy('paymentConfirmDateMonth', 'desc')->orderBy('paymentConfirmDateDay', 'desc')->get() as $paymentconfirmdate)
                                <option  value="?date={{ \Carbon\Carbon::parse($paymentconfirmdate->paymentConfirmDate)->format('d-m-Y') }}" {{request('date')==\Carbon\Carbon::parse($paymentconfirmdate->paymentConfirmDate)->format('d-m-Y') ? 'selected':''}}>
                                    {{ \Carbon\Carbon::parse($paymentconfirmdate->paymentConfirmDate)->format('d-m-Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <table id="datatablePriceinquiryWScroll" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">Serials</th>
                        <th scope="col">Order Confirmation Date</th>
                        <th scope="col">Client Information</th>
                        <th scope="col">Cart #</th>
                        <th scope="col">Order Details</th>
                        <th scope="col">Delivery Details</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>


<script>
    // var exportableColumns = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28,30 ];
    $(document).ready( function () {
        $('#datatablePriceinquiryWScroll').removeAttr('width').DataTable({
            // fixedHeader: {
            //     header: true,
            // },
            processing: true,
            serverSide: true,
            "bSort": true,
            "responsive": true,
            // "autoWidth": false,
            "order": [[ 0, "desc" ]],
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
                { targets: 3 ,width: 250 },
                { targets: 5 ,width: 250 },
               
            ],

            ajax: "{{url('/')}}"+"/api/report/paymentconfirmationreportgenerator"+"{{request()->has('date')? '?date='.request('date'): '' }}",

            datatype:'json',
            type: 'get',
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
                                        isDeleted='<br><br>'+'<strong style="color:red;">'+ 'Deleted Account'+'</strong>';
                                    } else {
                                        isDeleted='';
                                    }


                                    return   '<a href="/customers/customerProfileUpdate/'+customerId+'" target="_blank" >'+name+'</a>'+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            email+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            'Created by : <strong>'+ isCreatedByAdmin+'</strong>'+
                                            isDeleted+
                                            '<br><br>'+
                                            country+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            phone+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            registrationDate+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            '<a class="btn btn-success p-2" href="/report/allcustomersdata?customerId='+customerId+'" target="_blank"><i class="fa fa-bar-chart"></i> Customer Data Report</a>'+
                                            '<br><br>'+
                                            '<a class="btn btn-primary p-2" href="/customers/productPricesForUsersAssign/'+customerId+'" target="_blank">Assign Price</a>'

                                     ;
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

                         

                         { data: 'deliveryDetails', 
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


                         

                         
                    ],
        });
     });
</script>



{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
    $(document).ready(function() {
  
       $('#paymentConfirmDate').select2({
          placeholder: {
            id: '123', // the value of the option
            text: '--Select Date--'
          },
          // placeholder : "--Select Employee--",
          allowClear: true
       });
    });
</script>

@endsection