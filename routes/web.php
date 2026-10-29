<?php

use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\PaymentScreenshotController;
use App\Livewire\Admin\Joinings\Index;
use App\Livewire\Admin\Joinings\Show;
use App\Livewire\Admin\Login;
use App\Livewire\JoiningForm;
use Illuminate\Support\Facades\Route;

Route::livewire('/', JoiningForm::class)->name('join');

Route::prefix('admin')->name('admin.')->group(function (): void {
    Route::livewire('login', Login::class)->middleware('guest')->name('login');

    Route::middleware('auth')->group(function (): void {
        Route::livewire('/', Index::class)->name('joinings.index');
        Route::livewire('joinings/{joining}', Show::class)->name('joinings.show');
        Route::get('joinings/{joining}/screenshot', PaymentScreenshotController::class)->name('joinings.screenshot');
        Route::post('logout', LogoutController::class)->name('logout');
    });
});
