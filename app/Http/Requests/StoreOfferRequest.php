<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
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
            'title' => 'required|max:255',
            'address' => 'required',
            'city' => 'required|string',
            'zip_code' => 'nullable|numeric',
            'province' => 'required',
            'priority' => 'string',
            'vacant_positions' => 'required|integer|numeric',
            'description' => 'string',
            'requirements' => 'array|nullable',
            "requirements.*"  => "nullable|string|distinct|min:2",
            'subscriptionStartDate' => 'required|date',
            'subscriptionEndDate' => 'required|date',
            'activityStartDate' => 'date',
            'activityEndDate' => 'date',
            'image' => 'array',
            'image.*' => 'image'
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
            'title.required' => trans('validation_errors.title.required'),
            'title.max' => trans('validation_errors.title.max'),
            'address.required' => trans('validation_errors.address.required'),
            'city.string' => trans('validation_errors.city.string'),
            'inputState.string' => trans('validation_errors.inputState.string'),
            'inputZip.numeric' => trans('validation_errors.inputZip.numeric'),
            'inputZip.integer' => trans('validation_errors.inputZip.integer'),
            'subscriptionStartDate.required' => trans('validation_errors.subscriptionStartDate.required'),
            'subscriptionEndDate.required' => trans('validation_errors.subscriptionEndDate.required'),
            'activityEndDate.required' => trans('validation_errors.activityEndDate.required'),
            'activityStartDate.required' => trans('validation_errors.activityStartDate.required'),
            'activityEndDate.date' => trans('validation_errors.activityEndDate.date'),
            'activityStartDate.date' => trans('validation_errors.activityStartDate.date'),
            'subscriptionStartDate.date' => trans('validation_errors.subscriptionStartDate.date'),
            'subscriptionEndDate.date' => trans('validation_errors.subscriptionEndDate.date'),
            'vacant_positions.numeric' =>trans('validation_errors.vacant_positions.numeric'),
            'vacant_positions.integer' => trans('validation_errors.vacant_positions.integer'),
            'vacant_positions.required' => trans('validation_errors.vacant_positions.required'),
            'requirements.array' =>trans('validation_errors.requirements.array'),
            'requirements.*.string' =>trans('validation_errors.requirements.*.string'),
            'requirements.*.distinct' =>trans('validation_errors.requirements.*.distinct'),
            'requirements.*.min' =>trans('validation_errors.requirements.*.min'),
            'requirements.*.required' =>trans('validation_errors.requirements.*.required'),
            'image.array' =>trans('validation_errors.image.array'),
            'image.*.image' =>trans('validation_errors.image.*.image'),
            'description.required' => trans('validation_errors.description.required'),
            'description.string' => trans('validation_errors.description.string')
        ];
    }
}
