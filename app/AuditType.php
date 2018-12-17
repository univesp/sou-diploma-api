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
        'id', 
        'created_at', 
        'update_at'
    ];

    protected $hidden = [
        'id', 
        'created_at', 
        'update_at'
    ];

    public function auditProcesses()
    {
        return $this->hasMany(AuditProcess::class);
    }
}
