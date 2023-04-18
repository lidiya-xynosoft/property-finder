<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyIncome extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',  'amount', 'status', 'user_id', 'ledger_id',
        'payment_type_id', 'name', 'description', 'reference', 'date', 'income_date', 'property_agreement_id'
    ];
    public function propertyAgreement()
    {
        return $this->belongsTo(PropertyAgreement::class);
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