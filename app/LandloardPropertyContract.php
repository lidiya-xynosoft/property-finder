<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandloardPropertyContract extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'landloard_id',
        'contract_no',
        'lease_period',
        'lease_commencement',
        'lease_expiry',
        'lease_period_arabic',
        'monthly_rent',
        'security_deposit',
        'rent_payment_commencement',
        'is_draft',
        'is_published',
        'is_withdraw',
        'date',
        'time'
    ];
    public function landloardProperty()
    {
        return $this->hasMany(LandloardProperty::class);
    }
    public function landloard()
    {
        return $this->belongsTo(Landloard::class);
    }
}