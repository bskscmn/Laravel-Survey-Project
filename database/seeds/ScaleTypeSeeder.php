<?php

use Illuminate\Database\Seeder;
use App\ScaleType;

class ScaleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $scaleType = new ScaleType();
        $scaleType->type = 'Agree | Disagree';
        $scaleType->save();

        $scaleType = new ScaleType();
        $scaleType->type = 'Agree | Undecided | Disagree';
        $scaleType->save();

        $scaleType = new ScaleType();
        $scaleType->type = 'Strongly Agree | Agree | Undecided | Disagree | Strongly Disagree';
        $scaleType->save();

        $scaleType = new ScaleType();
        $scaleType->type = '1 | 2 | 3 | 4 | 5';
        $scaleType->save();

        $scaleType = new ScaleType();
        $scaleType->type = '1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10';
        $scaleType->save();
    }
}
