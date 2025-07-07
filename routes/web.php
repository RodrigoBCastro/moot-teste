<?php

use App\Livewire\ProductCreate;
use App\Livewire\ProductSearch;
use Illuminate\Support\Facades\Route;

Route::get('/', ProductSearch::class)->name('products.list');
Route::get('/produtos/criar', ProductCreate::class)->name('products.create');
