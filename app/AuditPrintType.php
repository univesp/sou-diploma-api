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
        'create_at', 'update_at'
    ];

    protected $hidden = [
        'id'
    ];

    public function universityDegreePrints()
    {
        return $this->belongsTo(AuditUniversityDegreePrint::class);
    }
}
