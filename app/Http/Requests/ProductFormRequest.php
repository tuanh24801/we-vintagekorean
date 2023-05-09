<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'string',
            'original_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'colors' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png ',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Bắt buộc phải nhập tên sản phẩm',
            'name.string' => 'Sai định dạng chuỗi',
            'description.string' => 'Mô tả phải là định dạng chuỗi',
            'original_price.required' => 'Giá gốc bắt buộc phải nhập',
            'original_price.numeric' => 'Giá gốc phải là dạng số',
            'selling_price.required' => 'Giá bán bắt buộc phải nhập',
            'selling_price.numeric' => 'Giá bán phải là dạng số',
            'colors.required' => 'Bắt buộc phải chọn màu sắc',
            'image.required' => 'Bắt buộc phải chọn ảnh cho sản phẩm',
            'image.mimes' => 'Định dạng ảnh vd:jpeg,jpg,png, ...',
        ];
    }
}
