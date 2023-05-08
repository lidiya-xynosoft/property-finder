<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landlordPropertyContract extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'landlord_id',
        'contract_no',
        'lease_period',
        'lease_commencement',
        'lease_expiry',
        'lease_period_arabic',
        'monthly_rent',
        'security_deposit',
        'cheque_no', 'share_holders',
        'rent_payment_commencement',
        'is_draft',
        'is_published',
        'is_withdraw',
        'date',
        'time'
    ];
    public function landlordProperty()
    {
        return $this->hasMany(landlordProperty::class);
    }
    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }
}