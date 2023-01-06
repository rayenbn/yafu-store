@extends('layouts.theme')
@section('content')
<div class="page-content">
    <main class="main-content">
        <section class="promo-hero text-center d-flex flex-column justify-content-center align-items-center mb-40"
                    style="background-image: url('{{ asset('img/banner4.jpg')}}');">
            <div class="container">
                <h1 class="promo-hero__title">Wholesale Cat Toys supplier</h1>
                <div class="promo-hero__text">Bulk Pricing and Custom Production Solutions for Retailers</div>

                <div class="promo-hero__scroll" id="js-scroll-down">
                    Scroll down<br><i class="flaticon-down-chevron"></i>
                </div>
            </div>
        </section>

        <section class="section-about m-100" id="scroll-to">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="section-title mb-40" style="letter-spacing: 1.5px;text-transform: none;font-weight: 700; font-size: 22px">Fill Your Store with the Best Selection of High-Quality Cat Toys at Wholesale Prices, or Create Your Own Unique Products</h1>

                        <p>Looking for the best selection of wholesale cat toys at competitive prices? As a leading supplier, 
                            we offer a wide range of high-quality products to keep cats entertained for hours. Our selection 
                            includes a variety of shapes, sizes, and textures, including dangling strings, crinkly balls, and interactive toys.
                        </p>
                        <p>
                        In addition to our standard products, we also offer custom production solutions for retailers looking to create 
                        their own unique products. All of our products are made from durable, safe, and non-toxic materials, and we offer 
                        fast and reliable shipping to ensure that you receive your order in a timely manner.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <img src="{{ asset('img/cat-banner.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </section>


        <section class="section-about m-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="section-title text-center col-12">
                        <h3 class="h3 section-title__heading">Benefits of Working with Us!</h3>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card mb-4" >
                            <h3>Wide selection of cat toys at wholesale prices</h3>
                            <p class="mt-4">Choose from a range of products, including dangling strings, crinkly balls, and interactive toys.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card mb-4" >
                            <h3>Custom production solutions</h3>
                            <p class="mt-4">If you have a specific product idea in mind, we offer custom production solutions to help you create your own unique products.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card mb-4" >
                            <h3>High-quality & safe materials</h3>
                            <p class="mt-4">All of our products are made from durable, safe, and non-toxic materials.</p>
                            <br><br>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card mb-4" >
                            <h3>Fast and reliable shipping</h3>
                            <p class="mt-4">We offer fast and reliable shipping to ensure that you receive your order in a timely manner.</p>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        

        <section class="section-featured-products m-100">
            <div class="container">
                <div class="section-title text-center">
                    <h2 class="h3 section-title__heading">Our Selection for Cat Toys</h2>
                </div>
                <ul class="products featured-products columns-4">
                    @foreach($products as $key => $product)
                    <li class="product">
                        <div class="product-thumb">
                            <!-- <span class="onsale">-30%</span> -->
                            <a href="{{ route('our-products.show', $product->id) }}" class="product-thumb__link">
                                <img src="../storage/products/thumbnail/{{ $product->img }}" alt="" style="height: 274px;">
                                <span class="btn btn-outline-light shop-link">Shop</span>
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="text-center mt-lg-4">
                <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">View all</a>
            </div>
        </section>

        <!-- Call Action -->    
        @include('frontend.components.call-to-action')
        <!-- End Section -->

       

    </main>
</div>
@endsection