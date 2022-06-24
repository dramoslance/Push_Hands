<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Organizer;
use App\Models\Language;

use Faker\Factory as Faker;

class OrganizerFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        // Create organizers out of the system users
        Organizer::factory(10)
            ->create();


        // Create organizers for with system users
        $organizers = Organizer::factory(10)
            ->create();
        
        $faker = Faker::create();
    
        $language= Language::factory()->create();
        foreach($organizers as $organizer) {
            // $organizer->user()->associate(User::factory()->create());
            // $organizer->save();

            $organizer->languages()->attach($language, [
                'name' => $faker->name(),
                'description' => $faker->text($maxNbChars = 200),
            ]);
        }
          
    }
}
