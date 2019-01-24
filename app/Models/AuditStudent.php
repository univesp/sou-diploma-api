<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditStudent extends Model
{
    protected $connection = 'mysql';

    protected $table = 'audit_processes';

    protected $fillable = [
        'id',
        'status',
        'user_id' 
    ];

    protected $sorted = [
        'id',
        'status',
        'user_id'
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

    // Relationships
    public function auditProcesses()
    {
        return $this->belongsTo(AuditProcess::class, 'audit_processes')->withTimestamps();
    }
    
    // Relationships
    public function universityDegreeLists()
    {
        return $this->belongsTo(UniversityDegreeList::class, 'university_degree_lists')->withTimestamps();
    }
}
