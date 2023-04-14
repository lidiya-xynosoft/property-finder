<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Landloard extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'first_name',
        'last_name',
        'phone',
        'email',
    ];
    public function property()
    {
        return $this->hasMany(Property::class);
    }
    public function landloardPropertyContract()
    {
        return $this->hasMany(LandloardPropertyContract::class);
    }
}
