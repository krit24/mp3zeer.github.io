<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', array('before' => 'isLoggedIn', 'uses' => 'AuthController@showPage'));
Route::post('login/submit', array('uses' => 'AuthController@postSubmit'));
Route::post('login/submit', array('uses' => 'AuthController@postSubmit'));
Route::get('logout', array('uses' => 'AuthController@logout'));
Route::get('unsuspend-user/{id}', array('uses' => 'AuthController@getUnsuspend'));
Route::get('json_lang', array('uses' => 'BaseController@getLanguage'));

Route::get('registration-confirmation', array('uses' => 'HomeController@showRegisterConfirmation'));
Route::post('register/submit', array('uses' => 'HomeController@postSubmit'));

Route::get('browse', array('before' => 'isNotLoggedIn', 'uses' => 'HomeController@showBrowse'));
Route::get('album/{permalink}', array('before' => 'isNotLoggedIn', 'uses' => 'HomeController@showAlbumSongLists'));


Route::get('sentry-group-run', array('uses' => 'SentryPermissions@run')); //run the permission for sentry
Route::get('sentry-register', array('uses' => 'SentryPermissions@getRegister')); //run register for sentry.

// Route for all the rest calls
Route::group(array('prefix' => 'rest'), function(){

    Route::post('unique', array('uses' => 'RestController@postUnique'));
    Route::post('register/unique', array('uses' => 'RestController@postUniqueRegUser'));
    Route::post('get-config', array('uses' => 'RestController@postConfig'));

});

Route::get('forgot', array('as' => 'forgot.index', 'uses' => 'HomeController@showForgotPass'));
Route::post('forgot/submit', array('as' => 'forgot.submit', 'uses' => 'HomeController@postForgotPass'));

// Route for all the rest calls
Route::group(array('prefix' => 'rest'), function(){

    Route::post('unique', array('uses' => 'RestController@postUnique'));
    Route::get('albums', array('uses' => 'RestController@getSongsByAlbum'));
    Route::get('albums/songs/{id}', array('uses' => 'RestController@getSongsByAlbumId'));
    Route::get('song/{id}', array('uses' => 'RestController@postSongDetails'));
    Route::post('song/update-count-play/', array('uses' => 'RestController@postUpdatePlayCount'));

});



/****************** Administrator Routes ******************/

// Route for admin
Route::get('admin', array('before' => 'isNotLoggedIn', 'as' => 'admin.dashboard', 'uses' => 'AdminController@showPage'));

//route controller for authentication

Route::group(array('prefix' => 'auth'), function(){

    Route::get('/', array('before' => 'isLoggedIn','uses' => 'AdminController@showLoginPage'));
    Route::post('submit', array('uses' => 'AdminController@postSubmit'));
    Route::get('logout', array('uses' => 'AdminController@logout'));

});

//route controller for artist side

Route::group(array('prefix' => 'admin/artist'), function(){

    Route::get('/', array('as' => 'admin.artist.index', 'before' => 'isNotLoggedIn','uses' => 'ArtistController@showPage'));
    Route::get('add', array('as' => 'admin.artist.add','before' => 'isNotLoggedIn', 'uses' => 'ArtistController@showAddForm'));
    Route::get('edit/{id}', array('as' => 'admin.artist.edit','before' => 'isNotLoggedIn', 'uses' => 'ArtistController@showEditForm'));
    Route::get('delete/{id}', array('as' => 'admin.artist.delete','before' => 'isNotLoggedIn', 'uses' => 'ArtistController@getDelete'));
    Route::post('get-list', array('uses' => 'ArtistController@getLists'));
    Route::post('submit', array('as' => 'admin.artist.submit','before' => 'isNotLoggedIn', 'uses' => 'ArtistController@postSubmit'));

});

//route controller for album side

