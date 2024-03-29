<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id', 'ledger_id', 'amount', 'status', 'user_id',
        'payment_type_id', 'name', 'description', 'reference', 'date', 'expense_date', 'property_agreement_id'
    ];
    public function ledger()
    {
        return $this->belongsTo(Ledger::class);
    }
    public function propertyAgreement()
    {
        return $this->belongsTo(PropertyAgreement::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}