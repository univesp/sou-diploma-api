<?php

namespace App\Models_Authentication;

use Illuminate\Database\Eloquent\Model;

class Parentage_types extends Model
{
    // protected $connection = 'mysql_sa';

    protected $fillable = ['id'];

     public function parentage()
    {
        return $this->belongsToMany(Parentage::class)->withTimestamps();
        
    }

}
