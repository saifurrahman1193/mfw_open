@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Sitemap')

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


@section('page_content')

<style>
    #sitemap li{
        padding: 10px 0px;
    }
    #sitemap li:hover{
        color: green;
        font-size: 16px;
    }
</style>

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            <h2 class="card-title" style="text-align: center; font-weight: bold;">{{ __('header.Sitemap') }}</h2>

            
          
            <ul id="sitemap">
                <li> <a class="nav-link"   
                    href="{{ route('home_f', app()->getLocale() ) }}" target="_blank"> {{ __('header.Home') }} </a></li>
                <li> <a class="nav-link" href="{{ route('contact_f', app()->getLocale()) }}" target="_blank"> {{ __('header.Contact') }} </a></li>
                <li> <a class="nav-link"  href="{{ route('sitemap_f', app()->getLocale()) }}"  target="_blank">  {{ __('header.Sitemap') }} </a></li> 
                <li> 
                    <a class="nav-link"  href="{{ route('productlistPage', [app()->getLocale(), 'diseaseCategoryId' => 0 ,'categoryId'=>''])  }}"  target="_blank">{{ __('header.Products') }}</a></li> 
                {{-- <li><a href="#"><strong>About</strong></a></li>
                <ul><li><a href="#">Subpage 1</a></li>
                    <li><a href="#">Subpage 2</a></li>
                    <li><a href="#">Subpage 3</a></li>
                    <li><a href="#">Subpage 4</a></li></ul>
                <li><a href="#"><strong>Portfolio</strong></a></li>
                <ul><li><a href="#">Subpage 1</a></li>
                    <li><a href="#">Subpage 2</a></li></ul>
                <li><a href="#"><strong>Contact</strong></a></li> --}}

                @foreach ($footerportion2pagesData as $footerportion2page)
                    <li>
                        <a href="{{ route('dynamicPageFront', [app()->getLocale(),$footerportion2page->pageId] ) }}" target="_blank">
                            @if (app()->getLocale()=='en')
                                {{ $footerportion2page->pageTitle }}
                            @elseif (app()->getLocale()=='cn')
                                {{ $footerportion2page->pageTitleCN }}
                            @elseif (app()->getLocale()=='ru')
                                {{ $footerportion2page->pageTitleRU }}
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>   
              


        </div>
    </div>
</div>



@endsection
