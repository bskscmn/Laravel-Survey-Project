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
        $questionType->type = 'Çoktan seçmeli';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Açık uçlu';
        $questionType->save();
    }
}
