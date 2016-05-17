@extends($theme_back)


{{-- Web site Title --}}
@section('title')
{{ Lang::choice('kotoba::cms.image', 2) }} :: @parent
@stop

@section('styles')
	<link href="{{ asset('assets/vendors/DataTables-1.10.7/plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendors/DataTables-1.10.7/plugins/integration/bootstrap/3/dataTables.bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('assets/vendors/dropzone-4.3.0/dist/min/dropzone.min.css') }}" rel="stylesheet">
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


var Asgard = {
	backendUrl: 'admin',
	mediaGridCkEditor : '{{ route('media.grid.ckeditor') }}',
	dropzonePostUrl : '{{ route('admin.api.media.store') }}',
	maxFilesize : '{{ $max_file_size }}',
	acceptedFiles : '{{ $allowed_types }}'
};

@stop



{{-- Content --}}
@section('content')


<div class="row">
<h1>
	<i class="fa fa-camera fa-lg"></i>
		{{ Lang::choice('kotoba::cms.image', 2) }}
	<hr>
</h1>
</div>


<div class="row">
<div class="col-sm-12">

	<form method="POST" class="dropzone">
		{!! Form::token() !!}
	</form>

</div>
</div>


<hr>


@if (count($files))


<div class="row">
<div class="col-sm-12">

{{--
	<table class="data-table table table-bordered table-hover jsFileList">
--}}
	<table id="table" class="table table-striped table-hover">
		<thead>
			<tr>
				<th>{{ Lang::choice('kotoba::table.image', 1) }}</th>
				<th>{{ trans('kotoba::table.filename') }}</th>
				<th>{{ trans('kotoba::table.created_at') }}</th>

				<th>{{ Lang::choice('kotoba::table.action', 2) }}</th>
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
	</table>

</div>
</div>


@else
<div class="alert alert-info">
</div>
	{{ trans('kotoba::general.error.not_found') }}
@endif

{{--
@include('media::partials.delete-modal')
--}}

@stop
