<?php

namespace Database\Seeders\Factory;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Instructor;
use App\Models\User;

class InstructorFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = User::factory()->create();

       Instructor::factory(6)
                ->for($user)
                ->create();

    //    foreach($instructors as $instructor){
    //          $instructor->user()->associate(User::factory()->create());
    //          $instructor->save();
    //    }
    
    }
}
