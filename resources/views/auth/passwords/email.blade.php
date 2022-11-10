@extends('layouts.theme')
@section('content')

<!-- Page content -->
<div class="page-content">
    <main class="main-content">
        <section class="not-found-wrap text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        @if($errors->has('email'))
                        <div class="alert alert-danger">
                            <strong>Error!</strong>
                            {{ $errors->first('email') }}
                        </div>
                        @endif 

                        @if(\Session::has('status'))
                        <div class="alert alert-success">
                            <strong>Success!</strong>
                            {{ \Session::get('status') }}
                        </div>
                        @endif 
                 
                        <h3>RESET YOUR PASSWORD</h3>
                        
                        <form method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
       
                        <p class="text-muted"></p>
                        <div>
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control" required="required" autofocus placeholder="{{ trans('global.login_email') }}">
                                @if($errors->has('email'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('email') }}
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