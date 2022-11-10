@extends('layouts.theme')
@section('content')

<!-- Page content -->
<div class="page-content">
    <main class="main-content">
        <section class="not-found-wrap text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        @foreach ($errors->all() as $error)

                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            {{ $error }}
                        </div>

                        @endforeach

                      
                        <h3>SET NEW PASSWORD</h3>
                        
                        <form method="POST" action="{{ route('password.request') }}">
                            {{ csrf_field() }}
        
                            <p class="text-muted"></p>
                            <div>
                                <input name="token" value="{{ $token }}" type="hidden">
                                <div class="form-group has-feedback">
                                    <input type="email" name="email" class="form-control" required="required" placeholder="{{ trans('global.login_email') }}">
                                    @if($errors->has('email'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </em>
                                    @endif
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" name="password" class="form-control" required="required" placeholder="{{ trans('global.login_password') }}">
                                    @if($errors->has('password'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('password') }}
                                        </em>
                                    @endif
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" name="password_confirmation" class="form-control" required="required" placeholder="{{ trans('global.login_password_confirmation') }}">
                                    @if($errors->has('password_confirmation'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('password_confirmation') }}
                                        </em>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">
                                        {{ trans('global.reset_password') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>
</div> <!-- /.page-content -->
@endsection