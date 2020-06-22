<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History_Attdance extends Model
{
    protected $table="history_attendance";
    protected $fillable = ['id_member', 'ip', 'id_phone', 'image','created_at', 'updated_at'];
}