Route::group(array('prefix' => 'admin/album'), function(){

    Route::get('/', array('as' => 'admin.album.index', 'before' => 'isNotLoggedIn','uses' => 'AlbumController@showPage'));
    Route::get('add', array('as' => 'admin.album.add','before' => 'isNotLoggedIn', 'uses' => 'AlbumController@showAddForm'));
    Route::get('edit/{id}', array('as' => 'admin.album.edit','before' => 'isNotLoggedIn', 'uses' => 'AlbumController@showEditForm'));
    Route::get('delete/{id}', array('as' => 'admin.album.delete','before' => 'isNotLoggedIn', 'uses' => 'AlbumController@getDelete'));
    Route::post('get-list', array('uses' => 'AlbumController@getLists'));
    Route::post('submit', array('as' => 'admin.album.submit','before' => 'isNotLoggedIn', 'uses' => 'AlbumController@postSubmit'));

});

//route controller for genre side

Route::group(array('prefix' => 'admin/genre'), function(){

    Route::get('/', array('as' => 'admin.genre.index', 'before' => 'isNotLoggedIn','uses' => 'GenreController@showPage'));
    Route::get('add', array('as' => 'admin.genre.add','before' => 'isNotLoggedIn', 'uses' => 'GenreController@showAddForm'));
    Route::get('edit/{id}', array('as' => 'admin.genre.edit','before' => 'isNotLoggedIn', 'uses' => 'GenreController@showEditForm'));
    Route::get('delete/{id}', array('as' => 'admin.genre.delete','before' => 'isNotLoggedIn', 'uses' => 'GenreController@getDelete'));
    Route::post('get-list', array('uses' => 'GenreController@getLists'));
    Route::post('submit', array('as' => 'admin.genre.submit','before' => 'isNotLoggedIn', 'uses' => 'GenreController@postSubmit'));

});

//route controller for songs side

Route::group(array('prefix' => 'admin/songs'), function(){

    Route::get('/', array('as' => 'admin.songs.index', 'before' => 'isNotLoggedIn','uses' => 'SongsController@showPage'));
    Route::get('add', array('as' => 'admin.songs.add','before' => 'isNotLoggedIn', 'uses' => 'SongsController@showAddForm'));
    Route::get('edit/{id}', array('as' => 'admin.songs.edit','before' => 'isNotLoggedIn', 'uses' => 'SongsController@showEditForm'));
    Route::get('detail/{id}', array('as' => 'admin.songs.detail','before' => 'isNotLoggedIn', 'uses' => 'SongsController@showDetails'));
    Route::get('album-songs/{artist_id}/{album_id}', array('as' => 'admin.songs.view','before' => 'isNotLoggedIn', 'uses' => 'SongsController@showAlbumSongs'));
    Route::get('delete/{id}', array('as' => 'admin.songs.delete','before' => 'isNotLoggedIn', 'uses' => 'SongsController@getDelete'));
    Route::post('get-list', array('uses' => 'SongsController@getLists'));
    Route::post('get-album-list/{id}', array('uses' => 'SongsController@getAlbumLists'));
    Route::post('sort-songs', array('uses' => 'SongsController@sortSongs'));
    Route::post('submit', array('as' => 'admin.songs.submit','before' => 'isNotLoggedIn', 'uses' => 'SongsController@postSubmit'));

});

//route controller for system users admin side

Route::group(array('prefix' => 'admin/system-users'), function(){

    Route::get('/', array('as' => 'admin.system_user.index', 'before' => 'isNotLoggedIn','uses' => 'SystemUsersController@showPage'));
    Route::get('add', array('as' => 'admin.system_user.add','before' => 'isNotLoggedIn', 'uses' => 'SystemUsersController@showAddForm'));
    Route::get('edit/{id}', array('as' => 'admin.system_user.edit','before' => 'isNotLoggedIn', 'uses' => 'SystemUsersController@showEditForm'));
    Route::get('delete/{id}', array('as' => 'admin.system_user.delete','before' => 'isNotLoggedIn', 'uses' => 'SystemUsersController@getDelete'));
    Route::post('get-list', array('uses' => 'SystemUsersController@getLists'));
    Route::post('submit', array('as' => 'admin.system_user.submit','before' => 'isNotLoggedIn', 'uses' => 'SystemUsersController@postSubmit'));

});