<!DOCTYPE html>
@extends('layouts.app')
@extends('layouts.navbar')
@extends('layouts.sidebar', ['usermodules' => DB::table('user_roles_modules_view')->where('userId', Auth::user()->id)->pluck('moduleId')->toArray()])


@section('pageTitle', 'Generic Settings')
@section('page_content')




<script src="{{ asset('js/jquery.min.js') }}"></script>


<script type="text/javascript">

    $(function(){

        $('#genericCompanyUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var genericCompanyId = button.data('genericcompanyid') ;
              var genericCompany = button.data('genericcompany') ;
              var genericCompanyCN = button.data('genericcompanycn') ;
              var genericCompanyRU = button.data('genericcompanyru') ;

              var modal = $(this);

              modal.find('.modal-body #genericCompanyId').val(genericCompanyId);
              modal.find('.modal-body #genericCompany').val(genericCompany);
              modal.find('.modal-body #genericCompanyCN').val(genericCompanyCN);
              modal.find('.modal-body #genericCompanyRU').val(genericCompanyRU);
        });


        $('#categoryUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var categoryId = button.data('categoryid') ;
              var category = button.data('category') ;
              var categoryCN = button.data('categorycn') ;
              var categoryRU = button.data('categoryru') ;

              var modal = $(this);

              modal.find('.modal-body #categoryId').val(categoryId);
              modal.find('.modal-body #category').val(category);
              modal.find('.modal-body #categoryCN').val(categoryCN);
              modal.find('.modal-body #categoryRU').val(categoryRU);
        });


        $('#diseaseCategoryUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var diseaseCategoryId = button.data('diseasecategoryid') ;
              var diseaseCategory = button.data('diseasecategory') ;
              var diseaseCategoryCN = button.data('diseasecategorycn') ;
              var diseaseCategoryRU = button.data('diseasecategoryru') ;
              var categoryId = button.data('categoryid') ;

              var modal = $(this);

              modal.find('.modal-body #diseaseCategoryId').val(diseaseCategoryId);
              modal.find('.modal-body #diseaseCategory').val(diseaseCategory);
              modal.find('.modal-body #diseaseCategoryCN').val(diseaseCategoryCN);
              modal.find('.modal-body #diseaseCategoryRU').val(diseaseCategoryRU);
              modal.find('.modal-body #categoryId').val(categoryId);
        });



        $('#dosageFormUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var dosageFormId = button.data('dosageformid') ;
              var dosageForm = button.data('dosageform') ;
              var dosageFormCN = button.data('dosageformcn') ;
              var dosageFormRU = button.data('dosageformru') ;

              var modal = $(this);

              modal.find('.modal-body #dosageFormId').val(dosageFormId);
              modal.find('.modal-body #dosageForm').val(dosageForm);
              modal.find('.modal-body #dosageFormCN').val(dosageFormCN);
              modal.find('.modal-body #dosageFormRU').val(dosageFormRU);
        })


        $('#genericStrengthUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var genericStrengthId = button.data('genericstrengthid') ;
              var genericStrength = button.data('genericstrength') ;
              var genericStrengthCN = button.data('genericstrengthcn') ;
              var genericStrengthRU = button.data('genericstrengthru') ;

              var modal = $(this);

              modal.find('.modal-body #genericStrengthId').val(genericStrengthId);
              modal.find('.modal-body #genericStrength').val(genericStrength);
              modal.find('.modal-body #genericStrengthCN').val(genericStrengthCN);
              modal.find('.modal-body #genericStrengthRU').val(genericStrengthRU);
        });


       



        $('#packTypesUpdateModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget) ;

              var packTypeId = button.data('packtypeid') ;
              var packType = button.data('packtype') ;
              var packTypeCN = button.data('packtypecn') ;
              var packTypeRU = button.data('packtyperu') ;
              var weightGM = button.data('weightgm') ;

              var modal = $(this);

              modal.find('.modal-body #packTypeId').val(packTypeId);
              modal.find('.modal-body #packType').val(packType);
              modal.find('.modal-body #packTypeCN').val(packTypeCN);
              modal.find('.modal-body #packTypeRU').val(packTypeRU);
              modal.find('.modal-body #weightGM').val(weightGM);
        });



    });
</script>


{{-- Indicator --}}


<style>
  @media (max-width: 400px) {
      #indicator_generic_brand {
        position: fixed; 
        z-index:10; 
        margin-left:5%; 
        margin-right:5%;
      }
  }  
  @media (min-width: 800px) {
      #indicator_generic_brand {
        position: fixed; 
        z-index:10; 
        margin-left:35%; 
        margin-right:15%;  
      }
  }  
