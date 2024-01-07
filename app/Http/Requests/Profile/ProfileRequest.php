<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            case 'PATCH':
                return [
                    'name' => 'required|string|max:255',
                    'email' => [
                        'required',
                        'string',
                        'email',
                        'max:255',
                        Rule::unique('users', 'email')->ignore(Auth::user()->id),
                    ],
                    'password' => 'string|min:8',
                    'address' => 'nullable|string|max:255',
                    'phone' => ['nullable','regex:/^(\+84|0)[0-9]{9,10}$/'],
                    // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên.',
            'name.string' => 'Tên phải là chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá :max ký tự.',

            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.string' => 'Email phải là chuỗi ký tự.',
            'email.email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
            'email.max' => 'Email không được vượt quá :max ký tự.',
            'email.unique' => 'Email đã được sử dụng, vui lòng chọn một email khác.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.string' => 'Mật khẩu phải là chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự.',

            'address.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'address.max' => 'Địa chỉ không được vượt quá :max ký tự.',

            'phone.regex' => 'Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại Việt Nam đúng định dạng.',

            'image.image' => 'Vui lòng nhập ảnh đúng định dạng',
            'image.mimes' => 'Chỉ được nhập ảnh jpeg,png,jpg,gif',
            'image.max' => 'Kích thước ảnh vượt quá :max',
        ];
    }
}