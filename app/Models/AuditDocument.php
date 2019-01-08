<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditDocument extends Model
{
    // Protected connection
    protected $connection = 'mysql';

    // Protected table name
    protected $table = 'audit_documents';

    // Protected fillable or inserts
    protected $fillable = [
        'audit_process_id', 
        'document_type_id', 
        'autenticate', 
        'attachment'
    ];
    
    // Protected define order
    protected $sorted = [
        'audit_process_id', 
        'document_type_id', 
        'autenticate', 
        'attachment'
    ];

    // Protected guard
    protected $guarded = [
        'id', 
        'created_at', 
        'update_at'
    ];

    // Protected hidden fields
    protected $hidden = [
        'id', 
        'created_at', 
        'update_at'
    ];

    // Relationships
    public function auditProcess()
    {
        return $this->belongsTo(AuditProcess::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
    
}
