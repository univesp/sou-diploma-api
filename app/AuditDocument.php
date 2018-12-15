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
        'create_at', 'update_at'
    ];

    protected $hidden = [
        'id'
    ];

    public function audit_processes() 
    {
        return $this->hasMany(AuditProcess::class);
    }

    public function documents_types() 
    {
        return $this->hasOne(AuditDocumentType::class);
    }
}