</style>

<div id=indicator_generic_brand>
  <a href="#genericcompanytable"><button type="button" id="b1" class="btn btn-danger">Generic Companies</button></a>
  <a href="#categorytable"><button type="button" id="b2" class="btn btn-danger">Category</button></a>
  <a href="#diseasecategorytable"><button type="button" id="b3" class="btn btn-danger">Disease Category</button></a>  
  <a href="#dosageformtable"><button type="button" id="b4" class="btn btn-danger">Dosage Form</button></a>  
  <a href="#genericstrengthtable"><button id="b5" type="button" class="btn btn-danger">Generic Strength</button></a>  
  <a href="#packtypestable"><button id="b6" type="button" class="btn btn-danger">Pack Type</button></a>  
  
</div>
<script type="text/javascript">
  $("#b1").click(function() {
    $('html,body').animate({
        scrollTop: $("#genericcompanytable").offset().top -220 },
        'fast');
  });
  $("#b2").click(function() {
    $('html,body').animate({
        scrollTop: $("#categorytable").offset().top -220 },
        'slow');
  });
  $("#b3").click(function() {
    $('html,body').animate({
        scrollTop: $("#diseasecategorytable").offset().top 100 },
        'slow');
  });
  $("#b4").click(function() {
    $('html,body').animate({
        scrollTop: $("#dosageformtable").offset().top -100 },
        'slow');
  });
  $("#b5").click(function() {
    $('html,body').animate({
        scrollTop: $("#genericstrengthtable").offset().top -100 },
        'slow');
  });  
  $("#b6").click(function() {
    $('html,body').animate({
        scrollTop: $("#packtypestable").offset().top -100 },
        'slow');
  });  

   
</script>
{{-- Indicator --}}
 <br>   
<br>   
<br> 

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



{{-- generic company table --}}
{{-- generic company table --}}
  <div class="card" id="genericcompanytable">
    <div class="card-body" >

        {{-- top side of the table --}}

        <h4 class="card-title" style="text-align: center;">Generic Companies</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#genericCompanySaveConfirmationModal" ><span>+ Create New Generic Company</span></a>


    <table id="datatable1" class="table table-striped table-bordered table-hover " >
          <thead>
              <tr class="bg-primary text-light">
                  <th scope="col">S/L</th>
                  <th scope="col">Action</th>
                  <th scope="col">Generic Company</th>
              </tr>
          </thead>
          
          <tbody>
               @foreach ($genericCompanyData as $genericcompany)
                  <tr>
                      <td>{{$loop->index+1}}</td>
                      <td id="tdtableaction">

                        <div class="d-inline-block">
                             <a role="button" href="#"   data-toggle="modal" data-target="#genericCompanyUpdateModal"  
                                 data-genericcompanyid='{{ $genericcompany->genericCompanyId }}' 
                                 data-genericcompany='{{ $genericcompany->genericCompany }}' 
                                 data-genericcompanycn='{{ $genericcompany->genericCompanyCN }}' 
                                 data-genericcompanyru='{{ $genericcompany->genericCompanyRU }}' 
                              title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                         </div>

                         @if ( !($genericcompany->isGenericCompanyUsed>0) )
                           <div class="d-inline-block tooltipster" title="Delete selected record?">
                               <form  method="post" action="{{ route('generics.settings.genericCompany.delete', $genericcompany->genericCompanyId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                      <td>{{$genericcompany->genericCompany.' '.$genericcompany->genericCompanyCN.' '.' '.$genericcompany->genericCompanyRU.' '}}</td>
                      
                  </tr>
                @endforeach
          </tbody>
      </table>

    </div>
  </div>
{{-- generic company table --}}
{{-- generic company table --}}

</div>









{{-- category table --}}
{{-- category table --}}
<div class="content-wrapper" style="min-height: 0px;" id="categorytable">
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Category</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#categorySaveConfirmationModal" ><span>+ Create New Category</span></a>
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable2" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">S/L</th>
                      <th scope="col">Action</th>
                      <th scope="col">Category</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($categoryData as $category)
                      <tr>
                          <td>{{$loop->index+1}}</td>
                          <td id="tdtableaction">

                             <div class="d-inline-block">
                                  <a role="button" href="#"   data-toggle="modal" data-target="#categoryUpdateModal"  

                                      data-categoryid='{{ $category->categoryId }}' 
                                      data-category='{{ $category->category }}' 
                                      data-categorycn='{{ $category->categoryCN }}' 
                                      data-categoryru='{{ $category->categoryRU }}' 

                                   title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                              </div>


                                  <div class="d-inline-block tooltipster" title="Delete selected record?">
                                      <form  method="post" action="{{ route('generics.settings.category.delete', $category->categoryId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                          <td>{{$category->category.' '.$category->categoryCN.' '.$category->categoryRU}}</td>

                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- category table --}}
{{-- category table --}}



