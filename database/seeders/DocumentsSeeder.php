<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\Interest;
use App\Models\PersonalDetail;
use Illuminate\Database\Seeder;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personalDetails = PersonalDetail::all();

        foreach ($personalDetails as $person) {
            $interests = $person->interests;

            foreach ($interests as $interest) {
                if (in_array($interest->name, ['Gardening', 'Animals', 'Children'])) {
                    $documentCount = rand(0, 3);

                    for ($i = 1; $i <= $documentCount; $i++) {
                        $isLinked = (rand(1, 100) <= 60);

                        $documentName = 'Document ' . $i . ' for ' . $interest->name;
                        $filePath = $isLinked ? 'https://example.com/documents/' . uniqid() . '.pdf' : null;

                        Document::create([
                            'personal_details_id' => $person->id,
                            'interest_id' => $interest->id,
                            'document_name' => $documentName,
                            'file_path' => $filePath,
                        ]);
                    }
                }
            }
        }
    }
}
