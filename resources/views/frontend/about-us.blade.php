@extends('layouts.theme')
@section('content')
<div class="section-featured-icons d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="icon-box icon-box-left icon-box-circle justify-content-lg-center">
                    <div class="icon-box__icon"><i class="flaticon flaticon-delivery-truck"></i></div>
                    <div class="icon-box__title">Delivery to all regions</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="icon-box icon-box-left icon-box-circle justify-content-lg-center">
                    <div class="icon-box__icon"><i class="flaticon flaticon-sales-ticket"></i></div>
                    <div class="icon-box__title">Don't miss this great deal!</div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="icon-box icon-box-left icon-box-circle justify-content-lg-center">
                    <div class="icon-box__icon"><i class="flaticon flaticon-thumb-up-gesture"></i></div>
                    <div class="icon-box__title">The highest quality of products</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="page-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
    </div>
</nav>

<!-- Page content -->
<div class="page-content">
    <main class="main-content">
        <section class="section-about">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h3 class="section-title mb-40">{{ $aboutus->sec_one_title ?? ''}}</h3>

                        {!! $aboutus->sec_one_text ?? '' !!}
                    </div>
                    <div class="col-lg-5">
                        @if(isset($aboutus->sec_one_img))
                        <img src="/storage/images/banners/{{ $aboutus->sec_one_img ?? ''}}" alt="{{ $aboutus->sec_one_title ?? ''}}"/>
                        @endif
                    </div>
                    <div class="col-lg-7" >
                        <div class="accordion" id="accordionExampleOutline">
                            <div class="card">
                                <div class="card-header" id="headingOneOutline">
                                    <button class="btn btn-outline-primary btn-lg" type="button" data-toggle="collapse" data-target="#collapseOneOutline" aria-expanded="true" aria-controls="collapseOneOutline">
                                        How to import pet supplies from china?
                                    </button>
                                </div>

                                <div id="collapseOneOutline" class="collapse show" aria-labelledby="headingOneOutline" data-parent="#accordionExampleOutline">
                                    <div class="card-body">
                                    Yafu pet toys store offers you a large collection of pet toys for dogs and cats, 
                                    if you have any doubt or you want to check our products before you place an order with us,
                                     you always can inquire for a sample set of different type of products you wish to purchase.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwoOutline">
                                    <button class="btn btn-outline-primary btn-lg collapsed" type="button" data-toggle="collapse" data-target="#collapseTwoOutline" aria-expanded="false" aria-controls="collapseTwoOutline">
                                    What is the MOQ(minimum order quantity) that I can buy?
                                    </button>
                                </div>
                                <div id="collapseTwoOutline" class="collapse" aria-labelledby="headingTwoOutline" data-parent="#accordionExampleOutline">
                                    <div class="card-body">
                                    A production MOQ can vary between 10pcs to 1000pcs depends on the products, but to make it easier for our client who just starting a small pet shop business, Yafu pet toys will also offer ready stock with low or no MOQ. You can consult our sales manager for more info about available products in stock <a href="/contact-us">here</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThreeOutline">
                                    <button class="btn btn-outline-primary btn-lg collapsed" type="button" data-toggle="collapse" data-target="#collapseThreeOutline" aria-expanded="false" aria-controls="collapseThreeOutline">
                                    Does order quantity effect the products price?
                                    </button>
                                </div>
                                <div id="collapseThreeOutline" class="collapse" aria-labelledby="headingThreeOutline" data-parent="#accordionExampleOutline">
                                    <div class="card-body">
                                    Yes, of course prices will be cheaper if your order quantity is bigger.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFourOutline">
                                    <button class="btn btn-outline-primary btn-lg collapsed" type="button" data-toggle="collapse" data-target="#collapseFourOutline" aria-expanded="false" aria-controls="collapseFourOutline">
                                    How can I place an order for my pet toys products?
                                    </button>
                                </div>
                                <div id="collapseFourOutline" class="collapse" aria-labelledby="headingFourOutline" data-parent="#accordionExampleOutline">
                                    <div class="card-body">
                                    <b>You can start your production in simply 4 easy steps:</b> <br>
                                    <ol>
                                        <li>Register and account <a href="/register">here</a> (if you do not have one already)</li>
                                        <li>Add the products you wish to buy to your shopping cart</li>
                                        <li>Submit your order <br><small>(By submitting your order you will receive a proforma-invoice file into your email.)</small></li>
                                        <li>Our sales manager will contact you by email Within 24h to confirm with you the order, and payment method.</li>
                                    </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingFiveOutline">
                                    <button class="btn btn-outline-primary btn-lg collapsed" type="button" data-toggle="collapse" data-target="#collapseFiveOutline" aria-expanded="false" aria-controls="collapseFiveOutline">
                                    Any warranty from Yafu if I receive damaged products?
                                    </button>
                                </div>
                                <div id="collapseFiveOutline" class="collapse" aria-labelledby="headingFiveOutline" data-parent="#accordionExampleOutline">
                                    <div class="card-body">
                                    -	Yes, Yafu guarantees all products and we will refund full amount for any product have production mistakes or quality issue.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="width: 100%; text-align: center;">
                        <img src="{{ asset('img/certificates.png')}}" alt="AFStore certificates"/>
                    </div>
                </div>
            </div>
        </section>
        {{--
        <section class="section-team">
            <div class="container">
                <h3 class="section-title text-center">Our team</h3>

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="team">
                            <div class="team__thumb">
                                <img src="images/270x380.png" alt="">
                            </div>
                            <div class="team__name h4">Barry McCoy</div>
                            <div class="team__position">Exec. Creative Director</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team">
                            <div class="team__thumb">
                                <img src="images/270x380.png" alt="">
                            </div>
                            <div class="team__name h4">Barbara Garner</div>
                            <div class="team__position">Client Partner</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team">
                            <div class="team__thumb">
                                <img src="images/270x380.png" alt="">
                            </div>
                            <div class="team__name h4">Justin Gomez</div>
                            <div class="team__position">Photographer</div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="team">
                            <div class="team__thumb">
                                <img src="images/270x380.png" alt="">
                            </div>
                            <div class="team__name h4">Eddie Douglas</div>
                            <div class="team__position">Senior Strategist</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        --}}
        @if ($galleries->count() > 0)
        <section class="section-team">
            <div class="container">
                <h3 class="section-title text-center">Yafu Factory</h3>
                <!-- Gallery -Photo -->
                <div class="gallery gallery-lightbox gallery-photos gallery-filled hover-zoom">

                    <ul class="photos-list col-x4">
                        @foreach($galleries as $key => $gallery)
                        <li>
                            <a href="../storage/gallery/{{ $gallery->picture }}" target="_blank">
                                <div class="photo">
                                    <img src="../storage/gallery/thumbnail/{{ $gallery->picture }}" alt="Photo Title">
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Gallery #end -->
            </div>
        </section>
        @endif
        
        <!-- Call Action -->
        @include('frontend.components.newsletter')
        <!-- End Section -->

    </main> <!-- end of main -->
</div> <!-- /.page-content -->

@endsection