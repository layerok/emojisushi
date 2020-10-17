<?php

use Illuminate\Database\Seeder;

class PaymentStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_statuses')->insert([
            ['name' => 'Оплачен'],
            ['name' => 'Не оплачен']
        ]);
    }
}
