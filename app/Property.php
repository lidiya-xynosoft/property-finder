<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',    'price',        'featured',     'purpose',  'type',         'image',
        'slug',     'bedroom',      'bathroom',     'city',     'city_slug',    'address',
        'area',     'agent_id',     'description',  'video',    'floor_plan', 'country_id',
        'location_latitude',        'location_longitude', 'city_id', 'garage', 'built_year', 'country_id',
        'purpose_id', 'type_id', 'product_code', 'electricity_no', 'water_no', 'zone_no', 'street_no', 'building_no', 'is_parent_property'
    ];

    public function features()
    {
        return $this->belongsToMany(Feature::class)->withTimestamps();
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function gallery()
    {
        return $this->hasMany(PropertyImageGallery::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class, 'property_id');
    }
    public function propertyComplaint()
    {
        return $this->hasMany(PropertyComplaint::class);
    }
    public function propertyCustomer()
    {
        return $this->hasMany(PropertyCustomer::class);
    }
    public function landlordExpense()
    {
        return $this->belongsTo(landlordExpense::class);
    }
    public function landlordIncome()
    {
        return $this->belongsTo(landlordIncome::class);
    }
    public function propertyRent()
    {
        return $this->hasMany(PropertyRent::class);
    }
    public function propertyAgreement()
    {
        return $this->hasMany(PropertyAgreement::class);
    }
    public function shareHolderAccount()
    {
        return $this->hasMany(ShareHolderAccount::class);
    }
}