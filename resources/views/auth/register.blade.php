@extends('layouts.theme')

@section('content')


<!-- Page content -->
<div class="page-content">
    <main class="main-content">
        <section class="not-found-wrap text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        @if(\Session::has('message'))
                            <div class="alert alert-danger">
                                <strong>Error!</strong>
                                {{ \Session::get('message') }}
                            </div>
                        @endif
            
                        <h2>Create an AFStore account</h2>
                        <p>If you have shopped with us before, please enter your details in the boxes below. If you already have an account <a href="{{ route('login') }}" style="color: crimson;">here.</a></p>
                        <form method="POST" action="{{ route('register') }}">
                        @csrf
                      
                            <div class="form-group mb-20">
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert" style="color: #fff;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                <input name="name" id="name" type="text" class="form-control mb-10 active {{ $errors->has('name') ? ' is-invalid' : '' }}"  value="{{ old('name') }}" required autofocus placeholder="{{ __('Name') }}">
                            </div>

                            <div class="form-group mb-20">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="color: #fff;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                <input name="email" id="email" type="email" class="form-control mb-10 active {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus placeholder="{{ __('E-Mail Address') }}">
                            </div>

                            <div class="form-group mb-20">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert" style="color: #fff;">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <input name="password" id="password" type="password" class="form-control mb-10 active {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required>
                            </div>

                            <div class="form-group mb-20">
                                <input id="password-confirm" type="password" class="form-control mb-10 active" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                            </div>

                            <button type="submit" title="Register" class="btn btn-primary btn-lg">
                                <span>{{ __('Register') }}</span>
                            </button>
                        </form>
                     
                    </div>
                </div>
            </div>
        </section>
    </main>
</div> <!-- /.page-content -->
@endsection
