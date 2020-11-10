<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ClassRequest;
use App\Models\Classes;
use Illuminate\Support\Facades\DB;

class ClassController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRequest $request)
    {
        DB::beginTransaction();
        try {
            $class = new Classes();
            $class->name = $request['name'];
            $class->class_type_id = $request['class_type_id'];
            $class->save();
            DB::commit();

            return $this->success($class, 'Class created succssfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Class creation failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Classes $class
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        return $this->success($class, 'Class retrieved successfully.');
    }

    /**
     * Update Resource
     *
     * @param ClassRequest $request
     * @param Classes $class
     * @return \Illuminate\Http\Response
     */
    public function update(ClassRequest $request, Classes $class)
    {
        DB::beginTransaction();
        try {
            $class->name = $request['name'];
            $class->class_type_id = $request['class_type_id'];
            $class->save();
            DB::commit();

            return $this->success($class, 'Class update successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Class updation failure');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Classes $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        DB::beginTransaction();
        try {
            $class->delete();
            DB::commit();
            return $this->success($class, 'Class deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Class deletion failure');
        }
    }
}
