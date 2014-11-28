@extends('layouts.master')

@section('content')
<div class="container">
	<h1>Add User</h1>
	{{ Form::open(array('action' => array('UsersController@store'), 'method' => 'POST', 'role' => 'form')) }}
		<div class="form-group">
			{{ Form::label('Username') }}
			{{ Form::text('username', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('First Name') }}
			{{ Form::text('first_name', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('Last Name') }}
			{{ Form::text('last_name', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('Email') }}
			{{ Form::text('email', NULL, array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('Group') }}
			{{ Form::select('group_id', array_merge(array('0' => 'Please Select'), $groups), '0', array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}

</div>
@stop