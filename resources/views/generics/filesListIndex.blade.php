
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])

@section('pageTitle', 'Add Files')

@section('page_content')
    
<script src="{{ asset('js/jquery.min.js') }}"></script>	


<script type="text/javascript">
    $(function(){
        $('#filelistindexUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var fileId = button.data('fileid') ;
              var purpose = button.data('purpose') ;

              var modal = $(this);

              modal.find('.modal-body #fileId').val(fileId);
              modal.find('.modal-body #purpose').val(purpose);
        });
    });
</script>





<div class="content-wrapper" style="min-height: 0px;">

    <div class="card">
        <div class="card-title mt-4">
                <h4 class="text-center mt-2">Add File</h4>
        </div>
        <div class="card-body">
            
            <form class="form-horizontal" method="POST"  enctype="multipart/form-data" action="{{ route('filesInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');"   >
                {{ csrf_field() }}
                
    
                

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row ">
                            <label class="col-sm-4 col-form-label control-label">Pack Size</label>
                            <div class="col-sm-8">
                                <select class="form-control m-bot15" name="genericPackSizeId" id="genericPackSizeId"  >
                                    <option value="">--Select Pack Size--</option>
                                    @foreach($genericpacksizesData->sortBy('genericBrand')  as $genericpacksize)
                                        <option value="{{ $genericpacksize->genericPackSizeId }}" >
                                            {{ $genericpacksize->genericBrand.' ('.$genericpacksize->genericName.' '.$genericpacksize->genericStrength.'), '.$genericpacksize->genericPackSize.'\'s '.$genericpacksize->packType.' | '. $genericpacksize->dosageForm.', '.$genericpacksize->genericCompany.' '.$genericpacksize->globalTradeNameCompany}}
                                        </option> 
                                    @endforeach   
                                </select>
                            </div>
                        </div>
                    </div>

                    

                    <div class="col-md-6">
                        <div class="form-group row required">
                            <label class="col-sm-4 col-form-label control-label">File</label>
                            <div class="col-sm-8">
                                <input id="filePath" name="filePath" type="file" class="file"  data-show-upload="true" data-show-caption="true" required >
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row ">
                          <label class="col-sm-4 col-form-label control-label">Purpose</label>
                          <div class="col-sm-8">
                            <textarea id="purpose" name="purpose"  rows="5" class="form-control" > </textarea>
                          </div>
                        </div>
                    </div>

                    

                </div> 
                

                <div class="row offset-sm-5">
                    <button   type="submit"   class="btn btn-success mr-2 ">Save</button>
                </div>

            </form>

        </div>
    </div>
    
</div>



