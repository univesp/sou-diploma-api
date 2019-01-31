<?php

namespace App\ModelsAuthentication;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $connection = 'mysql_sa';

    protected $fillable = ['name', 'cpf', 'assumed_name'];

    public function identities()
    {
        return $this->belongsToMany(Identity::class, 'student_x_identify', 'student_id', 'identity_id')->withTimestamps();
    }

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'student_x_emails')->withTimestamps();
    }

    public function parentages()
    {
        return $this->belongsToMany(Parentage::class, 'student_x_parentage')->withTimestamps();
    }

    public function addresses()
    {
        return $this->belongsTo(Address::class)->withTimestamps();
    }

    // Logic Bussiness
    public function getTableColumns()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
