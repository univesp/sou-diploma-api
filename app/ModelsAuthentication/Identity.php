<?php

namespace App\ModelsAuthentication;

use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    protected $connection = 'mysql_sa';
    protected $fillable = ['number'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_x_identify')->withTimestamps();
    }

    public function identityTypes()
    {
        //return $this->belongsToMany(Identity::class, 'student_x_identify')->withTimestamps();
        return $this->belongsTo(Identity::class, 'identity_type_id')->withTimestamps();
    }

    // Logic Bussiness
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
