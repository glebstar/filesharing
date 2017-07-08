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

Route::get('/', 'FileController@index');
Route::get('/{id}.html', 'FileController@file');
Route::get('/download/{id}', 'FileController@download');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/aaa', function () {
    $file = new SplFileObject(storage_path() . '/app/ips.txt');
    $file->setFlags(SplFileObject::READ_CSV);
    foreach ($file as $row) {
        var_dump($row);
    }
});
