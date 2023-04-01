<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyComplaint extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'property_id',
        'complaint_number',
        'property_agreement_id',
        'service_list_id',
        'customer_id',
        'handyman_id',
        'is_handyman_assigned',
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
    public function handymanComplaintStatus()
    {
        return $this->hasMany(HandymanComplaintStatus::class);
    }
}