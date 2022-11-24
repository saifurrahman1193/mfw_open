{{-- NOT USED --}}
@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Delivery Methods')

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


@section('page_content')

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            <h2 class="card-title" style="text-align: center; font-weight: bold;">
                @if (app()->getLocale()=='en')    {!! title_case($pageData->pageTitle) !!}
                @elseif (app()->getLocale()=='cn')  {!! title_case($pageData->pageTitleCN) !!}  
                @elseif (app()->getLocale()=='ru')  {!! title_case($pageData->pageTitleRU) !!}  
                @endif
                
            </h2>

            <div class="row justify-content-center ">
                <div class="row col-md-12">
                    <div class="card row"  style=" margin-top: 25px;">

                        <div class="card-body">
                            
                            @if (app()->getLocale()=='en')    {!! $pageData->pageDesc !!}
                            @elseif (app()->getLocale()=='cn')  {!! $pageData->pageDescCN !!}  
                            @elseif (app()->getLocale()=='ru')  {!! $pageData->pageDescRU!!}  
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
