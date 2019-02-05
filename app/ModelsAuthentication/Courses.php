<?php

namespace App\ModelsAuthentication;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $connection = 'mysql_sa';

    protected $fillable = ['name', 'duration_semesters', 'course_type'];

    public function classes()
    {
        return $this->belongsToMany(Classes::class)->withTimestamps();
    }

    // Logic Bussiness
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
