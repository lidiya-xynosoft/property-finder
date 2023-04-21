<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandloardIncome extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',  'amount', 'status', 'ledger_id',
        'payment_type_id', 'name', 'description', 'reference', 'date', 'income_date', 'landloard_property_contract_id', 'landloard_id'
    ];
    public function landloardPropertyContract()
    {
        return $this->belongsTo(LandloardPropertyContract::class);
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