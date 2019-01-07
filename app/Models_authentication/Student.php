<?php

namespace App\Models_authentication;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $connection = 'mysql_sa';

    protected $fillable = ['name','cpf','assumed_name'];
}
