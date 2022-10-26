@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                {{ trans('global.edit') }} {{ trans('global.product.title_singular') }}
            </div>

            <form action="{{ route("admin.products.update", [$product->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body" id="english-form">
                    <div class="form-group row">
                        <div class="form-group col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('global.product.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($product) ? $product->name : '') }}">
                            @if($errors->has('name'))
                            <em class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group col-sm-6 {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label>Category</label>
                            <select class="col-form-label select2" name="categories[]" multiple="multiple" data-placeholder="Select Category" style="width: 100%;">

                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" @foreach ($product->categories as $categori)
                                    @if ($categori->id == $category->id)
                                    selected
                                    @endif
                                    @endforeach
                                    >{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                            <em class="invalid-feedback">
                                {{ $errors->first('category') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.image_helper') }}
                            </p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-sm-4 {{ $errors->has('color') ? 'has-error' : '' }}">
                            <label>colors</label>
                            <select class="col-form-label select2" name="colors[]" multiple="multiple" data-placeholder="Select product colors" style="width: 100%;">
                                @foreach ($colors as $color)
                                <option value="{{$color->id}}" @foreach ($product->colors as $col)
                                    @if ($col->id == $color->id)
                                    selected
                                    @endif
                                    @endforeach
                                    >{{$color->color_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('color'))
                            <em class="invalid-feedback">
                                {{ $errors->first('color') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.color_helper') }}
                            </p>
                        </div>

                        <div class="form-group col-sm-4 {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label>Variants</label>
                            <select class="col-form-label select2" name="types[]" multiple="multiple" data-placeholder="Select product variants" style="width: 100%;">
                            @foreach ($types as $type)
                                <option value="{{$type->id}}" 
                                    @foreach ($product->types as $tp)
                                        @if ($tp->id == $type->id)
                                            selected
                                        @endif
                                    @endforeach
                                >
                                    {{$type->name}}
                                </option>
                                @endforeach
                            </select>
                            @if($errors->has('color'))
                            <em class="invalid-feedback">
                                {{ $errors->first('color') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.color_helper') }}
                            </p>
                        </div>

                        <div class="form-group col-sm-4 {{ $errors->has('availability') ? 'has-error' : '' }}">
                            <label>{{ trans('global.product.fields.availability') }}*</label>
                            <select class="form-control" id="availability" name="availability" style="width: 100%;" required>
                       
                                @if (isset($product))
                                    <option value="0"
                                        @if ($product->availability == 0)
                                            selected
                                        @endif
                                    >Available</option>
                                    <option value="1"
                                        @if ($product->availability == 1)
                                            selected
                                        @endif
                                    >Not Available</option>
                                    <option value="2"
                                        @if ($product->availability == 2)
                                            selected
                                        @endif
                                    >Pre Order</option>
                                @endif
                            </select>
                            @if($errors->has('availability'))
                            <p class="help-block">
                                {{ $errors->first('availability') }}
                            </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.availability_helper') }}
                            </p>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-sm-6{{ $errors->has('price') ? 'has-error' : '' }}">
                            <label for="price">{{ trans('global.product.fields.price') }}</label>
                            <input type="number" id="price" name="price" class="form-control" value="{{ old('price', isset($product) ? $product->price : '') }}" step="0.01">
                            @if($errors->has('price'))
                            <em class="invalid-feedback">
                                {{ $errors->first('price') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.price_helper') }}
                            </p>
                        </div>
                        <div class="form-group col-sm-6{{ $errors->has('discount_price') ? 'has-error' : '' }}">
                            <label for="discount_price">{{ trans('global.product.fields.discount_price') }}</label>
                            <input type="number" id="discount_price" name="discount_price" class="form-control" value="{{ old('discount_price', isset($product) ? $product->discount_price : '') }}" step="0.01">
                            @if($errors->has('discount_price'))
                            <em class="invalid-feedback">
                                {{ $errors->first('discount_price') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.discount_price_helper') }}
                            </p>
                        </div>
                    </div>

                    <div class="form-group row {{ $errors->has('img') ? 'has-error' : '' }}">
                        <label for="img" class="col-md-3 col-form-label ">{{ trans('global.product.fields.image') }}*</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="img" name="img">
                                    <label class="custom-file-label" for="img">{{ trans('global.choose_file') }}</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="img">{{ trans('global.upload') }}</span>
                                </div>
                            </div>
                        </div>
                        @if($errors->has('img'))
                        <em class="invalid-feedback">
                            {{ $errors->first('img') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.product.fields.image_helper') }}
                        </p>
                    </div>
                    <!--  upload video -->
                    <div class="form-group row {{ $errors->has('video') ? 'has-error' : '' }}">
                        <label for="video" class="col-md-3 col-form-label ">{{ trans('global.product.fields.video') }}*</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="video" name="video">
                                    <label class="custom-file-label" for="video">{{ trans('global.choose_file') }}</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="video">{{ trans('global.upload') }}</span>
                                </div>
                            </div>
                        </div>
                        @if($errors->has('video'))
                        <em class="invalid-feedback">
                            {{ $errors->first('video') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.product.fields.video_helper') }}
                        </p>
                    </div>

                    <div class="form-group row {{ $errors->has('productImages') ? 'has-error' : '' }}">
                        <label for="productImages" class="col-md-3 col-form-label ">Upload Images</label>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="productImages[]" id="productImages" accept="image/*" multiple>
                                    <label class="custom-file-label" for="productImages">{{ trans('global.choose_file') }}</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="productImages">{{ trans('global.upload') }}</span>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            @foreach ( $productImages as $image)
                            <div class="imagecontainer">
                                <img src="/storage/products/thumbnail/{{ $image->productImages }}" class="image" />
                                <div class="middle">
                                    <button type="button" name="deleteimage" data-image-id="{{$image->id}}" id="deleteimage" class="btn btn-danger"><i class="fa fa-trash" style="color: white"></i></button>
                                    <!-- <a href="#" id="deleteimage" data-image-id="{{$image->id}}" onclick="return confirm('{{ trans('global.areYouSure') }}');"> <i class="fa fa-trash" style="color: red"></i> </a> -->
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>


                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description">{{ trans('global.product.fields.description') }}</label>
                        <textarea id="description" name="description" class="form-control ">{{ old('description', isset($product) ? $product->description : '') }}</textarea>
                        @if($errors->has('description'))
                        <em class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.product.fields.description_helper') }}
                        </p>
                    </div>

                    <div class="col-md-6 mb-8">
                        <label class="form-check-label" for="haslogo">Allow users to upload their Logo?</label>
                        <input type="checkbox" name="haslogo" id="haslogo" onclick="myFunction()" value="1" @if ($product->haslogo == '1') checked @endif>
                        <div style="{{isset($product) && $product->haslogo == '1' ? 'display:block' : 'display:none' }}" id="logopriceInput" >
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group {{ $errors->has('logoprice') ? 'has-error' : '' }}">
                                        <label for="logoprice">Logo price per unit</label>
                                        <input type="text" id="logoprice" name="logoprice" class="form-control" value="{{ old('logoprice', isset($product) ? $product->logoprice : '') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-8">
                        <label class="form-check-label" for="status">Status</label>
                        <input type="checkbox" name="status" id="status" value="1" @if(isset($product) && $product->status == '1') checked @endif>
                    </div>


                    <div>
                        <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(document).on('click', '#deleteimage', function() {
        var imageid = $(this).data('image-id');
        if (confirm("{{ trans('global.areYouSure') }}")) {
            $.ajax({
                headers: {
                    'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'DELETE',
                url: "/admin/products/image/" + imageid,
            }).done(function() {
                location.reload()
            })
        }
    });
</script>
<script>
function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("haslogo");
  // Get the output text
  var inputBox = document.getElementById("logopriceInput");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    inputBox.style.display = "block";
  } else {
    inputBox.style.display = "none";
  }
}
</script>
@endsection
@endsection