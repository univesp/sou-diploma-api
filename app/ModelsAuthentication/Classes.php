<?php

namespace App\ModelsAuthentication;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $connection = 'mysql_sa';

    protected $fillable = ['name', 'period', 'period', 'year_entry', 'semester'];

    public function courses()
    {
        return $this->belongsTo(Courses::class, 'course_id')->withTimestamps();
    }

    public function Locations()
    {
        return $this->belongsTo(Locations::class, 'Locations_id')->withTimestamps();
    }

    // Logic Bussiness
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
