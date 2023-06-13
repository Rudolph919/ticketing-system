<?php

namespace Database\Seeders;

use App\Models\Interest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $interestTypes = [
            'Sports',
            'Fishing',
            'Gardening',
            'Animals',
            'Children',
            'Cooking',
            'Photography',
            'Traveling',
            'Painting',
            'Reading',
            'Writing',
            'Music',
            'Dancing',
            'Gaming',
            'Fashion',
            'Fitness',
            'Coding',
            'Astronomy',
            'Cars',
            'DIY Projects',
            'Singing',
            'Surfing',
        ];

        foreach ($interestTypes as $interestType) {
            Interest::create([
                'name' => $interestType
            ]);
        }
    }
}
