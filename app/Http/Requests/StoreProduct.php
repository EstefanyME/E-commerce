<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'brand_id'       => 'required|integer|exists:brands,id',
            'category_id'    => 'required|integer|exists:categories,id',
            'barcode'        => 'required|unique:products',
            'name'           => 'required|min:4',
            'description'    => 'nullable|min:5',
            'price'          => 'required|numeric',
            'stock'          => 'required|numeric',
            'url_image'      => 'nullable|url',
        ];
    }

    public function attributes()
    {
        return [
            'brand_id'       => 'id marca',
            'category_id'    => 'id categoría',
            'barcode'        => 'código de barras',
            'name'           => 'nombre',
            'description'    => 'descripción',
            'price'          => 'precio',
            'stock'          => 'existencias',
            'url_image'      => 'url_imagen',
        ];
    }
}
