<?php

namespace App\Http\Requests;

use App\Models\UnitOfMeasure;
use Illuminate\Foundation\Http\FormRequest;

class UnitOfMeasureRequest extends FormRequest
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
        $rules = UnitOfMeasure::$rules;
        $unitOfMeasure = $this->route('unit_of_measure');

        if ($this->route()->getName() == 'unit-of-measures.update') {
            $rules['abbreviation'] = 'required|unique:unit_of_measures,abbreviation,' . $unitOfMeasure->id;
        }

        return $rules;
    }
}
