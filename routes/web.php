<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Livewire\JoiningForm;

Route::livewire('/', JoiningForm::class)->name('join');
