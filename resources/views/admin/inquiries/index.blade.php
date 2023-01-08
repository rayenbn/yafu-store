@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Inquiries {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('global.product.fields.name') }}
                        </th>
                        <th>
                            {{ trans('global.user.fields.email') }}
                        </th>
                        <th>
                            Type
                        </th>
                        <th>
                            Submited date
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inquiries as $key => $inquiry)
                        <tr data-entry-id="{{ $inquiry->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $inquiry->name ?? '' }}
                            </td>
                            <td>
                                {{ $inquiry->email ?? '' }}
                            </td>
                            <td>
                                <span class="badge badge-info">
                                    {{ $inquiry->getTable() == 'company_inquiries' ? "Company" : "Private" }}
                                </span>
                            </td>
                            <td>
                                {{ $inquiry->created_at->diffForHumans() }}
                            </td>
                            <td>
                                @can('inquiries_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.inquiries.show', [$inquiry->id, $inquiry->getTable()]) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('inquiries_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.inquiries.edit', $inquiry->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('inquiries_delete')
                                    <form action="{{ route('admin.inquiries.destroy', $inquiry->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@section('scripts')
@parent

@endsection
@endsection