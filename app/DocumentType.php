<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\PropertyProperty;

class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'is_active'];
    public function propertyAgreementDocument()
    {
        return $this->hasMany(PropertyAgreementDocument::class);
    }
}