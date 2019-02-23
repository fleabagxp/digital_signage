<?php

use Illuminate\Database\Seeder;
use App\Display;

class DisplaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $display = new Display();
        $display->name = 'Mandarin M';
        $display->save();

        $display = new Display();
        $display->name = 'Mandarin P';
        $display->save();

        $display = new Display();
        $display->name = 'Mandarin A';
        $display->save();

        $display = new Display();
        $display->name = 'Mandarin B';
        $display->save();

        $display = new Display();
        $display->name = 'Mandarin C';
        $display->save();

        $display = new Display();
        $display->name = 'Mandarin BUD';
        $display->save();

        $display = new Display();
        $display->name = 'Mandarin Front';
        $display->save();
    }
}
