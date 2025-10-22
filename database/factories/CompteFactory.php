<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compte>
 */
class CompteFactory extends Factory
{
    protected $model = \App\Models\Compte::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'numero_compte' => 'SN' . $this->faker->year . $this->faker->unique()->numberBetween(100000, 999999),
            'type' => $this->faker->randomElement(['courant', 'epargne', 'entreprise']),
            'statut' => $this->faker->randomElement(['actif', 'bloque', 'ferme']),
            'solde' => $this->faker->randomFloat(2, 10000, 1000000),
            'client_id' => \App\Models\Client::factory(),
        ];
    }

    /**
     * Indicate that the compte is actif.
     */
    public function actif(): static
    {
        return $this->state(fn (array $attributes) => [
            'statut' => 'actif',
        ]);
    }

    /**
     * Indicate that the compte is bloque.
     */
    public function bloque(): static
    {
        return $this->state(fn (array $attributes) => [
            'statut' => 'bloque',
        ]);
    }

    /**
     * Indicate that the compte is ferme.
     */
    public function ferme(): static
    {
        return $this->state(fn (array $attributes) => [
            'statut' => 'ferme',
        ]);
    }
}
