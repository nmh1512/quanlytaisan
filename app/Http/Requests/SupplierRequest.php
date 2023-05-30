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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|max:255'
        ];
    }
    public function messages(): array
    {
        return [
            //
            'name.required' => 'Vui lòng nhập tên nhà cung cấp',
            'name.max' => 'Giới hạn :max ký tự'
        ];
    }
}
