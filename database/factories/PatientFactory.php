<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl(),
            'name' => $this->faker->name(),
            'mother_name' => $this->faker->name(),
            'birth_date' => $this->faker->date(),
            'cpf' => $this->faker->numerify('###########'),
            'cns' => '120531885920004',
        ];
    }
}
