<?php

namespace App\ModelsAuthentication;

use Illuminate\Database\Eloquent\Model;

class Parentage extends Model
{
    protected $connection = 'mysql_sa';
    protected $fillable = ['name', 'gender'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_x_parentage')->withTimestamps();
    }

    public function parentage_types()
    {
        return $this->belongsTo(Parentage::class, 'parentage_type_id')->withTimestamps();
    }

    // Logic Bussiness
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
