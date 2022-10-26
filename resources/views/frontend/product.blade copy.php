<?php

    use App\Http\Controllers\Controller;

    $social_media = Controller::footer();

?>
@extends('layouts.theme')
@section('content')
 <!--Banner-->
 <section class="page-heading">
    <div class="title-slide">
        <div class="container">
            <div class="banner-content">									
                <div class="page-title">
                    <h3>{{ $our_product->name}}</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Banner-->
<div class="page-content">					
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <ul>
                        <li class="home"><a href="/"><i class="fa fa-home"></i> Home</a></li>
                        <li><span>//</span></li>
                        <li class="category-2"><a href="{{ $our_product->path()}}" style="color: #fff;">{{ $our_product->name}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <div class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-view">
                        <div class="product-essential col-md-12">
                            <div class="product-img-box col-md-6">
                                <!-- <a href="#"><img alt="" src="/storage/products/thumbnail/{{ $our_product->img }}"></a> -->
                                <div class="more-views">
                                    <div id="owl-demo" class="owl-carousel owl-theme">
                                        <!-- <div class="item"><img alt="" src="/storage/products/thumbnail/{{ $our_product->img }}"></div> -->
                                        
                                        @foreach( $images as $image)
                                            <div class="item"><img alt="" src="/storage/products/thumbnail/{{ $image->productImages }}"></div>
                                        @endforeach
                                    </div>
                                     <a class="jcarousel-control-prev" href="#"><i class="fa fa-caret-left"></i></a>
                                        <a class="jcarousel-control-next" href="#"><i class="fa fa-caret-right"></i></a>
                                    <div class="customNavigation">
                                        <a class="btn prev"><i class="fa fa-caret-left"></i></a>
                                        <a class="btn next"><i class="fa fa-caret-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="product-shop col-md-6">
                                <div class="product-name">
                                    <h1>{{ $our_product->name }}</h1>
                                </div>
                                <div class="meta-box">
                                    <div class="price-box">	
                                    @if($our_product->discount_price)
                                        <span class="special-price">{{ $our_product->discount_price }}</span>
                                        <span class="old-price">{{ $our_product->price }}</span>
                                    @elseif($our_product->price)
                                        <span class="special-price">{{ $our_product->price }}</span>
                                    @endif																									
                                        
                                    </div>
                                    <div class="rating-box">
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="tags-list">
                                    <label>Availability: </label><span>:</span>
                                    <ul>
                                        
                                        @if (isset($our_product))
                                            @if ($our_product->availability == 0)
                                            <li><a href="#">Available</a></li>
                                            @endif

                                            @if ($our_product->availability == 1)
                                            <li><a href="#">Not Available</a></li>
                                            @endif

                                            @if ($our_product->availability == 2)
                                            <li><a href="#">Pre Order</a></li>
                                            @endif

                                        @endif
                                    </ul>
                                </div>
                                <div class="clearfix"></div>
                                <div class="short-description">
                                {!! substr($our_product->description ?? '', 0, 190) !!}
                                </div>
                                <div class="add-to-box">
                                    <div class="row">
                                        <div class="add-to-cart">
                                            <input type="text" class="input-text qty-1" title="Qty" value="1000" maxlength="12" id="qty" name="qty">
                                            <span class="increase-qty" onclick="increaseQty('1')"><i class="fa fa-sort-up"></i></span>
                                            <span class="decrease-qty" onclick="decreaseQty('1')"><i class="fa fa-sort-down"></i></span>
                                        </div>
                                        <!-- <div class="add-to-cart">
                                            <select>
                                                <option value="1">Black</option>
                                                <option value="2">Green</option>
                                                <option value="3">Red</option>
                                                <option value="4">Yellow</option>
                                            </select>
                                            
                                        </div> -->
                                        <select class="state">
                                            @foreach ( $our_product->colors as $color )
                                                <option value="{{ $color->id }}">{{ $color->color_code }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ( $our_product->types as $type )
                                        <select class="state">
                                            @foreach ( $type->variants as $variant )
                                                <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                            @endforeach
                                        </select>
                                        @endforeach
                                    </div>
                                    <button class="button btn-cart" title="Add to Cart" type="button">
                                        <em class="fa-icon"><i class="fa fa-shopping-cart"></i></em>
                                        <span>Add Cart</span>
                                    </button>
                                    <!-- <a class="link-wishlist"><i class="fa fa-heart"></i></a> -->
                                </div>
                                <div class="cat-list">
                                    <label>Categories</label><span>: </span>
                                    <ul>
                                        @foreach ( $our_product->categories as $category )
                                        <li><a href="{{ $category->path() }}">{{ $category->category_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                
                                <div class="tags-list">
                                    <label>Tags</label><span>:</span>
                                    <ul>
                                        <li><a href="#">Fitness</a></li>
                                        <li><a href="#">Lorem</a></li>
                                    </ul>
                                </div>
                                <div class="social-icon">
                                    <ul>
                                        @if (isset($footer->fb))
                                        <li><a href="{{ $footer->youtube }}"><i class="fa fa-youtube"></i></a></li>
                                        @endif
                                        @if (isset($footer->fb))
                                        <li><a href="{{ $footer->fb }}"><i class="fa fa-facebook"></i></a></li>
                                        @endif
                                        @if (isset($footer->ig))
                                        <li><a href="{{ $footer->ig }}"><i class="fa fa-instagram"></i></a></li>
                                        @endif
                                        @if (isset($footer->twitter))
                                        <li><a href="{{ $footer->twitter }}"><i class="fa fa-twitter"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="tabs" class="product-collateral">
                            <ul>
                                <li><a href="#tabs-1">Description</a></li>
                                <!-- <li><a href="#tabs-2">Reviews</a></li> -->
                            </ul>
                            <div id="tabs-1" class="box-collateral">
                                {!! $our_product->description !!}
                            </div>
                            <!-- <div id="tabs-2" class="box-collateral">
                                <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. </p>
                            </div> -->
                        </div>
                        @if ( !is_null($previous_record) || !is_null($next_record))
                        <div class="product-related row">
                            <div class="col-md-12">
                                <h3 class="title">Product Related</h3>
                            </div>
                            @foreach ( $previous_record as $prev_product)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="product-image-wrapper">
                                    <div class="product-content">
                                        <div class="product-image">
                                            <a href="{{ $prev_product->path() }}">
                                                <img alt="{{ $prev_product->name ?? '' }}" src="/storage/products/thumbnail/{{ $prev_product->img }}">
                                            </a>
                                        </div>
                                        <div class="info-products">
                                            <div class="product-name" >
                                                <a href="{{ $prev_product->path() }}">{{ $prev_product->name ?? ''}}</a>
                                                <div class="product-bottom"></div>
                                            </div>
                                            <div class="price-box">							
                                                @if($prev_product->discount_price)
                                                <span class="old-price">$ {{ $prev_product->price ?? ''}}</span>
                                                <span class="special-price">$ {{ $prev_product->discount_price ?? ''}}</span>
                                                @elseif ($prev_product->price)
                                                <span class="special-price">$ {{ $prev_product->price ?? ''}}</span>
                                                @endif
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-info"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <a class="arrows quickview" href="#quickview"><i class="fa fa-arrows"></i></a> -->
                                </div>
                            </div>
                            @endforeach
                            @foreach ( $next_record as $next_product)
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="product-image-wrapper">
                                    <div class="product-content">
                                        <div class="product-image">
                                            <a href="{{ $next_product->path() }}">
                                                <img alt="{{ $next_product->title ?? '' }}" src="/storage/products/thumbnail/{{ $next_product->img }}">
                                            </a>
                                        </div>
                                        <div class="info-products">
                                            <div class="product-name" >
                                                <a href="{{ $next_product->path() }}">{{ $next_product->name }}</a>
                                                <div class="product-bottom"></div>
                                            </div>
                                            <div class="price-box">																										
                                                @if($next_product->discount_price)
                                                <span class="old-price">$ {{ $next_product->price ?? ''}}</span>
                                                <span class="special-price">$ {{ $next_product->discount_price ?? ''}}</span>
                                                @elseif ($next_product->price)
                                                <span class="special-price">$ {{ $next_product->price ?? ''}}</span>
                                                @endif
                                            </div>
                                            <div class="actions">
                                                <ul>
                                                    <li><a href="#"><i class="fa fa-info"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <a class="arrows quickview" href="#quickview"><i class="fa fa-arrows"></i></a> -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@include('frontend.components.Enquiry_modal')
@endsection