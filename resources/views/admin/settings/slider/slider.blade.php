@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="box-title">Home Sliders</h3>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addslider">
                        Add New Slider
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable">
                    <thead>
                        <tr role="row">
                            <th width="10">

                            </th>
                            <th>
                                Slider Image
                            </th>
                            <th>
                                Title
                            </th>
                            <th>
                                Sub-title
                            </th>

                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                        <tr data-entry-id="{{ $slider->id }}">
                            <td>

                            </td>
                            <td><img src="/storage/sliders/{{ $slider->picture }}" width="450px" height="auto" /></td>
                            <td>{{ $slider->title ?? ''}}</td>
                            <td>{{ $slider->subtitle ?? ''}}</td>
                            <td>
                                @can('product_edit')
                                <a class="btn btn-xs btn-info" href="{{ route('admin.slider.edit', $slider->id) }}">
                                    {{ trans('global.edit') }}
                                </a>
                                @endcan
                                @can('product_delete')
                                <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- /.box-body -->
    </div>
</section>

<!-- ADD Modal -->
<div class="modal fade" id="addslider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Add new slider Image</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
           
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body" id="english-form">
                    <div class="form-group" >
                        <label for="avatar" class="col-md-2 control-label">Image</label>
                        <div class="col-md-6">
                            <input type="file" id="picture" name="picture">
                            <h5 style="color: red">Size: 1555*375px</h5>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-6 control-label">Title</label>
                        <div class="col-md-10">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}">

                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('subtitle') ? ' has-error' : '' }}">
                        <label for="subtitle" class="col-md-6 control-label">Sub-Title</label>
                        <div class="col-md-10">
                            <input id="subtitle" type="text" class="form-control" name="subtitle" value="{{ old('subtitle') }}">
                            @if ($errors->has('subtitle'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subtitle') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                        <label for="link" class="col-md-6 control-label">Link</label>
                        <div class="col-md-10">
                            <input id="link" type="text" class="form-control" name="link" value="{{ old('link') }}">
                            @if ($errors->has('link'))
                            <span class="help-block">
                                <strong>{{ $errors->first('link') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection