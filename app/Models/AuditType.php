<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditType extends Model
{
    // Protected connection
    protected $connection = 'mysql';
    
    // Protected table name
    protected $table = 'audit_types';

    // Protected fillable or insert
    protected $fillable = [
        'name'
    ];

    // Protected define order
    protected $sorted = [
        'name'
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
    public function auditProcesses()
    {
        return $this->hasMany(AuditProcess::class);
    }
}
