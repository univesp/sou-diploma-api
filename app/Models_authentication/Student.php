<?php

namespace App\Models_Authentication;

use Illuminate\Database\Eloquent\Model;
use Faker\Provider\fa_IR\Address;

class Student extends Model
{
    //protected $connection = 'mysql_sa';

    protected $fillable = ['name','cpf','assumed_name'];

    public function identities()
    {
        return $this->belongsToMany(Identity::class, 'student_x_identify', 'identity_id', 'student_id')->withTimestamps();
        //return $this->belongsToMany(Identity::class,'student_x_identify');
    }
    public function parentages()
    {
        return $this->belongsToMany(Parentage::class, 'student_x_parentage')->withTimestamps();
    }
    public function addresses()
    {
        return $this->belongsTo(Address::class)->withTimestamps();
    }

}
