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

post('file', ['uses' => 'MediaController@store', 'as' => 'api.media.store']);
post('media/link', ['uses' => 'MediaController@linkMedia', 'as' => 'api.media.link']);
post('media/unlink', ['uses' => 'MediaController@unlinkMedia', 'as' => 'api.media.unlink']);
get('media/all', ['uses' => 'MediaController@all', 'as' => 'api.media.all', ]);
post('media/sort', ['uses' => 'MediaController@sortMedia', 'as' => 'api.media.sort']);


$router->bind('media', function ($id) {
    return app(\App\Modules\Media\Http\Repositories\FileRepository::class)->find($id);
});

Route::group(['prefix' => 'admin'], function() {

	Route::get('media', ['as' => 'admin.media.media.index', 'uses' => 'MediaController@index']);
	Route::get('media/create', ['as' => 'admin.media.media.create', 'uses' => 'MediaController@create']);
	Route::post('media', ['as' => 'admin.media.media.store', 'uses' => 'MediaController@store']);
	Route::get('media/{media}/edit', ['as' => 'admin.media.media.edit', 'uses' => 'MediaController@edit']);
	Route::put('media/{media}', ['as' => 'admin.media.media.update', 'uses' => 'MediaController@update']);
	Route::delete('media/{media}', ['as' => 'admin.media.media.destroy', 'uses' => 'MediaController@destroy']);

	Route::get('media-grid/index', ['uses' => 'MediaGridController@index', 'as' => 'media.grid.select']);
	Route::get('media-grid/ckIndex', ['uses' => 'MediaGridController@ckIndex', 'as' => 'media.grid.ckeditor']);

});

