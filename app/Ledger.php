<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'title',
        'type',
        'description',
        
    ];

    public function daybook()
    {
        return $this->hasMany(Daybook::class);
    }

    public function propertyExpense()
    {
        return $this->hasMany(PropertyExpense::class);
    }
    public function propertyIncome()
    {
        return $this->hasMany(PropertyIncome::class);
    }
    public function shareHolderAccount()
    {
        return $this->hasMany(ShareHolderAccount::class);
    }
}