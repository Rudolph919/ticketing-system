<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketStatuses = [
            ['status_name' => 'Newly logged'],
            ['status_name' => 'In progress'],
            ['status_name' => 'Resolved'],
        ];

        TicketStatus::insert($ticketStatuses);
    }
}
