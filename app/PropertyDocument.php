<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyDocument extends Model
{
    use HasFactory;
    protected $fillable = ['property_id', 'document_type_id', 'file', 'status', 'property_agreement_id'];
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}