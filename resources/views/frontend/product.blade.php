<?php

    use App\Http\Controllers\Controller;

    $social_media = Controller::footer();

?>
@extends('layouts.theme')
@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="page-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            {{-- <li class="breadcrumb-item"><a href="{{ route('shop') }}">Shop</a></li> --}}
            <!-- <li class="breadcrumb-item"><a href="shop.html">Sale</a></li> -->
            <li class="breadcrumb-item active" aria-current="page">{{ $our_product->name}}</li>
        </ol>
    </div>
</nav>

<div class="page-content">
    <main class="main-content">
        

        <product
            :product="{{ json_encode($our_product ?? null) }}" 
            :types="{{ json_encode($types ?? null) }}" 
            :colors="{{ json_encode($our_product->colors ?? null) }}" 
            :images="{{ json_encode($images ?? []) }}" 
            :prod_categories="{{ json_encode($prod_categories ?? null) }}" 
            :user="{{ json_encode(auth()->user()) }}" 
            :social_media="{{ json_encode($social_media ?? null) }}" 
        >
        </product>
    
        {{--
        @if ( !is_null($previous_record) || !is_null($next_record))
        <section class="section-related">
            <div class="container">
                <h2 class="section-title text-center h3">Other items you may like</h2>
                <ul class="products featured-products columns-5">
                    @foreach ( $previous_record as $prev_product)
                    <li class="product">
                        <div class="product-thumb">
                            <!-- <span class="onsale">-30%</span> -->
                            <a href="{{ $prev_product->path() }}" class="product-thumb__link">
                                <img src="/storage/products/thumbnail/{{ $prev_product->img }}" alt="{{ $prev_product->name ?? ''}}">
                                <span class="btn btn-outline-light shop-link">View</span>
                            </a>
                        </div>
                        <div class="product-title"><a href="{{ $prev_product->path() }}">{{ $prev_product->name ?? ''}}</a></div>
                        <!-- <div class="price">
                            <span class="amount">$56.00</span>
                        </div> -->
                    </li>
                    @endforeach
                    @foreach ( $next_record as $next_product)
                    <li class="product">
                        <div class="product-thumb">
                            <span class="onsale">-30%</span>
                            <a href="{{ $next_product->path() }}" class="product-thumb__link">
                                <img src="/storage/products/thumbnail/{{ $next_product->img }}" alt="{{ $prev_product->name ?? ''}}">
                                <span class="btn btn-outline-light shop-link">View</span>
                            </a>
                        </div>
                        <div class="product-title"><a href="{{ $next_product->path() }}">{{ $prev_product->name ?? ''}}</a></div>
                        <!-- <div class="price">
                            <span class="amount">$56.00</span>
                        </div> -->
                    </li>
                    @endforeach
                </ul>
            </div>
        </section>
        @endif
        --}}
    </main>
</div>
@include('frontend.components.Enquiry_modal')
@endsection