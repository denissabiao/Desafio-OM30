<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePatient;
use App\Http\Requests\ImportCsvRequest;
use App\Http\Requests\UpdatePacient;
use App\Http\Resources\PatientResource;
use App\Imports\PatientsValidatedImport;
use App\Jobs\ProcessImportPatient;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class PatientController extends Controller
{

    protected $patientService;
    protected $patient;

    public function __construct(PatientService $patientService, Patient $patient)
    {
        $this->patientService = $patientService;
        $this->patient = $patient;
    }

    public function store(CreatePatient $request)
    {
        DB::beginTransaction();
        $patientData = $request->validated();

        try {
            $patient = Patient::create($patientData);
            $patient->address()->create($patientData);

            DB::commit();

            if ($request->hasFile('image')) {
                $request->file('image')->store('public/images');
            }

            return response()->json(['message' => 'Paciente cadastrado com sucesso.'], Response::HTTP_CREATED);
        } catch (\Exception $ex) {
            DB::rollBack();

            return response()->json([
                'data' => 'not found',
                'message' => $ex->getMessage(),
            ], 404);
        }
    }

    public function show($id)
    {
        try {
            $patient = Patient::findOrFail($id);
            $address = $patient->address;

            return response()->json(['data' => new PatientResource($patient, $address)]);
        } catch (\Exception $ex) {
            return response()->json([
                'data' => 'not found',
                'message' => $ex->getMessage(),
            ], 404);
        }
    }

    public function update(UpdatePacient $request, $id)
    {
        DB::beginTransaction();
        $patientData = $request->validated();

        try {
            $patient = $this->patient->findOrFail($id);
            $patient->update($patientData);

            $patient->address->update($patientData);
            DB::commit();

            return response()->json([
                "message" => "Paciente alterado com sucesso."
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'message' => $ex->getMessage(),
            ], 404);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->patient->findOrFail($id)->delete();

            DB::commit();

            return response()->json([
                "message" => "Paciente excluído com sucesso."
            ]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json([
                'message' => $ex->getMessage(),
            ], 404);
        }
    }

    public function filter(Request $request)
    {
        try {
            $patient = $this->patientService::verifyCpfOrName($request);

            return response()->json(['data' => $patient]);
        } catch (\Exception $ex) {
            return response()->json([
                'data' => 'not found',
                'message' => $ex->getMessage(),
            ], 404);
        }
    }

    public function import(ImportCsvRequest $request)
    {
        $path = Storage::putFileAs(
            'temp',
            $request->file('file'),
            $request->file('file')->getClientOriginalName()
        );

        $file_path = Storage::path($path);

        Excel::import(new PatientsValidatedImport, $file_path);

        ProcessImportPatient::dispatch($file_path);

        return response()->json(["message" => "Pacientes importados com sucesso."]);
    }
}
