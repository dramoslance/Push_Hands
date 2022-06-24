<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Location;
use App\Models\Organizer;
use App\Models\Instructor;

class StaffFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $locations = Location::factory(5)
            ->for(Organizer::factory()->create())
            ->create();

        $instructor = Instructor::factory()
            ->for(User::factory()->create())
            ->create();

        foreach($locations as $location){
            $location->instructors()->attach($instructor ,[]);
        }

    }
}
