@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.blog.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.blogs.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row {{ $errors->has('image') ? 'has-error' : '' }}">
                <label for="image" class="col-md-3 col-form-label ">{{ trans('global.blog.fields.image') }}*</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">{{ trans('global.choose_file') }}</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="image">{{ trans('global.upload') }}</span>
                        </div>
                    </div>
                </div>
                @if($errors->has('image'))
                <em class="invalid-feedback">
                    {{ $errors->first('image') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.blog.fields.image_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('global.blog.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($blog) ? $blog->title : '') }}">
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.blog.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                <label for="text">{{ trans('global.blog.fields.description') }}</label>
                <textarea id="text" name="text" class="form-control ">{{ old('text', isset($blog) ? $blog->text : '') }}</textarea>
                @if($errors->has('text'))
                    <p class="help-block">
                        {{ $errors->first('text') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.blog.fields.description_helper') }}
                </p>
            </div>
            
            <div class="form-group {{ $errors->has('keywords') ? 'has-error' : '' }}">
                <label for="keywords">{{ trans('global.blog.fields.keywords') }}*</label>
                <input type="text" id="keywords" name="keywords" class="form-control" value="{{ old('keywords', isset($blog) ? $blog->keywords : '') }}">
                @if($errors->has('keywords'))
                    <p class="help-block">
                        {{ $errors->first('keywords') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.blog.fields.keywords_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('meta_desc') ? 'has-error' : '' }}">
                <label for="meta_desc">{{ trans('global.blog.fields.meta_desc') }}*</label>
                <input type="text" id="meta_desc" name="meta_desc" class="form-control" value="{{ old('meta_desc', isset($blog) ? $blog->meta_desc : '') }}">
                @if($errors->has('meta_desc'))
                    <p class="help-block">
                        {{ $errors->first('meta_desc') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('global.blog.fields.meta_desc_helper') }}
                </p>
            </div>


            <div>
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection