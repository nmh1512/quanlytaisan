<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeAssetsRequest extends FormRequest
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
            'name' => 'required|max:255',
            'category_asset_id' => 'required',
            'brand' => 'required|max:255',
            'year' => 'required',
            'unit' => 'required|max:255',
        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Tên chủng loại tài sản',
            'category_asset_id' => 'Loại tài sản',
            'brand' => 'Hãng sản xuẩt',
            'year' => 'Năm sản xuất',
            'unit' => 'Đơn vị tính',
        ];
    }
    public function messages(): array
    {
        $text = 'Vui lòng nhập :attribute';
        $select = 'Vui lòng chọn :attribute';

        $max = 'Giới hạn :max ký tự';
        return [
            'name.required' => $text,
            'name.max' => $max,
            'category_asset_id.required' => $select,
            'brand.required' => $text,
            'brand.max' => $max,
            'year.required' => $select,
            'unit.required' => $text,
            'unit.max' => $max,

        ];
    }
}
