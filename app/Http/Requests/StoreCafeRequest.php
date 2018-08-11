<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCafeRequest extends FormRequest
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
            'name'                    => 'required',
            'location.*.address'      => 'required',
            'location.*.city'         => 'required',
            'location.*.state'        => 'required',
            'location.*.zip'          => 'required|regex:/\b\d{5}\b/',
            'location.*.brew_methods' => 'sometimes|array',
            'website'                 => 'nullable|url',
        ];
    }

    public function messages()
    {
        return [
            'name.required'               => 'A name for the cafe is required.',
            'location.*.address.required' => 'An address is required to add this cafe.',
            'location.*.city.required'    => 'A city is required to add this cafe.',
            'location.*.state.required'   => 'A state is required to add this cafe.',
            'location.*.zip.required'     => 'A zip code is required to add this cafe.',
            'location.*.zip.regex'        => 'The zip code entered is invalid.',
        ];
    }
}
