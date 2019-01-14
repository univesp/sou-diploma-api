<?php

namespace App\ModelsAuthentication;

use Illuminate\Database\Eloquent\Model;

class IdentityType extends Model
{
    //protected $connection = 'mysql_sa';

    protected $fillable = ['id','name'];
    
    public function identities()
    {
        return $this->belongsToMany(Identity::class)->withTimestamps();
    }

}