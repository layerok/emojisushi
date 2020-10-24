<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'name' => 'Доставка и оплата',
                'slug' => 'delivery-and-payment',
                'hidden' => 0
            ],
            [
                'name' => 'Спасибо',
                'slug' => 'thankyou',
                'hidden' => 1
            ],

        ]);
    }
}
