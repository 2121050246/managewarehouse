<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product' => 'required',
            'category' => 'required',
            'supplier' => 'required',
            'warehouse' => 'required',
            'number' => 'required|integer',
            'file' => 'required|file',
            'description' => 'required',


        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Vui lòng nhập thông tin :attribute ',
            'max' => 'Nhập quá số lượng 1000 cho phép',
            'integer' => 'Vui lòng nhập số nguyên' ,
            'file' => 'Vui lòng nhập đúng file'


        ];
    }
    public function attributes(): array
    {
        return [
            'product' => 'sản phẩm',
            'category' => 'loại hàng',
            'supplier' => 'nhà cung cấp',
            'warehouse' => 'nhà kho',
            'number' => 'số lượng',
            'file' => 'hình ảnh',
            'description' => 'mô tả',

        ];
    }
}
