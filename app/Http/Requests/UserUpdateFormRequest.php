<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateFormRequest extends FormRequest
{
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$userId}"],
            'role'  => ['required', 'string', 'in:admin,funcionario'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'  => 'O campo nome é obrigatório.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email'    => 'Formato de e-mail inválido.',
            'email.unique'   => 'Já existe uma conta com esse e-mail.',
            'role.required'  => 'O campo role é obrigatório.',
            'role.in'        => 'Role inválido. Valores aceitos: admin, funcionario.',
        ];
    }
}
