<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditItemAuditProcess extends Model
{
    protected $table = 'item_audit_processes';

    protected $fillable = [
        'id', 'audit_process_id', 'user_id', 'field_name', 'before', 'after', 'inconsistency'
    ];

    protected $sorted = [
        'id', 'audit_process_id', 'user_id', 'field_name', 'before', 'after', 'inconsistency'
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

    public function auditProccess()
    {
        return $this->belongsTo(AuditProcess::class);
    }

}
