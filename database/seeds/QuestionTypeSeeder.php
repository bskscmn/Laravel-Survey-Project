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
        $questionType->type = 'Only selection(Radio Button)';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Multiple selection(Checkbox)';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Only selection with other input';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Multiple selection with other input';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Scale';
        $questionType->save();

        $questionType = new QuestionType();
        $questionType->type = 'Open question';
        $questionType->save();
    }
}
