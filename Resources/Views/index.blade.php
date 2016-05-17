@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.setting', 2) }} :: @parent
@stop

@section('styles')
	<link href="{{ asset('assets/vendors/DataTables-1.10.7/plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendors/DataTables-1.10.7/plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('assets/vendors/dropzone-4.3.0/dist/min/dropzone.min.css') }}" rel="stylesheet">

<style>
.dropzone {
    border: 1px dashed #CCC;
    min-height: 227px;
    margin-bottom: 20px;
}
</style>

@stop

@section('scripts')
	<script src="{{ asset('assets/vendors/DataTables-1.10.7/media/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/vendors/DataTables-1.10.7/plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }}"></script>

	<script src="{{ asset('assets/vendors/dropzone-4.3.0/dist/min/dropzone.min.js') }}"></script>
	<script src="{{ asset('assets/modules/media/js/init-dropzone.js') }}"></script>
@stop

@section('inline-scripts')
$(document).ready(function() {
oTable =
	$('#table').DataTable({
		stateSave: true,
		'pageLength': 25
	});
});

<?php $config = config('asgard.media.config'); ?>
<script>
    var maxFilesize = '<?php echo $config['max-file-size'] ?>',
            acceptedFiles = '<?php echo $config['allowed-types'] ?>';
</script>

@stop



{{-- Content --}}
@section('content')


<h1>
    {{ trans('media::media.title.media') }}
</h1>
<ol class="breadcrumb">
    <li><a href="/"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
    <li><i class="fa fa-camera"></i> {{ trans('media::media.breadcrumb.media') }}</li>
</ol>


<div class="row">
    <div class="col-md-12">
        <form method="POST" class="dropzone">
            {!! Form::token() !!}
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <table class="data-table table table-bordered table-hover jsFileList">
                    <thead>
                        <tr>
                            <th>{{ trans('core::core.table.thumbnail') }}</th>
                            <th>{{ trans('media::media.table.filename') }}</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($files): ?>
                            <?php foreach ($files as $file): ?>
                                <tr>
                                    <td>
                                        <?php if ($file->isImage()): ?>
                                            <img src="{{ Imagy::getThumbnail($file->path, 'smallThumb') }}" alt=""/>
                                        <?php else: ?>
                                            <i class="fa fa-file" style="font-size: 20px;"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.media.media.edit', [$file->id]) }}">
                                            {{ $file->filename }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.media.media.edit', [$file->id]) }}">
                                            {{ $file->created_at }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.media.media.edit', [$file->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                            <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.media.media.destroy', [$file->id]) }}"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>{{ trans('core::core.table.thumbnail') }}</th>
                            <th>{{ trans('media::media.table.filename') }}</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th>{{ trans('core::core.table.actions') }}</th>
                        </tr>
                    </tfoot>
                </table>
            <!-- /.box-body -->
            </div>
        </div>
    </div>
</div>

@include('media.partials.delete-modal')

@stop
