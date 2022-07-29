<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClient extends FormRequest
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
            'name'      => 'required',
            'phone'     => 'required|digits:10',
            'email'     => 'required',
            'password'  => 'nullable|min:6'
        ];
    }

    public function attributes()
    {
        return [
            'name'      => 'nombre',
            'phone'     => 'telefono',
            'email'     => 'correo electrónico',
            'password'  => 'contraseña'
        ];
    }
}
