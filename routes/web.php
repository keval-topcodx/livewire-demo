<?php

use App\Http\Controllers\UserController;
use App\Livewire\Users;
use App\Livewire\UsersEdit;
use App\Livewire\UsersIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users/create', Users::class)->name('users.create');
Route::get('/users', UsersIndex::class)->name('users.index');
Route::get('/users/{user}/edit', UsersEdit::class)->name('users.edit');
