<?php

namespace App\Models_authentication;

use Illuminate\Database\Eloquent\Model;

class IdentityType extends Model
{
    //protected $connection = 'mysql_sa';

    protected $fillable = ['id','name'];
    
    public function identities()
    {
        return $this->belongsToMany(Identity::class, 'student_x_identify')->withTimestamps();
        //return $this->hasMany(Identity::class);
    }

}