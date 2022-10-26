@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="box-title">About-us Page</h3>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    @if($aboutus)
                    <form action="{{ route("admin.aboutus.update", [$aboutus->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @else
                        <form action="{{ route("admin.aboutus.store") }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @endif
                            
                          
                            <strong style="color: #1863AB;">Section 1</strong>
                            <hr>
                            <div class="row">
                                <div class="col-md-7">

                                    <div class="form-group  {{ $errors->has('sec_one_title') ? 'has-error' : '' }}">
                                        <label for="sec_one_title">{{ trans('global.aboutus.fields.title') }}</label>

                                        <input type="text" id="sec_one_title" name="sec_one_title" class="form-control" value="{{ old('sec_one_title', isset($aboutus) ? $aboutus->sec_one_title : '') }}" placeholder="Page section 1 title" required>
                                        @if ($errors->has('sec_one_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('sec_one_title') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group {{ $errors->has('sec_one_text') ? 'has-error' : '' }}">
                                        <label for="sec_one_text">{{ trans('global.aboutus.fields.description') }}</label>
                                        <textarea id="sec_one_text" name="sec_one_text" class="form-control ">{{ old('sec_one_text', isset($aboutus) ? $aboutus->sec_one_text : '') }}</textarea>
                                        @if($errors->has('sec_one_text'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('sec_one_text') }}
                                        </em>
                                        @endif
                                        <p class="helper-block">
                                            {{ trans('global.aboutus.fields.description_helper') }}
                                        </p>
                                    </div>

                                </div>
                                <div class="col-md-5">
                                    <div class="form-group row">
                                        <label for="sec_one_img">{{ trans('global.aboutus.fields.image') }}</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="sec_one_img" name="sec_one_img">
                                                <label class="custom-file-label" for="sec_one_img">{{ trans('global.choose_file') }}</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="sec_one_img">{{ trans('global.upload') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($aboutus->sec_one_img))
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <img src="/storage/images/banners/{{ $aboutus->sec_one_img }}" width="100%" />
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <hr>
                           
                            <div class="form-group row mb-0">
                                <div class="col-md-2 offset-md-10">
                                    <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
</section>
@endsection