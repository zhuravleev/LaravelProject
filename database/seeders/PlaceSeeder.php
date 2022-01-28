<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $place = new Place();
        $place->name = 'inventory';
        $place->description = 'Place for new things';
        $place->repair = false;
        $place->work = false; 
        $place->save();

        $work = new Place();
        $work->name = 'work';
        $work->description = 'Your thing is working';
        $work->repair = false;
        $work->work = true; 
        $work->save();

        $repair = new Place();
        $repair->name = 'repair';
        $repair->description = 'Your thing is repairing';
        $repair->repair = true;
        $repair->work = false; 
        $repair->save();
    }
}
