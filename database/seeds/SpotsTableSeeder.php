<?php

use Illuminate\Database\Seeder;
use App\Models\Spot;

class SpotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Spot::create([
            'name'          => env('POSTER_NAME'),
            'poster_token'  => env('POSTER_TOKEN'),
            'poster_link'   => env('POSTER_LINK')
        ]);

    }
}
