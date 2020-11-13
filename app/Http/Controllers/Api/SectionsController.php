<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionsRequest;
use App\Models\Sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionsController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sections::with('class', 'staff.user')->paginate(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SectionsRequest $request)
    {
        DB::beginTransaction();
        try {
            $section = new Sections();
            $section->name = $request['name'];
            $section->class_id = $request['class_id'];
            $section->teacher_id = $request['teacher_id'];
            $section->save();
            DB::commit();

            return $this->success($section, 'Section created succssfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Section creation failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Sections $section
     * @return \Illuminate\Http\Response
     */
    public function show(Sections $section)
    {
        return $this->success($section, 'Section retrieved successfully.');
    }

    /**
     * Update Resource
     *
     * @param SectionsRequest $request
     * @param Sections $section
     * @return \Illuminate\Http\Response
     */
    public function update(SectionsRequest $request, Sections $section)
    {
        DB::beginTransaction();
        try {
            $section->name = $request['name'];
            $section->class_id = $request['class_id'];
            $section->teacher_id = $request['teacher_id'];
            $section->save();
            DB::commit();

            return $this->success($section, 'Section update successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Section updation failure');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sections $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sections $section)
    {
        DB::beginTransaction();
        try {
            $section->delete();
            DB::commit();
            return $this->success($section, 'Class deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Class deletion failure');
        }
    }
}
