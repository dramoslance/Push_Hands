<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Database\Seeders\Factory\UserFactorySeeder;
use Database\Seeders\Factory\OrganizerFactorySeeder;
use Database\Seeders\Factory\ClusterFactorySeeder;
use Database\Seeders\Factory\LocationFactorySeeder;
use Database\Seeders\Factory\EventFactorySeeder;
use Database\Seeders\Factory\SpeakerFactorySeeder;

class FactorySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        
        $this->call([
            UserFactorySeeder::class,
            OrganizerFactorySeeder::class,
            ClusterFactorySeeder::class,
            LocationFactorySeeder::class,
            EventFactorySeeder::class,
            SpeakerFactorySeeder::class,
        ]);
    }
}
