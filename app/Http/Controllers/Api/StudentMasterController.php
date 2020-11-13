<?php

namespace App\Http\Controllers\Api;

use App\Helpers\GlobalHelper;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentMasterRequest;
use App\Models\Roles;
use App\Models\StudentMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentMasterController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $studentMaster = StudentMaster::with('user', 'class', 'section', 'parent');
    
        if ($request->has('parent_id')) {
            $studentMaster = $studentMaster->where('parent_id', $request['parent_id']);
        }
                           
        return $studentMaster->paginate(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentMasterRequest $request)
    {
       
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request['name'];
            $user->gender = $request['gender'];
            $user->email = $request['email'];
            $user->address = $request['address'];
            $user->username = strtoupper(Str::random(10));
            $user->phone = $request['phone'];
            $user->city_id = $request['city_id'];
            $user->code = strtoupper(Str::random(10));
            $user->image_url = GlobalHelper::getDefaultImage();
            $user->dob = Carbon::parse($request['dob'])->format('Y-m-d');
            if ($request->file('image')) {
                $user->image_url = $request->file('image')->store('public/uploads/profile');
            }
            $user->password = Hash::make(strtoupper(Str::random(10)));
            $user->save();

            $role = Roles::find(Roles::STUDENT);
            $user->roles()->save($role);
            $user->load('roles');

            $studentMaster = new StudentMaster();
            $studentMaster->class_id = $request['class_id'];
            $studentMaster->section_id = $request['section_id'];
            $studentMaster->admission_no = $user->id;
            $studentMaster->admission_date = Carbon::parse($request['admission_date'])->format('Y-m-d');
            $studentMaster->year_admitted = Carbon::parse($request['admission_date'])->format('Y');
            $studentMaster->session = Str::random(5);
            $studentMaster->age = GlobalHelper::isset($request['age']);
            $studentMaster->parent_id = GlobalHelper::isset($request['parent_id']);
            $studentMaster->user_id = $user->id;
            $studentMaster->save();

            DB::commit();

            return $this->success($user, 'Student created succssfully.');

        } catch (\Exception $e) {
            DB::rollback();
            
            return $this->error('Student creation failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentMaster = StudentMaster::with('class','section','parent','user.roles')->find($id);
        return $this->success($studentMaster, 'Student retrieved successfully.');
    }

    /**
     * Update Resource
     *
     * @param StudentMasterRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(StudentMasterRequest $request, $id)
    {
        $user = User::find($id);
       
        DB::beginTransaction();
        try {
            $user->name = $request['name'];
            $user->gender = $request['gender'];
            $user->email = $request['email'];
            $user->address = $request['address'];
            $user->phone = $request['phone'];
            $user->city_id = $request['city_id'];
            $user->dob = Carbon::parse($request['dob'])->format('Y-m-d');
            $user->image_url = GlobalHelper::getDefaultImage();
            if ($request->file('image')) {
                $user->image_url = $request->file('image')->store('public/uploads/profile');
            }
            $user->save();
            
            $role = Roles::find(Roles::STUDENT);
            $user->roles()->sync($role);
            $user->load('roles');

            $studentMaster = $user->load('student')->student;
            $studentMaster->class_id = $request['class_id'];
            $studentMaster->section_id = $request['section_id'];
            $studentMaster->admission_date = Carbon::parse($request['admission_date'])->format('Y-m-d');
            $studentMaster->year_admitted = Carbon::parse($request['admission_date'])->format('Y');
            $studentMaster->age = GlobalHelper::isset($request['age']);
            $studentMaster->parent_id = GlobalHelper::isset($request['parent_id']);
            $studentMaster->user_id = $user->id;
            $studentMaster->save();

            DB::commit();

            return $this->success($user, 'Student Updated succssfully.');

        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return $this->error('Student Updation failure');
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

    /**
     * List My Childres
     *
     * @return void
     */
    public function listChildrens() 
    {

    }
}
