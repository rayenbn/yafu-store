@extends('layouts.theme')
@section('content')
<!--Banner-->
<section class="page-heading" style="background-image:url('/storage/images/banners/{{ $blog_page->banner ?? ''}}') no-repeat center rgba(0, 0, 0, 0)">
    <div class="title-slide">
        <div class="container">
                <div class="banner-content slide-container">									
                    <div class="page-title">
                        <h3>RESET YOUR PASSWORD</h3>
                    </div>
                </div>
        </div>
    </div>
</section>
<!--End Banner-->
<div class="product-check-out">
    <div class="container">
        <div class="row ">
            <div class="col-md-12">
                <div class="checkout">                                            
                    <div class="checkout-row row ">
                        @if(\Session::has('message'))
                            <p class="alert alert-info">
                                {{ \Session::get('message') }}
                            </p>
                        @endif
                        <div class="col-md-3"></div>
                        <div class="log-in col-md-6">
                            <div class="title">{{ __('Register') }}</div>
                            <div class="box">
                                <!-- <p>
                                    If you forgot your password, don't worry you can
                                </p> -->
                                <form method="POST" action="{{ route('password.email') }}">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert" style="color: #fff;">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                            <input name="email" id="email" type="email" class="input-text" 
                                             required="required" autofocus placeholder="{{ trans('global.login_email') }}">
                                         
                                        </div>
                                      
                                        
                                    </div>
                                    <button type="submit" class="button" style="padding: 0px 7px 0 7px;">
                                        <!-- <em class="fa-icon"><i class="fa fa-unlock"></i></em> -->
                                        <span>{{ trans('global.reset_password') }}</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                  
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection