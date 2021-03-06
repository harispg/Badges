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
Route::get('/contact', function(){
	return view('contact');
});

Auth::routes();

Auth::routes(['verify' => true]);

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
Route::post('ajaxLike', 'AjaxController@likeUnlike');
Route::post('ajaxSelected', 'AjaxController@selected');
Route::post('selectedBadges', 'AjaxController@selectedBadges');
//Route::post('ajaxUnlike', 'AjaxController@unLike');

Route::get('/admin/users', 'UserActionsController@index')->name('userStatistics');

Route::get('haris/{id}', 'HarisController')->name('testiranje')/*->middleware('verified')*/;

Route::get('test', function(){ 
	/*$photo = App\Photo::find(1);
	\Storage::disk('public')->put('harisKruska.jpeg', \Storage::get('kruska.jpeg'));*/
	return class_uses_recursive(App\Http\Controllers\Auth\RegisterController::class);
	//return storage_path('app/public');
});

Route::post('tags','TagsController@store')->name('tagStore');
Route::get('badges/tags/{tag}', 'TagsController@index')->name('indexTaged');
Route::post('tags/{badge}', 'TagsController@store');

Route::post('items','OrderItemsController@store' );
