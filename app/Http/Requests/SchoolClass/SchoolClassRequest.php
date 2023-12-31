<?php

namespace App\Http\Requests\SchoolClass;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SchoolClassRequest extends FormRequest
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
                    'name' => 'required|string|max:255|unique:school_classes',
                    'status' => 'required'
                ];
            case 'PATCH':
                return [
                    'status' => 'required',
                    'name' => [
                        'required',
                        'string',
                        'max:255',
                        Rule::unique('school_classes', 'name')->ignore($this->id), // Ignore the current user
                    ],
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên lớp.',
            'name.string' => 'Tên lớp phải là chuỗi kí tự',
            'name.max' => 'Tên lớp không được vượt quá :max ký tự.',
            'name.unique' => 'Tên lớp đã tồn tại, vui lòng chọn một tên lớp khác.',

            'status.required' => 'Vui lòng nhập trạng thái.',
        ];
    }
}
