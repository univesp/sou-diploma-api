<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityDegreePrint extends Model
{
    // Protected connection
    protected $connection = 'mysql';
    
    // Protected table name
    protected $table = 'university_degree_prints';

    // Protected fillable or insert
    protected $fillable = [
        'audit_process_id', 
        'user_id', 
        'print_type_id', 
        'university_degree_number', 
        'label', 
        'serial_number', 
        'status'
    ];

    // Protected define order
    protected $sorted = [
        'audit_process_id', 
        'user_id', 
        'print_type_id', 
        'university_degree_number', 
        'label', 
        'serial_number', 
        'status'
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
    
    public function printType()
    {
        return $this->belongsTo(PrintType::class);
    }

    public function universityDegreePrintResponsibles()
    {
        return $this->hasMany(UniversityDegreePrintResponsible::class);
    }

    public function universityDegreePrintErrors()
    {
        return $this->hasMany(UniversityDegreePrintError::class);
    }
}
