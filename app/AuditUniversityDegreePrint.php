<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditUniversityDegreePrint extends Model
{
    protected $table = 'university_degree_prints';

    protected $fillable = [
        'id', 'audit_process_id', 'user_id', 'print_type_id', 'university_degree_number', 'label'
    ];

    protected $sorted = [
        'id', 'audit_process_id', 'user_id', 'print_type_id', 'university_degree_number', 'label'
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
    
    public function auditPrintType()
    {
        return $this->belongsTo(AuditPrintType::class);
    }
}
