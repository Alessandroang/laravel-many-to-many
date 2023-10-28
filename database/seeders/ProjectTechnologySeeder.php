<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;
use Faker\Generator;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $projects = Project::all();
        $technologies = Technology::all()->pluck('id')->toArray();

        foreach ($projects as $project) {
            $project
                ->technologies()
                ->attach($faker->randomElements($technologies, random_int(0, 3)));
        }
    }
}
