<?php

use Illuminate\Support\Facades\Route;

$namespace = 'Cinebaz\Page\Http\Controllers';

Route::namespace($namespace)->prefix('admin')->name('admin.page.')->middleware(['web', 'auth:web'])->group(function () {
    Route::get('pages', 'PageController@index')->name('all');
    Route::get('page/add', 'PageController@add')->name('add');
    Route::get('page/{id}/edit', 'PageController@edit')->name('edit');
    Route::post('page/save', 'PageController@store')->name('store');
});

Route::namespace($namespace)->middleware(['web', 'auth:web'])->group(function () {
    Route::get('getslug', 'PageController@getslug')->name('getslug');
});
Route::namespace($namespace)->middleware(['web'])->group(function () {
    Route::get('page/{slug}', 'PageController@webview')->name('webview');
});


// Route::get('admin/page', function () {
//     return " wow your model working";
// });
