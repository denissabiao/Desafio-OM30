<?php

namespace App\Imports;

use App\Http\Requests\CreatePatient;
use App\Jobs\ProcessImportPatient;
use App\Models\Patient;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\HttpFoundation\Response;

class PatientsValidatedImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $patients)
    {
        foreach ($patients as $row) {
            $data = $row->toArray();

            // retorno para o usuario caso algum dado estar incorreto
            $cretePatiente = new CreatePatient;
            $validator = Validator::make($data, $cretePatiente->rules(), $cretePatiente->messages());

            if ($validator->fails()) {
                throw new HttpResponseException(response()->json([
                    'error' => 'O paciente ' . $data['name'] . ' possui erro de validação',
                    'messages' => $validator->errors()
                ], Response::HTTP_BAD_REQUEST));
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
