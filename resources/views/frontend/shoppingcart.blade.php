@extends('layouts.theme')
@section('content')
<!-- Breadcrumbs -->
<nav aria-label="breadcrumb" class="page-breadcrumb">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">YOUR CART</li>
        </ol>
    </div>
</nav>

<div class="page-content">
    <main class="main-content">
        <div class="container">
            <h1 class="page-title h3 text-center">Your cart</h1>

            <table class="cart-table cart table">
                <thead>
                <tr>
                    <th class="product-thumbnail">Product</th>
                    <th class="product-name">&nbsp;</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-remove">&nbsp;</th>
                    <th class="product-subtotal">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $key => $item)

                <tr class="cart-item">
                    <td class="product-thumbnail">
                        <a href="/our-products/{{ $item->prod_id ?? '' }}-{{ $item->prod_name ?? '' }}">
                            <img width="170" height="240" src="/storage/products/thumbnail/{{ $item->prod_img ?? '' }}" alt="" class="attachment-shop_thumbnail"/>
                        </a>
                    </td>
                    <td class="product-name">
                        <h4><a href="/our-products/{{ $item->prod_id }}-{{ $item->prod_name }}">{{ $item->prod_name ?? '' }}</a></h4>
                        <p>{!! $item->prod_desc !!}</p>
                        @if (isset($item->logofile) && $item->logofile != 'null')
                        <p>Custom logo: <a href="storage/{{ $item->logofile ?? '#'}}" target="_blank" style="color: red;">view</a></p>
                        @endif
                    </td>
                    <td class="product-price" data-title="Price: ">
                       {{-- <!-- <span class="amount">$ {{ number_format($item->price, 2) ?? '' }}</span> --> --}}
                        <span class="amount">$ N/A</span>
                    </td>
                    <td class="product-quantity" data-title="Quantity: ">
                        <span class="amount">{{ $item->qty ?? '' }}</span>
                    </td>
                    <td class="product-remove">
                        <form action="{{ route('orders.delete-cart-item', $item->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="remove">
                                <i class="flaticon-waste-can"></i>
                                <span class="remove__text">Remove</span>
                            </button>
                        </form>

                    </td>
                    <td class="product-subtotal" data-title="Total: ">
                        {{-- <!-- <span class="amount">$ {{ number_format($item->total, 2) ?? '' }}</span> --> --}}
                        <span class="amount">$ N/A</span>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <div class="row justify-content-between">
                <div class="col-lg-3">
                    <!-- <h3 class="simple-heading mb-4">Calculate shipping</h3>

                    <form action="/" class="calc-shipping">
                        <div class="form-group">
                            <select class="form-control js-select2" data-placeholder="Choose country">
                                <option value="">Choose country</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="USA">USA</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control js-select2" data-placeholder="Select state">
                                <option value="">Select state</option>
                                <option value="Arizona">Arizona</option>
                                <option value="California">California</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Zip / Postal code">
                        </div>
                        <div class="form-submit">
                            <input type="submit" class="btn btn-outline-primary btn-block" name="update_cart" value="Calculate" />
                        </div>
                    </form> -->
                </div>

                <div class="col-lg-6 cart-total">
                    <div class="cart-subtotal d-flex justify-content-between align-items-center">
                        <span>Subtotal</span>
                        {{-- <!-- <span>$ {{ $cartPrice }}</span> --> --}}
                        <span>$ N/A</span>
                    </div>

                    <div class="cart-subtotal d-flex justify-content-between align-items-center">
                        <span>Cart Total</span>
                        {{-- <!-- <span>$ {{ $cartTotal }}</span> --> --}}
                        <span>$ N/A</span>
                    </div>

                    <div class="cart-total__btns text-lg-right">
                        <a href="{{ route('shop') }}" class="btn btn-outline-primary btn-lg cart-update-btn">Back to shop</a>
                        <a href="{{ route('orders.submit') }}" class="btn btn-primary btn-lg cart-checkout-btn">Checkout</a>
                    </div>
                </div>
            </div>

        </div>
    </main>
</div>
@endsection