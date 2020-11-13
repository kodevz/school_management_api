<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marks extends Model
{
    use HasFactory;

    public function class()
    {
        return $this->hasOne('App\Models\Classes', 'id', 'class_id');
    }

    public function section()
    {
        return $this->hasOne('App\Models\Sections', 'id', 'section_id');
    }

    public function student()
    {
        return $this->hasOne('App\Models\StudentMaster', 'id', 'student_master_id');
    }

    public function subject()
    {
        return $this->hasOne('App\Models\Subjects', 'id', 'subject_id');
    }

    public function grade()
    {
        return $this->hasOne('App\Models\Grades', 'id', 'grade_id');
    }
}
