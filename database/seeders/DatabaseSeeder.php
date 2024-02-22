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
        ])->answer()->create([
            'answer'=>'none of thr above'
        ]);/*->options()->each([
            ['option'=>'bird'],
            ['option'=>'feather'],
            ['option'=>'all of the above'],
           ['option'=> 'animal']
         ])->create();*/
    }
}
