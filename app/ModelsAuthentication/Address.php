<?php

namespace App\ModelsAuthentication;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $connection = 'mysql_sa';

    protected $fillable = ['street', 'neighborhood', 'street_number', 'zipcode', 'street_complement', 'state', 'street_type'];

    public function students()
    {
        return $this->belongsTo(Student::class)->withTimestamps();
    }

    // Logic Bussiness
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
