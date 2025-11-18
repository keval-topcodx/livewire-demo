<?php

use App\Livewire\Client;
use Illuminate\Support\Facades\Route;
use App\Livewire\User\Create as UserCreate;
use App\Livewire\User\Edit as UserEdit;
use App\Livewire\User\Index as UserIndex;
use App\Livewire\Product\Create as ProductCreate;
use App\Livewire\Product\Edit as ProductEdit;
use App\Livewire\Product\Index as ProductIndex;
use App\Livewire\Client\Create as ClientCreate;
use App\Livewire\Client\Edit as ClientEdit;
use App\Livewire\Client\Index as ClientIndex;



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/create', UserCreate::class)->name('create');
    Route::get('/', UserIndex::class)->name('index');
    Route::get('/{user}/edit', UserEdit::class)->name('edit');
});

Route::prefix('product')->name('product.')->group(function () {
    Route::get('/create', ProductCreate::class)->name('create');
    Route::get('/', ProductIndex::class)->name('index');
    Route::get('/{product}/edit', ProductEdit::class)->name('edit');
});

Route::prefix('client')->name('client.')->group(function () {
    Route::get('/create', ClientCreate::class)->name('create');
    Route::get('/', ClientIndex::class)->name('index');
    Route::get('/{client}/edit', ClientEdit::class)->name('edit');
});

//Route::get('/client/info', ClientInformation::class)->name('client.information');
