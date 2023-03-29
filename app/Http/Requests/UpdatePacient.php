<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UpdatePacient extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'birth_date' => 'required',
            'zip_code'=> 'required',
            'street'=> 'required',
            'number'=> 'required',
            'neighborhood'=> 'required',
            'city'=> 'required',
            'state'=> 'required',
            'complement'=> 'nullable',
            'cpf' => [
                'required',
                Rule::unique('patients')->ignore($this->patient)
            ],
            'cns' => [
                'required',
                Rule::unique('patients')->ignore($this->patient)
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nome é um campo obrigatório.',
            'birth_date.required' => 'Data de nascimento é um campo obrigatório.',
            'zip_code.required' => 'Cep é um campo obrigatório.',
            'street.required' => 'Logradouro é um campo obrigatório.',
            'number.required' => 'Número é um campo obrigatório.',
            'neighborhood.required' => 'Bairro é um campo obrigatório.',
            'city.required' => 'Cidade é um campo obrigatório.',
            'state.required' => 'UF é um campo obrigatório.',
            'cpf.required' => 'CPF é um campo obrigatório.',
            'cns.required' => 'CNS é um campo obrigatório.',
            'cpf.unique' => 'Já existe esse CPF cadastrado no sistema.',
            'cns.unique' => 'Já existe esse CNS cadastrado no sistema.',
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'messages' => $validator->errors()
        ], Response::HTTP_BAD_REQUEST));
    }
}
