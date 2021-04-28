<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:super_admin|admin'])
    ->name('dashboard.')
    ->prefix('dashboard')
    ->group(function () {
        // welcome routes
        Route::get('/home', 'WelcomeController@index')->name('welcome');

        // categories routes
        Route::resource('categories', 'CategoryController')->except(['destroy', 'show']);
        Route::delete('categories/destroy', 'CategoryController@destroy')->name('categories.destroy');

        // roles routes
        Route::resource('roles', 'RoleController')->except(['destroy', 'show']);
        Route::delete('roles/destroy', 'RoleController@destroy')->name('roles.destroy');

        // users routes
        Route::resource('users', 'UserController')->except(['destroy', 'show']);
        Route::delete('users/destroy', 'UserController@destroy')->name('users.destroy');
        Route::post('get_user_with_name', 'UserController@getUserByRole')->name('users.role');

        //settings routes
        Route::get('settings/social-login', 'settingController@socialLogin')->name('settings.social_login');
        Route::get('settings/social-links', 'settingController@socialLinks')->name('settings.social_links');
        Route::post('settings', 'settingController@store')->name('settings.store');

        //movies routes
        Route::resource('movies', 'MovieController')->except(['destroy']);
        Route::delete('movies/destroy', 'MovieController@destroy')->name('movies.destroy');
    });
