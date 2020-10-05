<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $table = 'menu';
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
        $id = $this->id;
        $condName = "bail|required|min:4|unique:$this->table,name";
        if(!empty($id)) {
            $condName .= ",$id";
        }
        return [
            'name' => $condName,
            'status' => 'bail|in:active,inactive',
            'ordering' => 'bail|required|numeric',
            'type' => 'bail|in:direct,category',
            'link' => 'bail|required|url|min:5',
        ];
    }
    public function messages()
    {
        return [
            // 'name.required' => 'Vui long nhap tieu de',
            // 'name.min' => ':input co it nhat :min ky tu'
        ];
    }
    public function attributes()
    {
        return [
            // 'description' => 'description:'
        ];
    }
}
