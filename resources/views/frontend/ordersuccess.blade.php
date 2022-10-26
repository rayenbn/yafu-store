@extends('layouts.theme')
@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="page-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order successed</li>
        </ol>
    </div>
</nav>

<!-- Page content -->
<div class="page-content">
    <section class="section-contact-map">
        <div class="container">
            <div class="row justify-content-center">
                <div class="map col-lg-10">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 col-md-10 text-center">
                                <!-- <h2 class="h3 mb-40">Contact us</h2> -->
                                <div class="blog-title" style="margin-top: 15px;">
                                    <a href="/my-profile#tabs-2">Your order is successfully submitted</a>
                                </div>
                                <div class="blog-intro">
                                    @if(session()->has('invoiceNumber'))
                                        <div class="created-by"> Save your order number: <span><b>{{session()->get('invoiceNumber', '')}}<b></span></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> <!-- /.page-content -->

@endsection
