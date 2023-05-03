<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landlordExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id', 'ledger_id', 'amount', 'status',
        'payment_type_id', 'name', 'description', 'reference', 'date', 'expense_date', 'landlord_property_contract_id', 'landlord_id'
    ];
    public function ledger()
    {
        return $this->belongsTo(Ledger::class);
    }
    public function landlordPropertyContract()
    {
        return $this->belongsTo(landlordPropertyContract::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}