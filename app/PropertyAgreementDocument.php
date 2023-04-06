<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyAgreementDocument extends Model
{
    use HasFactory;
    protected $fillable = ['property_id', 'document_type_id', 'file', 'property_agreement_id', 'status'];
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
    public function propertyAgreement()
    {
        return $this->belongsTo(PropertyAgreement::class);
    }
}
