@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.product.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.product.fields.image') }}
                    </th>
                    <td>
                        <img src="/storage/products/thumbnail/{{ $product->img }}" class="img-thumbnail" width="100px"/>
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.product.fields.name') }}
                    </th>
                    <td>
                        {{ $product->name }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.category') }}
                    </th>
                    <td>
                        @foreach ($product->categories as $category)
                        {{ $category->category_name }} <br /> 
                        @endforeach 
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.product.fields.price') }}
                    </th>
                    <td>
                        ${{ $product->price }}
                        @if ($product->price_range)
                        To  ${{ $product->price_range }}
                        @endif
                    </td>
                    
                </tr>
                <tr>
                    <th>
                        {{ trans('global.product.fields.description') }}
                    </th>
                    <td>
                        {!! $product->description !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.product.fields.color') }}
                    </th>
                    <td>
                        <div class="row">
                        @foreach($product->colors as $color)
                            <span style="display: block; margin-right: 5px; width: 35px; height: 35px; background-color: {{ $color->color_code ?? '' }};"></span>
                        @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.product.fields.availability') }}
                    </th>
                    <td>
                        @if ($product->availability == 0)
                        Available
                        @elseif ($product->availability == 1)
                            Not Available
                        @else   
                            Pre Order
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection