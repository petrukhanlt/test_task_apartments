<?php

namespace App\Http\Requests;

use App\Models\UserElement;
use Illuminate\Foundation\Http\FormRequest;

class IndexApartmentRequest extends FormRequest
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
            'name' => 'nullable|filled|string|max:50',
            'bedrooms' => 'nullable|filled|integer|min:1|max:10',
            'bathrooms' => 'nullable|filled|integer|min:1|max:10',
            'storeys' => 'nullable|filled|integer|min:1|max:10',
            'garages' => 'nullable|filled|integer|min:1|max:10',
            'price_from' => 'nullable|filled|integer|min:1',
            'price_to' => 'nullable|filled|integer|min:1',
            'skip' => 'nullable|filled|integer|min:1',
        ];
    }
}
