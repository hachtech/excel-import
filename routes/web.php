<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::resource('excel_import', 'ExcelImportController');
Route::post('import_parse', ['as'=> 'import_parse', 'uses'=>'ExcelImportController@parseImport']);
Route::post('import_process', ['as'=> 'import_process', 'uses'=>'ExcelImportController@processImport']);