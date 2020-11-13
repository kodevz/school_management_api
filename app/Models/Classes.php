<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    public function classType()
    {
        return $this->hasOne('App\Models\ClassTypes', 'id', 'class_type_id');
    }
}
