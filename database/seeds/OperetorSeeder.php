<?php

use Illuminate\Database\Seeder;

class OperetorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Operator::create([
            'name' => 'GP'
        ]);
        App\Models\Operator::create([
            'name' => 'Robi'
        ]);
        App\Models\Operator::create([
            'name' => 'Airtel'
        ]);
        App\Models\Operator::create([
            'name' => 'Teletalk'
        ]);

    }
}
