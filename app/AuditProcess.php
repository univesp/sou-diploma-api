<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditProcess extends Model
{
    // Protected table name
    protected $table = 'audit_processes';

    // Protected fillable or inserts
    protected $fillable = [
        'student_id', 
        'user_id', 
        'attributed_date', 
        'audit_type_id', 
        'accept_law', 
        'status', 
        'intership', 
        'commitment_term', 
        'activity_plan', 
        'process_number', 
        'ppi', 
        'public_school', 
        'location_record'
    ];

    // Protected define order
    protected $sorted = [
        'student_id', 
        'user_id', 
        'attributed_date', 
        'audit_type_id', 
        'accept_law', 
        'status', 
        'intership', 
        'commitment_term', 
        'activity_plan', 
        'process_number', 
        'ppi', 
        'public_school', 
        'location_record'
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
    public function auditResponsibles()
    {
        return $this->hasMany(AuditResponsible::class);
    }

    public function auditType()
    {
        return $this->belongsTo(AuditType::class);
    }

    public function itemAuditProcesses()
    {
        return $this->hasMany(ItemAuditProcess::class);
    }

    public function auditDocuments()
    {
        return $this->hasMany(AuditDocument::class);
    }

    public function universityDegreePrints()
    {
        return $this->hasMany(UniversityDegreePrint::class);
    }
}
