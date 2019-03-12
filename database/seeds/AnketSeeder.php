<?php

use Illuminate\Database\Seeder;
use App\Anket;

class AnketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anket = new Anket();
        $anket->name = 'Ön Büro Memnuniyet Anketi';
        $anket->save();
    }
}
