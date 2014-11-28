<?php

use Acme\Users\Groups\Group;

class GroupsController extends \BaseController {

    /**
     * Constructor
     *
     */
    function __construct()
    {
        $this->beforeFilter('admin');
    }



	/**
	 * Display a listing of the resource.
	 * GET /groups
	 *
	 * @return Response
	 */
	public function index()
	{
		$groups = Group::all();
		return View::make('admin.groups.index')->with('groups', $groups);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /groups/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.groups.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /groups
	 *
	 * @return Response
	 */
	public function store()
	{
		$group = new Group();
		$group->name = Input::get('name');
		$group->description = Input::get('description');
		$group->save();

		return Redirect::route('admin.groups.index')->with('flash_message', $group->name . ' has been created.');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /groups/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$group = Group::where('id', '=', $id)->first();
		return View::make('admin.groups.edit')->with('group', $group);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /groups/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$group = Group::find($id);
		$group->name = Input::get('name');
		$group->description = Input::get('description');
		$group->save();

		return Redirect::route('admin.groups.index')->with('flash_message', $group->name . ' has been updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /groups/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$group = Group::find($id);
		$group->delete();
		return Redirect::route('admin.groups.index')->with('flash_message', 'Group has been deleted.');
	}

}