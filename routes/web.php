<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentControlle;

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

Route::get('students', [StudentControlle::class, 'index'] );
Route::post('students', [StudentControlle::class, 'insert'] );
Route::get('fetch_data', [StudentControlle::class, 'fetch'] );
Route::get('fetch_dataedit/{id}', [StudentControlle::class, 'edit'] );
Route::put('update-student', [StudentControlle::class, 'update'] );
Route::delete('delete-student/{id}', [StudentControlle::class, 'Delete'] );

Route::get('/', function () {
    return view('welcome');
});
