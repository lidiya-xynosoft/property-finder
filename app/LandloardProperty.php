<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandloardProperty extends Model
{
    use HasFactory;
    protected $fillable = [
        'property_id',
        'landloard_id',
        'landloard_property_contract_id',
        'status',
        'start_date',
        'end_date',
        'is_withdraw',
        'is_renewed',
        'date',
        'time'
    ];
    public function landloardPropertyContract()
    {
        return $this->belongsTo(LandloardPropertyContract::class);
    }
    public function landloard()
    {
        return $this->belongsTo(Landloard::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}