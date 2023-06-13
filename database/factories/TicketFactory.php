<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Support\Str;
use App\Models\TicketCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    protected $model = Ticket::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category_id = random_int(1, 3);
        return [
            'user_id' => random_int(1, 6),
            'ticket_subject' => $this->faker->sentence(5),
            'ticket_description' => $this->faker->paragraph,
            'ticket_number' => $this->generateTicketNumber($category_id),
            'category_id' => $category_id,
            'status_id' => random_int(1, 3),
            'name' => $this->faker->firstName,
            'surname' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'phone_number' => '0' . $this->faker->numerify('#########'),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'ip_address' => $this->faker->ipv4,
            ];
    }

    public function generateTicketNumber($categoryId)
    {
        $category = TicketCategory::findOrFail($categoryId);
        $categoryCode = strtolower($category->category_name);

        // Generate a unique identifier
        $uniqueIdentifier = time();

        // Concatenate the category code and the unique identifier
        $ticketNumber = $categoryCode . '_' . random_int(100000, 999999);

        return $ticketNumber;
    }
}
