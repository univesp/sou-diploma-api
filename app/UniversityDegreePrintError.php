<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityDegreePrintError extends Model
{
    // Protected table name
    protected $table = 'university_degree_print_errors';

    // Protected fillable or insert
    protected $fillable = [
        'university_degree_print_id', 
        'serial_number', 
        'reason'
    ];

    // Protected define order
    protected $sorted = [
        'university_degree_print_id', 
        'serial_number', 
        'reason'
    ];

    // Protected guard
    protected $guarded = [
        'id', 
        'created_at', 
        'update_at'
    ];

    // Protected hidden fields
    protected $hidden = [
        'id', 
        'created_at', 
        'update_at'
    ];

    // Relationships
    public function universityDegreePrint()
    {
        return $this->belongsTo(UniversityDegreePrint::class);
    }
}
