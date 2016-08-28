<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use app\Customer;

class UpdateCustomer extends FormRequest
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
        $customer_id = $this->segment(2);

        $rules = Customer::$rules;
        $rules['email'] = 'required|unique:customers,email,' . $customer_id;

        return $rules; 
    }
}
