@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Price Inquiry Report')


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
            <h4 class="card-title" style="text-align: center;">Price Inquiry Report</h4>

            <div class="col-md-12" >
                <div class="form-group row">
                    <div class="col-sm-4">
                        <select class="form-control m-bot15 " name="inquiryDate" id="inquiryDate"  onchange ="location = this.options[this.selectedIndex].value;">
                            @if (request()->has('date'))
                              <option value="">{{ request('date') }}</option>
                            @else
                              <option value="">--Select Date--</option>
                            @endif
                            <option value="?">All</option>
                            @foreach (DB::table('priceinquiryreport_view')->select('inquiryDate')->distinct()->orderBy('created_at', 'DESC')->get() as $priceinquiryreport)
                                <option  value="?date={{ $priceinquiryreport->inquiryDate }}" >
                                    {{ $priceinquiryreport->inquiryDate }}
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
                        <th scope="col">Date-Time</th>
                        <th scope="col">Client Information</th>
                        <th scope="col">Prescription</th>
                        <th scope="col">Generic Brand</th>
                        <th scope="col">Generic Strength</th>
                        <th scope="col">Pack Type</th>
                        <th scope="col">Generic Name</th>
                        <th scope="col">Generic Company</th>
                        <th scope="col">Dosage Form</th>
                        <th scope="col">Originator</th>
                        <th scope="col">Message</th>
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
                { width: 150, targets: 1 },
                { width: 150, targets: 3 },
                { width: 150, targets: 4 },
                { width: 150, targets: 5 },
                { width: 150, targets: 6 },
                { width: 150, targets: 7 },
                { width: 300, targets: 8 },
                { width: 150, targets: 9 },
                { width: 300, targets: 10 },
            ],
                "order": [[ 0, "desc" ]]
            ,

            ajax: "{{url('/')}}"+"/api/report/priceinquiryreportgenerator"+"{{request()->has('date')? '?date='.request('date'): '' }}",

            datatype:'json',
            type: 'get',
            lengthMenu: [
            [ 10, 25, 50, 100, 500,-1 ],
                [ '10 rows', '25 rows', '50 rows','100 rows', '500 rows','Show all' ]
            ],
            columns: [
                        { data: 'userGenericInquiryId', 
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
                         { data: 'date_time', 
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
                                            name+'<span style="color:white;"> || </span>'+
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
                                            registrationDate+'<span style="color:white;"> || </span>'+
                                            '<br><br>'+
                                            '<a class="btn btn-success p-2" href="/report/allcustomersdata?customerId='+customerId+'" target="_blank"><i class="fa fa-bar-chart"></i>  Customer Data Report</a>'+
                                            '<br><br>'+
                                            '<a class="btn btn-primary p-2" href="/customers/productPricesForUsersAssign/'+customerId+'" target="_blank">Assign Price</a>';
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'prescriptionPath', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return "<a href='"+"{{url('/')}}"+data+"' target='_blank'> "+"{{url('/')}}"+data+"</a>";
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'genericBrand', 
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
                         { data: 'genericStrength', 
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
                         { data: 'packType', 
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

                         { data: 'genericName', 
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

                         { data: 'genericCompany', 
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

                         { data: 'dosageForm', 
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

                         { data: 'globalTradeNameCompany', 
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

                         

                         { data: 'message', 
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

                         
                    ],
        });
     });
</script>



{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
    $(document).ready(function() {
  
       $('#inquiryDate').select2({
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