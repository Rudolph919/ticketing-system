<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\PersonalDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PersonalDetailFactory extends Factory
{
    protected $model = PersonalDetail::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'date_of_birth' => $this->generateRandomDate(),
            'email' => $this->faker->safeEmail,
            'phone_number' => '0' . $this->faker->numerify('#########'),
            'gender' => $this->faker->randomElement(['male', 'female']),
        ];
    }

    // Generate a random date of birth
    private function generateRandomDate()
    {
        return Carbon::parse(rand(1970, 2003).'-'.rand(1, 12).'-'.rand(1, 28));
    }
}
