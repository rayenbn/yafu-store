@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.color') }}
    </div>

    <form action="{{ route('admin.color.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body"  id="english-form">
            <div class="row">
                <div class="form-group col-md-4 {{ $errors->has('color_name') ? 'has-error' : '' }}">
                    <label for="color_name">{{ trans('global.color_name') }} </label>
                    <input type="text" id="color_name" name="color_name" class="form-control" value="{{ old('color_name', isset($color) ? $color->color_name : '') }}">
                    @if($errors->has('color_name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('color_name') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('global.color_name_helper') }}
                    </p>
                </div>
                
                <div class="form-group col-md-4">
                    <label>Color picker:</label>

                    <div class="input-group my-colorpicker2 colorpicker-element" data-colorpicker-id="2">
                    <input type="text" class="form-control" id="color_code" name="color_code" data-original-title="" title="">

                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                    </div>
                    </div>
                    <!-- /.input group -->
                </div>

                <div class="form-group col-md-4 {{ $errors->has('price') ? 'has-error' : '' }}">
                    <label for="price">{{ trans('global.price') }} </label>
                    <input type="text" id="price" name="price" class="form-control" value="{{ old('price', isset($color) ? $color->price : '') }}">
                    @if($errors->has('price'))
                        <em class="invalid-feedback">
                            {{ $errors->first('price') }}
                        </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('global.price_helper') }}
                    </p>
                </div>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </div>
    </form>
</div>

@endsection