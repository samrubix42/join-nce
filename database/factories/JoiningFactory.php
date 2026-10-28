<?php

namespace Database\Factories;

use App\Models\Joining;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Joining>
 */
class JoiningFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'personal_number' => fake()->unique()->numerify('PN-#####'),
            'email' => fake()->unique()->safeEmail(),
            'jnv_name' => fake()->city(),
            'batch' => (string) fake()->numberBetween(1990, 2015),
            'official_contact_number' => fake()->phoneNumber(),
            'address_city' => fake()->city(),
            'business_name_city' => fake()->company().' '.fake()->city(),
            'business_category' => fake()->randomElement(['IT & Software', 'Trading', 'Services', 'Manufacturing', 'Other']),
            'website' => fake()->optional()->url(),
            'products_services' => fake()->sentence(),
            'willing_volunteer' => fake()->boolean(),
            'willing_sponsor' => fake()->boolean(),
            'status' => 'pending_payment',
        ];
    }
}
