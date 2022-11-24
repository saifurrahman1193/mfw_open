@extends('layouts.app')
@section('pageTitle', 'Admin Login')

<style type="text/css" media="screen">
    form .form-group i {
                                    position: absolute;
                                    right: 1rem;
                                    height: 18px;
                                    top: calc((100% - 18px) / 2);
                                }
</style>

@section('page_content')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<div class="container mt-4 col-xs-10 col-sm-8 col-md-10 col-lg-8 col-xl-6 ">
    <div class="row justify-content-center">
        <div class="col-md-8 ">
            <div class="card">
                <h1 class="card-title mt-5 mb-5" style="text-align: center;">Medicine For World </h1>

                <div class="card-header bg-primary text-light ">
                    <i class=" icon-login  text-light mr-2"></i>
                        {{ __('Login') }}
                </div>

                <div class="card-body bg-secondary">
                    <form method="POST" action="{{ route('adminLoginPost') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                <i class="mdi mdi-account"></i>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-9">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <i class="mdi mdi-eye" onmousedown="showPassword()" onmouseup="hidePassword()"></i>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row mb-0 float-right mr-1">
                            {{-- <div class="col-md-8 offset-md-6"> --}}
                            <div class="">
                                <button type="submit" class="btn btn-success float-right">
                                    {{ __('Login') }}
                                </button>

           
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- password showing function --}}
<script type="text/javascript">
    function showPassword() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    } 

    function hidePassword() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    } 

</script>







@endsection
