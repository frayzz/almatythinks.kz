<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now post something great!
|
*/

Route::group(['namespace' => 'Main'], function () {
    Route::get('/', 'IndexController');
});

Route::group(['namespace' => 'Personal', 'prefix' => 'personal', 'middleware' => ['auth', 'verified']], function() {
    Route::group(['namespace' => 'Main', 'prefix' => 'main'], function () {
        Route::get('/', 'IndexController')->name('personal.main.index');
    });

    Route::group(['namespace' => 'Liked', 'prefix' => 'liked'], function () {
        Route::get('/', 'IndexController')->name('personal.liked.index');
        Route::delete('/{post}', 'DeleteController')->name('personal.liked.delete');
    });

    Route::group(['namespace' => 'Comment', 'prefix' => 'comment'], function () {
        Route::get('/', 'IndexController')->name('personal.comment.index');
        Route::get('/{comment}/edit', 'EditController')->name('personal.comment.edit');
        Route::patch('/{comment}', 'UpdateController') -> name('personal.comment.update');
    });

    Route::group(['namespace' => 'Create', 'prefix' => 'create'], function () {
        Route::get('/', 'IndexController')->name('personal.create.index');
        Route::post('/', 'StoreController') -> name('personal.create.store');
        Route::get('/', 'CreateController')->name('personal.create.create');
    });

});

Route::group(['namespace' => 'Post', 'prefix' => 'posts'], function () {
    Route::get('/', 'IndexController')->name('post.index');
    Route::group(['namespace' => 'Like', 'prefix' => '{post}/likes'], function() {
        Route::post('/', 'StoreController')->name('post.like.store');
    });

    Route::group(['namespace' => 'Comment', 'prefix' => '{post}/comments'], function() {
        Route::get('/', 'CommentController@show')->name('post.comments.show');
    });
    Route::group(['namespace' => 'Comment', 'prefix' => '{post}/comments'], function() {
        Route::post('/', 'CommentController@store')->name('post.comments.store');
    });

});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin', 'verified']], function(){
    Route::group(['namespace' => 'Main'], function () {
        Route::get('/', 'IndexController')->name('admin.main.index');
    });

    Route::group(['namespace' => 'Post', 'prefix' => 'post'], function () {
        Route::get('/', 'IndexController') -> name('admin.post.index');
        Route::get('/post', 'CreateController') -> name('admin.post.post');
        Route::post('/', 'StoreController') -> name('admin.post.store');
        Route::get('/{post}', 'ShowController') -> name('admin.post.show');
        Route::get('/{post}/edit', 'EditController') -> name('admin.post.edit');
        Route::patch('/{post}', 'UpdateController') -> name('admin.post.update');
        Route::patch('/{post}', 'PublicateController') -> name('admin.post.publicate');
        Route::delete('/{post}', 'DeleteController') -> name('admin.post.delete');


    });

    Route::group(['namespace' => 'Category', 'prefix' => 'category'], function () {
        Route::get('/', 'IndexController') -> name('admin.category.index');
        Route::get('/post', 'CreateController') -> name('admin.category.post');
        Route::post('/', 'StoreController') -> name('admin.category.store');
        Route::get('/{category}', 'ShowController') -> name('admin.category.show');
        Route::get('/{category}/edit', 'EditController') -> name('admin.category.edit');
        Route::patch('/{category}', 'UpdateController') -> name('admin.category.update');
        Route::delete('/{category}', 'DeleteController') -> name('admin.category.delete');
    });

    Route::group(['namespace' => 'Tag', 'prefix' => 'tags'], function () {
        Route::get('/', 'IndexController') -> name('admin.tag.index');
        Route::get('/post', 'CreateController') -> name('admin.tag.post');
        Route::post('/', 'StoreController') -> name('admin.tag.store');
        Route::get('/{tag}', 'ShowController') -> name('admin.tag.show');
        Route::get('/{tag}/edit', 'EditController') -> name('admin.tag.edit');
        Route::patch('/{tag}', 'UpdateController') -> name('admin.tag.update');
        Route::delete('/{tag}', 'DeleteController') -> name('admin.tag.delete');
    });

    Route::group(['namespace' => 'User', 'prefix' => 'users'], function () {
        Route::get('/', 'IndexController') -> name('admin.user.index');
        Route::get('/post', 'CreateController') -> name('admin.user.post');
        Route::post('/', 'StoreController') -> name('admin.user.store');
        Route::get('/{user}', 'ShowController') -> name('admin.user.show');
        Route::get('/{user}/edit', 'EditController') -> name('admin.user.edit');
        Route::patch('/{user}', 'UpdateController') -> name('admin.user.update');
        Route::delete('/{user}', 'DeleteController') -> name('admin.user.delete');
    });
});

Auth::routes(['verify' => true]);
