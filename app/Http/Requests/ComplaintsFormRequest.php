<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintsFormRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id_payment' => ['required', 'integer', 'exists:payments,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_payment.required' => 'O pagamento é obrigatório',
            'id_payment.exists' => 'O pagamento informado não existe',
            'title.required' => 'O título é obrigatório',
            'description.required' => 'A descrição é obrigatória',
        ];
    }
}
