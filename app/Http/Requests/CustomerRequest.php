<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $rules = Customer::$rules;
        $customer = $this->route('customer');

        if ($this->route()->getName() == 'customers.update') {
            $rules['email'] = 'required|unique:customers,email,' . $customer->id;
        }

        return $rules;
    }
}
