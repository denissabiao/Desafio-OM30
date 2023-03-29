<?php

namespace App\Imports;

use App\Http\Requests\CreatePatient;
use App\Jobs\ProcessImportPatient;
use App\Models\Address;
use App\Models\Patient;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\HttpFoundation\Response;

class PatientsImport implements ToCollection, WithHeadingRow
{
    
    public function collection(Collection $patients)
    {
        foreach ($patients as $row) {
            $data = $row->toArray();

            $patient = new Patient();
            $patient->fill($data);
            $patient->save();
    
            $address = new Address();
            $address->fill($data);
            $address->patient_id = $patient->id;
            $address->save();
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
