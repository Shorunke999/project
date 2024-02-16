<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $data = \App\Models\Questions::create([
            'question' => 'what is not me',
             'answer' => 'all of the above',
         ])->options()->create([
            'option_1'=>'bird',
            'option_2'=>'feather',
            'option_3'=>'all of the above',
            'option_4'=> 'animal'
         ]);
    }
}
