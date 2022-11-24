@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

{{-- @section('pageTitle', title_case($pageData->pageTitle)) --}}

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@if (app()->getLocale()=='en' ) @section('pageTitle', $pageData->pageTitle)
@elseif (app()->getLocale()=='cn' ) @section('pageTitle', $pageData->pageTitleCN)
@elseif (app()->getLocale()=='ru' ) @section('pageTitle', $pageData->pageTitleRU)
@endif

@if (app()->getLocale()=='en' ) @section('meta_keywords', $pageData->meta_keywords)
@elseif (app()->getLocale()=='cn' ) @section('meta_keywords', $pageData->meta_keywordsCN)
@elseif (app()->getLocale()=='ru' ) @section('meta_keywords', $pageData->meta_keywordsRU)
@endif

@if (app()->getLocale()=='en' ) @section('meta_description', $pageData->meta_description)
@elseif (app()->getLocale()=='cn' ) @section('meta_description', $pageData->meta_descriptionCN)
@elseif (app()->getLocale()=='ru' ) @section('meta_description', $pageData->meta_descriptionRU)
@endif


{{-- <script src="{{ asset('frontend/js/jquery-3.4.1.min.js') }}"></script> --}}

{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}




@section('page_content')

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            <h2 class="card-title" style="text-align: center; font-weight: bold;">
                @if (app()->getLocale()=='en')    {!! $pageData->pageTitle !!}
                @elseif (app()->getLocale()=='cn')  {!! $pageData->pageTitleCN !!}  
                @elseif (app()->getLocale()=='ru')  {!! $pageData->pageTitleRU !!}  
                @endif
                
            </h2>

            {{-- <div class="row justify-content-center ">
                <div class="row col-md-12">
                    <div class="card row"  style=" margin-top: 25px;">

                        <div class="card-body">
                            
                            
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <p>
            @if (app()->getLocale()=='en')    {!! $pageData->pageDesc !!}
                        @elseif (app()->getLocale()=='cn')  {!! $pageData->pageDescCN !!}  
                        @elseif (app()->getLocale()=='ru')  {!! $pageData->pageDescRU!!}  
                        @endif
        </p>
    </div> 
</div>


@endsection
