<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScaleAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scale_answers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('survey_id')->unsigned();
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('scale_question_id')->unsigned();
            $table->foreign('scale_question_id')->references('id')->on('scale_questions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('answer');
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
        Schema::dropIfExists('scale_answers');
    }
}
