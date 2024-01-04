<?php

namespace App\Http\Requests\ClassSubject;

use Illuminate\Foundation\Http\FormRequest;

class ClassSubjectRequest extends FormRequest
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
                    'school_class_id' => 'required|exists:school_classes,id',
                    'school_subject_id' => 'required|array|min:1',
                    'school_subject_id.*' => 'required|exists:school_subjects,id',
                ];
            case 'PATCH':
                return [
                    'school_class_id' => 'exists:school_classes,id',
                    'school_subject_id' => 'required|min:1',
                ];
        }
    }

    public function messages(): array
    {
        return [
            'school_class_id.required' => 'Vui lòng chọn lớp học.',
            'school_class_id.exists' => 'Lớp học không tồn tại.',
            'school_subject_id.required' => 'Vui lòng chọn ít nhất một môn học.',
            'school_subject_id.array' => 'Dữ liệu môn học không hợp lệ.',
            'school_subject_id.min' => 'Vui lòng chọn ít nhất một môn học.',
            'school_subject_id.*.required' => 'Vui lòng chọn ít nhất một môn học.',
            'school_subject_id.*.exists' => 'Môn học không tồn tại.',
        ];
    }
}
