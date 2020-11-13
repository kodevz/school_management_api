<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\MarksRequest;
use App\Models\Marks;
use App\Models\StudentMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarksController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarksRequest $request)
    {

        DB::beginTransaction();
        try {
            $marks = [];
            foreach ($request['marks'] as $key => $mark) {
                $mark['total_mark'] = $mark['mark1'] + $mark['mark2'] + $mark['mark3'];
                $mark['year'] = date('Y');
                $markId = $mark['mark_id'];
                if ($markId) {
                    unset($mark['mark_id']);
                    Marks::where('id', $markId)->update($mark);
                } else {
                    Marks::insert($mark);
                }
            }
            DB::commit();
            return $this->success([], 'Mark created succssfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Marks $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Marks $mark)
    {
        return $this->success($mark, 'Mark retrieved successfully.');
    }

    /**
     * Update Resource
     *
     * @param MarksRequest $request
     * @param Marks $mark
     * @return \Illuminate\Http\Response
     */
    public function update(MarksRequest $request, Marks $mark)
    {
        DB::beginTransaction();
        try {
            $mark->student_master_id = $request['student_master_id'];
            $mark->subject_id = $request['subject_id'];
            $mark->class_id = $request['class_id'];
            $mark->section_id = $request['section_id'];
            $mark->exam_id = $request['exam_id'];
            $mark->mark1 = $request['mark1'];
            $mark->mark2 = $request['mark2'];
            $mark->mark3 = $request['mark3'];
            $mark->total_mark = $request['mark1'] + $request['mark2'] + $request['mark3'];
            $mark->save();
            DB::commit();

            return $this->success($mark, 'Mark update successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Mark updation failure');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Marks $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Marks $mark)
    {
        DB::beginTransaction();
        try {
            $mark->delete();
            DB::commit();
            return $this->success($mark, 'Mark deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Mark deletion failure');
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function listStudentsWithMarks(Request $request)
    {
        $selectFields = "
            student_master.*,
            users.name as student_name,
            marks.id as mark_id,
            marks.exam_id,
            marks.subject_id,
            marks.mark1,
            marks.mark2,
            marks.mark3,
            marks.total_mark,
            marks.grade_id,
            exams.name as exam_name,
            subjects.name as subject_name,
            classes.name as class_name,
            sections.name as section_name
        ";
        $studentMaster = StudentMaster::select(DB::raw($selectFields))->leftJoin('marks', function ($join) use ($request) {
            $join->on('marks.student_master_id', '=', 'student_master.id');
            $join->where('exam_id', $request['exam_id']);
            $join->where('subject_id', $request['subject_id']);
        })
            ->join('users', 'users.id', '=', 'student_master.user_id')
            ->leftJoin('exams', 'exams.id', '=', 'marks.exam_id')
            ->leftJoin('subjects', 'subjects.id', '=', 'marks.subject_id')
            ->leftJoin('classes', 'classes.id', '=', 'student_master.class_id')
            ->leftJoin('sections', 'sections.id', '=', 'student_master.section_id');

        if ($request->has('class_id')) {
            $studentMaster->where('student_master.class_id', $request['class_id']);
        }

        if ($request->has('section_id')) {
            $studentMaster->where('student_master.section_id', $request['section_id']);
        }

        return $this->success($studentMaster->get(), 'Student with marks retrieved successfully.');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function viewMarksheet(Request $request)
    {
        try {
            $marksheet =  Marks::with('class', 'section', 'student.user', 'subject', 'grade');

            if ($request->has('student_master_id')) {
                $marksheet = $marksheet->where('student_master_id', $request['student_master_id']);
            }

            if ($request->has('exam_id')) {
                $marksheet = $marksheet->where('exam_id', $request['exam_id']);
            }

            return $this->success($marksheet->get(), 'Student Marksheet retrieved successfully.');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