{{-- disease category table --}}
{{-- disease category table --}}
<div class="content-wrapper" style="min-height: 0px;" id="diseasecategorytable">
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Disease Category</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#diseaseCategorySaveConfirmationModal" ><span>+ Create New Disease Category</span></a>
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable3" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">S/L</th>
                      <th scope="col">Action</th>
                      <th scope="col">Disease Category</th>
                      <th scope="col">Category</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($diseaseCategoryData as $diseasecategory)
                      <tr>
                          <td>{{$loop->index+1}}</td>
                          <td id="tdtableaction">

                            <div class="d-inline-block">
                                 <a role="button" href="#"   data-toggle="modal" data-target="#diseaseCategoryUpdateModal"  

                                     data-diseasecategoryid='{{ $diseasecategory->diseaseCategoryId }}' 
                                     data-diseasecategory='{{ $diseasecategory->diseaseCategory }}' 
                                     data-diseasecategorycn='{{ $diseasecategory->diseaseCategoryCN }}' 
                                     data-diseasecategoryru='{{ $diseasecategory->diseaseCategoryRU }}' 
                                     data-categoryid='{{ $diseasecategory->categoryId }}' 

                                  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                             </div>


                                 <div class="d-inline-block tooltipster" title="Delete selected record?">
                                     <form  method="post" action="{{ route('generics.settings.diseaseCategory.delete', $diseasecategory->diseaseCategoryId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                          <td>{{$diseasecategory->diseaseCategory.' '.$diseasecategory->diseaseCategoryCN.' '.$diseasecategory->diseaseCategoryRU}}</td>
                          <td>{{$diseasecategory->category.' '.$diseasecategory->categoryCN.' '.$diseasecategory->categoryRU}}</td>
                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- disease category table --}}
{{-- disease category table --}}




{{-- dosage form table --}}
{{-- dosage form table --}}
<div class="content-wrapper" style="min-height: 0px;"  id="dosageformtable">
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Dosage Form</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#dosageFormSaveConfirmationModal" ><span>+ Create New Dosage Form</span></a>
        

        {{-- data table start --}}
        {{-- data table start --}}
        <table id="datatable4" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">S/L</th>
                      <th scope="col">Action</th>
                      <th scope="col">Dosage Form</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($dosageForms as $dosageform)
                      <tr>
                          <td>{{$loop->index+1}}</td>
                          <td id="tdtableaction">

                            <div class="d-inline-block">
                                 <a role="button" href="#"   data-toggle="modal" data-target="#dosageFormUpdateModal"  

                                     data-dosageformid='{{ $dosageform->dosageFormId }}' 
                                     data-dosageform='{{ $dosageform->dosageForm }}' 
                                     data-dosageformcn='{{ $dosageform->dosageFormCN }}' 
                                     data-dosageformru='{{ $dosageform->dosageFormRU }}' 

                                  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                             </div>

                             @if ( !($dosageform->isDosageFormUsed>0) )

                                 <div class="d-inline-block tooltipster" title="Delete selected record?">
                                     <form  method="post" action="{{ route('generics.settings.dosageForm.delete', $dosageform->dosageFormId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                          <td>{{$dosageform->dosageForm.' '.$dosageform->dosageFormCN.' '.$dosageform->dosageFormRU}}</td>
                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- dosage form table --}}
{{-- dosage form table --}}







