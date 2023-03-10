<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAgreement extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'customer_id',
        'agreement_id',
        'building_name_english',
        'building_name_arabic',
        'utilities',
        'unit_type_english',
        'unit_type_arabic',
        'water_no',
        'electricity_no',
        'building_no',
        'zone',
        'street',
        'location_english',
        'location_arabic',
        'lease_period',
        'lease_commencement',
        'lease_expiry',
        'lease_period_arabic',
        'lease_commencement_arabic',
        'lease_expiry_arabic',
        'monthly_rent',
        'monthly_rent_arabic',
        'utilities_arabic',
        'payment_mode_arabic',
        'payment_mode',
        'no_of_check',
        'security_deposit_arabic',
        'security_deposit',
        'rent_payment_commencement',
        'rent_payment_commencement_arabic',
        'rent_free',
        'is_draft',
        'is_published',
        'is_withdraw',
    ];
}
