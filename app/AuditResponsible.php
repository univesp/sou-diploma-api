<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditResponsible extends Model
{
    protected $table = 'audit_responsibles';

    protected $fillable = [
        'id', 'audit_process_id', 'user_id', 'status', 'atributed_date'
    ];

    protected $sorted = [
        'id', 'audit_process_id', 'user_id', 'status', 'atributed_date'
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
}
