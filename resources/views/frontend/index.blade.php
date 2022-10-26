@extends('layouts.theme')
@section('content')

<div class="page-content">
    <main class="main-content">
        @include('partials.slider', $sliders)
        
        <section class="section-featured-icons">
            <div class="container">
                <h2 class="screen-reader-text">Our features</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="icon-box icon-box-left icon-box-circle justify-content-sm-center">
                            <div class="icon-box__icon"><i class="flaticon flaticon-delivery-truck"></i></div>
                            <div class="icon-box__title">Delivery to all regions.</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="icon-box icon-box-left icon-box-circle justify-content-sm-center">
                            <div class="icon-box__icon"><i class="flaticon flaticon-thumb-up-gesture"></i></div>
                            <div class="icon-box__title">Focus on sales and leave supplies on Us.</div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="icon-box icon-box-left icon-box-circle justify-content-sm-center">
                            <div class="icon-box__icon"><i class="flaticon flaticon-sales-ticket"></i></div>
                            <div class="icon-box__title">Quality protection, 100% guarantee money back.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="section-offers">
            <div class="container">
                <h2 class="screen-reader-text">Offers</h2>
                <div class="row">
                    <div class="col-md-7">
                        <div class="offer-box">
                            <img class="offer-box__bg" src="{{ asset('img/pets-cat1.png') }}" alt="">
                            <div class="offer-box__body">
                                <div class="offer-box__title">Pet Toys</div>
                                <a href="/our-products" class="btn btn-outline-dark btn-lg">Explore products</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <a href="/blogs/1-how-to-import-pet-toys-products-from-china-for-your-amazon-fba-shop" class="offer-box offer-box-sm">
                            <img class="offer-box__bg" src="{{ asset('img/fbasellers.jpg') }}" alt="">
                            <div class="offer-box__body">
                                <div class="offer-box__title">
                                    For FBA sellers
                                </div>
                            </div>
                        </a>
                        <a href="/blogs/2-how-to-import-pet-toys-from-china" class="offer-box offer-box-sm">
                            <img class="offer-box__bg" src="{{ asset('img/forbussiness.jpg') }}" alt="">
                            <div class="offer-box__body">
                                <div class="offer-box__title">For business</div>
                            </div>
                        </a>
                    </div>
                </div> <!-- end of featured -->
            </div>
        </section>

        <section class="section-featured-products">
            <div class="container">
                <div class="section-title text-center">
                    <h2 class="h3 section-title__heading">Featured products</h2>
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
        {{--
     
        <section class="section-featured-products">
            <div class="container">
                <div class="section-title text-center">
                    <h2 class="h3 section-title__heading">Featured products</h2>
                </div>
                <ul class="products featured-products columns-4">
                    <li class="product">
                        <div class="product-thumb">
                            <span class="onsale">-30%</span>
                            <a href="single-product.html" class="product-thumb__link">
                                <img src="images/270x380.png" alt="">
                                <span class="btn btn-outline-light shop-link">Shop</span>
                            </a>
                        </div>
                        <div class="product-title"><a href="single-product.html">Cogen warm lamp</a></div>
                        <div class="price">
                            <ins><span class="amount">$56.00</span></ins>
                            <del><span class="amount">$73.00</span></del>
                        </div>
                    </li>
                    <li class="product">
                        <div class="product-thumb">
                            <a href="single-product.html" class="product-thumb__link">
                                <img src="images/270x380.png" alt="">
                                <span class="btn btn-outline-light shop-link">Shop</span>
                            </a>
                        </div>
                        <div class="product-title"><a href="single-product.html">Dutch grey bag</a></div>
                        <div class="price">
                            <span class="amount">$33.00</span>
                        </div>
                    </li>
                    <li class="product">
                        <div class="product-thumb">
                            <a href="single-product.html" class="product-thumb__link">
                                <img src="images/270x380.png" alt="">
                                <span class="btn btn-outline-light shop-link">Shop</span>
                            </a>
                        </div>
                        <div class="product-title"><a href="single-product.html">Wood tablet deck</a></div>
                        <div class="price">
                            <span class="amount">$30.00</span>
                        </div>
                    </li>
                    <li class="product">
                        <div class="product-thumb">
                            <a href="single-product.html" class="product-thumb__link">
                                <img src="images/270x380.png" alt="">
                                <span class="btn btn-outline-light shop-link">Shop</span>
                            </a>
                        </div>
                        <div class="product-title"><a href="single-product.html">Roniq watch</a></div>
                        <div class="price">
                            <span class="amount">$128.00</span>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        --}}
        {{--
        <section class="section-last-posts">
            <div class="container">
                <div class="section-title text-center">
                    <h2 class="h3 section-title__heading">From the blog</h2>
                </div>

                <div class="post-grid row">
                @foreach($blogs as $key => $blog)
                    <div class="col-lg-4 col-md-6">
                        <article class="post-item">
                            <a href="{{ $blog->path() }}" class="post-thumb">
                                <img src="../storage/blogs/thumbnail/{{ $blog->image }}" alt="">
                            </a>
                            <div class="post-item__content">
                                <div class="post-date">{{ $blog->created_at->diffForHumans() }}</div>
                                <h3 class="post-title"><a href="{{ $blog->path() }}">{{ $blog->title ?? ''}}</a></h3>
                            </div>
                        </article>
                    </div>
                @endforeach 
                   
                </div>
                <div class="text-center mt-lg-4">
                    <a href="{{ route('blogs') }}" class="btn btn-outline-primary btn-lg">View all posts</a>
                </div>
            </div>
        </section>
--}}

            {{--
        <section class="section-about mt-4">
            <div class="container">
             
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="section-title mb-40">About Us</h3>

                        <p>Our store is more than just another average online retailer.
                            We sell not only top unique products, but give our customers a positive online
                            shopping experience. Purchase the things you need every day or just like in a few
                            clicks or taps, depending on the device you use to access the Internet. We work to
                            make your life more enjoyable.
                        </p>
                        <p>Our store is more than just another average online retailer.
                            We sell not only top unique products, but give our customers a positive online
                            shopping experience. Purchase the things you need every day or just like in a few
                            clicks or taps, depending on the device you use to access the Internet. We work to
                            make your life more enjoyable.
                        </p>
                    </div>
                    <div class="col-lg-6">
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
                                     you always can inquire for a sample set of different type of products you whish to purchase.
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
                                    A production MOQ can vary between 10pcs to 1000pcs depends on the products, but to make it easier for our client who just starting a small pet shop bossiness Yafu will also offer ready stock with low or no MOQ. You can consult our ales manager for more info about available products in stock <a href="/contact-us">here</a>
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
                                <div class="card-header" id="headingThreeOutline">
                                    <button class="btn btn-outline-primary btn-lg collapsed" type="button" data-toggle="collapse" data-target="#collapseThreeOutline" aria-expanded="false" aria-controls="collapseThreeOutline">
                                    How can I place an order for my pet toys products?
                                    </button>
                                </div>
                                <div id="collapseThreeOutline" class="collapse" aria-labelledby="headingThreeOutline" data-parent="#accordionExampleOutline">
                                    <div class="card-body">
                                    <b>You can start your production in simply 4 easy steps:</b> <br>
                                    <ol>
                                        <li>Register and account <a href="/register">here</a> (if you don’t have one already)</li>
                                        <li>Add the products you wish to buy to your shopping cart</li>
                                        <li>Submit your order <br><small>(By submitting your order you will receive a proforma-invoice file into your email.)</small></li>
                                        <li>Our sales manager will contact you by email Within 24h to confirm with you the order, and payment method.</li>
                                    </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThreeOutline">
                                    <button class="btn btn-outline-primary btn-lg collapsed" type="button" data-toggle="collapse" data-target="#collapseThreeOutline" aria-expanded="false" aria-controls="collapseThreeOutline">
                                    Any warranty from Yafu if I receive damaged products?
                                    </button>
                                </div>
                                <div id="collapseThreeOutline" class="collapse" aria-labelledby="headingThreeOutline" data-parent="#accordionExampleOutline">
                                    <div class="card-body">
                                    -	Yes, Yafu guarantees all products and we will refund full amount for any product have production mistakes or quality issue.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                --}}

        {{--  
            <!-- banner -->
        <div class="banner mtb-45">
            <div class="container">
                <div class="content">
                    <h1>Lorem Ipsum</h1>
                    <p>Donec
                        Dolor Scelerisque Placerat Tristique Dictum
                    uis. Non egestas auctor nulla metus turpis vestibulum accumsan nulla eget. Purus. Odio. Sociosqu a eget sagittis lobortis sit fermentum montes porta magna purus. Faucibus id ipsum blandit. At, sociis sociosqu ac metus aptent aliquet est lorem elit risus pharetra quisque tortor. Ultrices, velit montes ipsum placerat imperdiet, ut eros a. Primis velit sit in curae; feugiat dictum lorem suscipit nisi nullam tincidunt pharetra lacus commodo mollis praesent euismod sociis hymenaeos bibendum purus cras, nam aenean curae; interdum dignissim.</p>
                </div>
            </div>
        </div> --}}

        <section class="section-contact-form" id="samples">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 text-center">
                        <div class="section-title section-title-w-text text-center">
                            <h2 class="h3 section-title__heading">Inquire a sample!</h2> 
                            <div class="section-title__text">To further support customers who are sincere about running a production with us,
                                we credit 50 USD towards your first purchase.</div>
                        </div>
                        
                        <form class="contact-form" action="{{ url('inquiry-sample') }}" method="post">
                        {{ csrf_field() }}
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="name" placeholder="Name*" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" name="email" placeholder="E-mail address*" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="address" placeholder="Address (Country, City)*" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone number">
                                </div>
                            </div>

                            <div class="form-group mb-10">
                                <select class="form-control js-select2" name="product" data-placeholder="Product sample:">
                                    <option value="Pet Toys">Pet Toys</option>
                                    <option value="Home Decore">Home Decore</option>
                                </select>
                            </div>

                            <div class="form-submit mt-3">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Send">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call Action -->
        @include('frontend.components.newsletter')
            <!-- End Section -->
    </main> <!-- end of main -->
</div>
@endsection