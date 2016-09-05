<?php

namespace App\Http\Requests;

use App\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplier extends FormRequest
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
        $supplier_id = $this->segment(2);

        $rules = Supplier::$rules;
        $rules['email'] = 'required|unique:customers,email,'.$supplier_id;

        return $rules;
    }
}
