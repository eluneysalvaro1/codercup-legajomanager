<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreColegiadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'laboratorio' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', Password::min(8)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre no es válido.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido no es válido.',
            'apellido.max' => 'El apellido no puede tener más de 255 caracteres.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email no tiene un formato válido.',
            'email.max' => 'El email no puede tener más de 255 caracteres.',
            'email.unique' => 'Ya existe un colegiado con ese email.',
            'laboratorio.required' => 'El laboratorio es obligatorio.',
            'laboratorio.string' => 'El laboratorio no es válido.',
            'laboratorio.max' => 'El laboratorio no puede tener más de 255 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}
