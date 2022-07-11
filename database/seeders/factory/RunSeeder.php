<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Seeder;

class RunSeeder extends Seeder
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