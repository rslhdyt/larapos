<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
        $user_id = $this->segment(2);

        $rules = User::$rules;
        $rules['email'] = 'required|unique:users,email,'.$user_id;
        unset($rules['password']);

        return $rules;
    }

    public function messages()
    {
        return [
            'role_id.required' => 'The role field is required.',
        ];
    }
}
