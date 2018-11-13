<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

/*$factory->define(App\Comment::class, function (Faker $faker) {
    return [
    	'user_id' => function(){
    		return factory('App\User')->create()->id;
    	},
        'body' => $faker->sentence,
        
    ];
});*/

$factory->define(App\Photo::class, function (Faker $faker){
   static $broj = 1;

    $path = 'Images/Badges/dummyPics/' . $broj . '.jpg';
    $thumbnail_path = 'Images/Badges/dummyPics/tn-' . $broj . '.jpg';
    $broj++;
    if($broj>20){
        $broj = 1;
    }
    return [
        
        'badge_id' => factory('App\Badge')->create()->id,
        'name' => $faker->word,
        'path' => $path,
        'main_picture' => 1,
        'thumbnail_path' => $thumbnail_path,
    ];
});

$factory->define(App\Badge::class, function (Faker $faker) {

    return [
        'name' => $faker->word,
        'description' => $faker->paragraph,     
    ];
});


