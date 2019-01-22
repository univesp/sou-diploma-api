<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class StudentAudit extends Model
{
    protected $connection = 'mysql_sa';

    protected $table = 'students';

    protected $fillable = [
        'id',
        'name', 
        'academic_register'
    ];

    protected $sorted = [
        'id',
        'name', 
        'academic_register'
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
    public function studantAuditProcesses()
    {
        return $this->hasOne(AuditProcess::class, 'audit_processes')->withTimestamps();
    }
    
    // Relationships
    public function studantUniversityDegreeLists()
    {
        return $this->hasOne(UniversityDegreeList::class, 'university_degree_lists')->withTimestamps();
    }

    public function getStudentsAudit()
    {
        // $students = DB::connection('mysql_sa')->select('
        //     select * from students s 
        //     inner join sou_audit.audit_processes p
        //     on p.student_id = s.id
        //     limit 10
        // ');

        // $students = \DB::select('select sou_authentication.students.id from sou_authentication.students 
        //                         join sou_audit.audit_processes 
        //                         on sou_authentication.students.id = sou_audit.audit_processes.student_id');
        
        /*$students = \DB::table('sou_authentication.students')
                    ->join('sou_audit.audit_processes', 'sou_authentication.students.id', '=', 'sou_audit.audit_processes.student_id')
                    ->select('*')
                    ->get();*/

        return response($students, 200);
    }
}
