<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NearbyCategory extends Model
{
    use HasFactory;
    protected $fillable = ['class', 'name', 'slug', 'icon'];
}