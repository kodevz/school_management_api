<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectsRequest;
use App\Models\StudentMaster;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Subjects::with('class','staff.user')->paginate(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectsRequest $request)
    {
        DB::beginTransaction();
        try {
            $subject = new Subjects();
            $subject->name = $request['name'];
            $subject->class_id = $request['class_id'];
            $subject->slug = $request['slug'];
            $subject->teacher_id = $request['teacher_id'];
            $subject->save();
            DB::commit();

            return $this->success($subject, 'Subject created succssfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Subject creation failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Subjects $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subjects $subject)
    {
        return $this->success($subject, 'Subject retrieved successfully.');
    }

    /**
     * Update Resource
     *
     * @param SubjectsRequest $request
     * @param Subjects $subject
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectsRequest $request, Subjects $subject)
    {
        DB::beginTransaction();
        try {
            $subject->name = $request['name'];
            $subject->class_id = $request['class_id'];
            $subject->slug = $request['slug'];
            $subject->teacher_id = $request['teacher_id'];
            $subject->save();
            DB::commit();

            return $this->success($subject, 'Subject update successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Subject updation failure');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Subjects $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subjects $subject)
    {
        DB::beginTransaction();
        try {
            $subject->delete();
            DB::commit();
            return $this->success($subject, 'Subject deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Subject deletion failure');
        }
    }
}
