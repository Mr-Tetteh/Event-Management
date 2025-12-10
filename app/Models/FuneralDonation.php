<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuneralDonation extends Model
{
    protected $fillable = [
        'donor_name',
        'amount',
        'phone',
        'beneficiary_id',
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }
}
