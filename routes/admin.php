<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('beneficiaries', App\Livewire\Admin\FuneralManagement\Beneficiary::class)->name('beneficiaries');
        Route::get('funeral-donations', \App\Livewire\Admin\FuneralManagement\FuneralDonation::class)->name('funeral-donations');
        Route::get('funeral-donation-cash-flow', \App\Livewire\Admin\FuneralManagement\FuneralDonationCashFlow::class)->name('funeral-donation-cash-flow');


        Route::get('event-types', \App\Livewire\Admin\AppManagement\EventType::class)->name('event-types')->middleware(\App\Http\Middleware\EnsureTokenIsSuperAdmin::class);
        Route::get('user-management', \App\Livewire\Admin\AppManagement\UserManagement::class)->name('user-management')->middleware(\App\Http\Middleware\EnsureTokenIsSuperAdmin::class);
        Route::get('brochure', \App\Livewire\Admin\GeneralPurpose\Brochure::class)->name('brochure');

        Route::get('wedding-beneficiaries', App\Livewire\Admin\WeddingManagement\Beneficiary::class)->name('wedding-beneficiaries');

    });


    

    // Route::get('sms', function () {
    //    $response =  sendWithSMSONLINEGH('233559724772', "Dear  thank you for your generous donation of GHS o support our funeral services. Your contribution is greatly appreciated. - Swift Care"); 
    //    return response()->json([
    //        'response' => $response,
    //    ]);
    // });


});
// /Volumes/CODE/www/laravel_projects/eventManagement/app/Livewire/Admin/FuneralManagement/Beneficiary.php