@extends('layouts.theme')

@section('content')


<!-- Page content -->
<div class="page-content">
    <main class="main-content">
        <section class="not-found-wrap text-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <br>
                        <a  style="color: red; cursor: pointer;" onclick="event.preventDefault(); document.getElementById('email-form').submit();">**{{ __('click here to request another') }}</a>.
                        <form id="email-form" action="{{ route('verification.resend') }}" method="POST" style="display: none;">@csrf</form>

                    </div>
                </div>
            </div>
        </section>
    </main>
</div> <!-- /.page-content -->
@endsection
