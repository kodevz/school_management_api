<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'student_master';

    public function class()
    {
        return $this->hasOne('App\Models\Classes', 'id', 'class_id');
    }

    public function section()
    {
        return $this->hasOne('App\Models\Sections', 'id', 'section_id');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\User', 'id', 'parent_id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
