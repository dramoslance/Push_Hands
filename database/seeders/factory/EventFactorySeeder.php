<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\Location;
use App\Models\Cluster;

class EventFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $organizer = Organizer::factory()->create();

        Event::factory(10)
            ->for($organizer)
            ->for(
                Location::factory()
                    ->for($organizer)
                    ->create()
            )
            ->for(Cluster::factory()->create())
            ->create();
    }
}
