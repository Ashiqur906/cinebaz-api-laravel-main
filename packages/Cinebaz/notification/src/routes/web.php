<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Cinebaz\Notification\Http\Controllers';

Route::namespace($namespace)->prefix('admin')->name('admin.notification.')->middleware(['web', 'auth:web'])->group(function () {
    Route::get('notification', 'NotificationController@index')->name('index');
    Route::get('notification/add', 'NotificationController@create')->name('add');
    Route::post('notification/store', 'NotificationController@store')->name('store');
});
