@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">

    @if($global_settings)
    <form action="{{ route('admin.global-settings.update', [$global_settings->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('admin.global-settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
    @endif
            <div class="card col-sm-10 offset-1">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="box-title">Global Settings</h3>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x: inherit;">
                        <div class="row">
                            <div class="col-sm-12">
                                @if(isset($global_settings->logo))
                                <div class="form-group row ">
                                    <div class="col-md-6 col-md-offset-3">
                                        <img src="/storage/logo/{{ $global_settings->logo }}" width="60px" />
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label for="logo" class="col-md-3 col-form-label ">Website Logo</label>
                                    <div class="col-md-9">
                                        <div class="input-group">

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                                <label class="custom-file-label" for="logo">{{ trans('global.choose_file') }}</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="logo">{{ trans('global.upload') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($global_settings->footer_logo))
                                <div class="form-group row ">
                                    <div class="col-md-6 col-md-offset-3">
                                        <img src="/storage/logo/{{ $global_settings->footer_logo }}" width="60px" />
                                    </div>
                                </div>
                                @endif
                                <div class="form-group row">
                                    <label for="footer_logo" class="col-md-3 col-form-label ">Footer Logo</label>
                                    <div class="col-md-9">
                                        <div class="input-group">

                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="footer_logo" name="footer_logo">
                                                <label class="custom-file-label" for="footer_logo">{{ trans('global.choose_file') }}</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="footer_logo">{{ trans('global.upload') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group  row {{ $errors->has('logo_title') ? 'has-error' : '' }}">
                                    <label class="col-md-3 col-form-label" for="logo_title">Logo Title</label>
                                    <div class="col-md-9">
                                        <input type="text" id="logo_title" name="logo_title" class="form-control" value="{{ old('logo_title', isset($global_settings) ? $global_settings->logo_title : '') }}">
                                        @if ($errors->has('logo_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('logo_title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  row {{ $errors->has('meta_title') ? 'has-error' : '' }}">
                                    <label class="col-md-3 col-form-label" for="meta_title">Meta-Title</label>
                                    <div class="col-md-9">
                                        <input type="text" id="meta_title" name="meta_title" class="form-control" value="{{ old('meta_title', isset($global_settings) ? $global_settings->meta_title : '') }}">
                                        @if ($errors->has('meta_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('meta_title') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-2 offset-md-10">
                            <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </div>
                </div>
            </div>
        </form>
</section>
@endsection