<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShareHolder extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'first_name',
        'last_name',
        'phone',
        'email',
        'status'
    ];
    public function shareHolderAccount()
    {
        return $this->hasMany(ShareHolderAccount::class);
    }
}
