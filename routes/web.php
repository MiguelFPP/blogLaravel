<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Panel\Tag\TagController;
use App\Http\Controllers\Panel\CategoryController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

/* pagina principal */
Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/category/{category}', [BlogController::class, 'category'])->name('blog.category');
Route::get('/tag/{tag}', [BlogController::class, 'tag'])->name('blog.tag');
Route::get('/post/{post}', [BlogController::class, 'show'])->name('blog.show');

/* categories */
Route::get('/categories', [CategoryController::class, 'index'])->name('panel.category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('panel.category.create');
Route::get('/categories/{category}', [CategoryController::class, 'edit'])->name('panel.category.edit');

/* tags */
Route::get('/tags', [TagController::class, 'index'])->name('panel.tag.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('panel.tag.create');
Route::get('/tags/{tag}', [TagController::class, 'edit'])->name('panel.tag.edit');
