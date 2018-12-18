<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAuditProcess extends Model
{
    // Protected table name
    protected $table = 'item_audit_processes';

    // Protected fillable or inserts
    protected $fillable = [ 
        'audit_process_id', 
        'user_id', 
        'field_name', 
        'before', 
        'after', 
        'inconsistency'
    ];

    // Protected define order
    protected $sorted = [
        'audit_process_id', 
        'user_id', 
        'field_name', 
        'before', 
        'after', 
        'inconsistency'
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

}
