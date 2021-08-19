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
Route::get('/', [ArticlesController::class, 'index'])->name('articles.index');
Route::post('/', [ArticlesController::class, 'store'])->name('articles.store');
Route::get('/articles/create', [ArticlesController::class, 'create'])->name('articles.create');
Route::get('/articles/{slug}', [ArticlesController::class, 'show'])->name('articles.show');
Route::patch('/articles/{slug}', [ArticlesController::class, 'update'])->name('articles.update');
Route::get('/articles/{slug}/edit', [ArticlesController::class, 'edit'])->name('articles.edit');
Route::delete('/articles/{slug}', [ArticlesController::class, 'delete'])->name('articles.delete');
// Route::resource('/articles', 'App\Http\Controllers\ArticlesController');
Route::get('/contacts', [ContactsController::class, 'create']);
Route::post('/contacts', [ContactsController::class, 'store']);
Route::get('/admin/feedback', [ContactsController::class, 'index']);
