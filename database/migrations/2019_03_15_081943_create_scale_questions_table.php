<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScaleQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scale_questions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('survey_id')->unsigned();
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('question_id')->unsigned();
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('question_number')->default('1');
            $table->string('soru');
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
        Schema::dropIfExists('scale_questions');
    }
}
