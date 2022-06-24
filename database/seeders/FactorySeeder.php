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
use Database\Seeders\Factory\ActivityFactorySeeder;
use Database\Seeders\Factory\LanguageFactorySeeder;
use Database\Seeders\Factory\InstructorFactorySeeder;
use Database\Seeders\Factory\StaffFactorySeeder;
use Database\Seeders\Factory\MemberFactorySeeder;
use Database\Seeders\Factory\ThemeFactorySeeder;

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
            InstructorFactorySeeder::class,
            LocationFactorySeeder::class,
            EventFactorySeeder::class,
            SpeakerFactorySeeder::class,
            ActivityFactorySeeder::class,
            LanguageFactorySeeder::class,
            StaffFactorySeeder::class,
            MemberFactorySeeder::class,
            ThemeFactorySeeder::class,
            
        ]);
    }
}