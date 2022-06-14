<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\User;
use App\Models\Organizer;

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

        foreach($organizers as $organizer) {
            $organizer->user()->associate(User::factory()->create());
            $organizer->save();
        }
          
    }
}
