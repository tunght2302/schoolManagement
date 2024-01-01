<?php

namespace App\Http\Requests\SchoolSubject;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SchoolSubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|string|max:255|unique:school_subjects',
                    'school_subject_type_id' => 'required',
                    'status' => 'required',
                ];
            case 'PATCH':
                return [
                    'name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('school_subjects', 'name')->ignore($this->id), // Ignore the current user
                    ],
                    'school_subject_type_id' => 'required',
                    'status' => 'required',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên môn học.',
            'name.string' => 'Tên môn học phải là chuỗi kí tự',
            'name.max' => 'Tên môn học không được vượt quá :max ký tự.',
            'name.unique' => 'Tên môn học đã tồn tại, vui lòng chọn một tên môn học khác.',

            'school_subject_type_id.required' => 'Vui lòng nhập loại môn học.',

            'status.required' => 'Vui lòng nhập trạng thái.',
        ];
    }
}