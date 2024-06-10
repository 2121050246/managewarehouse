<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,user',

        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập  :attribute',
            'email' => 'Vui lòng nhập vào :attribute',
            'unique' => ':attribute đã tồn tại',
            'min' => 'Mật khẩu không ít quá 6 kí tự',
            'in' => 'Chỉ chọn admin hoặc user',

        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'họ và tên ',
            'password' => 'mật khẩu ',
            'role' => 'vai trò'

        ];
    }

}
