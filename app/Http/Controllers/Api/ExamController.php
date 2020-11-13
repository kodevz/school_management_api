<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamRequest;
use App\Models\Exams;
use Illuminate\Support\Facades\DB;

class ExamController extends BaseController
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Exams::paginate(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        DB::beginTransaction();
        try {
            $exam = new Exams();
            $exam->name = $request['name'];
            $exam->term = $request['term'];
            $exam->year = $request['year'];
            $exam->save();
            DB::commit();

            return $this->success($exam, 'Exam created succssfully.');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return $this->error('Exam creation failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Exams $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exams $exam)
    {
        return $this->success($exam, 'Exam retrieved successfully.');
    }

    /**
     * Update Resource
     *
     * @param ExamRequest $request
     * @param Exams $exam
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exams $exam)
    {
        DB::beginTransaction();
        try {
            $exam->name = $request['name'];
            $exam->term = $request['term'];
            $exam->save();
            DB::commit();

            return $this->success($exam, 'Exam update successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Exam updation failure');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Exams $Exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exams $exam)
    {
        DB::beginTransaction();
        try {
            $exam->delete();
            DB::commit();
            return $this->success($exam, 'Exam deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Exam deletion failure');
        }
    }
}
