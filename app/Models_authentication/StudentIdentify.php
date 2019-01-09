<?php

namespace App\Models_authentication;

use Illuminate\Database\Eloquent\Model;

class StudentIdentify extends Model
{
    protected $connection = 'mysql_sa';

    protected $table = 'student_x_identify';

    protected $fillable = ['student_id','identity_id'];

    public function identities()
    {
        //return $this->belongsToMany(Identity::class, 'student_x_identify')->withTimestamps();
        return $this->belongsTo(Identity::class,'id','identity_id');
    }

    public function students()
    {
        //return $this->belongsToMany(Student::class, 'student_x_identify')->withTimestamps();
        return $this->belongsTo(Student::class,'id','student_id');
    }
}
