<?php

namespace App\ModelsAuthentication;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $connection = 'mysql_sa';

    protected $fillable = ['name'];

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'locations_id')->withTimestamps();
    }

    // Logic Bussiness
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
