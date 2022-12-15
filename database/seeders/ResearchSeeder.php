<?php

namespace Database\Seeders;

use App\Models\Research;
use Illuminate\Database\Seeder;

class ResearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $research = [
            [
                'research_id' => '1',
                'research_th' => 'การพัฒนากระบวนการบริหารสินค้าคงคลัง ผลิตภัณฑ์กล้วยอบน้ำผึ้ง กรณีศึกษากลุ่มแปรรูปสมุนไพรพื้นบ้านกล้วยอบน้ำผึ้ง อ.แม่ระมาด จ.ตาก',
                'research_en' => 'Development Inventory Management Process Honey Banana Products A Case Study of Banana Honey Herbal Processing Group, Mae Ramat, Tak Province',
                'research_source_id' => '1',
                'type_research_id' => 'ชุมชนท้องถิ่น',
                'keyword' => 'กล้วย,กล้วยอบน้ำผึ้ง',
                'date_research_start' => '2023-01-07',
                'date_research_end' => '2023-08-10',
                'research_area' => 'อ.แม่ระมาด จ.ตาก',
                'budage_research' => '100000',
                'word_file' => '1_0.docx',
                'pdf_file' => '1_0.pdf',
                'research_summary_feedback' => 'null',
                'research_status' => '0',
                'year_research' => '2566'
            ],
            [
                'research_id' => '2',
                'research_th' => 'ประสิทธิภาพผงชีวภัณฑ์ Bacillus sp. Ks5 ในการส่งเสริมการเจริญเติบโตของพืช และควบคุมเชื้อ Xanthomonas oryzae pv. oryzae ที่เป็นสาเหตุโรคขอบใบแห้งในข้าว',
                'research_en' => 'Efficiency of Dry Formulation Bacillus sp. Ks5 to Plant Growth Promotion and Biological Control of Xanthomonas oryzae pv. oryzae Caused Bacterial Leaf Blight Disease',
                'research_source_id' => '1',
                'type_research_id' => 'ชุมชนท้องถิ่น',
                'keyword' => 'ผงชีวภัณฑ์,Xanthomonas oryzae pv. oryzae',
                'date_research_start' => '2023-01-07',
                'date_research_end' => '2023-08-10',
                'research_area' => 'อ.เมือง จ.กำแพงเพชร 62000',
                'budage_research' => '100000',
                'word_file' => '2_0.docx',
                'pdf_file' => '2_0.pdf',
                'research_summary_feedback' => 'null',
                'research_status' => '0',
                'year_research' => '2566'
            ]

        ];
        foreach ($research as $key => $value) {
            Research::create($value);
        }
    }
}
