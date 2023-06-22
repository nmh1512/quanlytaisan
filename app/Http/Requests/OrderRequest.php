<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
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
            // 'code' => 'required|max:255|unique:orders,code,'. $this->route('id'),

            'code' => [
                'required',
                'max:255',
                Rule::unique('orders', 'code')->ignore($this->route('id'))
            ],
            'supplier_id' => 'required|numeric|max:255',
            'order_date' => 'required|date|before_or_equal:delivery_date',
            'delivery_date' => 'required|date|after_or_equal:order_date|after_or_equal:'.Date::today()->toDateString(),
            'payment_methods' => 'required|numeric',
            'type_asset_id' => 'required',
            'price.*' => 'required|numeric',
            'quantity.*' => 'required|numeric',
            
        ];
    }
    public function attributes(): array
    {
        return [
            'id' => 'Id',
            'code' => 'Mã đơn hàng',
            'supplier_id' => 'Nhà cung cấp',
            'order_date' => 'Ngày đặt hàng',
            'delivery_date' => 'Ngày nhận hàng',
            'payment_methods' => 'Phương thức thanh toán',
            'type_asset_id' => 'Chủng loại tài sản',
            'price.*' => 'Đơn giá',
            'quantity.*' => 'Số lượng',
        ];
    }
    public function messages()
    {
        $required = 'Vui lòng nhập :attribute';
        $requiredChoose = 'Vui lòng chọn :attribute';
        $max = 'Giới hạn :attribute';
        $error = 'Có lỗi xảy ra';
        $numeric = 'Vui lòng nhập số';
        return [
            'id.exists' => ':attribute không tồn tại',

            'code.required' => $required,
            'code.unique' => ':attribute này đã tồn tại',
            'code.max' => $max,

            'supplier_id.required' => $requiredChoose,
            'supplier_id.numeric' => $error,
            'supplier_id.max' => $max,

            'order_date.required' => $requiredChoose,
            'order_date.date' => $error,
            'order_date.before_or_equal' => ':attribute phải nhỏ hơn hoặc bằng ngày nhận hàng',

            'delivery_date.required' => $requiredChoose,
            'delivery_date.date' => $error,
            'delivery_date.after_or_equal' => ':attribute phải lớn hơn hoặc nhỏ hơn ngày nhận hàng',
            'delivery_date.after_or_equal.*' => ':attribute phải lớn hơn hoặc nhỏ hơn hiện tại',

            'payment_methods.required' => $requiredChoose,
            'payment_methods.numeric' => $error,

            'type_asset_id.required' => $requiredChoose,
            'type_asset_id.numeric' => $error,

            'price.*.required' => $required,

            'quantity.*.required' => $required,
            'quantity.*.numeric' => $numeric,
        ];
    }
}
