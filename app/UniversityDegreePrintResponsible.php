<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityDegreePrintResponsible extends Model
{
    // Protected table name
    protected $table = 'university_degree_print_responsibles';

    // Protected fillable or insert
    protected $fillable = [
        'user_id', 
        'university_degree_print_id', 
        'status'
    ];

    // Protected define order
    protected $sorted = [
        'user_id', 
        'university_degree_print_id', 
        'status'
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
