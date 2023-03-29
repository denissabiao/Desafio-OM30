<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class CreateUser extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|unique:users,email',
            'name' => 'required',
            'password' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é um campo obrigatório.',
            'email.required' => 'Email é um campo obrigatório.',
            'email.unique' => 'Já existe esse email cadastrado no sistema.',
            'password.required' => 'Senha é um campo obrigatório.',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'messages' => $validator->errors()
        ], Response::HTTP_BAD_REQUEST));
    }
}
