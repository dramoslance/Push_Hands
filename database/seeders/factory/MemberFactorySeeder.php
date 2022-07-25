<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Organizer;
use App\Models\User;

class MemberFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $organizers = Organizer::factory(5)->create();
         
         $user = User::factory()->create();
         foreach($organizers as $organizer){
             $organizer->members()->attach($user ,[]);
         }
    }
}
