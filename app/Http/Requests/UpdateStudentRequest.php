<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
        $studentId = $this->route('student');

        return [
            'avatar' => 'image',
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $studentId,
            'birth_date' => 'required|date',
        ];
    }
}
