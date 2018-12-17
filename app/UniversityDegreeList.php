<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UniversityDegreeList extends Model
{
    // Protected table name
    protected $table = 'university_degree_lists';

    // Protected fillable or insert
    protected $fillable = [
        'student_id', 
        'status'
    ];

    // Protected define order
    protected $sorted = [
        'student_id', 
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
}
