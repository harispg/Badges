<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Cache;

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/github', 'Auth\LoginController@redirectToGitHub')->name('githubLogin');
Route::get('login/github/callback', 'Auth\LoginController@handleGitHubCallback');
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name('facebookLogin');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::get('badges', 'BadgesController@index')->name('allBadges');
Route::get('badges/create', 'BadgesController@create')->name('createBadge');
Route::post('badges', 'BadgesController@store')->name('storeBadge');
Route::get('badges/{badge}', 'BadgesController@show')->name('showBadge');
Route::get('badges/{id}/edit', 'BadgesController@edit')->name('editBadge');
Route::PATCH('badges/{id}', 'BadgesController@update')->name('updateBadge');
Route::DELETE('badges/{id}/delete', 'BadgesController@destroy')->name('deleteBadge');
Route::post('photos/{badge}', 'PhotosController@store')->name('storePhoto');
Route::DELETE('photos/{photo}', 'PhotosController@destroy')->name('deletePhoto');

Route::post('badges/{badge}/comments', 'CommentsController@store')->name('addComment');

Route::post('postajax', 'AjaxController@post');
Route::post('ajaxPhoto', 'AjaxController@changeAvatar');
Route::post('ajaxDeletePhoto', 'AjaxController@deletePhoto');
Route::post('ajaxLike', 'AjaxController@like');
Route::post('ajaxUnlike', 'AjaxController@unLike');

Route::get('/admin/users', 'UserActionsController@index')->name('userStatistics');