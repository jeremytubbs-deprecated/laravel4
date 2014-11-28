<?php

use Acme\Users\User;
use Acme\Users\Groups\Group;

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET admin/users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::with('groups')->get();
		return View::make('admin.users.index', array(
			'users' => $users
		));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$groups = Group::lists('name', 'id');
		return View::make('admin.users.create')->withGroups($groups);
	}

	/**
	 * Admin Store User - user will not have password
	 * POST admin/users/store
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = array(
			'email' => Input::get('email'),
			);
		$rules = array(
			'email' => 'required|email|unique:users'
		);
		$validator = Validator::make($input, $rules);

		if ($validator->passes()) {
			$user = new User;
			$user->email = $input['email'];
			$user->save();

			if (Input::get('group_id') != '0') {
				$user->assignGroup(Input::get('group_id'));
			}

			return Redirect::route('admin.users.index')->with('success', $user->email . ' has been created.');
		}
		$error = $validator->messages();
		return Redirect::back()->with('error', $error);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::with('groups')->where('id', '=', $id)->first();
		$user_groups = [];
		foreach ($user->groups as $group) {
			$user_groups[$group->id] = $group->name;
		}
		$groups = Group::select('name', 'id')->get();
		return View::make('admin.users.edit', array(
			'user' => $user,
			'user_groups' => $user_groups,
			'groups' => $groups
		));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->slug = getSlug(Input::get('first_name') . ' ' . Input::get('last_name'), 'User');
		$user->email = Input::get('email');
		$user->save();

		return Redirect::route('admin.users.index')->with('flash_message', $user->first_name . ' ' . $user->last_name . ' has been updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();
		return Redirect::route('admin.users.index')->with('flash_message', 'User has been deleted.');
	}

	public function assignGroup($id, $group)
	{
		$user = User::find($id);
		$user->assignGroup($group);
		return Redirect::back();
	}

	public function removeGroup($id, $group)
	{
		$user = User::find($id);
		$user->removeGroup($group);
		return Redirect::back();
	}

}