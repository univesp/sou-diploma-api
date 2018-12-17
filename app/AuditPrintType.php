<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditPrintType extends Model
{
    protected $table = 'print_types';

    protected $fillable = [
        'id', 'name'
    ];

    protected $sorted = [
        'id', 'name'
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

    public function auditUniversityDegreePrints()
    {
        return $this->hasMany(AuditUniversityDegreePrint::class);
    }
}
