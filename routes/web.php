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

Route::get('/home','HomeController@index')->name('home');
Route::redirect('', '/home',301);

Auth::routes();

/*Route::get('login/github', 'Auth\LoginController@redirectToGitHub')->name('githubLogin');
Route::get('login/github/callback', 'Auth\LoginController@handleGitHubCallback');*/
Route::get('login/facebook', 'Auth\LoginController@redirectToFacebook')->name('facebookLogin');
Route::get('login/facebook/callback', 'Auth\LoginController@handleFacebookCallback');

Route::prefix('badges')->group(function(){
	Route::get('', 'BadgesController@index')->name('allBadges');
	Route::get('create', 'BadgesController@create')->name('createBadge');
	Route::post('', 'BadgesController@store')->name('storeBadge');
	Route::get('{badge}', 'BadgesController@show')->name('showBadge');
	Route::get('{id}/edit', 'BadgesController@edit')->name('editBadge');
	Route::PATCH('{id}', 'BadgesController@update')->name('updateBadge');
	Route::DELETE('{id}/delete', 'BadgesController@destroy')->name('deleteBadge');
});


Route::post('photos/{badge}', 'PhotosController@store')->name('storePhoto');
Route::DELETE('photos/{photo}', 'PhotosController@destroy')->name('deletePhoto');

Route::post('badges/{badge}/comments', 'CommentsController@store')->name('addComment');

Route::post('postajax', 'AjaxController@post');
Route::post('ajaxPhoto', 'AjaxController@changeAvatar');
Route::post('ajaxDeletePhoto', 'AjaxController@deletePhoto');
Route::post('ajaxLike', 'AjaxController@like');
Route::post('ajaxUnlike', 'AjaxController@unLike');

Route::get('/admin/users', 'UserActionsController@index')->name('userStatistics');

Route::get('haris/{id}', 'HarisController');
