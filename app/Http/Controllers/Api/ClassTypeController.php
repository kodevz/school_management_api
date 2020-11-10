<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ClassTypeRequest;
use App\Models\ClassTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassTypeController extends BaseController
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
    public function store(ClassTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            $classType = new ClassTypes();
            $classType->name = $request['name'];
            $classType->code = $request['code'];
            $classType->save();
            DB::commit();

            return $this->success($classType, 'Successfully Created Class Type');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Class Type creation failure');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ClassTypes $classType
     * @return \Illuminate\Http\Response
     */
    public function show(ClassTypes $classType)
    {
        return $this->success($classType, 'Classtype retrieved successfully.');
    }

    /**
     * Update Resource
     *
     * @param ClassTypeRequest $request
     * @param ClassTypes $classType
     * @return \Illuminate\Http\Response
     */
    public function update(ClassTypeRequest $request, ClassTypes $classType)
    {
        DB::beginTransaction();
        try {
            $classType->name = $request['name'];
            $classType->code = $request['code'];
            $classType->save();
            DB::commit();

            return $this->success($classType, 'Classtype update successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Classtype updation failure');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ClassTypes $classType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassTypes $classType)
    {
        DB::beginTransaction();
        try {
            $classType->delete();
            DB::commit();
            return $this->success($classType, 'Classtype deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return $this->error('Classtype deletion failure');
        }
    }
}
