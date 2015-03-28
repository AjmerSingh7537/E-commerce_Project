<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Model::unguard();

		$this->call('UsersTypeTableSeeder');
        Model::unguard();
	}

}

class UsersTypeTableSeeder extends Seeder {

    public function run(){
        DB::table('users_type')->delete();

        DB::table('users_type')->insert([
            ['user_type' => 'regular'],
            ['user_type' => 'admin'],
            ['user_type' => 'banned'],
        ]);
    }
}
