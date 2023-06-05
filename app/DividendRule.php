<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DividendRule extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id', 'no_of_share_holders', 'share_holder_id', 'percentage', 'status', 'mode_of_calculation', 'landlord_property_contract_id', 'property_agreement_id'
    ];
}
