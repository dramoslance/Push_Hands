<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\Location;
use App\Models\Cluster;
use App\Models\Language;


use Faker\Factory as Faker;


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
        
        $language= Language::factory()->create();

        foreach($events as $event){
            $event->languages()->attach($language, [
                'name' => $faker->catchPhrase(),
                'short_name' => $faker->text($maxNbChars = 20),
                'tagline' => $faker->jobTitle(),
                'slug' => $faker->slug()
            ]);
        }
    }
}
