<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaffMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'staff_master';

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