{{-- files table --}}
{{-- files table --}}
<div class="content-wrapper" style="min-height: 0px;" id="emailbodytable">
    <div class="card">
      <div class="card-body">
  
  
          <h4 class="card-title" style="text-align: center;">files</h4>
  
          {{-- <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#emailBodySaveConfirmationModal" ><span>+ Create New files</span></a> --}}
          
  
          {{-- data table start --}}
          {{-- data table start --}}
          <table id="datatable1WScrollcustom" class="table table-striped table-bordered table-hover " >
                <thead>
                    <tr class="bg-primary text-light">
                        <th scope="col">S/L</th>
                        <th scope="col">Action</th>
                        <th scope="col">Pack</th>
                        <th scope="col">Purpose</th>
                        <th scope="col">File</th>
                    </tr>
                </thead>
                
                <tbody>
                     @foreach ($filesData as $file)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td id="tdtableaction">

                                <div class="d-inline-block">
                                    <a role="button" href="#"   data-toggle="modal" data-target="#filelistindexUpdateModal"  
                                        data-fileid="{{ $file->fileId }}" 
                                        data-purpose="{{ $file->purpose }}" 
                                     title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                                </div>
  
                                <div class="d-inline-block tooltipster" title="Delete selected record?">
                                    <form  method="post" action="{{ route('filesDelete', $file->fileId) }}" onsubmit="return confirm('Do you really want to proceed?');">
                                        {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <a>
                                            <button type="submit" value="DELETE" class="btn btn-link" >
                                                <i class="fa fa-trash" style="font-size:25px; color:red"></i>
                                            </button>
                                            </a>
                                    </form>
                                </div>
                            </td>
                            <td>
                                @if ($file->genericPackSizeId>0)
                                    {{$file->genericBrand.' '. '('.$file->genericName.' '.$file->genericStrength.'), '.$file->genericPackSize.'\'s '.$file->packType.' | '. $file->dosageForm.' | '.$file->genericCompany.' | '.$file->globalTradeNameCompany   }}
                                @endif
                            </td>
                            <td>{{$file->purpose}}</td>
                            <td>
                                <ul class="list-group ">
                                    <li class="list-group-item  list-group-item-action">
                                        <a href="{{url('/').$file->filePath}}" target="_blank" >{{url('/').$file->filePath}}</a>
                                    </li>

                                    <li class="list-group-item  list-group-item-action">
                                        <a class="btn btn-primary py-2" role="button" href="#"   data-toggle="modal" data-target="#normal-modal" data-title='Copy Only Link'
                                         data-body="{{ $file->filePath }}" 
                                          class="normal-modal" >
                                            <i class="fa fa-link"></i>
                                            Copy <strong>Only Link</strong>
                                        </a>
                                    </li>

                                    <li class="list-group-item  list-group-item-action">
                                        <a class="btn btn-primary py-2" role="button" href="#"   data-toggle="modal" data-target="#normal-modal" data-title='Copy Link With Base URL'
                                         data-body="{{ url('/').$file->filePath }}" 
                                          class="normal-modal" >
                                            <i class="fa fa-link"></i>
                                            Copy Link With <strong>Base URL</strong>
                                        </a>
                                    </li>

                                    <li class="list-group-item  list-group-item-action">
                                        <a class="btn btn-primary py-2 normal-modal" role="button" href="#"   data-toggle="modal" data-target="#normal-modal" data-title='Copy Link With <a> Tag'
                                            data-body='<a href={{ '"'.$file->filePath.'"' }} target="_blank" style="color: green !important;" class="btn btn-link" role="button">{{ $file->purpose }}</a>' 
                                              >
                                                <i class="fa fa-link"></i>
                                                Copy Link With <strong>&lt;a&gt;</strong> Tag
                                        </a>
                                    </li>

                                    <li class="list-group-item  list-group-item-action">
                                        <a class="btn btn-primary py-2 normal-modal" role="button" href="#"   data-toggle="modal" data-target="#normal-modal" data-title='Copy Link With <img> Tag'
                                         data-body='<img src={{ '"'.$file->filePath.'"' }}   class="img-responsive" alt={{  '"'.(strlen($file->purpose)>0 ? $file->purpose : 'image').'"' }}>' 
                                           >
                                            <i class="fa fa-image"></i>
                                            Copy Link With <strong>&lt;img&gt;</strong> Tag
                                        </a>
                                    </li>

                                    <li class="list-group-item  list-group-item-action">
                                        <a class="btn btn-primary py-2 normal-modal" role="button" href="#"   data-toggle="modal" data-target="#normal-modal" data-title='Copy Link With <video> Tag'
                                         data-body='<span class="fr-video fr-deletable fr-fvc fr-dvi fr-draggable" contenteditable="false" id="mfw_video_span"><video class="fr-fvc fr-dvi fr-draggable" controls=" " id="mfw_video" style="margin:15%; width: 70%;"><source src={{'"'.$file->filePath.'"'}} type="video/mp4"><source src={{'"'.$file->filePath.'"'}} type="video/webm"><source src={{'"'.$file->filePath.'"'}} type="video/ogg"></video></span>' 
                                        >
                                            <i class="fa fa-video-camera"></i>
                                            Copy Link With <strong>&lt;video&gt;</strong> Tag
                                        </a>
                                    </li>

                                    <li class="list-group-item  list-group-item-action">
                                        <a class="btn btn-primary py-2 normal-modal" role="button" href="#"   data-toggle="modal" data-target="#normal-modal" data-title='Copy Link for PDF'
                                         data-body='<a download={{'"'.$file->purpose.'"'}} href={{'"'.$file->filePath.'"'}} style="display: inline-block; text-align: right; width: 85%;">&nbsp;<button class="btn btn-sm btn-success" type="button"><i class="fa fa-file-pdf-o"></i>  Download PDF here...</button></a>' 
                                        >
                                            <i class="fa fa-file-pdf-o"></i>
                                            Copy Link for <strong>PDF</strong>
                                        </a>
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
  {{-- files table --}}
  {{-- files table --}}


<script type="text/javascript">
    function copyLink(link='') {
        /* Get the text field */
        var copyText = link || '';

        console.log(copyText)

      
        

        if (navigator.clipboard != undefined) {//Chrome
            navigator.clipboard.writeText(copyText).then(function () {
                console.log('Async: Copying to clipboard was successful!');
            }, function (err) {
                console.error('Async: Could not copy text: ', err);
            });
        }
        else if(window.clipboardData) { // Internet Explorer
            window.clipboardData.setData("Text", copyText);
            // navigator.clipboard.writeText(copyText);
        }


        document.execCommand("copy");
      
        /* Alert the copied text */
        // alert(copyText);
    } 
    
  </script>

  
  
  <script type="text/javascript">
    $(document).ready(function() {
        $("#filePath").fileinput({
            theme : 'fa',
            overwriteInitial:false,
            maxFileCount: 1,
        });        
    });
  </script>





{{-- select 2 script --}}
{{-- select 2 script --}}
<script >
    $(document).ready(function() {
  
       $('#genericPackSizeId').select2({
        // dropdownAutoWidth : true,
          placeholder: {
            id: '12', // the value of the option
            text: '--Select Generic Pack--'
          },
          // placeholder : "--Select Employee--",
          allowClear: true,
          language: {
            noResults: function (params) {
              return "No Data Found!";
            }
          },
       });
  
    });
  </script>



  <script>
  

    $(document).ready(function() {

        // with sxrol-x
        $('#datatable1WScrollcustom').DataTable( {
            "pagingType": "simple_numbers",
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            },
            "scrollX": true,
            "scrollY": false,
            // "ordering": false,
            "order": [[ 0, "desc" ]],
            "responsive": true,
            "autoWidth": false,
            lengthMenu: [
            [ 10, 25, 50, 100, 500,-1 ],
                [ '10 rows', '25 rows', '50 rows','100 rows', '500 rows','Show all' ]
            ]

        } );


        
    } );


  </script>




  <!-- File list index Edit Modal -->
  <!-- File list index Edit Modal -->
  <div class="modal fade" id="filelistindexUpdateModal" tabindex="-1" role="dialog" aria-labelledby="filelistindexUpdateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title offset-5" id="filelistindexUpdateModal">Update Position</h5>
        </div>
        <div class="modal-body" style="margin-top: -2vw;">
                <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('fileUpdate') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                            {{method_field('put')}}
                            {{ csrf_field() }}
  
                            <input type="hidden" name="fileId" id="fileId" value="">
  
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Purpose</label>
                                <div class="col-sm-8">
                                    <textarea id="purpose" name="purpose"  rows="5" class="form-control" > </textarea>

                                </div>
                              </div>
                            </div>
  
  
                            <div class="form-group">
                                <div class="col-md-12 col-md-offset-4 mt-2">
  
                                    <button type="submit" class="btn btn-success float-right">
                                        Update
                                    </button>
                                    
                                    <a {{-- href="{{ route('user.index') }}" --}}>
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
  <!-- File list index Edit Modal -->
  <!-- File list index Edit Modal -->
@endsection