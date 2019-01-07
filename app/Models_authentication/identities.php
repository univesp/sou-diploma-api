<?php

namespace App\Models_authentication;

use Illuminate\Database\Eloquent\Model;

class identities extends Model
{
    protected $connection = 'mysql_sa';

    protected $fillable = ['number'];
}
