@extends('layouts_f.app')
@extends('layouts_f.header')
@extends('layouts_f.search')
@extends('layouts_f.footer')

@section('pageTitle', 'Change Password')

{{ app()->setLocale( getLocaleFromUrl(URL::current()) ) }}

{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}" > --}}


@section('page_content')

{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<div class="container padd-60">
    <div class="content-wrapper " style="min-height: 0px;">
        <div class="card-body">
            <h2 class="card-title" style="text-align: center; font-weight: bold;">
                {{__('register.resetpassword')}}
                
            </h2>
            {{-- <div class="card-title">Register</div> --}}

            <div class="row justify-content-center ">
                <div class="row col-md-12">
                    <div class="card row col-md-12"  style=" margin-top: 25px;">

                        <div class="card-body">
                            
                            <form method="POST" action="{{ route('change_passsword_f_from_mail.update') }}" aria-label="Reset Password">
                                @csrf
        
                                <div class="row ">
                                    <div class="form-group col-md-6">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{__('register.password')}}</label>
            
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
            
                                    <div class="form-group  col-md-6">
                                        <button type="submit" class="btn btn-primary">
                                            {{__('register.resetpassword')}}
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
