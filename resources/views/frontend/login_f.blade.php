@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Login')


{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


@section('page_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            <h2 class="card-title" style="text-align: center; font-weight: bold;">
                @if (app()->getLocale()=='en')    Login
                @elseif (app()->getLocale()=='ru')  Авторизоваться  
                @elseif (app()->getLocale()=='cn')  登录  
                @endif
                
            </h2>
            {{-- <div class="card-title">Register</div> --}}

            <div class="row justify-content-center ">
                <div class="row col-md-12">
                    <div class="card row col-md-12"  style=" margin-top: 25px;">

                        <div class="card-body">
                            <form method="POST" action="{{ route('customerLoginPost', app()->getLocale()) }}" aria-label="{{__('header.Login')}}">
                                @csrf

                                <div class="row col-md-8 col-md-offset-2">
                                    

                                    <div class="form-group row col-md-12">
                                        <label for="emailOrPhone" class="col-md-4 col-form-label text-md-right">
                                            {{__('checkout.email').' / '.__('checkout.phone')}}
                                        </label>

                                        <div class="col-md-8">
                                            <input id="emailOrPhone" type="text" class="form-control{{ $errors->has('emailOrPhone') ? ' is-invalid' : '' }}" name="emailOrPhone" value="{{ old('emailOrPhone') }}" required>

                                            @if ($errors->has('emailOrPhone'))
                                                <span class="invalid-feedback text-danger " role="alert">
                                                    <strong>{{ $errors->first('emailOrPhone') }}</strong>
                                                </span>
                                            @endif

                                            @if (session('passwordChangeLimitCrossed'))
                                                <span class="invalid-feedback text-danger " role="alert">
                                                    <strong>{{__('header.passchangelimitcrossed')}}</strong>
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group row col-md-12">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">
                                            {{__('register.password')}}
                                        </label>

                                        <div class="col-md-8">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group row col-md-12">
                                        <div class="col-md-12 ">

                                            <button type="submit" class="btn btn-primary btn-lg" style="float: right;">
                                               {{__('header.Login')}}
                                            </button>

                                            <a class="btn btn-light" href="{{ app()->getLocale()?action('HomeController@change_passsword_f', array( 'lang'=>app()->getLocale() ) ) : action('HomeController@change_passsword_f', array('lang'=>app()->getLocale() ) ) }}" style="float: right; margin-right: 2px;">{{__('register.forgetpassword')}}?</a>

                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript">
    $(window).on('load',function(){
        @if (session('passwordresetlinksent'))
            $('#passwordresetlinksentModal').modal('show');
        @endif
    });

    $(window).on('load',function(){
        @if (request('userVerified'))
            $('#signupcompleteModal').modal('show');
        @endif
    });

    $(window).on('load',function(){
        @if (request('emailverifiedlinksent'))
            $('#emailverifiedlinksentModal').modal('show');
        @endif
    });

    $(window).on('load',function(){
        @if (session('emailnotverified'))
            $('#emailnotverifiedModal').modal('show');
        @endif
    });

    $(window).on('load',function(){
        @if (session('invalidUser'))
            $('#invalidUserModal').modal('show');
        @endif
    });


</script>

<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        <div class="modal fade" id="passwordresetlinksentModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
						<div class="thank-you-pop">
							<p > {{__('modals.passwordresetlinksentModalmsg')}}  </p>
 						</div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        {{-- <a class="btn btn-primary" data-toggle="modal" href="#signupcompleteModal">open Popup</a> --}}
        <div class="modal fade" id="signupcompleteModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="text-center  text-success">{{__('modals.signupcompleteModaltitlemsg')}}</h2>
                    </div>
					
                    <div class="modal-body">
						<div class="thank-you-pop">
							<p>{{__('modals.signupcompleteModalmsg')}}</p>
							<p>{{__('modals.signupcompleteModalmsg2')}}</p>
 						</div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        {{-- <a class="btn btn-primary" data-toggle="modal" href="#signupcompleteModal">open Popup</a> --}}
        <div class="modal fade" id="emailverifiedlinksentModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="text-center  text-success">{{__('modals.emailverifiedlinksentModaltitlemsg')}}</h2>
                    </div>
					
                    <div class="modal-body">
						<div class="thank-you-pop" style="text-align: left;">
							<p class="font-weight-bold">{{__('modals.emailverifiedlinksentModalmsg')}}</p>
							<p style="font-size: 17px; color:#cc5347;"><strong>{{__('modals.note')}} : </strong> {{__('modals.emailverifiedlinksentModalmsg2')}}</p>
 						</div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        <div class="modal fade" id="emailnotverifiedModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
						<div class="thank-you-pop">
							<p > {{__('modals.emailnotverifiedModalmsg')}}  </p>
 						</div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="z-index: 10000000000000000000000">
    <div class="row">
        <div class="modal fade" id="invalidUserModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
						<div class="thank-you-pop">
							<h2 > {{__('modals.invalidUserModalmsg')}}  </h2>
							<h4 > {{__('modals.invalidUserModalmsg2')}}  </h4>
 						</div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('frontend/css/thankyou.css') }}">




@endsection
