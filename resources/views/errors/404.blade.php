@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Page not found - 404')


{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

@section('page_content')

<div class="clearfix"></div>

 {{-- <div class="container text-success" id="path-section" style="padding-top: 50px; font-weight: bold;">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ app()->getLocale()?action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) : action('HomeController_F@home_f', array('lang'=>app()->getLocale() ) ) }}">{{ __('header.Home') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('header.notifications') }}</li>
      </ol>
    </nav>

</div> --}}

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-30">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            
            {{-- <div class="card-title">Register</div> --}}
            
            <div class="content-wrapper" style="min-height: 0px;" id="prescriptiontable">

                {{-- <h3 class="card-title padd-30" style="text-align: center; font-weight: bold;">404</h3> --}}
                
                <div class="card">
                    <div class="card-body text-center">

                            {{-- <a href="{{ route('home_f', array( app()->getLocale())) }}" class="btn btn-success">Go To Homepage</a><br>
                            <a href="{{ url('/en/'.Request::path())  }}" class="btn btn-success">Or Click Here</a>
                            <h2>Oops! This Page Could Not Be Found</h2>
                            <p>Sorry but the page you are looking for does not exist, have been removed. name changed or is temporarily unavailable</p> --}}

                            {{-- <h2>My URL is :/en  {{ Request::path() }}</h2> --}}
                            <h2>{{__('error.error_title1')}}</h2>
                            <h2>{{__('error.error_title2')}}</h2>
                            {{-- <span>⬇️</span> --}}
                            <a href="{{ url('/en/'.Request::path())  }}" class="btn btn-success">{{__('error.click_here')}}</a>
                            <h2>{{__('error.or')}}</h2>                            
                            <a href="{{ route('home_f', array( app()->getLocale())) }}" class="btn btn-success">{{__('error.got_to_homepage')}}</a><br>
                            {{-- <p>Sorry for this inconvenience</p> --}}


                    </div>
                </div>
            </div>




        </div>
    </div>
</div>




@endsection
