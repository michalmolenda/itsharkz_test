<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'name' => 'required',
            'rate' => 'required|integer|between:1,5',
            'file' => 'image'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email type',
            'name.required' => 'User name is required',
            'rate.required' => 'Rate is required',
            'rate.integer' => 'Invalid rate type',
            'rate.between' => 'Rate is too high or too low',
            'file.image' => 'Uploaded file have wrong format'
        ];
    }

    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            'email' => 'trim|lowercase',
            'name' => 'trim|lowercase',
        ];
    }
}
