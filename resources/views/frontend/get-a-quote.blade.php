@extends('layouts.theme')
@section('content')
<!-- Header -->
<header class="site-header header-s1 is-sticky">
    @include('partials.themeHeader')
    <!-- Banner -->
    <div class="banner banner-static">
        <div class="container">
            <div class="content row">

                <div class="imagebg">
                    @if($contactus)
                    <img src="/storage/images/banners/{{ $contactus->banner }}" alt="">
                    @else
                    <img src="{{ asset('theme/image/banner-contact.jpg') }}" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Banner -->
</header>
<!-- End Header -->

<div class="section section-contents section-freequote section-pad">
    <div class="container">
        <div class="row">

            <div class="freequote-content row">

                <div class="quote-list col-md-8 res-m-bttm">
                    <div class="quote-group">
                        <h1>Request for Free Conslutation</h1>
                        <p>{{ $contactus->title ?? ''}}</p>
                        @if(count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $error)
                            <li style="color: red;">-> {{ $error }}</li>
                            @endforeach
                        </ul>
                        @endif
                        @if($message = Session::get('success'))
                        <h1 style="color:seagreen;">*** {{ $message }} ***</h1>
                        @endif
                        <form class="form-quote" action="{{ url('get-a-quote/send') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="form-field col-md-6 form-m-bttm">
                                    <input name="name" type="text" placeholder="Name *" class="form-control required">
                                </div>
                                <div class="form-field col-md-6">
                                    <input name="company" type="text" placeholder="Company" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-field col-md-6 form-m-bttm">
                                    <input name="email" type="email" placeholder="Email *" class="form-control required email">
                                </div>
                                <div class="form-field col-md-6">
                                    <input name="phone" type="text" placeholder="Phone *" class="form-control required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-field col-md-6">
                                    <p>Best Time to Reach</p>
                                    <select name="reach">
                                        <option value="">Please select</option>
                                        <option value="09am-12pm">09 AM - 12 PM</option>
                                        <option value="12pm-03pm">12 PM - 03 PM</option>
                                        <option value="03pm-06pm">03 PM - 06 PM</option>
                                    </select>
                                </div>
                                <div class="form-field col-md-6">
                                    <p>Hear About Us</p>
                                    <select name="hear">
                                        <option value="">Please select</option>
                                        <option value="Friends">Friends</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Google">Google</option>
                                        <option value="Collegue">Collegue</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-field col-md-12">
                                    <textarea name="message" placeholder="Messages *" class="txtarea form-control required"></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn">Submit</button>
                            <div class="form-results"></div>
                        </form>
                    </div>
                </div>

                <div class="contact-details col-md-4">
                    <h3>Contact Information</h3>
                    <ul class="contact-list">
                        <li><em class="fa fa-map" aria-hidden="true"></em>
                            <span>{{ $contactus->address ?? ''}}</span>
                        </li>
                        <li><em class="fa fa-phone" aria-hidden="true"></em>
                            <span>Toll Free : {{ $contactus->phone ?? ''}}</span>
                        </li>
                        <li><em class="fa fa-envelope" aria-hidden="true"></em>
                            <span>Email : <a href="#">{{ $contactus->email ?? ''}}</a><br>
                                QQ : <a href="#">{{ $contactus->qq }}</a></span>
                        </li>
                        <li>
                            <em class="fa fa-clock-o" aria-hidden="true"></em><span>{{ $contactus->working_time ?? ''}}</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Content -->
@endsection