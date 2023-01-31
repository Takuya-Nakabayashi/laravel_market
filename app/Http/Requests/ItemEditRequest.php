<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemEditRequest extends FormRequest
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
    public function rules()
    {
        return [
             'name' => ['required','max:255'],
            'description' => ['required','max:1000'],
            'price' => ['required','regex:/^[0-9]+$/i','between:1,1000000'],
            'category_id' => ['integer', 'min:1', 'max:9','exists:items'],
            
        ];
    }
}
