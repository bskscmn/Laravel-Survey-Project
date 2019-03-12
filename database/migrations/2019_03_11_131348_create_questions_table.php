<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('anket_id')->unsigned();
            $table->foreign('anket_id')->references('id')->on('ankets')->onDelete('cascade');
            $table->string('question_type_id')->unsigned();
            $table->foreign('question_type_id')->references('id')->on('question_types')->onDelete('cascade');
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
        Schema::dropIfExists('questions');
    }
}
