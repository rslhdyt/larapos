<?php

namespace App\Http\Requests;

use App\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
        $rules = Supplier::$rules;
        $supplier = $this->route('supplier');

        if ($this->route()->getName() == 'suppliers.update') {
            $rules['email'] = 'required|unique:suppliers,email,' . $supplier->id;
        }

        return $rules;
    }
}
