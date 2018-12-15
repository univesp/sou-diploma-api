<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditUniversityDegreePrint extends Model
{
    protected $table = 'univesty_degree_prints';

    protected $fillable = [
        'id', 'audit_process_id', 'user_id', 'print_type_id', 'university_degree_number', 'label'
    ];

    protected $sorted = [
        'id', 'audit_process_id', 'user_id', 'print_type_id', 'university_degree_number', 'label'
    ];

    protected $guarded = [
        'create_at', 'update_at'
    ];

    protected $hidden = [
        'id'
    ];

    public function auditProcesses()
    {
        return $this->hasMany(AuditProcess::class);
    }
    
    public function print_types()
    {
        return $this->hasMany(AuditPrintType::class);
    }
}
