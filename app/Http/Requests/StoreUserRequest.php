<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // If the user is not admin
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|min:3\regex:/[a-zA-Z]',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // Must contain small letter
                'regex:/[A-Z]/', // Must contain Capital letter
                'regex:/[0-9]/', // 0 - 9 
                'regex:/[@$!#%*&]/' // Special characters
            ],
           'confirm_password' => 'required|same:password',
        ];
    }
}
