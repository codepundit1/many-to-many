<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarRequest extends FormRequest
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
        return [
            'title' => ['required', 'string', 'max:255'],
            'driver_id' => ['required', 'integer'],
            'car_number' => ['required', 'integer', 'digits_between:5,20', Rule::unique('cars')->ignore($this->car)],
            'model' => ['nullable', 'string', 'max:9999'],
            'price' => ['nullable', 'numeric', 'gt:0'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ];
    }
}
