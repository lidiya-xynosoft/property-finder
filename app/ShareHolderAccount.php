<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareHolderAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id', 'ledger_id', 'share_holder_id', 'landlord_property_contract_id', 'reference',
        'applied_percentage', 'applied_amount', 'debit', 'credit', 'date',
        'reference_amount', 'ledger_amount', 'time', 'status', 'property_agreement_id', 'parent_property_id'
    ];
    public function shareHolder()
    {
        return $this->belongsTo(ShareHolder::class);
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
