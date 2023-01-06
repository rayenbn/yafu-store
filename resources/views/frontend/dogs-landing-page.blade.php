@extends('layouts.theme')
@section('content')
<div class="page-content">
    <main class="main-content">
        <section class="promo-hero text-center d-flex flex-column justify-content-center align-items-center mb-40"
                    style="background-image: url('{{ asset('img/banner1.jpg')}}');">
            <div class="container">
                <h1 class="promo-hero__title" style="color: #ececec;">Welcome to Our Wholesale Dog Toy Store!</h1>
                <div class="promo-hero__text" style="color: #ececec;">Bulk Pricing and Custom Production Solutions for Retailers</div>

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

                        <p>
                        As a leading supplier of high-quality dog toys, we offer a wide range of products at competitive prices. 
                        Our selection includes everything from chew toys to interactive toys to fetch toys, in a variety of 
                        shapes, sizes, and textures.
                        </p>
                        <p>
                        But that's not all! We also offer custom production solutions for retailers looking to create their own 
                        unique products. All of our products are made from durable, safe, and non-toxic materials, and we offer 
                        fast and reliable shipping to ensure that you receive your order in a timely manner.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <img src="{{ asset('img/dog-banner.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </section>


        <section class="section-about m-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="section-title text-center col-12">
                        <h3 class="h3 section-title__heading">Why Choose Us?</h3>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card mb-4" >
                            <h3>Wide selection of dog toys</h3>
                            <p class="mt-4">We offer a wide range of products to suit every dog's playstyle, including chew toys, interactive toys, and fetch toys.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card mb-4" >
                            <h3>Custom production solutions</h3>
                            <p class="mt-4">If you have a specific product idea in mind, we can help bring it to life with our custom production solutions.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card mb-4" >
                            <h3>High-quality & safe materials</h3>
                            <p class="mt-4">We use only the best materials to ensure that our products are durable, safe, and non-toxic.</p>
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
                    <h2 class="h3 section-title__heading">Our Selection for Dog Toys</h2>
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