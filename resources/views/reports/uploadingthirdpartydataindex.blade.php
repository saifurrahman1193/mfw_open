@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Third party data')
@section('page_content')



<script src="{{ asset('js/jquery.min.js') }}"></script>





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


  





{{-- Payment Method table --}}
{{-- Payment Method table --}}
  
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Uploading third party data</h4>

        <a href="{{ route('uploadingthirdpartydata_c') }}"  class="btn btn-default " style="margin-bottom: 10px; "  onclick="return confirm('Do you really want to proceed?');"><span>+ Add New third party data</span></a>
        

        <table id="datatableThirdpartyDataReportWScroll" class="table table-striped table-bordered table-hover " >
            <thead>
                <tr class="bg-primary text-light">
                    <th scope="col">ID</th>
                    <th scope="col">Purchasing Date</th>
                    <th scope="col">Purchase Amount</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Carts</th>
                    <th scope="col">Files</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
        </table>


    </div>
  </div>
</div>
{{-- Payment Method table --}}
{{-- Payment Method table --}}








<script >
  var deletemessage = "'Do you really want to delete ?'";

  $(document).ready( function () {
        datatableDataLoad();
    });

  function datatableDataLoad() 
    {
        $('#datatableThirdpartyDataReportWScroll').removeAttr('width').DataTable({
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
                { targets: 6 ,width: 150 },
               
            ],

            ajax: "{{url('/')}}"+"/api/report/uploadingthirdpartdataindexgenerator",

            datatype:'json',
            type: 'get',
            lengthMenu: [
            [ 10, 25, 50, 100, 500,-1 ],
                [ '10 rows', '25 rows', '50 rows','100 rows', '500 rows','Show all' ]
            ],
            columns: [
                        { data: 'thirdpartydataId', 
                            render: function(data, type, full, meta){
                                if (data)
                                {
                                    return data ;
                                }
                                else{
                                    return   " ";
                                }
                            },
                         },
                         { data: 'purchasingDate2', 
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

                         { data: 'purchaseAmount', 
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

                         { data: 'supplier', 
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

                         { data: 'carts', 
                            render: function(data, type, full, meta){
                                if (data  )
                                {
                                    let cartId='';
                                    let created_at='';
                                    let cartList='';

                                    let cartsArray=data.split('::');
                                    cartsArray.forEach(cartDetail => {
                                        let cart=cartDetail.split(':');

                                        cartId=cart[0];
                                        cartNumber=cart[1];

                                        cartList = cartList+ "<li  class='list-group-item list-group-item-action'>"+"<a href='/cart/cartListAdmin?cartId="+cartId+"' target='_blank'>"+cartNumber+"</a>"+'<span style="color:white;"> || </span>'+"</li>"

                                    });   

                                    return "<ul class='list-group'>"+cartList+"</ul>";
                                }
                                else
                                {
                                    return   " ";
                                }
                            },
                         },
                         { data: 'files', 
                            render: function(data, type, full, meta){
                                if (data  )
                                {
                                    let cartId='';
                                    let created_at='';
                                    let fileList='';

                                    let filesArray=data.split(':');
                                    filesArray.forEach(filePath => {
                                        fileList = fileList+ "<li  class='list-group-item list-group-item-action '>"+"<a href='"+filePath+"' target='_blank'>"+filePath+"</a>"+'<span style="color:white;"> || </span>'+"</li>"
                                    });   

                                    return "<ul class='list-group'>"+fileList+"</ul>";
                                }
                                else
                                {
                                    return   " ";
                                }
                            },
                         },

                         { data: 'thirdpartydataId', 
                            render: function(data, type, full, meta){
                                if (data  )
                                {
                                    return  '<div class="d-inline-block ml-2 tooltipster"   title="Edit "> <a href="/report/uploadingthirdpartydata_e/'+data+'"><i class="fa fa-edit" style="font-size:32px"></i></a> </div>'
                                      +
                                      '<div class="btn d-inline-block  tooltipster " title="Delete " >   <form  method="post" action="/report/uploadingthirdpartydata_delete/'+data+'" onsubmit="return confirm('+deletemessage+');" > <a href="javascript:void(0)">  <input type="hidden" name="_method" value="DELETE"> @csrf   <button type="submit" value="DELETE" class="btn btn-link" style="margin-top: -9px; margin-left: -12px;"> <i class="fa fa-trash " style="font-size:29px; color:red"></i>  </button>  </a> </div>'
                                      ;
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
</script>




@endsection