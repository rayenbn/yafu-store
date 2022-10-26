@extends('layouts.admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        @can('product_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <!-- <a class="btn btn-success" href="{{ route('admin.type.create') }}">
                        {{ trans('global.add') }} {{ trans('global.type') }}
                    </a> -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#typesModal">
                        {{ trans('global.add') }} {{ trans('global.type') }}
                    </button>
                </div>
            </div>
        @endcan
        <div class="card">
            <div class="card-header">
                {{ trans('global.categories') }} {{ trans('global.list') }}
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <!-- <th width="10">

                                </th> -->
                                <th>
                                    {{ trans('global.type') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($types as $key => $type)
                                <tr >
                                    <td>
                                        {{ $type->name ?? '' }}
                                    </td>
                                    <td>
                                        @can('product_edit')
                                            <a class="btn btn-xs btn-info" href="{{ route('admin.type.edit', $type->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                           
                                        @endcan
                                        @can('product_delete')
                                            <form action="{{ route('admin.type.destroy', $type->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        </div>
    </div>
    <div class="col-md-7">
        @can('product_create')
            <div style="margin-bottom: 10px;" class="row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#variantsModal">
                    {{ trans('global.add') }} {{ trans('global.variant') }}
                    </button>
                </div>
            </div>
        @endcan
        <div class="card">
            <div class="card-header">
                {{ trans('global.variant') }} {{ trans('global.list') }}
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable">
                        <thead>
                            <tr>
                                <!-- <th width="10">

                                </th> -->
                                <th>
                                    {{ trans('global.variant') }}
                                </th>
                                <th>
                                    Price
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($variants as $key => $variant)
                                <tr >
                                    <td>
                                        {{ $variant->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $variant->price ?? '' }}
                                    </td>
                                    <td>
                                        @can('product_edit')
                                            <a class="btn btn-xs btn-info" href="{{ route('admin.variant.edit', $variant->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan
                                        @can('product_delete')
                                            <form action="{{ route('admin.variant.destroy', $variant->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        </div>
    </div>
</div>

<!-- type Modal Add-->
<div class="modal" id="typesModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Type</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('admin.type.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
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
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" >Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- variant Modal Add-->
<div class="modal" id="variantsModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add variant</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <form action="{{ route('admin.variant.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('global.variant') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($variant) ? $variant->name : '') }}">
                @if($errors->has('name'))
                <em class="invalid-feedback">
                    {{ $errors->first('name') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.category_name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('global.product.fields.price') }}*</label>
                <input type="numeric" id="price" name="price" class="form-control" value="{{ old('name', isset($variant) ? $variant->price : '') }}">
                @if($errors->has('price'))
                <em class="invalid-feedback">
                    {{ $errors->first('price') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.price_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                <label>{{ trans('global.type') }}</label>
                <select class="col-form-label select2" name="type" data-placeholder="Select variant type" style="width: 100%;">
                    @foreach ($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                <em class="invalid-feedback">
                    {{ $errors->first('type') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.type_helper') }}
                </p>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success" >Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

@section('scripts')
@parent

@endsection
@endsection