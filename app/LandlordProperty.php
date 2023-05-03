<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class landlordProperty extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'landlord_id',
        'landlord_property_contract_id',
        'status',
        'start_date',
        'end_date',
        'is_withdraw',
        'is_renewed',
        'date',
        'time'
    ];
    public function landlordPropertyContract()
    {
        return $this->belongsTo(landlordPropertyContract::class);
    }
    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}