<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'marks' => 'required | array',
            'marks.*.exam_id' => 'required|exists:exams,id',
            'marks.*.student_master_id' => 'required|exists:student_master,id',
            'marks.*.class_id' => 'required|exists:classes,id',
            'marks.*.section_id' => 'required|exists:sections,id',
            'marks.*.subject_id' => 'required|exists:subjects,id'
        ];
    }

    public function attributes()
    {
        return  [
            'exam_id' => 'Exam',
            'student_master_id' => 'Student',
            'class_id' => 'Class',
            'section_id' => 'Section',
            'subject_id' => 'Subject',
        ];
    }
}
