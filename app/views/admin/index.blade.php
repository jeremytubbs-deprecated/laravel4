@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
	<div id="page-wrapper" ng-class="{'active': toggle}">
		<div id="sidebar-wrapper">
			<ul class="sidebar">
				<li class="sidebar-head">
					<a href="#" ng-click="toggleSidebar()">
						Dashboard
					</a>
				</li>
				<li class="sidebar-list">{{ link_to_route('admin.users.index', 'Site Users')}}</li>
				<li class="sidebar-list">{{ link_to_route('admin.groups.index', 'Manage Groups')}}</li>
			</ul>
		</div>

		<div id="content-wrapper">
			<div class="page-content">
		        Dashboard
			</div>
		</div>
	</div>
@stop