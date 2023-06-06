<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
         $uniqueEmail = 'unique:users';
         if(session('id')){
            $id = session('id');
            $uniqueEmail = 'unique:users,email,'.$id;
         }


        return [ 
            'name' => 'required | min:5',
            'email'=> 'required |email |'.$uniqueEmail,
            'group_id'=>['required','integer',function($attribute,$value,$fail){
                if($value==0){
                    $fail('グループ選択してください。');
                }
            }],
            'status'=>'required | integer'
            // unique dùng để kiểm tra xem dữ liệu nhập có bị trùng lặp hay không
            //users là nơi chứa dữ liệu

        ];
    }


    public function messages()
    {
        return [
            'name.required'=>'名前入力してください',
            'name.min' => '名前５桁以上入力してください',
            'email.required'=>'email 入力してください',
            'email.email'=>'email正しく入力してください',
            'email.unique'=>'email存在しています',
            'group_id.required'=>'グループ選択してください。',
            'group_id.integer'=>'無効なグループ',
            'status.required'=>'空にしないでください',
            'status.integer'=>'無効なステータス'
        ];
    }
}
