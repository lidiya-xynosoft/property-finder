<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'customer_id',
        'property_agreement_id',
        'status'
    ];
}
