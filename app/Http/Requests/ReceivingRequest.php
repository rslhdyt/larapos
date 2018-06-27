<?php

namespace App\Http\Requests;

use App\Models\Receiving;
use Illuminate\Foundation\Http\FormRequest;

class ReceivingRequest extends FormRequest
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

    public function all($attribute = [])
    {
        $data = parent::all();

        $data['user_id'] = $this->user()->id;

        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = Receiving::$rules;

        if ($this->route()->getName() == 'receivings.update') {
            $rules = array_only($rules, ['supplier_id']);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'items.min' => 'Please add 1 or more item product.'
        ];
    }
}
