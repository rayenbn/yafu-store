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
                    <img src="{{ asset('theme/image/banner-inside-b.jpg') }}" alt="">
                </div>

                <div class="banner-text">
                    <h1 class="page-title">Resources</h1>
                    <p class="page-breadcrumb">Home / <span class="current">Recources</span></p>
                </div>

            </div>
        </div>
    </div>
    <!-- End Banner -->
</header>
<!-- End Header -->
<!-- Contents -->
<div class="section section-contents section-pad">
    <div class="container">
        <div class="content row">

            <div class="row">
                <div class="col-md-8">
                    <h1>Resources &amp; Reserves</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercation ullamco laboris nisi ut aliquip ex ea commodo conquat. Duis aute irure dolor nostrud ullamco.</p>
                    <p><strong>Prominent Hill</strong><br>
                        <a href="#">2017 Consectetur adipiscing elit sed do eiusmod tempor ut labore as at 01 March 2017</a></p>
                    <p><strong>Carrapateena Hill</strong><br>
                        <a href="#">2016 Adipiscing elit sed do eiusmod tempor incididunt ut labore as at 01 July 2016</a></p>
                    <p><strong>Carrapateena Hill</strong><br>
                        <a href="#">2015 Elit sed do eiusmod tempor incididunt ut labore as at 01 November 2015</a></p>

                    <hr>
                    <h3>Downloads</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua quis nostrud exercation ullamco laboris.</p>
                    <p><a href="#"><em class="fa fa-file-pdf-o"></em> Recycling of Tubes, Globes and LED Lights</a></p>
                    <p><a href="#"><em class="fa fa-file-pdf-o"></em> Recycling of Fluorescent Tubes</a></p>
                    <p><a href="#"><em class="fa fa-file-pdf-o"></em> Lamp Recycling Process Flow</a></p>
                    <p><a href="#"><em class="fa fa-file-pdf-o"></em> Dental Amalgam Recycling</a></p>
                    <p><a href="#"><em class="fa fa-file-pdf-o"></em> ECO AS04 Amalgam Separator</a></p>
                    <p><a href="#"><em class="fa fa-file-pdf-o"></em> Sample Recycling Certificate</a></p>

                    <hr>
                    <h3>Useful links</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua quis nostrud exercation ullamco laboris.</p>
                    <ul>
                        <li>Full Members: <a href="#">www.sitename.com.au</a></li>
                        <li>Associate Members: <a href="#">www.anothersitename.co.nz</a></li>
                        <li>Associate Members: <a href="#">www.anothersite.com</a></li>
                    </ul>
                    <h5>Looking for something?</h5>
                    <p>Contact us at 808 0123 6478 or get in touch with us online.</p>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <div class="sidebar-right">

                        <div class="wgs-box wgs-menus">
                            <div class="wgs-content">
                                <ul class="list list-grouped">
                                    <li class="list-heading">
                                        <span>About Our Firms</span>
                                        <ul>
                                            <li><a href="about-us.html">Overview</a></li>
                                            <li><a href="history.html">Our History</a></li>
                                            <li><a href="teams.html">Board Of Directors</a></li>
                                            <li><a href="teams-alter.html">Management Team</a></li>
                                            <li><a href="investors.html">Our Investors</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="clients.html">Our Clients</a></li>
                                    <li class="current"><a href="resources.html">Resources</a></li>
                                    <li><a href="responsibility.html">Responsibility</a></li>
                                    <li><a href="testimonial.html"><span>Testimonials</span></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="wgs-box wgs-quoteform">
                            <h3 class="wgs-heading">Quick Contact</h3>
                            <div class="wgs-content">
                                <p>If you have any questions or would like to book a session please contact us.</p>
                                <form id="contact-us" class="form-quote" action="http://demo.themenio.com/industrial/form/contact.php" method="post">
                                    <div class="form-results"></div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <input name="contact-name" type="text" placeholder="Name *" class="form-control required">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <input name="contact-email" type="email" placeholder="Email *" class="form-control required email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field form-m-bttm">
                                            <input name="contact-phone" type="text" placeholder="Phone" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <input name="contact-service" type="text" placeholder="Interest of Service" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <textarea name="contact-message" placeholder="Messages *" class="txtarea form-control required"></textarea>
                                        </div>
                                    </div>
                                    <input type="text" class="hidden" name="form-anti-honeypot" value="">
                                    <button type="submit" class="btn btn-alt sb-h">Submit</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Sidebar #end -->
            </div>

        </div>
    </div>
</div>
<!-- End Section -->
<!-- Call Action -->
<div class="call-action bg-primary">
    <div class="cta-block">
        <div class="container">
            <div class="content row">

                <div class="cta-sameline">
                    <h3>Looking an Adequate Solution for your Company?</h3>
                    <p>Contact us today for free conslutaion or more information.</p>
                    <a class="btn btn-outline" href="get-a-quote.html">Get In Touch</a>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Section -->

@endsection