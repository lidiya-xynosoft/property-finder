<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyComplaint extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'complaint_number',
        'property_agreement_id',
        'service_list_id',
        'customer_id',
        // 'handiman_id',
        'is_handiman_assigned',
        'complaint',
        'status',
        'approved_time',
        'rejected_time',
        'assigned_time',
        'resolved_time',
    ];
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
    public function serviceList()
    {
        return $this->belongsTo(ServiceList::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function complaintImage()
    {
        return $this->hasMany(ComplaintImage::class);
    }
}