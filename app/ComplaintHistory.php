<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintHistory extends Model
{
    use HasFactory;
    protected $fillable = ['property_complaint_id', 'customer_id', 'property_agreement_id', 'message', 'title', 'date'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
