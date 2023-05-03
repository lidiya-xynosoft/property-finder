<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landlordIncome extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',  'amount', 'status', 'ledger_id',
        'payment_type_id', 'name', 'description', 'reference', 'date', 'income_date', 'landlord_property_contract_id', 'landlord_id'
    ];
    public function landlordPropertyContract()
    {
        return $this->belongsTo(landlordPropertyContract::class);
    }
    public function ledger()
    {
        return $this->belongsTo(Ledger::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}