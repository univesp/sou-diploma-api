<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditProcess extends Model
{
    protected $table = 'audit_processes';

    protected $fillable = [
        'id', 'student_id', 'user_id', 'attributed_date', 'audit_type_id', 'accept_law', 'status', 'intership', 'commitment_term', 'activity_plan', 'process_number', 'ppi', 'public_school', 'location_record'
    ];

    protected $sorted = [
        'id', 'student_id', 'user_id', 'attributed_date', 'audit_type_id', 'accept_law', 'status', 'intership', 'commitment_term', 'activity_plan', 'process_number', 'ppi', 'public_school', 'location_record'
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
        return $this->hasMany(ItemAuditProcesses::class);
    }

    public function auditDocuments()
    {
        return $this->hasMany(AuditDocument::class);
    }

    public function auditUniversityDegreePrints()
    {
        return $this->hasMany(AuditUniversityDegreePrint::class);
    }
}
