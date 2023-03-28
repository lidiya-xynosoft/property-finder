<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintImage extends Model
{
    use HasFactory;
    protected $fillable = ['property_complaint_id', 'name'];

    public function PropertyComplaint()
    {
        return $this->belongsTo(PropertyComplaint::class);
    }
}
