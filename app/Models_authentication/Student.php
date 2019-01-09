<?php

namespace App\Models_authentication;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //protected $connection = 'mysql_sa';

    protected $fillable = ['name','cpf','assumed_name'];

    public function identities()
    {
        return $this->belongsToMany(Identity::class, 'student_x_identify')->withTimestamps();
        //return $this->belongsToMany(Identity::class,'student_x_identify');
    }
}
