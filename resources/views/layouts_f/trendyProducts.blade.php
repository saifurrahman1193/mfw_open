
<style type="text/css">

    ul li ul li{
        list-style: none;
        font-size: 16px;
        line-height: 35px;
    }

    ul li ul li:hover{
        color : #109510b0;
    }


    ul li ul li a:focus{
        /* color : #cac221; */
        color : #109510b0;

    }

    
</style>

@section('trendy_products_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
<div class="container-fluid trendy-sec">
	
    <div class="col-md-3 category-col">
    	
        <nav class="navbar navbar-default " >
            
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-category-sub-category-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <h2>                  
                    @if (app()->getLocale()=='en')    Categories
                    @elseif (app()->getLocale()=='ru')    категории
                    @elseif (app()->getLocale()=='cn')    分类
                    @endif
              </h2>
            </div>   
            
            {{-- CATEGORY SELECTION --}}
            <div class="collapse navbar-collapse" id="bs-category-sub-category-navbar-collapse" style="overflow-y: scroll !important; max-height: 480px; ">
                  <ul class="nav navbar-nav">

                    <li >
                        <a href="{{ 
                            route('productlistPage', [app()->getLocale(), 'diseaseCategoryId' => 0 ,'categoryId'=>'' ])
                        }}">
                            {{ __('productlist.all') }}

                            {{ '('.$genericbrandData->count('genericBrandId').')' }}
                                <i class="flaticon-1-right-arrow" aria-hidden="true"></i>
                            
                            
                        </a>
                    </li>

                    @foreach ($categoryData->sortBy('category') as $category)
                        <li data-toggle="collapse"  href="#collapseCat-{{ $category->categoryId }}" data-categoryid="{{ $category->categoryId }}" 
                            data-category="{{ $category->category }}"
                            data-categoryru="{{ $category->categoryRU }}"
                            data-categorycn="{{ $category->categoryCN }}"

                         class="category-subcategory" style="z-index: 20;">
                            <a href="javascript:void(0)">
                                

                                @if (app()->getLocale()=='en')    {{ $category->category }} 
                                @elseif (app()->getLocale()=='ru')    {{ $category->categoryRU }} 
                                @elseif (app()->getLocale()=='cn')    {{ $category->categoryCN }} 
                                @endif


                                {{ '('.$genericbrandcategoryData->where('categoryId', $category->categoryId)->count('genericBrandId').')' }}


                                <i class="flaticon-1-right-arrow" aria-hidden="true"></i>
                            </a>
                            <ul class="collapse" id="collapseCat-{{ $category->categoryId }}" >

                                


                                @foreach ( ($diseasecategoryData->where('categoryId', $category->categoryId))->sortBy('diseaseCategory') as $diseasecategory)

                                    <li  data-diseasecategoryid="{{ $diseasecategory->diseaseCategoryId }}" 
                                        data-diseasecategory="{{ $diseasecategory->diseaseCategory }}" 
                                        data-diseasecategoryru="{{ $diseasecategory->diseaseCategoryRU }}" 
                                        data-diseasecategorycn="{{ $diseasecategory->diseaseCategoryCN }}" 

                                        class="category-subcategory" style="z-index: 20;">
                                        <a href="javascript:void(0)">
                                            @if (app()->getLocale()=='en')    {{ $diseasecategory->diseaseCategory }}
                                            @elseif (app()->getLocale()=='ru')    {{ $diseasecategory->diseaseCategoryRU }}
                                            @elseif (app()->getLocale()=='cn')    {{ $diseasecategory->diseaseCategoryCN }}
                                            @endif

                                            {{ '('.$genericbranddieseasecateprodData->where('diseaseCategoryId', $diseasecategory->diseaseCategoryId)->count('genericBrandId').')' }}
                                            
                                        </a>
                                    </li>

                                @endforeach
                            </ul>
                        </li>
                    @endforeach

                  </ul>
              
            </div>
            {{-- CATEGORY SELECTION --}}

        </nav>
        
    </div>
    

    <div class="col-md-9 col-md-offset-3 padd-60">
    	
        <div class="col-md-12 text-center heading">
            {{-- <h1>Trendy</h1> --}}
            {{-- <h1 id="category-section-header-bg" >{{ ($categoryData->sortBy('category'))->pluck('category')->first() }}</h1> --}}
            <h2 id="category-section-header"  >
                @if (app()->getLocale()=='en')    
                    {{ ($categoryData->sortBy('category'))->pluck('category')->first() }}
                @elseif (app()->getLocale()=='ru')    
                    {{ ($categoryData->sortBy('category'))->pluck('categoryRU')->first() }}
                @elseif (app()->getLocale()=='cn')    
                    {{ ($categoryData->sortBy('category'))->pluck('categoryCN')->first() }}
                @endif
            </h2>
        </div>
        <div class="clearfix"></div>
        
        <div class="tranding mt-30">
        	<div class="owl-carousel special-offer " id="tranding">

        
                    @foreach ( $genericbrandcategoryData->where('categoryId', ($categoryData->sortBy('category'))->pluck('categoryId')->first() ) as $genericbrandcategory)
                    
                      <div class="thumbnail no-border no-padding" >

                        <div class="product">

                        	<div class="product-img">
                            	<a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] )  }}" class="product-href"></a>
                                <img class="lozad" data-src="{{ asset('image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $genericbrandcategory->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=400&sizeY=400"  alt="image" class="img-responsive"   style="max-height: 235px; min-height: 235px"/>
                        	</div>

                       		<div class="product-body" style="max-height: 155px; min-height: 155px">
                                {{-- <p><a href="#">{{ $slider_new_selling_product->genericBrand }}</a></p> --}}
                                @if ( (round($reviewData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('rating')->first())) > 0)
                                    <p>
                                        @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                            <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                        @endfor

                                        @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                            <i class="fa fa-star" style="color: #ddd !important;"></i>
                                        @endfor
                                    </p>
                                @endif
                                
                                <p>  
                                    @if (app()->getLocale()=='en')
                                        <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] ) }}">
                                            {{ $genericbrandcategory->genericBrand }}
                                            {{ $genericstrengthCompactData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericStrength')->first() }}
                                        </a>
                                    @elseif (app()->getLocale()=='ru')    
                                        <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] ) }}">
                                            {{ $genericbrandcategory->genericBrandRU }}
                                            {{ $genericstrengthCompactData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                        </a>
                                    @elseif (app()->getLocale()=='cn') 
                                        <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] ) }}">
                                            {{ $genericbrandcategory->genericBrandCN }}
                                            {{ $genericstrengthCompactData->where('genericBrandId', $genericbrandcategory->genericBrandId)->pluck('genericStrengthCN')->first() }}
                                        </a>
                                    @endif
                                </p>                                

                                <h5><strong>                                    

                                    @if (app()->getLocale()=='en')  
                                        <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] ) }}"> 
                                            {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->first() )->genericName }}
                                        </a> 
                                    @elseif (app()->getLocale()=='ru')   
                                        <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] ) }}">
                                            {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->first() )->genericNameRU }}
                                        </a> 
                                    @elseif (app()->getLocale()=='cn') 
                                        <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] ) }}">  
                                            {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->first() )->genericNameCN }} 
                                        </a>
                                    @endif

                                </strong></h5>
                                <h5>
                                    @if (app()->getLocale()=='en')
                                        <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] ) }}">    
                                            {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->first() )->genericCompany }}
                                        </a>
                                    @elseif (app()->getLocale()=='ru') 
                                        <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] ) }}">   
                                            {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->first() )->genericCompanyRU }}
                                        </a>
                                    @elseif (app()->getLocale()=='cn')  
                                        <a href="{{ route('productDetailsPageCaller', [app()->getLocale(), $genericbrandcategory->genericBrandId] ) }}">  
                                            {{ ( $genericbrandData->where('genericBrandId', $genericbrandcategory->genericBrandId)->first() )->genericCompanyCN }}
                                        </a>
                                    @endif
                                    
                                </h5>
                               
                            </div>

                        </div>
                      </div>
                    @endforeach




              
              
              
            </div>
      	</div>

        <div style="float: right;  padding-right: 5vw;" >
            <a   href="{{ 
                route('productlistPage', [app()->getLocale(), 'diseaseCategoryId' => 0 ,'categoryId'=>'' ])
                
             }}" class="more-button">
                {{ __('slidernewproducts.more') }} >>
            </a>
        </div>
        
    </div>
    
    <div class="clearfix"></div>
    
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('ul > li > ul > li').on('click', function(e) { e.stopPropagation(); });
    });
