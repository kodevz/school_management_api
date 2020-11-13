<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\GradesRequest;
use App\Models\Grades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Grades::with('classType')->paginate(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradesRequest $request)
    {
        DB::beginTransaction();
        try {
            $grade = new Grades();
            $grade->name = $request['name'];
            $grade->class_type_id = $request['class_type_id'];
            $grade->mark_from = $request['mark_from'];
            $grade->mark_to = $request['mark_to'];
            $grade->remark = $request['remark'];
            $grade->save();
            DB::commit();

            return $this->success($grade, 'Grade created succssfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Grade creation failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Grades $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grades $grade)
    {
        return $this->success($grade, 'Grade retrieved successfully.');
    }

    /**
     * Update Resource
     *
     * @param GradesRequest $request
     * @param Grades $grade
     * @return \Illuminate\Http\Response
     */
    public function update(GradesRequest $request, Grades $grade)
    {
        DB::beginTransaction();
        try {
            $grade->name = $request['name'];
            $grade->class_type_id = $request['class_type_id'];
            $grade->mark_from = $request['mark_from'];
            $grade->mark_to = $request['mark_to'];
            $grade->remark = $request['remark'];
            $grade->save();
            DB::commit();

            return $this->success($grade, 'Grade update successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Grade updation failure');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Grades $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grades $grade)
    {
        DB::beginTransaction();
        try {
            $grade->delete();
            DB::commit();
            return $this->success($grade, 'Grade deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Grade deletion failure');
        }
    }
}
