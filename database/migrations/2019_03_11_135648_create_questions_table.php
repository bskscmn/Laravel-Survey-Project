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
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('anket_id')->unsigned();
            $table->foreign('anket_id')->references('id')->on('ankets')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('question_type_id')->unsigned();
            $table->foreign('question_type_id')->references('id')->on('question_types')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('questions');
    }
}
