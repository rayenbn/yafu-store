@extends('layouts.admin')
@section('content')
@can('blog_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.blogs.create") }}">
                {{ trans('global.add') }} {{ trans('global.blog.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.blog.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="5%">

                        </th>
                        <th width="40%">
                            {{ trans('global.blog.fields.title') }}
                        </th>
                        <th width="40%">
                            {{ trans('global.blog.fields.description') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $key => $blog)
                        <tr data-entry-id="{{ $blog->id }}">
                            <td>

                            </td>
                            <td >
                                {{ $blog->title ?? '' }}
                            </td>
                            <td>
                                {!! Str::limit($blog->text, 100) ?? '' !!}
                            </td>
                            <td>
                                @can('blog_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.blogs.show', $blog->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('blog_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.blogs.edit', $blog->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('blog_delete')
                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.blogs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('blog_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection