@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="box-title">Policies Page</h3>
                        </div>
                    </div>
                </div>

                <!-- /.box-header -->
                @if($warranty)
                <form action="{{ route("admin.warranty-page.update", [$warranty->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                @else
                <form action="{{ route("admin.warranty-page.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                @endif
                <div class="card-body">
                    <div class="form-group  {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title">Banner {{ trans('global.aboutus.fields.title') }}</label>

                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($warranty) ? $warranty->title : '') }}" placeholder="Warranty page title" required>
                        @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                        <label for="content">Banner {{ trans('global.aboutus.fields.description') }}</label>
                        <textarea id="content" name="content" class="form-control " rows="10">{{ old('content', isset($warranty) ? $warranty->content : '') }}</textarea>
                        @if($errors->has('content'))
                        <em class="invalid-feedback">
                            {{ $errors->first('content') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.aboutus.fields.description_helper') }}
                        </p>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-2 offset-md-10">
                            <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </div>
                </div>

                </form>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</section>
@endsection