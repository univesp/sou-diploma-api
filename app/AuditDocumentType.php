<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditDocumentType extends Model
{
    protected $table = 'document_types';

    protected $fillable = [
        'id', 'name'
    ];

    protected $sorted = [
        'id', 'name'
    ];

    protected $guarded = [
        'id', 
        'created_at', 
        'update_at'
    ];

    protected $hidden = [
        'id', 
        'created_at', 
        'update_at'
    ];

    public function auditDocuments()
    {
        return $this->hasMany(AuditDocument::class);
    }
}
