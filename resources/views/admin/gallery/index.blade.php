@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-8">
                <h3 class="box-title">Page Banner</h3>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="card-body">
        @if($gallerypage)
          <form action="{{ route('admin.gallery-page.update', [$gallerypage->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
        @else
         <form action="{{ route('admin.gallery-page.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @endif
                <div class="table-responsive" style="overflow-x: inherit;">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <div class="form-group  row{{ $errors->has('page_title') ? 'has-error' : '' }}">
                                <label for="page_title" class="col-md-2 col-form-label ">{{ trans('global.contactus.fields.title') }}</label>
                                <div class="col-md-10">
                                    <input type="text" id="page_title" name="page_title" class="form-control" value="{{ old('page_title', isset($gallerypage) ? $gallerypage->page_title : '') }}" placeholder="Page title" required>
                                    @if ($errors->has('page_title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('page_title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="banner" class="col-md-2 col-form-label ">{{ trans('global.aboutus.fields.banner') }}</label>
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
                            @if(isset($gallerypage->banner))
                            <div class="form-group row ">
                                <div class="col-md-12">
                                    <img src="/storage/images/banners/{{ $gallerypage->banner }}" width="100%" />
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-2 offset-md-10">
                        <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">
                    </div>
                </div>
            </form>

    </div>
</div>
@can('product_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.gallery.create") }}">
            {{ trans('global.add') }} {{ trans('global.photo') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.photo') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <tbody>
                    <div style="display: flex;flex-wrap: wrap;">
                        @foreach($galleries as $key => $gallery)
                        <div class="col-md-3 col-sm-12 ">
                            <img src="../storage/gallery/thumbnail/{{ $gallery->picture }}" class="img-thumbnail" />
                            @can('product_delete')
                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan
                        </div>
                        @endforeach
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection