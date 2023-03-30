<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Address;
use App\Models\Patient;
use App\Models\User;
use Tests\TestCase;

class PatientTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $patient;
    protected $address;
    protected $token;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->patient = Patient::factory()->make();
        $this->address = Address::factory()->make();

        $this->token = $this->user->createToken('ApiToken')->plainTextToken;

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ]);
    }

    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_login()
    {
        $response = $this->json('POST', 'api/login', [
            "email" => $this->user->email,
            "password" => "password",
        ]);

        $response->assertStatus(200);
    }

    public function test_can_create_user()
    {
        $user = User::factory()->make();

        $response = $this->json('POST', 'api/register', [
            "email" => $user->email,
            "password" => "password",
            "name" => $user->name
        ]);

        $response->assertStatus(201);
    }

    public function test_create_patient()
    {

        $response = $this->json('POST', 'api/patient', [
            "name" => $this->patient->name,
            "birth_date" => $this->patient->birth_date,
            "cpf" => $this->patient->cpf,
            "cns" => $this->patient->cns,
            "zip_code" => $this->address->zip_code,
            "street" => $this->address->street,
            "number" => $this->address->number,
            "neighborhood" => $this->address->neighborhood,
            "city" => $this->address->city,
            "state" => $this->address->state
        ]);

        $response->assertStatus(201);

        $response->assertExactJson(
            [
                "message" => "Paciente cadastrado com sucesso."
            ]
        );
    }

    public function test_can_see_unique_patient_by_id()
    {
        $patient = Patient::factory()->create();

        $response = $this->json('GET', 'api/patient/' . $patient->id);

        $response->assertStatus(200);
    }

    public function test_can_see_specific_patient_by_cpf()
    {
        $patient = Patient::factory()->create();

        $response = $this->json('GET', 'api/patient/filter?cpf=' . $patient->cpf);

        $response->assertStatus(200);
    }

    public function test_can_see_specific_patient_by_name()
    {
        $response = $this->json('GET', 'api/patient/filter?name=denis');

        $response->assertStatus(200);
    }

    public function test_can_see_all_patients()
    {
        $response = $this->json('GET', 'api/patient/filter');

        $response->assertStatus(200);
    }

    public function test_user_can_edit_patient()
    {
        $patient = Patient::factory()->create();
        $patient->address()->create($this->address->toArray());

        $response = $this->json('PATCH', 'api/patient/' . $patient->id, [
            "name" => "denis sabiao",
            "birth_date" => "2000-01-01",
            "cpf" => "43081587700",
            "cns" => "779546584920008",
            "zip_code" => "31515-030",
            "street" => "Rua da Matriz",
            "number" => "55",
            "neighborhood" => "Venda Nova",
            "city" => "Belo Horizonte",
            "state" => "MG"
        ]);

        $response->assertStatus(200);
    }

    public function test_user_can_destroy_patient_by_id()
    {
        $patient = Patient::factory()->create();

        $response = $this->json('DELETE', 'api/patient/' . $patient->id);

        $response->assertStatus(200);
    }
}