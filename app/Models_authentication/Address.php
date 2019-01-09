<?php

namespace App\Models_authentication;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $connection = 'mysql_sa';

    protected $fillable = ['street','neighborhood','street_number','zipcode','street_complement','state','street_type'];
}
