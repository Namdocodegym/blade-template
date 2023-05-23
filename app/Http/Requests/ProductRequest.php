<?php

namespace App\Http\Requests;


use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_name' => 'required | min:6',
            'product_price' => 'required | integer',
        ];
    }

    public function messages()
    {
        return [
            //trong trường hợp muốn hiển thị tên tự động thì dùng :attribute 入力してください
        'product_name.required' => ' :attribute 入力してください',
        'product_name.min' => ':attribute 入力 :min 桁以上',
        'product_price.required'=>':attribute 入力してください' ,
        'product_price.integer'=>':attribute 数字入力してください'
        ];
        

    }

    public function attributes()
    {
        return [
            'product_name' => '品名',
            'product_price' => '値段'
        ];
    }

    // xử lý dữ liệu 
    //  "protected" giúp bảo vệ sự riêng tư của thành viên lớp, đồng thời cho phép các lớp con kế thừa và sử dụng chúng
    protected function withValidator($validator){
        $validator->after(function($validator){
            if($validator->errors()->count() > 0){
                $validator->errors()->add('msg','入力エラー、ご確認して下さい！');
            }
        });
    }

    //lọc dữ liệu thay đổi dữ liệu
    protected function  prepareForValidation()
    {
        $this->merge([
            'create_at' => date('Y-m-d H:i:s'),
        ]);
    }
    //thay đổi message khi trang web thông báo lỗi
    protected function failedAuthorization(){
        throw new AuthorizationException('このサイト制限になっております');

        //chuyển hướng trang web phải khai báo use ở trên và thiết lập ở trang cần chuyển,cụ thể dưới đây là trang chủ home
        // throw new HttpResponseException(redirect('/')->with('msg','危険')->with('type','danger'));
    }
}
