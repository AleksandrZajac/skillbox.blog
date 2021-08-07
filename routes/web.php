<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\ContactsController;

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

Route::get('/about', function () {
    return view('about');
});
Route::get('/', [ArticlesController::class, 'index']);
Route::post('/', [ArticlesController::class, 'store']);
Route::get('/articles/create', [ArticlesController::class, 'create']);
Route::get('/articles/{slug}', [ArticlesController::class, 'show']);
Route::get('/contacts', [ContactsController::class, 'create']);
Route::post('/contacts', [ContactsController::class, 'store']);
Route::get('/admin/feedback', [ContactsController::class, 'index']);
