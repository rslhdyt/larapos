<?php

namespace App\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRole extends FormRequest
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
        $role_id = $this->segment(3);

        $rules = Role::$rules;
        $rules['name'] = 'required|unique:roles,name,'.$role_id;
        $rules['permission_ids'] = 'required';

        return $rules;
    }

    public function messages()
    {
        return [
            'permission_ids.required' => 'The permissions field is required.',
        ];
    }
}
