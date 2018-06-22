<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = Product::$rules;
        $product = $this->route('product');

        if ($this->route()->getName() == 'products.update') {
            $rules['barcode'] = 'required|unique:products,barcode,' . $product->id;
        } else {
            $rules['quantity'] = 'required|numeric';
        }

        return $rules;
    }
}
