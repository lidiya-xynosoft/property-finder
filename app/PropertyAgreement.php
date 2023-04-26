<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyAgreement extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'property_id',
        'customer_id',
        'agreement_id',
        'building_name_english',
        'building_name_arabic',
        'utilities',
        'unit_type_english',
        'unit_type_arabic',
        'water_no',
        'electricity_no',
        'building_no',
        'zone',
        'street',
        'location_english',
        'location_arabic',
        'lease_mode',
        'lease_period',
        'lease_commencement',
        'lease_expiry',
        'lease_period_arabic',
        'lease_commencement_arabic',
        'lease_expiry_arabic',
        'monthly_rent',
        'monthly_rent_arabic',
        'utilities_arabic',
        'payment_mode_arabic',
        'payment_mode',
        'no_of_check',
        'security_deposit_arabic',
        'security_deposit',
        'rent_payment_commencement',
        'rent_payment_commencement_arabic',
        'rent_free',
        'is_draft',
        'is_published',
        'is_signed',
        'is_withdraw',
        'date',
        'time',
        'people_share'
    ];
    public function propertyCustomer()
    {
        return $this->hasMany(PropertyCustomer::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function propertyExpense()
    {
        return $this->hasMany(PropertyExpense::class);
    }
    public function propertyIncome()
    {
        return $this->hasMany(PropertyIncome::class);
    }
    public function propertyAgreementDocument()
    {
        return $this->hasMany(PropertyAgreementDocument::class);
    }
    public function propertyRent()
    {
        return $this->hasMany(PropertyRent::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class);
    }
   
}