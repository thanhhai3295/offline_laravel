<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $table = 'setting';
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
        $task = '';
        if($this->setting_email) $task = 'setting-email';
        if($this->setting_main) $task = 'setting-main';
        if($this->setting_social) $task = 'setting-social';
        switch ($task) {
            case 'setting-main':        
                return [
                    'thumb'     => 'bail|image|max:500',
                    'hotline'   => 'bail|required|numeric|min:9',
                    'copyright' => 'bail|required',
                    'time_work' => 'bail|required',
                    'address'   => 'bail|required',
                    'intro'     => 'bail|required'
                ];
                break;
            case 'setting-email':
                return [
                    'email'     => 'bail|required|email',
                    'password'  => 'bail|required|min:5',
                    'cc'        => 'nullable|email',
                    'title'     => 'bail|required|min:5',
                    'content'   => 'bail|required|min:5'
                ];
                break;
            case 'setting-social':
                return [
                    'facebook'  => 'bail|required|url',
                    'youtube'   => 'bail|required|url',
                    'twitter'   => 'bail|required|url'
                ];
                break;
            default:
                break;
        }
        
        return [
            'username' => $condUserName,
            'email'    => $condEmail,
            'fullname' => $condFullname,
            'status'   => $condStatus,
            'password' => $condPass,
            'level'    => $condLevel,
            'avatar'   => $condAvatar,
            'current_password' => $condCurrentPass
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
