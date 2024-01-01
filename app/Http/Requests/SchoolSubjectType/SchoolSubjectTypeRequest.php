<?php

namespace App\Http\Requests\SchoolSubjectType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SchoolSubjectTypeRequest extends FormRequest
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
                    'name' => 'required|string|max:255|unique:school_subject_types',
                ];
            case 'PATCH':
                return [
                    'name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('school_subject_types', 'name')->ignore($this->id), // Ignore the current user
                    ],
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên loại môn học.',
            'name.string' => 'Tên loại môn học phải là chuỗi kí tự',
            'name.max' => 'Tên loại môn học không được vượt quá :max ký tự.',
            'name.unique' => 'Tên loại môn học đã tồn tại, vui lòng chọn một tên loại môn học khác.',
        ];
    }
}
