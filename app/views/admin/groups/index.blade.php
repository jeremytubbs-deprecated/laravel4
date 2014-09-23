@extends('layouts.master')

@section('content')
<div class="container">
	<h1>Manage Groups</h1>
	<table class="table">
		<thead>
			<tr>
				<th>Group</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($groups as $group)
			<tr>
				<td>{{ $group->name }}</td>
				<td>{{ $group->description }}</td>
				<td>
					@if (! Auth::guest() && Auth::user()->hasGroup('admin'))
					<a href="{{ URL::route('admin.groups.edit', $group->id) }}">Edit</a>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	@if (! Auth::guest() && Auth::user()->hasGroup('admin'))
		<a class="btn btn-default" href="{{ URL::route('admin.groups.create') }}">Add Group</a>
	@endif
</div>
@stop