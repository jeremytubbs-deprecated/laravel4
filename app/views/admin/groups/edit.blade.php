@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<h1>Edit Group</h1>
		</div>
		<div class="col-md-6">
			{{ Form::open(['method' => 'DELETE', 'route' => ['admin.groups.destroy', $group->id]]) }}
				<button class="btn btn-default btn-xs pull-right" type="submit">Delete Group</button>
			{{ Form::close() }}
		</div>
	</div>
	{{ Form::model($group, ['route' => ['admin.groups.update', $group->id], 'method' => 'PUT', 'role' => 'form']) }}
		<div class="form-group">
			{{ Form::label('Name') }}
			{{ Form::text('name', NULL, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::label('Description') }}
			{{ Form::textarea('description', NULL, ['class' => 'form-control']) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Update', ['class' => 'btn btn-default']) }}
		</div>
	{{ Form::close() }}
</div>
@stop