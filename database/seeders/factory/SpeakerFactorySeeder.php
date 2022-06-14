<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Speaker;
use App\Models\Organizer;
use App\Models\Location;
use App\Models\Cluster;
use App\Models\Event;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Factory as Faker;

class SpeakerFactorySeeder extends Seeder
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

        $events = Event::factory(10)
            ->for($organizer)
            ->for(
                Location::factory()
                    ->for($organizer)
                    ->create()
            )
            ->for(Cluster::factory()->create())
            ->create();


        $faker = Faker::create();
    
        foreach($events as $event) {
            
        
            // Create Speakers with system users 
            $user = User::factory()->create();
            $event->users()->attach($user, [
                'portrait' => $faker->imageUrl(100, 100),
                'type' => $faker->randomElement([0, 1])
            ]);

             // Create Speakers withou system users
            Speaker::factory(10)
                ->for($event)
                ->create();

        }


    }
}
