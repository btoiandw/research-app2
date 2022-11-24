<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResearchSource;
use Illuminate\Support\Facades\DB;

class Source extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $source = [
            [
                
                'research_source_name' => 'งบแผ่นดินโครงการยุทธศาสตร์',
                'Year_source' => '2565',
                'type_research_source' => 'ภายใน',
                'ex_research' => ''
            ],
            [
              
                'research_source_name' => 'งบรายได้(บ.กศ.)',
                'Year_source' => '2565',
                'type_research_source' => 'ภายใน',
                'ex_research' => ''
            ],
            [
                
                'research_source_name' => 'วช.',
                'Year_source' => '2565',
                'type_research_source' => 'ภายนอก',
                'ex_research' => ''
            ],
            [
                
                'research_source_name' => 'สก.สว.',
                'Year_source' => '2565',
                'type_research_source' => 'ภายนอก',
                'ex_research' => ''
            ],
            [
                
                'research_source_name' => 'PMU',
                'Year_source' => '2565',
                'type_research_source' => 'ภายนอก',
                'ex_research' => ''
            ]
        ];
        foreach ($source as $key => $value) {
            ResearchSource::create($value);
        }
    }
}
