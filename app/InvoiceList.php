<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceList extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'item',
        'item_price',
        'date',
    ];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}