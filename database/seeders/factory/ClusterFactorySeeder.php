<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;


use App\Models\Cluster;
use App\Models\Language;

use Faker\Factory as Faker;

class ClusterFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $clusters = Cluster::factory(10)
            ->create();

        $faker = Faker::create();
        
        $language= Language::factory()->create();

        foreach($clusters as $cluster){
            $cluster->languages()->attach($language, [
                'name' => $faker->name(),
                'slug' => $faker->slug(),
                'description' => $faker->text($maxNbChars = 200)
            ]);
        }

    }
}
