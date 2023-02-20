<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['name','slug'];

    
    public function properties()
    {
        return $this->belongsToMany(Property::class)->withTimestamps();
    }
    public function features()
    {
        return $this->belongsToMany(Feature::class)->withTimestamps();
    }
}