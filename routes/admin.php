<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('beneficiaries', \App\Livewire\Admin\Beneficiary::class)->name('beneficiaries');
        Route::get('funeral-donations', \App\Livewire\Admin\FuneralDonation::class)->name('funeral-donations');
        Route::get('funeral-donation-cash-flow', \App\Livewire\Admin\FuneralDonationCashFlow::class)->name('funeral-donation-cash-flow');
        Route::get('event-types', \App\Livewire\Admin\EventType::class)->name('event-types')->middleware(\App\Http\Middleware\EnsureTokenIsSuperAdmin::class);
    });


    

    // Route::get('sms', function () {
    //    $response =  sendWithSMSONLINEGH('233559724772', "Dear  thank you for your generous donation of GHS o support our funeral services. Your contribution is greatly appreciated. - Swift Care"); 
    //    return response()->json([
    //        'response' => $response,
    //    ]);
    // });


});