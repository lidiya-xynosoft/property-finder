<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['country_id', 'name', 'slug', 'image', 'latitude', 'longitude', 'city_order'];
    public function property()
    {
        return $this->hasMany(Property::class);
    }
}