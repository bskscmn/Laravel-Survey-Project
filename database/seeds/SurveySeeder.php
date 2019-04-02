<?php

use Illuminate\Database\Seeder;
use App\Survey;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $survey = new Survey();
        $survey->name = 'Satisfaction Survey';
        $survey->save();
    }
}
