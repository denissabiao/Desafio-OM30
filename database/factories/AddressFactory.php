<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'zip_code' => $this->faker->numerify('########'),
            'street' => $this->faker->word,
            'number' => $this->faker->numerify('##'),
            'neighborhood' => $this->faker->word,
            'city' => $this->faker->word,
            'state' => $this->faker->word,
            'complement' => $this->faker->word,
        ];
    }
}
