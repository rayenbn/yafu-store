@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">

    @if($footer)
    <form action='{{ route("admin.footer.update", [$footer->id]) }}' method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    @else
        <form action='{{ route("admin.footer.store") }}' method="POST" enctype="multipart/form-data">
        @csrf
    @endif

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-8">
                            <h3 class="box-title">Footer</h3>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x: inherit;">
                        <div class="row">
                           
                            <div class="col-md-6 border-right">
                                <strong style="color: #1863AB;">Social media info</strong>
                                <div class="form-group  row {{ $errors->has('fb') ? 'has-error' : '' }}">
                                    <label class="col-md-2 col-form-label" for="fb"><i class="fab fa-facebook"></i></label>
                                    <div class="col-md-10">
                                        <input type="text" id="fb" name="fb" class="form-control" value="{{ old('fb', isset($footer) ? $footer->fb : '') }}" placeholder="http://">
                                        @if ($errors->has('fb'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('fb') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  row {{ $errors->has('twitter') ? 'has-error' : '' }}">
                                    <label class="col-md-2 col-form-label" for="twitter"><i class="fab fa-twitter"></i></label>
                                    <div class="col-md-10">
                                        <input type="text" id="twitter" name="twitter" class="form-control" value="{{ old('twitter', isset($footer) ? $footer->twitter : '') }}" placeholder="http://">
                                        @if ($errors->has('twitter'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('twitter') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  row {{ $errors->has('ig') ? 'has-error' : '' }}">
                                    <label class="col-md-2 col-form-label" for="ig"><i class="fab fa-instagram" aria-hidden="true"></i>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" id="ig" name="ig" class="form-control" value="{{ old('ig', isset($footer) ? $footer->ig : '') }}" placeholder="http://">
                                        @if ($errors->has('ig'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ig') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group  row {{ $errors->has('youtube') ? 'has-error' : '' }}">
                                    <label class="col-md-2 col-form-label" for="youtube"><i class="fab fa-youtube" aria-hidden="true"></i>
                                    </label>
                                    <div class="col-md-10">
                                        <input type="text" id="youtube" name="youtube" class="form-control" value="{{ old('youtube', isset($footer) ? $footer->youtube : '') }}" placeholder="http://">
                                        @if ($errors->has('youtube'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('youtube') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 border-right">
                                <strong style="color: #1863AB;">General Info's</strong>
                                <div class="form-group  row {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label class="col-md-2 col-form-label" for="address">Address</label>
                                    <div class="col-md-10">
                                        <textarea type="text" id="address" name="address" class="form-control">{{ old('address', isset($footer) ? $footer->address : '') }}</textarea>
                                        @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
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