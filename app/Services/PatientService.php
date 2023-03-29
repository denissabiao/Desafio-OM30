<?php

namespace App\Services;

use App\Models\Patient;

class PatientService extends Patient
{

    public static function verifyCpfOrName($request)
    {
        if ($request->query('name') != '') {
            return Patient::where('name', 'like', '%' . $request->name . '%')->with('address')->paginate(10);
        }

        if ($request->query('cpf') != '') {
            return Patient::where('cpf', $request->query('cpf'))->with('address')->firstOrFail();
        }

        return Patient::with('address')->paginate(10);
    }
}
