<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class PaymentsFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_user' => ['integer', 'required', 'exists:users,id'],
            'value' => ['required', 'decimal:2', 'min:1'],
            'payment_date' => ['required', 'date', 'after_or_equal:' . today()->subDays(7)->toDateString()],
            'description' => ['sometimes', 'string'],
            'status' => ['sometimes', 'string', 'in:pago,cancelado'],
        ];
    }

    public function messages(): array
    {
        return [
            'id_user.required' => 'O usuário é obrigatório',
            'id_user.exists' => 'O usuário informado não existe',
            'value.required' => 'O valor é obrigatório',
            'value.decimal' => 'O valor deve ser um número',
            'value.min' => 'O valor deve ser maior que zero',
            'payment_date.required' => 'A data de pagamento é obrigatória',
            'payment_date.date' => 'A data de pagamento está em formato inválido',
            'description.string' => 'A descrição deve ser um texto',
            'status.string' => 'O status deve ser um texto',
            'status.in' => 'O status deve ser pago ou cancelado',
        ];
    }
}
