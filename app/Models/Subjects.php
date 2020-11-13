<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;

    public function class()
    {
        return $this->hasOne('App\Models\Classes', 'id', 'class_id');
    }

    public function staff()
    {
        return $this->hasOne('App\Models\StaffMaster', 'id', 'teacher_id');
    }
}
