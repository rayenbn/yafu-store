@extends('layouts.theme')
@section('content')
<div class="page-content">
    <main class="main-content">
        <section class="promo-hero text-center d-flex flex-column justify-content-center align-items-center"
                    style="background-image: url('{{ asset('img/promo banner1.jpg')}}');">
            <div class="container">
                <h1 class="promo-hero__title">Discover unique products, buy it in one place</h1>
                <div class="promo-hero__text">Our products never go out of style</div>

                <div class="promo-hero__scroll" id="js-scroll-down">
                    Scroll down<br><i class="flaticon-down-chevron"></i>
                </div>
            </div>
        </section>

        <section class="promo-section" id="scroll-to">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-5 promo-section__img">
                        <img src="{{ asset('img/blue-t2.jpg') }}" alt="">
                    </div>
                    <div class="col-lg-7 promo-section__card">
                        <div class="promo-card">
                            <a href="single-product.html">
                                <img src="{{ asset('img/ladies-sery-coll-bg2.jpg') }}" alt="" class="promo-card__img">
                            </a>
                            <div class="promo-card__content">
                                <h2 class="promo-card__title"><a href="single-product.html">PUFFLEX ladies serie 3500 Puff</a></h2>
                                <div class="promo-card__text">Disposable Vape Pods, Style and functionality go hand in hand</div>
                                <a href="single-product.html" class="btn btn-primary btn-lg">discover</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="promo-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 promo-section__card">
                        <div class="promo-card promo-card-offset-left">
                            <a href="single-product.html">
                                <img src="{{ asset('img/femini-multi-color-banner.jpg') }}" alt="" class="promo-card__img">
                            </a>
                            <div class="promo-card__content">
                                <h2 class="promo-card__title"><a href="single-product.html">PEARL PAPER CLUTCH</a></h2>
                                <div class="promo-card__text">The bottom is structured by an inside plastic rectangle cut</div>
                                <a href="single-product.html" class="btn btn-primary btn-lg">discover</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 promo-section__img">
                        <img src="{{ asset('img/lady-series-bg.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>


      
        <!-- <section class="promo-section">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-5 promo-section__img">
                        <img src="{{ asset('img/960x900.png') }}" alt="">
                    </div>
                    <div class="col-lg-7 promo-section__card">
                        <div class="promo-card">
                            <a href="single-product.html">
                                <img src="{{ asset('img/670x470.png') }}" alt="" class="promo-card__img">
                            </a>
                            <div class="promo-card__content">
                                <h2 class="promo-card__title"><a href="single-product.html">MacBook Folio Sleeve</a></h2>
                                <div class="promo-card__text">Style and functionality go hand in hand</div>
                                <a href="single-product.html" class="btn btn-primary btn-lg">discover</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <section class="section-subscribe subscribe-wrap-promo" style="background-image:url('{{ asset('img/footer-bg.jpg')}}')">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="subscribe-form d-flex flex-column justify-content-center align-items-center">
                            <div class="section-title section-title-w-text text-center">
                                <h2 class="h3 section-title__heading">Newsletter subscription</h2>
                                <div class="section-title__text">Newest products, promotions and sales</div>
                            </div>

                            <form class="form-inline w-100">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg subscribe-form__input" placeholder="E-mail adress">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg subscribe-form__btn">subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
</div>
@endsection