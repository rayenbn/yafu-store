@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('global.blog.title') }}
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>
                        {{ trans('global.blog.fields.image') }}
                    </th>
                    <td>
                    <img src="/storage/blogs/thumbnail/{{ $blog->picture }}" width="100px"/>
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.blog.fields.title') }}
                    </th>
                    <td>
                        {{ $blog->title }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('global.blog.fields.description') }}
                    </th>
                    <td>
                        {!! $blog->description !!}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection