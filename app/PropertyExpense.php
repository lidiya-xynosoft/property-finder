<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyExpense extends Model
{
    use HasFactory;
    protected $fillable = ['property_id', 'expense_category_id', 'amount', 'is_active'];
}
