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

    public function daybook()
    {
        return $this->hasMany(Daybook::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
}