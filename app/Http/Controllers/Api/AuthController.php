<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    /**
     * Get Auth User
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        $id =  Auth::user()->id;
        return User::with('roles', 'student')->find($id);
    }
}
