<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditDocument extends Model
{
    protected $table = 'audit_documents';

    protected $fillable = [
        'audit_process_id', 'document_type_id', 'autenticate', 'attachment'
    ];
    
    protected $sorted = [
        'audit_process_id', 'document_type_id', 'autenticate', 'attachment'
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

    public function auditProcess()
    {
        return $this->belongsTo(AuditProcess::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
    
}
