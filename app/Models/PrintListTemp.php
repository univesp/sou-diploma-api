<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintListTemp extends Model
{
    protected $table = 'print_list_temp';

    protected $fillable = [
        'status_impress'
    ];
}
