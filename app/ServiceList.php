<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceList extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function propertyComplaint()
    {
        return $this->hasMany(PropertyComplaint::class);
    }
}