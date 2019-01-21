<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTemp extends Model
{
    // Protected table name
    protected $table = 'user_temp';

    protected $fillable = ['name'];
}
