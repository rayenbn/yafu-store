@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                {{ trans('global.create') }} {{ trans('global.product.title_singular') }}
            </div>

            <form action="{{ route("admin.products.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body"  id="english-form">
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
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('category'))
                            <em class="invalid-feedback">
                                {{ $errors->first('category') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.categories_helper') }}
                            </p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="form-group col-sm-4 {{ $errors->has('color') ? 'has-error' : '' }}">
                            <label>colors</label>
                            <select class="col-form-label select2" name="colors[]" multiple="multiple" data-placeholder="Select product colors" style="width: 100%;">
                                @foreach ($colors as $color)
                                <option value="{{$color->id}}">{{$color->color_name}}</option>
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
                                <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                            <em class="invalid-feedback">
                                {{ $errors->first('type') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.variant_helper') }}
                            </p>
                        </div>

                        <div class="form-group col-sm-4 {{ $errors->has('availability') ? 'has-error' : '' }}">
                            <label>{{ trans('global.product.fields.availability') }}*</label>
                            <select class="form-control" id="availability" name="availability" style="width: 100%;" required>
                                <option value="0" selected>Available</option>
                                <option value="1">Not Available</option>
                                <option value="2">Pre Order</option>
                            </select>
                            @if($errors->has('status'))
                            <p class="help-block">
                                {{ $errors->first('status') }}
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
                        <input type="checkbox" name="haslogo" id="haslogo" onclick="myFunction()" value="1">
                        <div style="{{isset($product) && $product->haslogo == '1' ? 'display:block' : 'display:none' }}" id="logopriceInput">
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


                    <div class="form-group">
                        <div class="form-group col-sm-12 {{ $errors->has('keywords') ? 'has-error' : '' }}">
                            <label for="keywords">{{ trans('global.product.fields.keywords') }}*</label>
                            <input type="text" id="keywords" name="keywords" class="form-control" value="{{ old('keywords', isset($product) ? $product->keywords : '') }}">
                            @if($errors->has('keywords'))
                            <em class="invalid-feedback">
                                {{ $errors->first('keywords') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.keywords_helper') }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group col-sm-12 {{ $errors->has('meta_desc') ? 'has-error' : '' }}">
                            <label for="meta_desc">{{ trans('global.product.fields.meta_desc') }}*</label>
                            <input type="text" id="meta_desc" name="meta_desc" class="form-control" value="{{ old('meta_desc', isset($product) ? $product->meta_desc : '') }}">
                            @if($errors->has('meta_desc'))
                            <em class="invalid-feedback">
                                {{ $errors->first('meta_desc') }}
                            </em>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.product.fields.meta_desc_helper') }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-8">
                        <label class="form-check-label" for="status">Status</label>
                        <input type="checkbox" name="status" id="status" checked value="1">
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