<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_feedback', function (Blueprint $table) {
            $table->integer('feedback_id')->primary();
            $table->integer('id');
            $table->integer('research_id');
            $table->dateTime('date_send_referess');
            $table->text('feedback');
            $table->string('Assessment_result');
            $table->dateTime('Date_feedback_research');
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
        Schema::dropIfExists('tb_feedback');
    }
}
