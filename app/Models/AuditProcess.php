<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditProcess extends Model
{
    protected $connection = 'mysql';

    // Protected table name
    protected $table = 'audit_processes';

    // Protected fillable or inserts
    protected $fillable = [
        'academic_register',
        'student_id',
        'user_id',
        'attributed_date',
        'audit_type_id',
        'accept_law',
        'audit_status_name',
        'intership',
        'commitment_term',
        'activity_plan',
        'process_number',
        'ppi',
        'public_school',
        'location_record',
        'status',
    ];

    // Protected define order
    protected $sorted = [
        'academic_register',
        'student_id',
        'user_id',
        'attributed_date',
        'audit_type_id',
        'accept_law',
        'audit_status_name',
        'intership',
        'commitment_term',
        'activity_plan',
        'process_number',
        'ppi',
        'public_school',
        'location_record',
        'status',
    ];

    // Protected guard
    protected $guarded = [
        'academic_register',
        'id',
        'created_at',
        'update_at',
    ];

    // Protected hidden fields
    protected $hidden = [
        'academic_register',
        'id',
        'created_at',
        'update_at',
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
}
