<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::get('restaurant','RestaurantController@index')->name('restaurant.index');
    Route::post('restaurant','RestaurantController@store')->name('restaurant.store');
    Route::get('restaurant/{id}/edit', 'RestaurantController@edit')->name('restaurant.edit');
    Route::post('restaurant/update', 'RestaurantController@update')->name('restaurant.update');
    Route::get('restaurant/{id}/delete', 'RestaurantController@destroy')->name('restaurant.delete');
});
