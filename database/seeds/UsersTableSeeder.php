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
        	'superAdmin' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ],
        [
        	'name' => 'Ivana',
        	'email' => 'ivana@example.com',
        	'password' => bcrypt('password'),
        	'superAdmin' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'email_verified_at' => Carbon::now(),
        ]
    ]);

        factory('App\Photo', 20)->create();
    }
}
