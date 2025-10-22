<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    protected $model = \App\Models\Client::class;

    public function definition()
    {
        return [
            'id' => (string) Str::uuid(),
            'nom' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'telephone' => $this->faker->numerify('77########'),
        ];
    }
}
