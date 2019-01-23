<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class StudentAudit extends Model
{
    protected $connection = 'mysql_sa';

    protected $table = 'students';

    protected $fillable = [
        'id',
        'name', 
        'academic_register'
    ];

    protected $sorted = [
        'id',
        'name', 
        'academic_register'
    ];

    protected $guarded = [
        'id', 
        'created_at', 
        'update_at'
    ];

    protected $hidden = [
        'id', 
        'created_at', 
        'update_at'
    ];
    
}
