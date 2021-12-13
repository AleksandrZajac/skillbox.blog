<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerArticleController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\NewsController;

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

Route::get('/articles/tags/{tag}', [TagController::class, 'indexArticles'])->name('articles.tags.index');
Route::get('/news/tags/{tag}', [TagController::class, 'indexNews'])->name('news.tags.index');

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::post('/', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::patch('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

Route::get('/contacts', [ContactsController::class, 'create']);
Route::post('/contacts', [ContactsController::class, 'store']);

Route::get('/admin/feedback', [ContactsController::class, 'index']);
Route::get('/admin/articles', [AdminController::class, 'index'])->name('admin.articles.index');
Route::get('/admin/articles/{article}/edit', [ArticleController::class, 'edit'])->name('admin.articles.edit');
Route::get('/admin/articles/{article}/history', [AdminController::class, 'history'])->name('admin.articles.history');
Route::get('/admin/portal/statistics', [AdminController::class, 'portalStatistics'])->name('admin.portal.statistics');

Route::get('/owner/articles', [OwnerArticleController::class, 'index'])->name('owner.articles.index');

Route::post('/articles/{article}/comments', [CommentsController::class, 'storeArticleComment'])->name('article.comments.store');
Route::get('/{article}/article/comments/create', [CommentsController::class, 'createArticleComment'])->name('article.comments.create');
Route::post('/news/{news}/comments', [CommentsController::class, 'storeNewsComment'])->name('news.comments.store');
Route::get('/{news}/newscle/comments/create', [CommentsController::class, 'createNewsComment'])->name('news.comments.create');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/admin/news', [AdminController::class, 'news'])->name('admin.news');
Route::post('/admin/news', [NewsController::class, 'store'])->name('admin.news.store');
Route::get('/admin/news/create', [NewsController::class, 'create'])->name('admin.news.create');
Route::get('/admin/news/{news}', [AdminController::class, 'show'])->name('admin.news.show');
Route::get('/admin/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
Route::patch('/admin/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
Route::delete('/admin/news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

Auth::routes();
