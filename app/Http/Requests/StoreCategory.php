<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategory extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'parent_id'     => 'nullable|integer|exists:categories,id',
            'name'          => 'required|min:4',
            'url_image'     => 'nullable|url'
        ];
    }
    public function attributes()
    {
        return [
            'parent_id'     => 'Id Padre',
            'name'          => 'Nombre',
            'url_image'     => 'url imagen'
        ];
    }
}
