<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Organizer;
use App\Models\Location;
use App\Models\Event;
use App\Models\Cluster;
use App\Models\Activity;
use App\Models\Language;

use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Factory as Faker;


class ActivityFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        
        // $event = Event::factory()->create();

        //  Avtivity::factory(5)
        //     ->for($event)
        //     ->create();

        $organizer = Organizer::factory()->create();

        $events = Event::factory(5)
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
            
            $activities = Activity::factory(5)
                ->for($event)
                ->create();

            $language = Language::factory()->create();
            foreach($activities as $activity){
                $activity->languages()->attach($language, [
                    'name' => $faker->name(),
                    'description' => $faker->text($maxNbChars = 200)
                ]);
            }

        }


    }
}