{{-- Generic Strength form table --}}
{{-- Generic Strength form table --}}
<div class="content-wrapper" style="min-height: 0px;"  id="genericstrengthtable">
  <div class="card">
    <div class="card-body">


        <h4 class="card-title" style="text-align: center;">Generic Strength</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#genericStrengthSaveConfirmationModal" ><span>+ Create New Generic Strength</span></a>
        

        <table id="datatable5" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      
                      <th scope="col">S/L</th>
                      <th scope="col">Action</th>
                      <th scope="col">Generic Strength</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($genericstrengths as $genericstrength)
                      <tr>
                          <td>{{$loop->index+1}}</td>
                          <td id="tdtableaction">

                            <div class="d-inline-block">
                                 <a role="button" href="#"   data-toggle="modal" data-target="#genericStrengthUpdateModal"  

                                     data-genericstrengthid='{{ $genericstrength->genericStrengthId }}' 
                                     data-genericstrength='{{ $genericstrength->genericStrength }}' 
                                     data-genericstrengthcn='{{ $genericstrength->genericStrengthCN }}' 
                                     data-genericstrengthru='{{ $genericstrength->genericStrengthRU }}' 

                                  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                             </div>

                              @if ( !($genericstrength->isGenericStrengthUsed>0) )
                                 <div class="d-inline-block tooltipster" title="Delete selected record?">
                                     <form  method="post" action="{{ route('generics.settings.genericStrength.delete', $genericstrength->genericStrengthId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                          <td>{{$genericstrength->genericStrength.' '.$genericstrength->genericStrengthCN.' '.$genericstrength->genericStrengthRU }}</td>
                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Generic Strength form table --}}
{{-- Generic Strength form table --}}









{{-- Pack Types form table --}}
{{-- Pack Types form table --}}
<div class="content-wrapper" style="min-height: 0px;"  id="packtypestable">
  <div class="card">
    <div class="card-body">
        <h4 class="card-title" style="text-align: center;">Pack Types</h4>

        <a href="#"  class="btn btn-default " style="margin-bottom: 10px; " data-toggle="modal" data-target="#packTypesSaveConfirmationModal" ><span>+ Create New Pack Types</span></a>
        
        <table id="datatable6" class="table table-striped table-bordered table-hover " >
              <thead>
                  <tr class="bg-primary text-light">
                      <th scope="col">S/L</th>
                      <th scope="col">Action</th>
                      <th scope="col">Pack Types</th>
                      <th scope="col">Weight (GM)</th>
                  </tr>
              </thead>
              
              <tbody>
                   @foreach ($packtypeData as $packtype)
                      <tr>
                          <td>{{$loop->index+1}}</td>
                          <td id="tdtableaction">

                            <div class="d-inline-block">
                                 <a role="button" href="#"   data-toggle="modal" data-target="#packTypesUpdateModal"  
                                     data-packtypeid='{{ $packtype->packTypeId }}' 
                                     data-packtype='{{ $packtype->packType }}' 
                                     data-packtypecn='{{ $packtype->packTypeCN }}' 
                                     data-packtyperu='{{ $packtype->packTypeRU }}' 
                                     data-weightgm='{{ $packtype->weightGM }}' 
                                  title="Edit Record?"><i class="fa fa-edit tooltipster" title="Edit Record?"></i></a>
                             </div>

                             @if ( !($packtype->isPackTypeUsed>0) )


                                 <div class="d-inline-block tooltipster" title="Delete selected record?">
                                     <form  method="post" action="{{ route('generics.settings.packType.delete', $packtype->packTypeId) }}" onsubmit="return confirm('Do you really want to proceed?');">
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
                          <td>{{$packtype->packType.' '.$packtype->packTypeCN.' '.$packtype->packTypeRU}}</td>
                          <td>{{$packtype->weightGM}}</td>
                          
                      </tr>
                    @endforeach
              </tbody>
          </table>

    </div>
  </div>
</div>
{{-- Pack Types form table --}}
{{-- Pack Types form table --}}
















