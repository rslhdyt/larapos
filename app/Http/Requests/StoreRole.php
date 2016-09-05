<?php

namespace App\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
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
        $rules = Role::$rules;
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
