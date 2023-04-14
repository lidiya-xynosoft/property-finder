<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandloardExpense extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id', 'ledger_id', 'amount', 'status', 'user_id',
        'payment_type_id', 'name', 'description', 'reference', 'date', 'expense_date', 'landloard_property_contract_id', 'landloard_id'
    ];
    public function ledger()
    {
        return $this->belongsTo(Ledger::class);
    }
    public function landloardPropertyContract()
    {
        return $this->belongsTo(LandloardPropertyContract::class);
    }
}