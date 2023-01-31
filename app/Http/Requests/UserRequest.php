<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request; // 追加
use Illuminate\Validation\Rule; // 追加

class UserRequest extends FormRequest
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
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'profile' => ['nullable', 'max:1000'],
            'name' =>['required', 'max:255'],
        ];
     
    } 
    
    
    
    
    public function message()
    {
        return [
            'name'=>'名前は必須です。'
        ];
    }
}
