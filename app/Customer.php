<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'name_arabic',
        'tenant_no',
        'po_box',
        'phone',
        'email',
    ];
}
