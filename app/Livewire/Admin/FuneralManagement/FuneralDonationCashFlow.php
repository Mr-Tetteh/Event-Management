<?php

namespace App\Livewire\Admin\FuneralManagement;

use App\Models\FuneralDonation;
use Livewire\Component;

class FuneralDonationCashFlow extends Component
{
    public function render()
{
    // Fetch all donation records
    $donations = FuneralDonation::orderBy('created_at', 'desc')->get();

    // Group by date (Y-m-d)
    $datas = $donations->groupBy(function ($item) {
        return $item->created_at->format('Y-m-d');
    });

    // Calculate total sum of all records
    $totalSum = $donations->sum('amount');

    return view('livewire.admin.funeral-management.funeral-donation-cash-flow', [
        'datas' => $datas,
        'totalSum' => $totalSum
    ]);
}

}
