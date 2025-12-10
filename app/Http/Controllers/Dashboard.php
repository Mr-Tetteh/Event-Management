<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuneralDonation;

class Dashboard extends Controller
{
    //


   public function __invoke(Request $request)
{
    // Group and sum donations by day
    $dailyTotals = FuneralDonation::selectRaw('DATE(created_at) as day, SUM(amount) as total')
        ->groupBy('day')
        ->orderBy('day', 'asc')
        ->get();

    return view('dashboard', [
        'dailyTotals' => $dailyTotals
    ]);
}

}
