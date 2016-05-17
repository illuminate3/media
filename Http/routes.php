<?php

/*
|--------------------------------------------------------------------------
| Origami
|--------------------------------------------------------------------------
*/

// Route::pattern('news', '[0-9a-z]+');

// Resources
// Controllers

Route::group(['prefix' => 'filex'], function() {
	Route::get('welcome', [
		'uses'=>'FilexController@welcome'
	]);
});


// API

//Route::group(['prefix' => 'api'], function() {
//});


$router->bind('media', function ($id) {
    return app(\App\Modules\Media\Http\Repositories\FileRepository::class)->find($id);
});


Route::group(['prefix' => 'admin'], function() {

// API

	Route::post('api/file', [
		'uses' => 'Api\MediaController@store',
		'as' => 'admin.api.media.store'
		]);

	Route::post('api/media/link', [
		'uses' => 'Api\MediaController@linkMedia',
		'as' => 'admin.api.media.link'
		]);
	Route::post('api/media/unlink', [
		'uses' => 'Api\MediaController@unlinkMedia',
		'as' => 'admin.api.media.unlink'
		]);
	Route::get('api/media/all', [
		'uses' => 'Api\MediaController@all',
		'as' => 'admin.api.media.all'
		]);
	Route::post('api/media/sort', [
		'uses' => 'Api\MediaController@sortMedia',
		'as' => 'admin.api.media.sort'
		]);

// Controllers

	Route::get('media', [
		'as' => 'admin.media.index',
		'uses' => 'MediaController@index'
		]);

	Route::get('media/create', ['as' => 'admin.media.create', 'uses' => 'MediaController@create']);
	Route::post('media', ['as' => 'admin.media.store', 'uses' => 'MediaController@store']);

	Route::get('media/{media}/edit', [
		'as' => 'admin.media.edit',
		'uses' => 'MediaController@edit'
		]);
	Route::put('media/{media}', [
		'as' => 'admin.media.update',
		'uses' => 'MediaController@update'
		]);
	Route::delete('media/{media}', [
		'as' => 'admin.media.destroy',
		'uses' => 'MediaController@destroy'
		]);

	Route::get('media-grid/index', ['uses' => 'MediaGridController@index', 'as' => 'media.grid.select']);
	Route::get('media-grid/ckIndex', ['uses' => 'MediaGridController@ckIndex', 'as' => 'media.grid.ckeditor']);

});
