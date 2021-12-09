<?php

use App\Http\Livewire\ArticleForm;
use App\Http\Livewire\Articles;
use App\Http\Livewire\ArticleShow;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Articles::class)->name('articles.index');; //home

Route::get('/articles-create', ArticleForm::class)
     ->name('articles.create')
     ->middleware('auth'); //ruta de crear articulo

Route::get('/blog/{article}', ArticleShow::class)->name('articles.show'); //ruta de ver articulo

Route::get('/blog/{article}/edit', ArticleForm::class)
    ->name('articles.edit')
    ->middleware('auth'); //ruta de ver articulo

// Route::get('login')->name('login');

Route::middleware(['auth:sanctum', 'verified'])->get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/articles', Articles::class)
    ->name('articles.index');


