<?php

namespace App\Http\Controllers\Api;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Roles;
use App\Models\StaffMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends BaseController
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::with('roles')->whereHas('roles', function($q) {
            $q->whereIn('id', [2, 3, 4]);
        })->paginate(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
       
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request['name'];
            $user->gender = $request['gender'];
            $user->email = $request['email'];
            $user->address = $request['address'];
            $user->username = $request['username'];
            $user->phone = $request['phone'];
            $user->city_id = $request['city_id'];
            $user->code = strtoupper(Str::random(10));
            $user->image_url = GlobalHelper::getDefaultImage();
            $user->dob = Carbon::parse($request['dob'])->format('Y-m-d');
            if ($request->file('image')) {
                $user->image_url = $request->file('image')->store('public/uploads/profile');
            }
            $user->password = Hash::make($request['password']);
            $user->save();

            $role = Roles::find($request['role_id']);
            $user->roles()->save($role);

            $user->load('roles');

            if ($request['role_id'] === Roles::TEACHER) {
                $staff = new StaffMaster();
                $staff->code = date('Y/m/d'). '/' . $user->id;
                $staff->emp_date = Carbon::parse($request['emp_date'])->format('Y-m-d');
                $staff->user_id = $user->id;
                $staff->save();
                $user->load('staff');
            }

            DB::commit();

            return $this->success($user, 'User created succssfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('User creation failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $class
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('roles');

        if ($user->roles()->find(Roles::TEACHER)) {
            $user->load('staff');
        }

        return $this->success($user, 'User retrieved successfully.');
    }

    /**
     * Update Resource
     *
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->name = $request['name'];
            $user->gender = $request['gender'];
            $user->email = $request['email'];
            $user->address = $request['address'];
            $user->username = $request['username'];
            $user->phone = $request['phone'];
            $user->city_id = $request['city_id'];
            $user->code = strtoupper(Str::random(10));
            $user->image_url = GlobalHelper::getDefaultImage();
            $user->dob = Carbon::parse($request['dob'])->format('Y-m-d');
            if ($request->file('image')) {
                $user->image_url = $request->file('image')->store('public/uploads/profile');
            }
            $user->password = $request->has('password') ? Hash::make($request['password']) : $user->password;
            $user->save();
            
            $role = Roles::find($request['role_id']);
            $user->roles()->sync($role);
            $user->load('roles');

            if ($request['role_id'] === Roles::TEACHER) {
                $staff = $user->load('staff')->staff;
                $staff->code = date('Y/m/d'). '/' . $user->id;
                $staff->emp_date = Carbon::parse($request['emp_date'])->format('Y-m-d');
                $staff->user_id = $user->id;
                $staff->save();
            }

            DB::commit();

            return $this->success($user, 'User Updated succssfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('User Updation failure');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return $this->success($user, 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('User deletion failure');
        }
    }
}
