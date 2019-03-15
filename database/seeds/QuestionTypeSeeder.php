<?php

use Illuminate\Database\Seeder;
use App\QuestionType;

class QuestionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionType = new QuestionType();
        $questionType->type = 'Tek seçenek';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Birden çok seçenek';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Tek seçenek + Diğer alanı';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Birden çok seçenek + Diğer alanı';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Dereceleme';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Açık uçlu';
        $questionType->save();
    }
}
