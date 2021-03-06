<?php

namespace App\Http\Requests;

use App\Models\Adjustment;
use Illuminate\Foundation\Http\FormRequest;

class AdjustmentRequest extends FormRequest
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
        return Adjustment::$rules;
    }
}
