@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <strong>Gallery</strong>
        <small>images uplod</small>
    </div>
    <div class="card-body">
        <br />
        <form method="post" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label class="col-md-3 col-form-label" for="file-multiple-input">Upload Images</label>
                <div class="col-md-6">
                    <input type="file" name="file[]" id="file" accept="image/*" multiple />
                </div>
                <div>
                    <input class="btn btn-success" name="upload" type="submit" value="{{ trans('global.save') }}">
                </div>
            </div>
        </form>
        <br />
        <div class="progress mb-3">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 0%" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">
                0%
            </div>
        </div>
        <br />
        <div id="success" class="row">

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
$(document).ready(function(){
    $('form').ajaxForm({
        beforeSend:function(){
            $('#success').empty();
            $('.progress-bar').text('0%');
            $('.progress-bar').css('width', '0%');
        },
        uploadProgress:function(event, position, total, percentComplete){
            $('.progress-bar').text(percentComplete + '0%');
            $('.progress-bar').css('width', percentComplete + '0%');
        },
        success:function(data)
        {
            if(data.success)
            {
                $('#success').html('<div class="text-success text-center"><b>'+data.success+'</b></div><br/><br/>');
                $('#success').append(data.image);
                $('.progress-bar').text('Uploaded');
                $('.progress-bar').css('width', '100%');
            }
        }
    });
});
</script>
@endsection
@endsection