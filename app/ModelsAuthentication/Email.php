<?php

namespace App\ModelsAuthentication;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    // protected $connection = 'mysql_sa';
    protected $fillable = ['email','email_type'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_x_emails')->withTimestamps();
    }
}
