<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use App\Models\Car;
use App\Events\Location as LocationEvent;

class Location extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the locations of the cars';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $seconds = 60;

        while ($seconds) {
            $cars = Car::with('location')->get();
            foreach ($cars as $car) {
                $car->location()->create([
                    'latitude' => ($car->location ? $car->location->latitude : 0) + rand(0, 50),
                    'longitude' => ($car->location ? $car->location->longitude : 0) + rand(0, 50),
                ]);

                event(new LocationEvent($car));
            }
            
            sleep(3);
            $seconds -= 3;
        }

        return 0;
    }
}
