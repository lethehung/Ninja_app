<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = "configuration_cpny";
    protected $fillable = [
        'email', 'time_start', 'time_end','work_schedule','ip','location','id_cpny'
    ];
}
