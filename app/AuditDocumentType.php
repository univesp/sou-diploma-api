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
        'create_at', 'update_at'
    ];

    protected $hidden = [
        'id'
    ];

    public function audit_documents()
    {
        return $this->belongsTo(AuditDocument::class);
    }
}
