<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            [
                'name' => 'Araç 1'
            ],
            [
                'name' => 'Araç 2'
            ]
        ];

        foreach($cars as $car){
            Car::create($car);
        }
    }
}
