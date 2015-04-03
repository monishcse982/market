<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AdminsTableSeeder extends Seeder {

	public function run()
	{
		$admin = array(
			['name' => 'admin', 'password' => Hash::make('password')]
			);

		DB::table('admins')->insert($admin);
	}

}