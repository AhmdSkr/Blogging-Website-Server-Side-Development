<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;

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

Route::controller(BlogController::class)->prefix('blogs')->group(function() {
    Route::get(                         '/create',              'create')           ->name('blog.create');
    Route::post(                        '/',                    'store')            ->name('blog.store');
    Route::get(                         '/',                    'index')            ->name('blog.index');
    Route::get(                         '{blog}',               'show')             ->name('blog.show');
    Route::get(                         '{blog}/edit',          'edit')             ->name('blog.edit');
    Route::match( ['put','patch'],      '{blog}',               'update')           ->name('blog.update');
    Route::delete(                      '{blog}',               'destroy')          ->name('blog.destroy');
    Route::delete(                      "{blog}/uncover",       'uncover')          ->name('blog.uncover');
});

Route::controller(PostController::class)->group(function(){

    Route::prefix('blogs')->group(function(){
        Route::get(                     '{blog}/posts/create',  'create')           ->name('post.create');
        Route::post(                    '{blog}/posts',         'store')            ->name('post.store');
    });
    
    Route::prefix('posts')->group(function(){
        Route::get(                     '/',                    'index')            ->name('post.index');
        Route::get(                     '{post}',               'show')             ->name('post.show');
        Route::get(                     '{post}/edit',          'edit')             ->name('post.edit');
        Route::match( ['put','patch'],  '{post}',               'update')           ->name('post.update');
        Route::delete(                  '{post}',               'destroy')          ->name('post.destroy');
        Route::delete(                  "{post}/uncover",       'uncover')          ->name('post.uncover');
    });

});
