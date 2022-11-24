@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Pages')
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


        <h4 class="card-title" style="text-align: center;">Pages</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#pageSaveModal" ><span>+ Add New Page</span></a>
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable2WScroll" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">Page Id</th>
                      <th scope="col">Action</th>
                      <th scope="col">Page Title</th>
                      {{--  <th scope="col">Page Description</th>  --}}
                      <th scope="col">Meta Keywords</th>
                      <th scope="col">Meta Description</th>
                      
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($pagesData as $page)
                      <tr>
                        <td>
                          {{ $page->pageId }}
                        </td>
                        <td id="tdtableaction">

                          <div class="d-inline-block">
                               <a role="button" href="{{ route('pageEdit', $page->pageId) }}"  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                           </div>


                           @if ($page->isDeletable>0 || !(isset($page->isDeletable)) )


                               <div class="d-inline-block tooltipster" title="Delete selected record?">
                                   <form  method="post" action="{{ route('pageDelete', $page->pageId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                            {{ $page->pageTitle }} <br> <hr>
                              {{ $page->pageTitleCN }} <br> <hr>
                              {{ $page->pageTitleRU }}
                          </td>

                          {{--  <td >
                              <span id="{{'pageid-'.$page->pageId.'-desc'}}" data-desc="{{$page->pageDesc}}">{!! substr($page->pageDesc, 0, 200) !!}</span> 
                              @if (strlen($page->pageDesc)>200)
                                <button id="{{'pageid-'.$page->pageId.'-btn'}}" style="font-size: 14px !important; font-weight: normal !important;" onClick="readMore({{$page->pageId}})">Read More...</button>
                              @endif
                          </td>  --}}


                          <td>
                            {{$page->meta_keywords}}<br> <hr>
                            {{$page->meta_keywordsCN}}<br> <hr>
                            {{$page->meta_keywordsRU}}
                          </td>

                          <td>
                            {{$page->meta_description}}<br> <hr>
                            {{$page->meta_descriptionCN}}<br> <hr>
                            {{$page->meta_descriptionRU}}


                          </td>
                          

                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Payment Method table --}}
{{-- Payment Method table --}}









<!-- Page  Save Modal -->
<!-- Page  Save Modal -->
<div class="modal fade" id="pageSaveModal" style="overflow:hidden" role="dialog" aria-labelledby="pageSaveModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="pageSaveModal">Add A Page</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('pageInsert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            

                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Page Title</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="pageTitle" name="pageTitle" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Page Title (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="pageTitleCN" name="pageTitleCN" required>
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Page Title (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="pageTitleRU" name="pageTitleRU" required>
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
<!-- Page  Save Modal -->
<!-- Page  Save Modal -->



<script type='text/javascript'> 
  function readMore(pageId) {
    console.log('called')
    console.log('pageId = '+ pageId )


    var desc= $('#pageid-'+pageId+'-desc').data('desc');
    console.log(desc)

    document.getElementById('pageid-'+pageId+'-desc').innerHTML=desc;
    var btn = document.getElementById('pageid-'+pageId+'-btn');
    if (btn) {
      document.getElementById('pageid-'+pageId+'-btn').innerHTML='Read Less';
    }
    else{
      document.getElementById('pageid-'+pageId+'-desc').innerHTML=desc+'<br>'+
      "<button id='pageid-'+pageId+'-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readLess("+pageId+")'>Read Less...</button>";
    }

  }

  function readLess(pageId) {
    var desc= $('#pageid-'+pageId+'-desc').data('desc');
    document.getElementById('pageid-'+pageId+'-desc').innerHTML=desc.substr(0,200);
    var btn = document.getElementById('pageid-'+pageId+'-btn');
    if (btn) {
      document.getElementById('pageid-'+pageId+'-btn').innerHTML='Read More';
    }
    else{
      document.getElementById('pageid-'+pageId+'-desc').innerHTML=desc.substr(0,200)+'<br>'+
      "<button id='pageid-'+pageId+'-btn' style='font-size: 14px !important; font-weight: normal !important;' onClick='readMore("+pageId+")'>Read More...</button>";
    }

  }
</script>



@endsection