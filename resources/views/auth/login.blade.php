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
                        <h2>Log in</h2>
                        <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer register new account <a href="{{ route('register') }}" style="color: crimson;">here.</a></p>
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group mb-20">
                                <input type="text" class="form-control mb-10 active" name="email" placeholder="Email">
                            </div>

                            <div class="form-group mb-20">
                                <input type="password" name="password" class="form-control mb-10 active" placeholder="Password">
                            </div>
                            <div class="row">
                                <label class="col-6" style="text-align: initial;">
                                    <input name="remember" type="checkbox" /> {{ trans('global.remember_me') }}
                                </label>
                                <label class="col-6 text-right" >
                                    <a class="" href="{{ route('password.request') }}">
                                        {{ trans('global.forgot_password') }}
                                    </a>
                                </label>
                            </div>
                            <button type="submit" title="Log in" class="btn btn-primary btn-lg">
                                <span>{{ trans('global.login') }}</span>
                            </button>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div> <!-- /.page-content -->

@endsection