<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditResponsible extends Model
{
    // Protected connection
    protected $connection = 'mysql';
    
    // Protected table name
    protected $table = 'audit_responsibles';

    // Protected fillable or insert
    protected $fillable = [
        'audit_process_id', 
        'user_id', 
        'status', 
        'atributed_date'
    ];

    // Protected define order
    protected $sorted = [
        'audit_process_id', 
        'user_id', 
        'status', 
        'atributed_date'
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
