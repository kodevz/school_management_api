<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    const SUPER_ADMIN = 1;
    const ADMIN = 2;
    const TEACHER = 3;
    const PARENTS = 4;
    const STUDENT = 5;


}
