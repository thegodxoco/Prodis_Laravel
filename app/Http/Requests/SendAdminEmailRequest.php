<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendAdminEmailRequest extends FormRequest
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
            'for' => 'required|max:255|email',
            'subject' => 'string|nullable',
            'content' => 'string|nullable'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'for.required' => trans('validation_errors.for.required'),
            'for.email' => trans('validation_errors.for.email'),
            'for.max' => trans('validation_errors.for.max'),
            'subject.string' => trans('validation_errors.subject.string'),
            'content.string' => trans('validation_errors.content.string')
        ];
    }
}
