<?php

namespace App\Models_Authentication;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
   // protected $connection = 'mysql_sa';

    protected $fillable = ['id','number'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_x_identify', 'student_id', 'identity_id')->withTimestamps();
        //return $this->belongsToMany(Student::class, 'student_x_identify');
    }

    public function identity_types()
    {
        //return $this->belongsToMany(Identity::class, 'student_x_identify')->withTimestamps();
        return $this->belongsTo(Identity::class,'identity_type_id', 'id')->withTimestamps();
    }
}