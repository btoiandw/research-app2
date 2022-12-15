<?php

namespace Database\Seeders;

use App\Models\sendResearch;
use Illuminate\Database\Seeder;

class SendResearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $send = [
            [
                'research_id' => 1,
                'id' => 2,
                'pc' => 60
            ],
            [
                'research_id' => 1,
                'id' => 4,
                'pc' => 35
            ],
            [
                'research_id' => 1,
                'id' => 5,
                'pc' => 5
            ],
            [
                'research_id' => 2,
                'id' => 4,
                'pc' => 100
            ]
        ];
        foreach ($send as $key => $value) {
            sendResearch::create($value);
        }
    }
}
