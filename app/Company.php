<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "company_user";
    protected $fillable = [
        'name', 'email', 'address','phone','facebook','zalo','date_start','date_end','date_sell','avatar','type'
    ];
}
