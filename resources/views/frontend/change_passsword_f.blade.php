@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Change Password')


{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


@section('page_content')
{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            <p style="color:#605050; text-align: center; font-weight: bold; font-size: 16px; font-weight: bold; ">{{__('register.resetpasswordnote')}}</p>
            <h2 class="card-title" style="text-align: center; ">
                {{__('register.resetpassword')}}
                
            </h2>
            {{-- <div class="card-title">Register</div> --}}

            <div class="row justify-content-center ">
                <div class="row col-md-12">
                    <div class="card row col-md-12"  style=" margin-top: 25px;">

                        <div class="card-body">
                            
                            <form method="POST" action="{{ route('change_passsword_f_from_mail', app()->getLocale()) }}" aria-label="Reset Password">
                                @csrf
        
                                <div class="row col-md-8 col-md-offset-2">
                                    <div class="form-group col-md-12">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{__('register.registeredemailaddress')}}</label>
            
                                        <div class="col-md-8">
                                            <input id="email" type="email" class="form-control{{ session('invalidMail') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
            
                                            @if (session('invalidMail'))
                                                <span class="invalid-feedback text-danger" role="alert">
                                                    <strong>{{__('register.cantfindemail')}}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{__('register.newpassword')}}</label>
            
                                        <div class="col-md-8">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('password') }}" required>
                                        </div>
                                    </div>
            
                                    <div class="form-group  col-md-12">
                                        <button type="submit" class="btn btn-primary" style="float: right">
                                            {{__('register.sendpassresetlink')}}
                                        </button>
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





@endsection
