<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'name' => 'required:min:3',
            'city' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'address' => 'required',
            'phone' => 'required',


        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập thông tin  :attribute',
            'min' => 'Nhập không quá ít hơn 3 ký tự',


        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'tên nhà phân phối',
            'city' => 'thành phố',
            'district' => 'quận/huyện',
            'ward' => 'xã/phường',
            'address' => 'số nhà',
            'phone' => 'số điện thoại',



        ];
    }
}
