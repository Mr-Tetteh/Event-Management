<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('beneficiaries', \App\Livewire\Admin\Beneficiary::class)->name('beneficiaries');
    });

});