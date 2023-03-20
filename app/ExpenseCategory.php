<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpenseCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'type',
        'description',
    ];

    public function ledger()
    {
        return $this->hasMany(Ledger::class);
    }

    public function propertyExpense()
    {
        return $this->hasMany(PropertyExpense::class);
    }
}