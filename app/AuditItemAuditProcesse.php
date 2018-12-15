<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditItemAuditProcesse extends Model
{
    protected $table = 'item_audit_processes';

    protected $fillable = [
        'id', 'audit_process_id', 'user_id', 'field_name', 'before', 'after', 'inconsistency'
    ];

    protected $sorted = [
        'id', 'audit_process_id', 'user_id', 'field_name', 'before', 'after', 'inconsistency'
    ];

    protected $guarded = [
        'create_at', 'update_at'
    ];

    protected $hidden = [
        'id'
    ];

    public function auditProccesses()
    {
        return $this->hasMany(AuditProcess::class);
    }

}
