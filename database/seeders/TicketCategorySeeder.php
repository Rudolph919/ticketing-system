<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketCategories = [
            ['category_name' => 'Sales'],
            ['category_name' => 'Accounts'],
            ['category_name' => 'IT'],
        ];

        TicketCategory::insert($ticketCategories);
    }
}
