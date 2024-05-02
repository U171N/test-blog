<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/login', [AuthorController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/author/login', [AuthorController::class, 'AuthorLogin'])->middleware(RedirectIfAuthenticated::class);

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AuthorController::class, 'jumlahAuthor'])->name('admin.dashboard');

    Route::get('/admin/logout', [AuthorController::class, 'AdminDestroy'])->name('admin.logout');
});

Route::middleware(['auth', 'role:author'])->group(function () {

    Route::get('/author/dashboard', [PostController::class, 'jumlahPostingAuthor'])->name('author.dashboard');

    Route::get('/author/logout', [AuthorController::class, 'AuthorDestroy'])->name('author.logout');
});

Route::controller(PostController::class)->group(function () {

    Route::get('/admin/posts/all', 'index_admin')->name('posts.admin');

    Route::get('/admin/posts/tambah', 'admin_create')->name('tambah.post.admin');
    Route::post('/admin/posts/store', 'admin_store')->name('admin.store.posts');

    Route::get('/admin/posts/edit/{post_id}', 'admin_edit')->name('admin.posts.edit');
    Route::put('/admin/posts/update/{post_id}', 'admin_update')->name('admin.update.post');

    Route::get('/admin/posts/delete/{post_id}', 'admin_destroy')->name('admin.posts.delete');


    //author
    Route::get('/author/posts/all', 'index_author')->name('posts.author');

    Route::get('/author/posts/tambah', 'author_create')->name('tambah.post.author');
    Route::post('/author/posts/store', 'author_store')->name('author.store.posts');

    Route::get('/author/posts/edit/{post_id}', 'author_edit')->name('author.posts.edit');
    Route::put('/author/posts/update/{post_id}', 'author_update')->name('author.update.post');


    Route::get('/author/posts/delete/{post_id}', 'author_destroy')->name('author.posts.delete');

});


Route::controller(AuthorController::class)->group(function () {

    Route::get('/author/all', 'index')->name('author.admin');

    Route::get('/admin/author/tambah', 'create')->name('tambah.author');
    Route::post('/admin/author/store', 'store')->name('store.author');

    Route::get('/admin/author/edit/{id}', 'edit')->name('edit.author');
    Route::post('/admin/author/update', 'update')->name('update.author');

    Route::get('/admin/author/delete/{id}', 'destroy')->name('delete.author');
});

require __DIR__.'/auth.php';
