<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Location;
use App\Models\Organizer;
use App\Models\Language;

use Faker\Factory as Faker;


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
        $faker = Faker::create();

        // Create locations for the same organizer
        $locations = Location::factory(10)
            ->for(Organizer::factory()->create())
            ->create();

        $language= Language::factory()->create();
        foreach($locations as $location){
            $location->languages()->attach($language, [
                'name' => $faker->catchPhrase(),
                'description' => $faker->text($maxNbChars = 20),
                'address_line' => $faker->address()
            ]);
        }

        // Create locations for many organizers

        foreach(Organizer::factory(10)->create() as $organizer) {
           Location::factory(1)
                ->for(Organizer::factory()->create())
                ->create();

        }

    }
}
