<?php

use App\Http\Livewire\ArticleForm;
use App\Http\Livewire\Articles;
use App\Http\Livewire\ArticleShow;
use App\Http\Livewire\About;
use App\Http\Livewire\Contact;
use App\Http\Livewire\Productos;
use App\Http\Livewire\ShowPosts;
use App\Http\Livewire\Personaje;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/articles', Articles::class)
    ->name('articles.index');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/about', About::class)
    ->name('about');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/contact', Contact::class)
    ->name('contact');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/productos', Productos::class)
    ->name('productos');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/showpost', ShowPosts::class)
    ->name('showpost');



