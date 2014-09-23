@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<h1>Site Users</h1>
		<table class="table">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Groups</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->first_name }}</td>
					<td>{{ $user->last_name }}</td>
					<td>{{ $user->email }}</td>
					<td>
						@foreach ($user->groups as $group)
							@if ($group->name)
								{{ $group->name . ' ' }}
							@endif
						@endforeach
					</td>
					<td>
						@if (! Auth::guest() && Auth::user()->hasGroup('admin'))
						<a href="{{ URL::route('admin.users.edit', $user->id) }}">Edit</a>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@if (! Auth::guest() && Auth::user()->hasGroup('admin'))
		<a class="btn btn-default" href="{{ URL::route('admin.users.create') }}">Add User</a>
		@endif
	</div>
</div>
@stop