<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearbyProperty extends Model
{
    use HasFactory;
    protected $fillable = ['nearby_category_id', 'property_id', 'title', 'distance'];
}
