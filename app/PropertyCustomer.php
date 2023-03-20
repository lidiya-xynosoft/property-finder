<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyCustomer extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'property_id',
        'customer_id',
        'property_agreement_id',
        'status',
        'start_date',
        'end_date',
        'is_withdraw',
        'is_renewed',
        'date',
        'time'
    ];
    public function propertyAgreement()
    {
        return $this->belongsTo(PropertyAgreement::class);
    }
}