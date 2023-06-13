<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Document;
use App\Models\Interest;
use App\Models\PersonalDetail;
use Illuminate\Database\Seeder;

class PersonalDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // List of interest types
        $interestTypes = [
            'Sport',
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

        // Generate 50
        for ($i = 1; $i <= 50; $i++) {
            $person = PersonalDetail::factory()->create();

            // Generate random number of interests (min 3 and max 12)
            $interestCount = rand(3, 12);

            // Generate interests for the person
            $interests = [];
            while (count($interests) < $interestCount) {
                $interestType = $interestTypes[rand(0, count($interestTypes) - 1)];

                // Skip if interest type is 'Sport' or 'Fishing'
                if ($interestType === 'Sport' || $interestType === 'Fishing') {
                    continue;
                }

                // Skip if interest type already added
                if (in_array($interestType, $interests)) {
                    continue;
                }

                $interests[] = $interestType;

                $interest = Interest::create([
                    'personal_details_id' => $person->id,
                    'interest' => $interestType
                ]);

                // Generate multiple documents for Gardening, Animals or Children interests
                if ($interestType === 'Gardening' || $interestType === 'Animals' || $interestType === 'Children') {
                    $documentCount = rand(0, 3); // Random number of documents (0 to 3)

                    for ($j = 1; $j <= $documentCount; $j++) {
                        // Determine whether the document is linked or not (60% success rate)
                        $isLinked = (rand(1, 100) <= 60);

                        Document::create([
                            'personal_details_id' => $person->id,
                            'interest_id' => $interest->id,
                            'document_name' => 'Document '.$j.' for '.$interestType,
                            'file_path' => $isLinked ? 'https://example.com/documents/'.uniqid().'.pdf' : null,
                        ]);
                    }
                }
            }
        }
    }


}
