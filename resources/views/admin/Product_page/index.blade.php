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
                            <h3 class="box-title">Product Page</h3>
                        </div>
                    </div>
                </div>
               
                <!-- /.box-header -->
                @if($productpage)
                    <form action='{{ route("admin.product-page.update", [$productpage->id]) }}' method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                @else
                    <form action='{{ route("admin.product-page.store") }}' method="POST" enctype="multipart/form-data">
                @csrf
                @endif
                        <div class="card-body" id="english-form">
                            @if(isset($productpage->banner))
                            <div class="form-group row ">
                                <div class="col-md-12">
                                    <img src="/storage/images/banners/{{ $productpage->banner ?? ''}}" width="100%" />
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label for="banner" class="col-md-2 col-form-label ">{{ trans('global.page_banner') }}</label>
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="banner" name="banner">
                                            <label class="custom-file-label" for="banner">{{ trans('global.choose_file') }}</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="banner">{{ trans('global.upload') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group  row{{ $errors->has('page_title') ? 'has-error' : '' }}">
                                <label for="page_title" class="col-md-2 col-form-label ">{{ trans('global.contactus.fields.title') }}</label>
                                <div class="col-md-10">
                                    <input type="text" id="page_title" name="page_title" class="form-control" value="{{ old('page_title', isset($productpage) ? $productpage->page_title : '') }}" placeholder="Page title" required>
                                    @if ($errors->has('page_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('page_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
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