<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
        	'name' => 'Haris',
        	'email' => 'haris@example.com',
        	'password' => bcrypt('password'),
        	'superAdmin' => true
        ],
        [
        	'name' => 'Ivana',
        	'email' => 'ivana@example.com',
        	'password' => bcrypt('password'),
        	'superAdmin' => false
        ]
    ]);

        factory('App\Photo', 20)->create();
    }
}
