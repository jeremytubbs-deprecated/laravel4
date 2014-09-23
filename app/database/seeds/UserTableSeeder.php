<?php

use Acme\Users\User;
use Acme\Groups\Group;

class UserTableSeeder extends Seeder {

	public function run()
	{

		///create admin role
		$group = Group::create([
			'name' => 'admin'
		]);

		//create admin user
		$user = User::create([
			'password' => 'admin',
			'email'	   => 'admin@admin.com'
		]);

		//Create non admin user
		$user2 = User::create([
			'password' => 'user',
			'email'	   => 'user@user.com'
		]);

		//assign admin role to first user
		$user->assignGroup(1);

	}

}
