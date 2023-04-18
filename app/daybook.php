<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class daybook extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'property_agreement_id',
        'landloard_property_contract_id',
        'user_id',
        'date',
        'time',
        'title',
        'head',
        'debit',
        'credit',
        'total',
    ];
}