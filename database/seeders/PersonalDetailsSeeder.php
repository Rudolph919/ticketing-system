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
    public function run()
    {
        $interestTypes = [
            // List of 15 or more different interest types
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

        $interestsToSkip = ['Sport', 'Fishing'];

        PersonalDetail::factory()
            ->count(50)
            ->create()
            ->each(function ($person) use ($interestTypes, $interestsToSkip) {
                $interestCount = rand(3, 12);
                $interests = [];

                while (count($interests) < $interestCount) {
                    $interestType = $interestTypes[rand(0, count($interestTypes) - 1)];

                    if (in_array($interestType, $interests) || in_array($interestType, $interestsToSkip)) {
                        continue;
                    }

                    $interests[] = $interestType;

                    $interest = Interest::create([
                        'name' => $interestType
                    ]);

                    $person->interests()->attach($interest->id);

                    if (in_array($interestType, ['Gardening', 'Animals', 'Children'])) {
                        $documentCount = rand(0, 3);

                        for ($i = 1; $i <= $documentCount; $i++) {
                            $isLinked = (rand(1, 100) <= 60);

                            $documentName = 'Document ' . $i . ' for ' . $interestType;
                            $filePath = $isLinked ? 'https://example.com/documents/' . uniqid() . '.pdf' : null;

                            $person->documents()->create([
                                'personal_detail_id' => $person->id,
                                'interest_id' => $interest->id,
                                'document_name' => $documentName,
                                'file_path' => $filePath,
                            ]);
                        }
                    }
                }
            });
    }


}
