<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research', function (Blueprint $table) {
            $table->integer('research_id');
            $table->timestamp('date_upload_file');
            $table->string('research_th')->nullable();
            $table->string('research_en')->nullable();
            $table->string('research_source_id')->nullable();
            $table->string('type_research_id')->nullable();
            $table->text('keyword')->nullable();
            $table->date('date_research_start')->nullable();
            $table->date('date_research_end')->nullable();
            $table->text('research_area')->nullable();
            $table->double('budage_research')->nullable();
            $table->string('word_file')->nullable();
            $table->string('pdf_file')->nullable();
            $table->text('research_summary_feedback')->nullable();
            $table->string('research_status')->default('0');
            /*0=รอตรวจสอบ, 1=ไม่ผ่าน/ปรับปรุงครั้งที่ 1, 2=ไม่ผ่าน/ปรับปรุงครั้งที่ 2, 3=ไม่ผ่าน/ปรับปรุงครั้งที่ 3, 4=ผ่าน, 5=ยกเลิก */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research');
    }
}
