@extends('layouts.theme')
@section('content')  
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="page-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shop</li>
        </ol>
    </div>
</nav>
@include('frontend.components.shop-category', $categories)
<div class="page-content">
        <main class="main-content">
            <div class="container">
                
                <!-- <div class="shop-controls d-flex align-items-center">
                    <div class="shop-control">
                        <label for="per_page" class="control-label">View:</label>
                        <select id="per_page" name="perpage" class="prod-per-page js-select2 select-style">
                            <option value="12">12</option>
                            <option value="24">24</option>
                        </select>
                    </div>
                    <div class="shop-control">
                        <label for="order_by" class="control-label">Sort by:</label>
                        <select id="order_by" name="orderby" class="orderby js-select2 select-style">
                            <option value="1">Newest to oldest</option>
                            <option value="1">Oldest to newest</option>
                        </select>
                    </div>
                </div> -->

                <ul class="products columns-4">
                    @foreach($products as $key => $product)
                    <li class="product">
                        <div class="product-thumb">
                            <!-- <span class="onsale">-30%</span> -->
                            <a href="{{  $product->path() }}" class="product-thumb__link">
                                <img src="/storage/products/thumbnail/{{ $product->img }}" alt="">
                                <span class="btn btn-outline-light shop-link">View</span>
                            </a>
                        </div>
                        <div class="product-title"><a href="{{  $product->path() }}">{{ $product->name ?? ''}}</a></div>
                        <!-- <div class="price">
                            <ins><span class="amount">$15.00</span></ins>
                            <del><span class="amount">$178.00</span></del>
                        </div> -->
                    </li>
                    @endforeach
                </ul>

                <nav class="shop-pagination text-center">
                {{ $products->links('vendor.pagination.theme_paginator') }}
                </nav>
            </div>
        </main>
    </div>

@endsection