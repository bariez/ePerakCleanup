<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest implements \Laravolt\Epicentrum\Contracts\Requests\Account\Store
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
            'name'     => 'required|max:255',
            // 'email'    => 'required|email|unique:users',
            'email'    => 'required|email|unique:users|regex:/(.*)@*.gov\.my/i|unique:users|',
            // 'password' => 'required|min:6|max:255',
            // 'password' => 'required|string|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&.~`^()-_+={}:;<>])[A-Za-z\d@$!%*#?&.~`^()-_+={}:;<>]{8,}$/|max:255',
             'password' => [
                     'required', 
                     'regex:/^(?=.*[A-Z])(?=.*\d).*$|^(?=.*[@\].])(?=.*\d).*$|^(?=.*[@\].])(?=.*[A-Z]).*$|^[A-Z]$|^[A-Z]{3,}$/',
                     'min:8', 
                   ],
            'status'   => 'required',
       
        ];
        
    }
}
