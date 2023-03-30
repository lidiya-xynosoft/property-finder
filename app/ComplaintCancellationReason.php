<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintCancellationReason extends Model
{
    use HasFactory;
    protected $fillable = ['property_complaint_id', 'cancellation_reason_id'];
}
