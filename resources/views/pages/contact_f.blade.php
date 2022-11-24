@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Contact')


{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


@section('page_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            <h2 class="card-title" style="text-align: center; font-weight: bold;">
                @if (app()->getLocale()=='en')
                    {{ $footerportion4Data->portion4Title }}
                @elseif (app()->getLocale()=='cn')
                    {{ $footerportion4Data->portion4TitleCN }}
                @elseif (app()->getLocale()=='ru')
                    {{ $footerportion4Data->portion4TitleRU }}
                @endif
                {{-- {{ __('header.Contact') }} --}}
                
            </h2>

            <div class="row justify-content-center ">
                <div class="row col-md-12 ">
                    <div class="card row"  style=" margin-top: 25px; margin-left: 25%; margin-right: 25%;">

                        <div class="card-body">
                            
                            @if (app()->getLocale()=='en')
                            <p style="text-align: center !important;">{!! $footerportion4Data->portion4Desc !!}</p>
                            
                            @elseif (app()->getLocale()=='cn')
                                {!! $footerportion4Data->portion4DescCN !!}
                            @elseif (app()->getLocale()=='ru')
                                {!! $footerportion4Data->portion4DescRU !!}
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>

            <ul class="list-inline" style="text-align: center;">
                @foreach ($footerportion4socialsData as $footerportion4social)
                    <li class="footerportion1-social-icons" 
                        style="
                            border: 1px solid;
                            border-radius: 50%;
                        " 
                    >
                        <a role="button" href="#"   data-toggle="modal" data-target="#socialDetailModal"
                             data-socialmediaid='{{ $footerportion4social->socialMediaId }}' 
                              data-socialmedia='{{ $footerportion4social->socialMedia }}' 
                              data-iconclass='{{ $footerportion4social->iconclass }}' 
                              data-iconsrc='{{ $footerportion4social->iconsrc }}' 
                              data-link='{{ $footerportion4social->link }}' 
                              data-info='{{ $footerportion4social->info }}' 
                              data-picpath='{{ $footerportion4social->picPath }}' 
                        >
                            @if ($footerportion4social->iconclass != null)
                                <i class="{{ $footerportion4social->iconclass }}"></i>
                            @else
                                <img src="{{ $footerportion4social->iconsrc }}" alt="" style="max-height: 20px; max-width: 20px;">
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>


        </div>
    </div>
</div>


@endsection
