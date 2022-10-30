<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

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


Route::middleware('auth')->group(function () {

    Route::get('/profile/{user}',[ProfileController::class,'index'])->name('prof.index');
    Route::get('/profile/{user}/edit',[ProfileController::class,'edit'])->name('prof.edit');
    Route::post('/profile/{user}',[ProfileController::class,'update'])->name('prof.update');

    
    Route::get('/p/create',[PostController::class,'create'])->name('post.create');
    Route::post('/p',[PostController::class,'store'])->name('post.store');
    Route::get('/p/{post}/edit',[PostController::class,'edit'])->name('post.edit');
    Route::post('/p/{post}',[PostController::class,'update'])->name('post.update');
    Route::delete('/p/{post}/delete',[PostController::class,'delete'])->name('post.delete');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
