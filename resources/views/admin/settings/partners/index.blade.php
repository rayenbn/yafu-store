@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-8">
                    <h3 class="box-title">Partners Logo</h3>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addpartner">
                        Add New Partner
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="card-body">
            <div class="table-responsive" style="overflow-x: inherit;">
                <div class="row">
                @foreach ($partners as $partner)
                <div class="col-md-3 col-sm-12">
                    <img src="/storage/images/partners/{{ $partner->partner_logo }}" width="100%" max-height="190px" />
                    <!-- <form class="row" method="POST" action="{{ route('admin.partners.destroy', ['id' => $partner->id]) }}" onsubmit="return confirm('确定删除？')">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('admin.partners.edit', ['id' => $partner->id]) }}" class="btn btn-info col-sm-3 col-xs-5 btn-margin">
                            edit
                        </a>
                        <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                            Delete
                        </button>
                    </form> -->
                    <button type="button" name="deleteimage" data-image-id="{{$partner->id}}" id="deleteimage" class="btn btn-danger"><i class="fa fa-trash" style="color: white"></i></button>
                </div>
                @endforeach
                </div>
            </div>
        </div>

        <!-- /.box-body -->
    </div>
</section>

<!-- ADD Modal -->
<div class="modal fade" id="addpartner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Add new Partner Logo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="partner_logo" class="col-md-4 col-form-label ">Partner Logo</label>
                        <div class="col-md-8">
                            <div class="input-group">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="partner_logo" name="partner_logo">
                                    <label class="custom-file-label" for="partner_logo">{{ trans('global.choose_file') }}</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="partner_logo">{{ trans('global.upload') }}</span>
                                </div>
                            </div>
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
@section('scripts')
@parent
<script>
    $(document).on('click', '#deleteimage', function() {
        var imageid = $(this).data('image-id');
        if (confirm('{{ trans('global.areYouSure ') }}')) {
            $.ajax({
                headers: {
                    'x-csrf-token': _token
                },
                method: 'DELETE',
                url: "/admin/partners/" + imageid,
            }).done(function() {
                location.reload()
            })
        }
    });
</script>
@endsection
@endsection