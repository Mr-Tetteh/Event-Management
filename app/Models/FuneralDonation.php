<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuneralDonation extends Model
{
    protected $fillable = [
        'donor_name',
        'amount',
        'phone',
        'beneficiary_ids'

    ];


    protected $casts = [
        'beneficiary_ids' => 'array', // VERY IMPORTANT
    ];


public function beneficiaries()
{
    $ids = is_array($this->beneficiary_ids) 
        ? $this->beneficiary_ids 
        : json_decode($this->beneficiary_ids, true) ?? [];

    return Beneficiary::whereIn('id', $ids)->get();
}

public function getBeneficiaryIdsAttribute($value)
{
    return is_array($value) ? $value : json_decode($value, true) ?? [];
}


}