<!-- Generic Company  Save Modal -->
<!-- Generic Company  Save Modal -->
<div class="modal fade" id="genericCompanySaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="genericCompanySaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="genericCompanySaveConfirmationModal">Add A Generic Company</h5>

      </div>
      <div class="modal-body" style="margin-top: -4vw;">
              

              <form class="form-horizontal" method="POST"  action="{{ route('generics.settings.genericCompany.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Generic Company</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericCompany" name="genericCompany" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic Company (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericCompanyCN" name="genericCompanyCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic Company (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericCompanyRU" name="genericCompanyRU" >
                                </div>
                              </div>
                            </div>


                            <button data-toggle="modal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>

                </form>
      </div>
    </div>
  </div>
</div>
<!-- Generic Company  Save Modal -->
<!-- Generic Company  Save Modal -->




<!-- Generic Company Edit Modal -->
<!-- Generic Company Edit Modal -->
<div class="modal fade" id="genericCompanyUpdateModal" tabindex="-1" role="dialog" aria-labelledby="genericCompanyUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="genericCompanyUpdateModal">Update Generic Company</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generics.settings.genericCompany.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="genericCompanyId" id="genericCompanyId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Generic Company</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="genericCompany" name="genericCompany" required>
                              </div>
                            </div>
                          </div>


                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Generic Company (CN)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="genericCompanyCN" name="genericCompanyCN" >
                              </div>
                            </div>
                          </div>


                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Generic Company (RU)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="genericCompanyRU" name="genericCompanyRU" >
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
<!-- Generic Company Edit Modal -->
<!-- Generic Company Edit Modal -->









<!-- Category  Save Modal -->
<!-- Category  Save Modal -->
<div class="modal fade" id="categorySaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="categorySaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="categorySaveConfirmationModal">Add A Category</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('generics.settings.category.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label"> Category</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="category" name="category" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Category (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="categoryCN" name="categoryCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Category (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="categoryRU" name="categoryRU" >
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
<!-- Category  Save Modal -->
<!-- Category  Save Modal -->




<!-- Category Edit Modal -->
<!-- Category Edit Modal -->
<div class="modal fade" id="categoryUpdateModal" tabindex="-1" role="dialog" aria-labelledby="categoryUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="categoryUpdateModal">Update Disease Category</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generics.settings.category.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="categoryId" id="categoryId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Disease Category</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="category" name="category" required>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Category (CN)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="categoryCN" name="categoryCN" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Category (RU)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="categoryRU" name="categoryRU" >
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
<!-- Category Edit Modal -->
<!-- Category Edit Modal -->












<!-- Disease Category  Save Modal -->
<!-- Disease Category  Save Modal -->
<div class="modal fade" id="diseaseCategorySaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="diseaseCategorySaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="diseaseCategorySaveConfirmationModal">Add A Disease Category</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('generics.settings.diseaseCategory.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Disease Category</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="diseaseCategory" name="diseaseCategory" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Disease Category (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="diseaseCategoryCN" name="diseaseCategoryCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Disease Category (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="diseaseCategoryRU" name="diseaseCategoryRU" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Category</label>
                                <div class="col-sm-8">
                                  <select class="form-control m-bot15" name="categoryId" id="categoryId" required >
                                      <option value="">--Select Category--</option>
                                      @foreach($categoryData as $category)
                                          <option value="{{ $category->categoryId }}">
                                            {{ title_case($category->category)}}
                                          </option> 
                                      @endforeach   
                                  </select>
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
<!-- Disease Category  Save Modal -->
<!-- Disease Category  Save Modal -->




<!-- Disease Category Edit Modal -->
<!-- Disease Category Edit Modal -->
<div class="modal fade" id="diseaseCategoryUpdateModal" tabindex="-1" role="dialog" aria-labelledby="diseaseCategoryUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="diseaseCategoryUpdateModal">Update Disease Category</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generics.settings.diseaseCategory.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="diseaseCategoryId" id="diseaseCategoryId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Disease Category</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="diseaseCategory" name="diseaseCategory" required>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Disease Category (CN)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="diseaseCategoryCN" name="diseaseCategoryCN" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Disease Category (RU)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="diseaseCategoryRU" name="diseaseCategoryRU" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Category</label>
                                <div class="col-sm-8">
                                  <select class="form-control m-bot15" name="categoryId" id="categoryId" required >
                                      @foreach($categoryData as $category)
                                          <option value="{{ $category->categoryId }}">
                                            {{ title_case($category->category)}}
                                          </option> 
                                      @endforeach   
                                  </select>
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
<!-- Disease Category Edit Modal -->
<!-- Disease Category Edit Modal -->









<!-- Dosage Form  Save Modal -->
<!-- Dosage Form  Save Modal -->
<div class="modal fade" id="dosageFormSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="dosageFormSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="dosageFormSaveConfirmationModal">Add A Dosage Form</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('generics.settings.dosageForm.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Dosage Form</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="dosageForm" name="dosageForm" required>
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Dosage Form (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="dosageFormCN" name="dosageFormCN" >
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Dosage Form (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="dosageFormRU" name="dosageFormRU" >
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
<!-- Dosage Form  Save Modal -->
<!-- Dosage Form  Save Modal -->




<!-- Dosage Form Edit Modal -->
<!-- Dosage Form Edit Modal -->
<div class="modal fade" id="dosageFormUpdateModal" tabindex="-1" role="dialog" aria-labelledby="dosageFormUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="dosageFormUpdateModal">Update Dosage Form</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generics.settings.dosageForm.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="dosageFormId" id="dosageFormId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Dosage Form</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="dosageForm" name="dosageForm" required>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Dosage Form (CN)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="dosageFormCN" name="dosageFormCN" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Dosage Form (RU)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="dosageFormRU" name="dosageFormRU" >
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
<!-- Dosage Form Edit Modal -->
<!-- Dosage Form Edit Modal -->








<!-- Generic strength  Save Modal -->
<!-- Generic strength  Save Modal -->
<div class="modal fade" id="genericStrengthSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="genericStrengthSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="genericStrengthSaveConfirmationModal">Add A Generic Strength</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('generics.settings.genericStrength.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Generic strength</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericStrength" name="genericStrength" required>
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic strength (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericStrengthCN" name="genericStrengthCN" >
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Generic strength (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="genericStrengthRU" name="genericStrengthRU" >
                                </div>
                              </div>
                            </div>


                            <button data-toggle="modal"  type="submit"   class="btn btn-success mr-2 float-right">Save</button>

                            <button type="button" class="btn btn-danger float-right mr-1" data-dismiss="modal">Cancel</button>
                        </div>


                </form>
      </div>
    </div>
  </div>
</div>
<!-- Generic strength  Save Modal -->
<!-- Generic strength  Save Modal -->








<!-- Generic strength  Edit Modal -->
<!-- Generic strength  Edit Modal -->
<div class="modal fade" id="genericStrengthUpdateModal" tabindex="-1" role="dialog" aria-labelledby="genericStrengthUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="genericStrengthUpdateModal">Update Generic strength </h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generics.settings.genericStrength.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="genericStrengthId" id="genericStrengthId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Generic strength </label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="genericStrength" name="genericStrength" required>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Generic strength (CN)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="genericStrengthCN" name="genericStrengthCN" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Generic strength (RU)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="genericStrengthRU" name="genericStrengthRU" >
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
<!-- Generic strength  Edit Modal -->
<!-- Generic strength  Edit Modal -->
















<!-- Pack Type  Save Modal -->
<!-- Pack Type  Save Modal -->
<div class="modal fade" id="packTypesSaveConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="packTypesSaveConfirmationModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="packTypesSaveConfirmationModal">Add A Pack Type</h5>
      </div>
      <div class="modal-body" style="margin-top: -4vw;">

              <form class="form-horizontal" method="POST"  action="{{ route('generics.settings.packType.insert') }}"  onsubmit="return confirm('Do you really want to proceed?');" >
                {{ csrf_field() }}

                    <br>
                      <p class="card-description">
                      </p>
                        <div>
                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Pack Type</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="packType" name="packType" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Pack Type (CN)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="packTypeCN" name="packTypeCN" >
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="form-group row ">
                                <label class="col-sm-4 col-form-label control-label">Pack Type (RU)</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control" id="packTypeRU" name="packTypeRU" >
                                </div>
                              </div>
                            </div>


                            <div class="col-md-12">
                              <div class="form-group row required">
                                <label class="col-sm-4 col-form-label control-label">Weight (GM)</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control" id="weightGM" name="weightGM" required>
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
<!-- Pack Type  Save Modal -->
<!-- Pack Type  Save Modal -->




<!-- Pack Type Edit Modal -->
<!-- Pack Type Edit Modal -->
<div class="modal fade" id="packTypesUpdateModal" tabindex="-1" role="dialog" aria-labelledby="packTypesUpdateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title offset-5" id="packTypesUpdateModal">Update Pack Type</h5>
      </div>
      <div class="modal-body" style="margin-top: -2vw;">
              <form class="form-horizontal"  method="post" enctype="multipart/form-data" action="{{ route('generics.settings.packType.update') }}"  onsubmit="return confirm('Do you really want to proceed?');">
                          {{method_field('put')}}
                          {{ csrf_field() }}

                          <input type="hidden" name="packTypeId" id="packTypeId" value="">

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Pack Type</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="packType" name="packType" required>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Pack Type (CN)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="packTypeCN" name="packTypeCN" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row ">
                              <label class="col-sm-4 col-form-label control-label">Pack Type (RU)</label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="packTypeRU" name="packTypeRU" >
                              </div>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group row required">
                              <label class="col-sm-4 col-form-label control-label">Weight (GM)</label>
                              <div class="col-sm-8">
                                <input type="number" class="form-control" id="weightGM" name="weightGM" required>
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
<!-- Pack Type Edit Modal -->
<!-- Pack Type Edit Modal -->


@endsection