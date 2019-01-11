<?php

namespace App\Models_Authentication;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //protected $connection = 'mysql_sa';

    protected $fillable = ['street','neighborhood','street_number','zipcode','street_complement','state','street_type'];

    public function students()
    {
        return $this->belongsTo(Student::class)->withTimestamps();
    }
}
