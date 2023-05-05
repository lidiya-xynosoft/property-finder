<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'handyman_id',
        'property_complaint_id',
        'invoice_no',
        'customer_id',
        'property_agreement_id',
        'date',
    ];
    public function propertyComplaint()
    {
        return $this->belongsTo(PropertyComplaint::class);
    }
    public function invoiceList()
    {
        return $this->hasMany(InvoiceList::class);
    }
}