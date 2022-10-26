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
                            <h3 class="box-title">Home Page</h3>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                @if($homepage)
                <form action='{{ route("admin.home-page.update", [$homepage->id]) }}' method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @else
                <form action="{{ route('admin.home-page.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @endif
                        <div class="card-body" >
                            <!-- section 2  produnts discount-->
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label  class="col-md-12 col-form-label ">Collection 1</label>
                                            <div class="col-md-12 row">
                                                <label for="sec2_image1" class="col-form-label ">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="sec2_image1" name="sec2_image1">
                                                        <label class="custom-file-label" for="sec2_image1">{{ trans('global.choose_file') }}</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="sec2_image1">{{ trans('global.upload') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-6 {{ $errors->has('sec2_text1') ? 'has-error' : '' }}">
                                                    <label for="sec2_text1">{{ trans('global.homepage.fields.title') }}</label>
                                                    <input type="text" id="sec2_text1" name="sec2_text1" class="form-control" value="{{ old('sec2_text1', isset($homepage) ? $homepage->sec2_text1 : '') }}">
                                                    @if($errors->has('sec2_text1'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('sec2_text1') }}
                                                    </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.homepage.fields.title_helper') }}
                                                    </p>
                                                </div>

                                                <div class="form-group col-sm-6 {{ $errors->has('sec2_desc1') ? 'has-error' : '' }}">
                                                    <label for="sec2_desc1">{{ trans('global.homepage.fields.subtitle') }}</label>
                                                    <input type="text" id="sec2_desc1" name="sec2_desc1" class="form-control" value="{{ old('sec2_desc1', isset($homepage) ? $homepage->sec2_desc1 : '') }}">
                                                    @if($errors->has('sec2_desc1'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('sec2_desc1') }}
                                                    </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.homepage.fields.subtitle_helper') }}
                                                    </p>
                                                </div>
                                                <div class="form-group col-sm-12 {{ $errors->has('sec2_link1') ? 'has-error' : '' }}">
                                                    <label for="sec2_link1">Button link</label>
                                                    <input type="text" id="sec2_link1" name="sec2_link1" class="form-control" placeholder="http://" value="{{ old('sec2_link1', isset($homepage) ? $homepage->sec2_link1 : '') }}">
                                                </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label  class="col-md-12 col-form-label ">Collection 1</label>
                                            <div class="col-md-12 row">
                                                <label for="sec2_image2" class="col-form-label ">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="sec2_image2" name="sec2_image2">
                                                        <label class="custom-file-label" for="sec2_image2">{{ trans('global.choose_file') }}</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="sec2_image2">{{ trans('global.upload') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-6 {{ $errors->has('sec2_text2') ? 'has-error' : '' }}">
                                                    <label for="sec2_text2">{{ trans('global.homepage.fields.title') }}</label>
                                                    <input type="text" id="sec2_text2" name="sec2_text2" class="form-control" value="{{ old('sec2_text2', isset($homepage) ? $homepage->sec2_text2 : '') }}">
                                                    @if($errors->has('sec2_text2'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('sec2_text2') }}
                                                    </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.homepage.fields.title_helper') }}
                                                    </p>
                                                </div>

                                                <div class="form-group col-sm-6 {{ $errors->has('sec2_desc2') ? 'has-error' : '' }}">
                                                    <label for="sec2_desc2">{{ trans('global.homepage.fields.subtitle') }}</label>
                                                    <input type="text" id="sec2_desc2" name="sec2_desc2" class="form-control" value="{{ old('sec2_desc2', isset($homepage) ? $homepage->sec2_desc2 : '') }}">
                                                    @if($errors->has('sec2_desc2'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('sec2_desc2') }}
                                                    </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.homepage.fields.subtitle_helper') }}
                                                    </p>
                                                </div>
                                                <div class="form-group col-sm-12 {{ $errors->has('sec2_link2') ? 'has-error' : '' }}">
                                                    <label for="sec2_link2">Button link</label>
                                                    <input type="text" id="sec2_link2" name="sec2_link2" class="form-control" placeholder="http://" value="{{ old('sec2_link2', isset($homepage) ? $homepage->sec2_link2 : '') }}">
                                                </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label  class="col-md-12 col-form-label ">Collection </label>
                                            <div class="col-md-12 row">
                                                <label for="sec2_image2" class="col-form-label ">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="sec2_image3" name="sec2_image3">
                                                        <label class="custom-file-label" for="sec2_image3">{{ trans('global.choose_file') }}</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="sec2_image3">{{ trans('global.upload') }}</span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-6 {{ $errors->has('sec2_text3') ? 'has-error' : '' }}">
                                                    <label for="sec2_text3">{{ trans('global.homepage.fields.title') }}</label>
                                                    <input type="text" id="sec2_text3" name="sec2_text3" class="form-control" value="{{ old('sec2_text3', isset($homepage) ? $homepage->sec2_text3 : '') }}">
                                                    @if($errors->has('sec2_text3'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('sec2_text3') }}
                                                    </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.homepage.fields.title_helper') }}
                                                    </p>
                                                </div>

                                                <div class="form-group col-sm-6 {{ $errors->has('sec2_desc3') ? 'has-error' : '' }}">
                                                    <label for="sec2_desc3">{{ trans('global.homepage.fields.subtitle') }}</label>
                                                    <input type="text" id="sec2_desc3" name="sec2_desc3" class="form-control" value="{{ old('sec2_desc3', isset($homepage) ? $homepage->sec2_desc3 : '') }}">
                                                    @if($errors->has('sec2_desc3'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('sec2_desc3') }}
                                                    </em>
                                                    @endif
                                                    <p class="helper-block">
                                                        {{ trans('global.homepage.fields.subtitle_helper') }}
                                                    </p>
                                                </div>
                                                <div class="form-group col-sm-12 {{ $errors->has('sec2_link3') ? 'has-error' : '' }}">
                                                    <label for="sec2_link3">Button link</label>
                                                    <input type="text" id="sec2_link3" name="sec2_link3" class="form-control" placeholder="http://" value="{{ old('sec2_link3', isset($homepage) ? $homepage->sec2_link3 : '') }}">
                                                </div>

                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- section 2 end produnts discount-->
                            <!-- <hr> -->
                                <!-- banner-->
                            <div class="row">
                                <div class="col-md-12">
                                    <label  class="col-md-12 col-form-label ">Gallery Banner</label>
                                    <div class="form-group col-sm-6 {{ $errors->has('sec3_title') ? 'has-error' : '' }}">
                                        <label for="sec3_title">Banner {{ trans('global.homepage.fields.title') }}</label>
                                        <input type="text" id="sec3_title" name="sec3_title" class="form-control" value="{{ old('sec3_title', isset($homepage) ? $homepage->sec3_title : '') }}">
                                        @if($errors->has('sec3_title'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('sec3_title') }}
                                        </em>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('global.homepage.fields.title_helper') }}
                                        </p>
                                    </div>

                                    <div class="form-group col-sm-6 {{ $errors->has('sec3_subtitle') ? 'has-error' : '' }}">
                                        <label for="sec3_subtitle">{{ trans('global.homepage.fields.subtitle') }}</label>
                                        <input type="text" id="sec3_subtitle" name="sec3_subtitle" class="form-control" value="{{ old('sec3_subtitle', isset($homepage) ? $homepage->sec3_subtitle : '') }}">
                                        @if($errors->has('sec3_subtitle'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('sec3_subtitle') }}
                                        </em>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('global.homepage.fields.subtitle_helper') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- banner-->
                            <hr>
                            
                            
                            <div class="form-group row ">
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

@section('scripts')
@parent

@endsection
@endsection