</script>


<script type="text/javascript">
    $(document).ready(function() 
    {
        $('.category-subcategory').on('click', function(e) 
        { 
              var categoryId = $(this).data('categoryid');

              var category = $(this).data('category');
              var categoryRU = $(this).data('categoryru');
              var categoryCN = $(this).data('categorycn');

              {{-- console.log(categoryId)   --}}

              var diseaseCategoryId = $(this).data('diseasecategoryid');
              var diseaseCategory = $(this).data('diseasecategory');
              var diseaseCategoryRU = $(this).data('diseasecategoryru');
              var diseaseCategoryCN = $(this).data('diseasecategorycn');
              {{-- console.log(diseaseCategoryId)   --}}

              if (categoryId>0) 
              {

                @if (app()->getLocale()=='en')    
                    $('#category-section-header').text(category);
                @elseif (app()->getLocale()=='ru')    
                    $('#category-section-header').text(categoryRU);
                @elseif (app()->getLocale()=='cn')    
                    $('#category-section-header').text(categoryCN);
                @endif



                $.ajax({
                    // url: '/{{ app()->getLocale() }}/inventory/states/get/'+genericId,
                    url: '/{{ app()->getLocale() }}/home/homecategorysection/getHomeCategoryProducts/'+categoryId,
                    type:"GET",
                    dataType:"json",

                    success:function(data) {

                        $("#tranding").empty();
                        {{-- // console.log(response); --}}
                        {{-- // console.log(response.data); --}}
                        console.log(data);
                        {{-- console.log(data.data); --}}
                        // var json_obj = $.parseJSON(data.object);//parse JSON


                        
                        {{-- // console.log(data.data.length) --}}

                        if (data.data.length<1) {
                             $("#tranding").append(

                                '<div class="thumbnail no-border no-padding"  style="height:500px;">'
                                    
                                +'</div>' 

                            );
                        }

                        
                        // $('#tranding').html('<div id="tranding" class="owl-carousel"></div>');

                        
                        $(data.data).each(function(index, el) {

                            {{-- console.log('genericBrandId = '+el.genericBrandId+ ', genericBrand = '+el.genericBrand+', category = '+el.category); --}}

                            

                            @if (app()->getLocale()=='en')    
                                var genericBrandVar = el.genericBrand;
                                var genericStrengthVar = el.genericStrength;
                                var genericNameVar = el.genericName;
                                var genericCompanyVar = el.genericCompany;
                    
                            @elseif (app()->getLocale()=='ru')   
                                var genericBrandVar = el.genericBrandRU;
                                var genericStrengthVar = el.genericStrengthRU;
                                var genericNameVar = el.genericNameRU;
                                var genericCompanyVar = el.genericCompanyRU; 
                            
                            @elseif (app()->getLocale()=='cn')  
                                var genericBrandVar = el.genericBrandCN;
                                var genericStrengthVar = el.genericStrengthCN;
                                var genericNameVar = el.genericNameCN;
                                var genericCompanyVar = el.genericCompanyCN;  
                            
                            @endif

                            
                            $("#tranding").append(
                        

                                            '<div class="thumbnail no-border no-padding"> '
                                                +' <div class="product"> '
                                                    +'<div class="product-img"> '
                                                        +'<a href="'
                                                            +'/{{ app()->getLocale() }}/productDetailsPageCaller/'+el.genericBrandId
                                                        +'" class="product-href"></a>'
                                                        +'<img src="image/imageResize?url='+el.picPath+'&sizeX=400&sizeY=400"  alt="image" class="img-responsive"   style="max-height: 235px; min-height: 235px"/>'
                                                    +'</div> '
                                                    +'<div class="product-body" style="max-height: 155px; min-height: 155px"> '
                                                        +'<a href="'
                                                            +'/{{ app()->getLocale() }}/productDetailsPageCaller/'+el.genericBrandId
                                                        +'" >'
                                                            +'<p>'
                                                                +genericBrandVar
                                                                    +' '
                                                                +genericStrengthVar
                                                            +'</p>'
                                                        +'</a>'

                                                        +'<h5>'
                                                            +'<strong>'
                                                                +genericNameVar
                                                            +'</strong>'
                                                        +'</h5>'
                                                        +'<h5>'
                                                            +genericCompanyVar
                                                        +'</h5>'

                                                    +'</div>'
                                                +'</div>'
                                            +'</div>' 
                            );

                        });


                        $('#tranding').owlCarousel('refresh');

                        var owl = $("#tranding");
                        owl.data('owlCarousel').destroy();

                        owl.owlCarousel({
                          autoplay:true,
                            autoplayTimeout:2000,
                            autoplayHoverPause:true,
                            loop: true,
                            margin: 10,
                            dots: true,
                            nav: true,
                            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                            responsive: {
                                320: {
                                    items: 1
                                },
                                479: {
                                    items: 2
                                },
                                768: {
                                    items: 3
                                },
                                991: {
                                    items: 3
                                },
                                1024: {
                                    items: 3
                                },
                                1280: {
                                    items: 3
                                },
                            }
                        });


                    },
                    failure: function(){
                        {{-- console.log('Failure') --}}
                    },
                    complete: function(){
                        {{-- console.log('Complete') --}}

                    }
                });

              }
              else if (diseaseCategoryId>0) 
              {


                @if (app()->getLocale()=='en')    
                    $('#category-section-header').text(diseaseCategory);
                @elseif (app()->getLocale()=='ru')    
                    $('#category-section-header').text(diseaseCategoryRU);
                @elseif (app()->getLocale()=='cn')    
                    $('#category-section-header').text(diseaseCategoryCN);
                @endif


                $.ajax({
                    // url: '/{{ app()->getLocale() }}/inventory/states/get/'+genericId,
                    url: '/{{ app()->getLocale() }}/home/homecategorysection/getHomeDiseaseCategoryProducts/'+diseaseCategoryId,
                    type:"GET",
                    dataType:"json",

                    success:function(data) {

                        $("#tranding").empty();
                        {{-- // console.log(response); --}}
                        {{-- // console.log(response.data); --}}
                        console.log(data);
                        {{-- console.log(data.data); --}}
                        // var json_obj = $.parseJSON(data.object);//parse JSON


                        
                        {{-- // console.log(data.data.length) --}}

                        if (data.data.length<1) {
                             $("#tranding").append(

                                '<div class="thumbnail no-border no-padding"  style="height:500px;">'
                                    
                                +'</div>' 

                            );
                        }

                        
                        // $('#tranding').html('<div id="tranding" class="owl-carousel"></div>');

                        
                        $(data.data).each(function(index, el) {

                            {{-- console.log('genericBrandId = '+el.genericBrandId+ ', genericBrand = '+el.genericBrand+', category = '+el.category); --}}


                            @if (app()->getLocale()=='en')    
                                var genericBrandVar = el.genericBrand;
                                var genericStrengthVar = el.genericStrength;
                                var genericNameVar = el.genericName;
                                var genericCompanyVar = el.genericCompany;
                    
                            @elseif (app()->getLocale()=='ru')   
                                var genericBrandVar = el.genericBrandRU;
                                var genericStrengthVar = el.genericStrengthRU;
                                var genericNameVar = el.genericNameRU;
                                var genericCompanyVar = el.genericCompanyRU; 
                            
                            @elseif (app()->getLocale()=='cn')  
                                var genericBrandVar = el.genericBrandCN;
                                var genericStrengthVar = el.genericStrengthCN;
                                var genericNameVar = el.genericNameCN;
                                var genericCompanyVar = el.genericCompanyCN;  
                            
                            @endif



                            
                            $("#tranding").append(
                        

                                            '<div class="thumbnail no-border no-padding"> '
                                                +' <div class="product"> '
                                                    +'<div class="product-img"> '
                                                        +'<a href="'
                                                            +'/{{ app()->getLocale() }}/productDetailsPageCaller/'+el.genericBrandId
                                                        +'" class="product-href"></a>'
                                                        +'<img src="image/imageResize?url='+el.picPath+'&sizeX=400&sizeY=400"  alt="image" class="img-responsive"   style="max-height: 235px; min-height: 235px"/>'
                                                    +'</div> '
                                                    +'<div class="product-body" style="max-height: 155px; min-height: 155px"> '

                                                        +'<a href="'
                                                            +'/{{ app()->getLocale() }}/productDetailsPageCaller/'+el.genericBrandId
                                                        +'" >'
                                                            +'<p>'
                                                                +genericBrandVar
                                                                    +' '
                                                                +genericStrengthVar
                                                            +'</p>'
                                                        +'</a>'

                                                        +'<h5>'
                                                            +'<strong>'
                                                                +genericNameVar
                                                            +'</strong>'
                                                        +'</h5>'
                                                        +'<h5>'
                                                            +genericCompanyVar
                                                        +'</h5>'

                                                    +'</div>'
                                                +'</div>'
                                            +'</div>' 

                            );

                        });


                        $('#tranding').owlCarousel('refresh');

                        var owl = $("#tranding");
                        owl.data('owlCarousel').destroy();

                        owl.owlCarousel({
                          autoplay:true,
                            autoplayTimeout:2000,
                            autoplayHoverPause:true,
                            loop: true,
                            margin: 10,
                            dots: true,
                            nav: true,
                            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
                            responsive: {
                                320: {
                                    items: 1
                                },
                                479: {
                                    items: 2
                                },
                                768: {
                                    items: 3
                                },
                                991: {
                                    items: 3
                                },
                                1024: {
                                    items: 3
                                },
                                1280: {
                                    items: 3
                                },
                            }
                        });


                    },
                    failure: function(){
                        {{-- console.log('Failure') --}}
                    },
                    complete: function(){
                        {{-- console.log('Complete') --}}

                    }


                  });


              }

         });
    });
</script>




<script type="text/javascript">
    $(document).ready(function() {
        $('.navbar-nav>li>a, .navbar-nav>li>ul>li>a').on('click', function(){
            $('.navbar-collapse').collapse('hide');
        });
    });
</script>

@endsection

