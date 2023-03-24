<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'email',
    ];
    public function propertyCustomer()
    {
        return $this->hasMany(PropertyCustomer::class);
    }
    public function propertyAgreement()
    {
        return $this->hasMany(PropertyAgreement::class);
    }
}