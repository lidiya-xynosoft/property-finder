<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandymanComplaintStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'handyman_id',
        'property_complaint_id',
        'handyman_status',
        'service_list_id',
        'is_handyman_assigned',
        'work_start_time',
        'work_end_time',
        'customer_id',
        'elapsed_time',
        'date',
    ];
    public function propertyComplaint()
    {
        return $this->belongsTo(PropertyComplaint::class);
    }
    public function handyman()
    {
        return $this->belongsTo(Handyman::class);
    }
}
