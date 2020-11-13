<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\ClassTypeController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ExamRecordsController;
use App\Http\Controllers\Api\GradesController;
use App\Http\Controllers\Api\MarksController;
use App\Http\Controllers\Api\SectionsController;
use App\Http\Controllers\Api\Select2Controller;
use App\Http\Controllers\Api\StudentMasterController;
use App\Http\Controllers\Api\SubjectsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('v1')->group(function() {
    // Route::post('login', 'Api\AuthController@login');
    // Route::post('register', 'Api\AuthController@register');

    Route::group(['middleware' => 'auth:api'], function() {
        
        Route::get('getUser',  [AuthController::class, 'getUser']);
        Route::get('select2Classes', [Select2Controller::class, 'getSelect2Classes']);
        Route::get('select2Sections', [Select2Controller::class, 'getSelect2Sections']);
        Route::get('select2Parents', [Select2Controller::class, 'getSelect2Parents']);
        Route::get('select2City', [Select2Controller::class, 'getSelect2City']);
        Route::get('select2ClassTypes', [Select2Controller::class, 'getSelect2ClassTypes']);
        Route::get('select2Staffs', [Select2Controller::class, 'getSelect2Staffs']);
        Route::get('select2GradeRemarks', [Select2Controller::class, 'getSelect2GradeRemarks']);
        Route::get('select2Subjects', [Select2Controller::class, 'getSelect2Subjects']);
        Route::get('select2Exams', [Select2Controller::class, 'getSelect2Exams']);
        Route::get('studentWithMarks', [MarksController::class, 'listStudentsWithMarks']);
        Route::get('viewMarksheet', [MarksController::class, 'viewMarksheet']);

        Route::resource('user', UserController::class);

        Route::resource('class', ClassController::class);

        Route::resource('section', SectionsController::class);

        Route::resource('grade', GradesController::class);

        Route::resource('subject', SubjectsController::class);

        Route::resource('exam', ExamController::class);

        Route::resource('mark', MarksController::class);

        Route::resource('exam-record', ExamRecordsController::class);

        Route::resource('classType', ClassTypeController::class);

        Route::resource('student', StudentMasterController::class);

        Route::get('student/list-my-childrens', [StudentMasterController::class, 'listChildrens']);
       
    });
});