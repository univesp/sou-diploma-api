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
        'create_at', 'update_at'
    ];

    protected $hidden = [
        'id'
    ];

    public function auditTypes()
    {
        return $this->hasMany(AuditType::class);
    }
}
