<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
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