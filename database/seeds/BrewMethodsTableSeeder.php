<?php

use App\Models\BrewMethod;
use Illuminate\Database\Seeder;

class BrewMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $methods = [
            'Hario V60 Dripper',
            'Chemex',
            'Siphon',
            'Kyoto Cold Brew',
            'Clover',
            'Espresso',
            'Aeropress',
            'French Press',
            'Kalita Wave Dripper',
            'Nitrous',
        ];

        foreach ($methods as $method) {
            BrewMethod::create(['method' => $method]);
        }
    }
}
