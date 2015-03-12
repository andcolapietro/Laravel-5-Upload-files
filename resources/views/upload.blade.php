<div class="panel-heading">
	<h1>Uploads</h1>
</div>

@if(Session::has('success_message'))
    <div class="alert alert-success" role="alert">
        <strong>{!!  Session::get('success_message') !!}</strong>
    </div>
@endif

<br><br>

<div class="panel-body">
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems uploading the pictures.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	{!! Form::open(['route' => 'upload', 'class' => 'form-horizontal', 'files'=>true]) !!}
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<label class="col-md-4 control-label">Upload</label><br><br>
			<div class="col-md-6">
				{!! Form::file('images[]', ['multiple' => true]) !!}
			</div>
		</div>

		<br><br>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				 {!! Form::submit('Upload', array('class' => 'btn btn-sm btn-success') ) !!}
			</div>
		</div>
	{!! Form::close() !!}
</div>


