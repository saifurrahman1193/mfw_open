@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Products Report')


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
            <h4 class="card-title" style="text-align: center;">Products Report</h4>


            {{-- filters --}}
            {{-- filters --}}

            <!-- Accordion card start-->
            <!-- Accordion card start-->
            <div class="accordion md-accordion" id="accordionHeading1" role="tablist" aria-multiselectable="true">
                <div class="card">

                    <!-- Card header 1 -->
                    <div class="card-header" role="tab" id="heading1">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading1" href="#collapseHeading1"
                            aria-expanded="false" aria-controls="collapseHeading1">
                            <h5 class="mb-0"><i class="fa fa-plus-square"></i> 1. Which product sold how many times </h5>
                        </a>
                    </div>

                    <!-- Card body 1 start-->
                    <div id="collapseHeading1" class="collapse" role="tabpanel" aria-labelledby="heading1"
                    data-parent="#accordionHeading1">
                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="f1_genericBrandId">Generic Brand</label>
                                    <select class="form-control m-bot15 " id="f1_genericBrandId" name="f1_genericBrandId" onchange="filter1(this.value)">
                                        <option value="">--Select Generic Brand--</option>
                                        <option value="-1">All</option>
                                        @foreach ($productsreportData->unique('genericBrand')->sortBy('genericBrand') as $productsreport)
                                            <option  value="{{$productsreport->genericBrandId}}" >
                                                {{$productsreport->genericBrand}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="f1_date1">Date 1</label>

                                    <input  type="text" id="f1_date1" name="f1_date1" class="form-control"  value="{{ \Carbon\Carbon::parse(request()->date1)->format('d-m-Y') }}"  data-date-format="dd-mm-yyyy"  required>
                                </div>

                                <div class="col-sm-4">
                                    <label for="f1_date2">Date 2</label>

                                    <input  type="text" id="f1_date2" name="f1_date2" class="form-control" value="{{ \Carbon\Carbon::parse(request()->date2)->format('d-m-Y') }}"   data-date-format="dd-mm-yyyy"  required>
                                </div>

                                <div class="col-sm-4">
                                    <a href="#" id="f1_filter" class="btn btn-primary" onclick="filter1withDateRange()">Filter</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Card body 1 end-->



                    <!-- Card header 2 -->
                    <div class="card-header" role="tab" id="heading2">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading2" href="#collapseHeading2"
                            aria-expanded="false" aria-controls="collapseHeading2">
                            <h5 class="mb-0"><i class="fa fa-plus-square"></i> 2. Which products not sold </h5>
                        </a>
                    </div>

                    <!-- Card body 2 start-->
                    <div id="collapseHeading2" class="collapse" role="tabpanel" aria-labelledby="heading2"
                    data-parent="#accordionHeading2">
                        <div class="card-body">
                            <a href="#" id="f1_filter" class="btn btn-primary" onclick="filter2()">Find Which products not sold</a>
                        </div>
                    </div>
                    <!-- Card body 2 end-->


                    <!-- Card header 3 -->
                    <div class="card-header" role="tab" id="heading3">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading3" href="#collapseHeading3"
                            aria-expanded="false" aria-controls="collapseHeading3">
                            <h5 class="mb-0"><i class="fa fa-plus-square"></i> 3. Products inquired but not sold </h5>
                        </a>
                    </div>

                    <!-- Card body 3 start-->
                    <div id="collapseHeading3" class="collapse" role="tabpanel" aria-labelledby="heading3"
                    data-parent="#accordionHeading3">
                        <div class="card-body">
                            <a href="#" id="f1_filter" class="btn btn-primary" onclick="filter3()">Show inquired products but not sold</a>
                        </div>
                    </div>
                    <!-- Card body 3 end-->


                   


                    <!-- Card header 4 -->
                    <div class="card-header" role="tab" id="heading4">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading4" href="#collapseHeading4"
                            aria-expanded="false" aria-controls="collapseHeading4">
                            <h5 class="mb-0"><i class="fa fa-plus-square"></i> 4. Country wise filter</h5>
                        </a>
                    </div>

                    <!-- Card body 4 start-->
                    <div id="collapseHeading4" class="collapse" role="tabpanel" aria-labelledby="heading4"
                    data-parent="#accordionHeading4">
                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="f4_country">Country</label>
                                    <select class="form-control m-bot15 " id="f4_country" name="f4_country" onchange="filter4(this.value)">
                                        <option value="">--Select Country--</option>
                                        @foreach ($countryData->sortBy('country') as $country)
                                            <option  value="{{$country->country}}" >
                                                {{$country->country}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="f4_date1">Date 1</label>

                                    <input  type="text" id="f4_date1" name="f4_date1" class="form-control"  value="{{ \Carbon\Carbon::parse(request()->date1)->format('d-m-Y') }}"  data-date-format="dd-mm-yyyy"  required>
                                </div>

                                <div class="col-sm-4">
                                    <label for="f4_date2">Date 2</label>

                                    <input  type="text" id="f4_date2" name="f4_date2" class="form-control" value="{{ \Carbon\Carbon::parse(request()->date2)->format('d-m-Y') }}"   data-date-format="dd-mm-yyyy"  required>
                                </div>

                                <div class="col-sm-4">
                                    <a href="#" id="f4_filter" class="btn btn-primary" onclick="filter4withDateRange()">Filter</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Card body 4 end-->


                    <!-- Card header 5 -->
                    <div class="card-header" role="tab" id="heading5">
                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionHeading5" href="#collapseHeading5"
                            aria-expanded="false" aria-controls="collapseHeading5">
                            <h5 class="mb-0"><i class="fa fa-plus-square"></i> 5. Company wise filter</h5>
                        </a>
                    </div>

                    <!-- Card body 5 start-->
                    <div id="collapseHeading5" class="collapse" role="tabpanel" aria-labelledby="heading5"
                    data-parent="#accordionHeading5">
                        <div class="card-body">

                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="f5_companyId">Company</label>
                                    <select class="form-control m-bot15 " id="f5_companyId" name="f5_companyId" onchange="filter5(this.value)">
                                        <option value="">--Select Company--</option>
                                        @foreach ($cartdetailsData->unique('genericCompany')->sortBy('genericCompany') as $cartdetail)
                                            <option  value="{{$cartdetail->genericCompanyId}}" >
                                                {{$cartdetail->genericCompany}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="f5_date1">Date 1</label>

                                    <input  type="text" id="f5_date1" name="f5_date1" class="form-control"  value="{{ \Carbon\Carbon::parse(request()->date1)->format('d-m-Y') }}"  data-date-format="dd-mm-yyyy"  required>
                                </div>

                                <div class="col-sm-4">
                                    <label for="f5_date2">Date 2</label>

                                    <input  type="text" id="f5_date2" name="f5_date2" class="form-control" value="{{ \Carbon\Carbon::parse(request()->date2)->format('d-m-Y') }}"   data-date-format="dd-mm-yyyy"  required>
                                </div>

                                <div class="col-sm-4">
                                    <a href="#" id="f5_filter" class="btn btn-primary" onclick="filter5withDateRange()">Filter</a>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- Card body 5 end-->


                   


        
                </div>
            </div>
            <!-- Accordion card end-->
            <!-- Accordion card end-->





            {{-- filters --}}
            {{-- filters --}}

            


            <table id="datatableProductsReportWScroll" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">Generic Brand</th>
                        <th scope="col">Rating</th>
                        <th scope="col">Review</th>
                        <th scope="col">Sold Qty</th>
                        <th scope="col">Selling Price</th>
                        <th scope="col">Country</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>




<script>
    
    // var exportableColumns = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28,30 ];
    $(document).ready( function () {
        datatableDataLoad('?isInitialLoading=1');
    });

    // 1. Which product sold how many times
    function filter1(genericBrandId) 
    {
        console.log(genericBrandId )
        if (genericBrandId && genericBrandId!=(-1)) 
        {
            datatableDataLoad('?filter1=1&genericBrandId='+genericBrandId);
        } 
        else 
        {
            datatableDataLoad('?isInitialLoading=1');
        }
    }

    function filter1withDateRange() 
    {
        var genericBrandId = $('select#f1_genericBrandId').find(':selected').val();
        console.log(genericBrandId)

        var date1 = $('#f1_date1').val();
        console.log(date1)
        var date2 = $('#f1_date2').val();
        console.log(date2)
        
        if (genericBrandId && date1 && date2) 
        {
            datatableDataLoad('?filter1withDateRange=1&genericBrandId='+genericBrandId+'&date1='+date1+'&date2='+date2);
        } 
        else if (genericBrandId && genericBrandId!=(-1)) 
        {
            datatableDataLoad('?filter1=1&genericBrandId='+genericBrandId);
        } 
        else 
        {
            datatableDataLoad('?isInitialLoading=1');
        }
    }


    // 2. Which products not sold
    function filter2() 
    {
        datatableDataLoad('?filter2=1');
    }

    // 3. Products inquired but not sold
    function filter3() 
    {
        datatableDataLoad('?filter3=1');
    }


    // 4. country wise filter
    function filter4(country) 
    {
        console.log(country )
        if (country) 
        {
            datatableDataLoad('?filter4=1&country='+country);
        } 
        else 
        {
            datatableDataLoad('?isInitialLoading=1');
        }
    }

    function filter4withDateRange() 
    {
        var country = $('select#f4_country').find(':selected').val();
        console.log(country)

        var date1 = $('#f4_date1').val();
        console.log(date1)
        var date2 = $('#f4_date2').val();
        console.log(date2)
        
        if (country && date1 && date2) 
        {
            datatableDataLoad('?filter4withDateRange=1&country='+country+'&date1='+date1+'&date2='+date2);
        } 
        else 
        {
            datatableDataLoad('?isInitialLoading=1');
        }
        
    }


    // 5. company wise filter
    function filter5(companyId) 
    {
        console.log(companyId )
        if (companyId) 
        {
            datatableDataLoad('?filter5=1&companyId='+companyId);
        } 
        else 
        {
            datatableDataLoad('?isInitialLoading=1');
        }
    }

    function filter5withDateRange() 
    {
        var companyId = $('select#f5_companyId').find(':selected').val();
        console.log(companyId)

        var date1 = $('#f5_date1').val();
        console.log(date1)
        var date2 = $('#f5_date2').val();
        console.log(date2)
        
        if (companyId && date1 && date2) 
        {
            datatableDataLoad('?filter5withDateRange=1&companyId='+companyId+'&date1='+date1+'&date2='+date2);
        } 
        else 
        {
            datatableDataLoad('?isInitialLoading=1');
        }
        
    }


    function datatableDataLoad(queryParams) 
    {
        $('#datatableProductsReportWScroll').removeAttr('width').DataTable({
            // fixedHeader: {
            //     header: true,
            // },
            destroy: true,
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
                { targets: 0 ,width: 250 },
               
            ],

            ajax: "{{url('/')}}"+"/api/report/productsreportgenerator"+queryParams,

            datatype:'json',
            type: 'get',
            lengthMenu: [
            [ 10, 25, 50, 100, 500,-1 ],
                [ '10 rows', '25 rows', '50 rows','100 rows', '500 rows','Show all' ]
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
    
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
    
                // Total over all pages
                // total = api
                //     .column( 4 )
                //     .data()
                //     .reduce( function (a, b) {
                //         return intVal(a) + intVal(b);
                //     }, 0 );
    
                // Total over this page
                pageTotalSoldQty = api
                    .column( 3, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                
                pageTotalSellingPrice = api
                    .column( 4, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
    
                // Update footer
                $( api.column( 3 ).footer() ).html( pageTotalSoldQty  );
                $( api.column( 4 ).footer() ).html( 'USD '+pageTotalSellingPrice  );
            },
            columns: [
                        { data: 'productDetails', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');
                                    let genericBrandId=dataArray[0];
                                    let genericBrand=dataArray[1];
                                    let genericName=dataArray[2];
                                    let genericCompany=dataArray[3];
                                    let genericStrength=dataArray[4];
                                    let dosageForm=dataArray[5];
                                    let genericPackSize=dataArray[6];
                                                                       
                                    return '<ul class="list-group">'+
                                                '<li class="list-group-item list-group-item-action "> <a href="{{ url('/') }}/en/'+genericBrand+'/productDetailsPage/'+genericBrandId+'" target="_blank">'+genericBrand+'</a></li>'+
                                                '<li class="list-group-item list-group-item-action ">'+genericName+'<span style="color:white;"> || </span>'+'</li>'+
                                                '<li class="list-group-item list-group-item-action ">'+genericCompany+'<span style="color:white;"> || </span>'+'</li>'+
                                                '<li class="list-group-item list-group-item-action ">'+genericStrength+'<span style="color:white;"> || </span>'+'</li>'+
                                                '<li class="list-group-item list-group-item-action ">'+dosageForm+'<span style="color:white;"> || </span>'+'</li>'+
                                                '<li class="list-group-item list-group-item-action ">'+genericPackSize+'<span style="color:white;"> || </span>'+'</li>'
                                            +'</ul>' ;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'rating', 
                            render: function(data, type, full, meta){
                                if (data  )
                                {
                                    return data;
                                }
                                else
                                {
                                    return   " ";
                                }
                            },
                         },
                         { data: 'totalReview', 
                            render: function(data, type, full, meta){
                                if (data )
                                {
                                    return data;
                                }
                                else
                                {
                                    return   " ";
                                }
                            },
                         },
                         { data: 'soldQty', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return data;
                                }
                                else
                                {
                                    return   " ";
                                }
                            },
                         },
                         { data: 'sellingPrice', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return data;
                                }
                                else
                                {
                                    return   " ";
                                }
                            },
                         },
                         { data: 'country', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    let dataArray=data.split(':');

                                    let listItems = " ";
                                    dataArray.forEach(element => {
                                        listItems = listItems+'<li class="list-group-item list-group-item-action">'+element+'<span style="color:white;"> || </span>'+'</li>';
                                    });       

                                    return '<ul class="list-group">'+ listItems  +'</ul>' ;
                                }
                                else
                                {
                                    return   " ";
                                }
                            },
                         },


                         

                         
                    ],
        });
     }


     $(document).ready(function() {
  
        $('#f1_genericBrandId').select2({
            placeholder: {
            id: '123', // the value of the option
            text: '--Select Generic Brand--'
            },
            // placeholder : "--Select Employee--",
            allowClear: true
        });

        $('#f4_country').select2({
            placeholder: {
            id: '123', // the value of the option
            text: '--Select Country--'
            },
            // placeholder : "--Select Employee--",
            allowClear: true
        });

        $('#f5_companyId').select2({
            placeholder: {
            id: '123', // the value of the option
            text: '--Select Company--'
            },
            // placeholder : "--Select Employee--",
            allowClear: true
        });

    });
</script>


<script type="text/javascript">
    $(function() {
       $( "#f1_date1" ).datepicker(
           { 
             // maxDate:0,
             dateFormat: 'dd-mm-yy' 
         }
       );
       $( "#f1_date2" ).datepicker(
           { 
             // maxDate:"-18y",
             dateFormat: 'dd-mm-yy' 
         }
       );

       $( "#f4_date1" ).datepicker(
           { 
             // maxDate:0,
             dateFormat: 'dd-mm-yy' 
         }
       );
       $( "#f4_date2" ).datepicker(
           { 
             // maxDate:"-18y",
             dateFormat: 'dd-mm-yy' 
         }
       );

       $( "#f5_date1" ).datepicker(
           { 
             // maxDate:0,
             dateFormat: 'dd-mm-yy' 
         }
       );
       $( "#f5_date2" ).datepicker(
           { 
             // maxDate:"-18y",
             dateFormat: 'dd-mm-yy' 
         }
       );
       
    });
</script>


@endsection