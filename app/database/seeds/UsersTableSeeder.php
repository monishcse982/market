<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		$user = array(
			['username' => 'monish', 'password' => Hash::make('monish'), 'remember_token' => 0]
			);

		DB::table('Users')->insert($user);
	}

}