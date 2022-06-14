<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Location;
use App\Models\Organizer;

class LocationFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Create locations for the same organizer
        Location::factory(10)
            ->for(Organizer::factory()->create())
            ->create();

        // Create locations for many organizers

        
        foreach(Organizer::factory(10)->create() as $organizer) {
             Location::factory(1)
            ->for(Organizer::factory()->create())
            ->create();
        }

    }
}
