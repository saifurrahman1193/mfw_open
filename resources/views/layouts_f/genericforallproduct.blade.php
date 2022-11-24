
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

@section('genericforallproduct_content')
<?php
    $genericforallproducts = Cache::rememberForever('genericforallproduct_content_genericforallproducts',  function () {
            return DB::table('genericforallproduct_view')->get(); 
    });


    $genericbrands = Cache::rememberForever('genericforallproduct_content_genericbrands',  function () {
            return DB::table('genericbrand_view')->where('isFrontendVisible', 1)->get(); 
    });
    
?>
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}
@if ($genericforallproducts->count()>0)
<hr>
    
<div class="container-fluid trendy-sec add-section-space" >
	
    <div class="col-md-3 category-col">
    	
        <nav class="navbar navbar-default " >
            
            <div class="navbar-header" style="position: relative; z-index: -10;">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-category-sub-category-genericforallproduct-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>  
                                
                    @if (app()->getLocale()=='en')   <h4> SHOW PRODUCTS BY GENERIC</h4>
                    @elseif (app()->getLocale()=='cn') <h4>   展示产品通用的 </h4>
                    @elseif (app()->getLocale()=='ru')  <h7>  ПОКАЗАТЬ ПРОДУКТЫ ПО РОДОВОЕ </h7>
                    @endif
              
            </div>   
            
            {{-- CATEGORY SELECTION --}}
            <div class="collapse navbar-collapse" id="bs-category-sub-category-genericforallproduct-navbar-collapse" style="overflow-y: scroll !important; max-height: 480px; ">
                <ul class="nav navbar-nav">
                    @foreach ($genericforallproducts->where('isViewable', 1)->sortBy('genericName') as $item)
                        <li >
                            <a href="{{ 
                                route('generic_medicine', [app()->getLocale(), Illuminate\Support\Str::slug($item->metaTitle), $item->genericId])
                            }}">
                                @if (app()->getLocale()=='en')    {{$item->genericName}}
                                @elseif (app()->getLocale()=='cn')    {{$item->genericNameCN}}
                                @elseif (app()->getLocale()=='ru')    {{$item->genericNameRU}}
                                @endif
                                <i class="flaticon-1-right-arrow" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- CATEGORY SELECTION --}}

        </nav>
        
    </div>
    
    <div class="col-md-9 col-md-offset-3 padd-30">
    	
        <div class="col-md-12 text-center heading">
            {{-- <h1>Trendy</h1> --}}
            {{-- <h1 id="category-section-header-bg" >{{ ($categoryData->sortBy('category'))->pluck('category')->first() }}</h1> --}}
            <h2 id="category-section-header"  >
                @if (app()->getLocale()=='en')    
                    {{ ($genericforallproducts->where('isViewable', 1)->sortBy('metaTitle'))->pluck('genericName')->first() }}
                @elseif (app()->getLocale()=='ru')    
                    {{ ($genericforallproducts->where('isViewable', 1)->sortBy('metaTitle'))->pluck('genericNameRU')->first() }}
                @elseif (app()->getLocale()=='cn')    
                    {{ ($genericforallproducts->where('isViewable', 1)->sortBy('metaTitle'))->pluck('genericNameCN')->first() }}
                @endif
            </h2>
        </div>
        <div class="clearfix"></div>
        
        <div class="tranding mt-30">

        
                    <div class="row" id="category-subcat-products" style="overflow-y: scroll !important; max-height: 360px; ">
            

                        {{-- products --}}
                        {{-- products --}}
                        {{-- products --}}

            
                        @foreach ( $genericbrands->where('genericId', ($genericforallproducts->where('isViewable', 1)->sortBy('metaTitle'))->pluck('genericId')->first()) as $item)
                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-left single-product">
                                <div class="product">
                                        <div class="product-img">
                                            <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $item->genericBrandId ] ) }}" class="product-href"></a>
                                                <img  data-src="{{ asset('/image/imageResize?url='.$genericbrandpicData->where('genericBrandId', $item->genericBrandId )->pluck('picPath')->first() ) }}&sizeX=200&sizeY=200" alt="image" class="lozad img-responsive"   style="max-height: 235px; min-height: 235px"/>
                                        </div>
                                        <div class="product-body" style="max-height: 155px; min-height: 155px">
                                            @if ( (round($reviewData->where('genericBrandId', $item->genericBrandId)->pluck('rating')->first())) > 0)
                                                <p>
                                                    @for ($i = 1; $i <= (round($reviewData->where('genericBrandId', $item->genericBrandId)->pluck('rating')->first())); $i++) {{-- ratings --}}
                                                        <i class="fa fa-star" style="color: #eec627 !important;"></i>
                                                    @endfor
            
                                                    @for ($i = 1; $i <= 5-(round($reviewData->where('genericBrandId', $item->genericBrandId)->pluck('rating')->first())); $i++)  {{-- non ratings --}}
                                                        <i class="fa fa-star" style="color: #ddd !important;"></i>
                                                    @endfor
                                                </p>
                                            @endif
                                                    
                                            <p>
                                                <a href="{{ route('productDetailsPageCaller', [ app()->getLocale(), $item->genericBrandId ] ) }}">
                                                    @if (app()->getLocale()=='en')    
                                                        {{ $item->genericBrand }}
                                                        {{ $genericstrengthCompactData->where('genericBrandId', $item->genericBrandId)->pluck('genericStrength')->first() }}
                                                    @elseif (app()->getLocale()=='ru')  
                                                        {{ $item->genericBrandRU }}
                                                        {{ $genericstrengthCompactData->where('genericBrandId', $item->genericBrandId)->pluck('genericStrengthRU')->first() }}
                                                    @elseif (app()->getLocale()=='cn')    
                                                        {{ $item->genericBrandCN }}
                                                        {{ $genericstrengthCompactData->where('genericBrandId', $item->genericBrandId)->pluck('genericStrengthCN')->first() }}
                                                    @endif
                                                </a>
                                            </p>
            
                                            
            
                                            <h5><strong>
                                                @if (app()->getLocale()=='en')  
                                                    {{ ( $genericbrandData->where('genericBrandId', $item->genericBrandId)->pluck('genericName')->first() ) }}  
                                                @elseif (app()->getLocale()=='ru')    
                                                    {{ ( $genericbrandData->where('genericBrandId', $item->genericBrandId)->pluck('genericNameRU')->first() ) }}
                                                @elseif (app()->getLocale()=='cn')   
                                                    {{ ( $genericbrandData->where('genericBrandId', $item->genericBrandId)->pluck('genericNameCN')->first() ) }} 
                                                @endif
                                                
                                            </strong></h5>
                                            <h5>
                                                
                                                @if (app()->getLocale()=='en')    
                                                    {{ ( $genericbrandData->where('genericBrandId', $item->genericBrandId)->pluck('genericCompany')->first() ) }}
                                                @elseif (app()->getLocale()=='ru')    
                                                    {{ ( $genericbrandData->where('genericBrandId', $item->genericBrandId)->pluck('genericCompanyRU')->first() ) }}
                                                @elseif (app()->getLocale()=='cn')    
                                                    {{ ( $genericbrandData->where('genericBrandId', $item->genericBrandId)->pluck('genericCompanyCN')->first() ) }}
                                                @endif
                                            </h5>
                                        </div>
                                </div>
                            </div>
                        @endforeach
            
            
                        
                        
                    </div>
        
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
    $(document).ready(function() {
        $('.navbar-nav>li>a, .navbar-nav>li>ul>li>a').on('click', function(){
            $('.navbar-collapse').collapse('hide');
        });
    });
</script>


<style scoped>
.add-section-space{
    height: 580px;
}
</style>

@endif


<style type="text/css">
    .single-product  a {
        float: none;
        padding: 0px;
    }
</style>

@endsection

