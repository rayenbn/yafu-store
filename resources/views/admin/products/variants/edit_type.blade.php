@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                {{ trans('global.edit') }} {{ trans('global.category') }}
            </div>

            <form action="{{ route('admin.type.update', [$type->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
               
                    <div class="form-group col-md-8 {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">{{ trans('global.type') }}*</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($type) ? $type->name : '') }}">
                        @if($errors->has('name'))
                        <em class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.category_name_helper') }}
                        </p>
                    </div>
                    <br>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
@parent
@endsection
@endsection