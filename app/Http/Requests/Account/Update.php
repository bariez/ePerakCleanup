<?php

namespace App\Http\Requests\Account;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class Update extends FormRequest implements \Laravolt\Epicentrum\Contracts\Requests\Account\Update
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
    {//
        //$id = request()->route('site::users.update');
        $id = Request::segment(4);

     

        return [
            'name'     => 'required|max:255',
            'email'    => [
                'required',
                'email',
                Rule::unique(auth()->user()->getTable())->ignore($id),
               // 'regex:/(.*)@gov\.my/i',
            ],
            'status'   => 'required',
            //'roles'=>'required_if:status,==,ACTIVE',
            //'Ulasan' => 'required_if:status,==,BLOCKED'
        ];
    }
}
