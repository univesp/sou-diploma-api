<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditType extends Model
{
    protected $table = 'audit_types';

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

    public function auditProcesses()
    {
        return $this->belongsTo(AuditProcess::class);
    }
}
