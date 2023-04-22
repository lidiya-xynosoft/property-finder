<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyRent extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'property_id', 'property_agreement_id', 'payment_type_id', 'month', 'ledger_id',
        'rental_date', 'payment_date', 'payment_time', 'rent_amount', 'payment_status', 'status', 'property_agreement_id',
    ];
    public function propertyAgreement()
    {
        return $this->belongsTo(PropertyAgreement::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}