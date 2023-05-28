<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryAssetsRequest extends FormRequest
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
            'category_asset_name' => 'required|max:255',
        ];
    }
    public function messages(): array
    {
        return [
            'category_asset_name.required' => 'Vui lòng nhập tên loại tài sản',
            'category_asset_name.max' => 'Giới hạn 255 ký tự'
        ];
    }
}
