<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landlordRent extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id', 'landlord_property_contract_id', 'payment_type_id', 'month', 'ledger_id',
        'rental_date', 'payment_date', 'payment_time', 'rent_amount', 'payment_status', 'status', 'landlord_id',
    ];
    public function landlordPropertyContract()
    {
        return $this->belongsTo(landlordPropertyContract::class);
    }
}