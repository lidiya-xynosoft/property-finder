<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminNotificatin extends Model
{
    use HasFactory;
    protected $fillable = [
        'message',
        'date',
        'user_id',
        'title',
        'property_id_id',
        'property_complaint_id',
    ];
}
