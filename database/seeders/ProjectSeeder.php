<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * * @return void
     */
    public function run(Faker $faker)
    {

        for ($i = 0; $i < 100; $i++) {
            $project = new Project();
            $project->name = $faker->catchPhrase();
            $project->title = $faker->catchPhrase();
            $project->content = $faker->paragraphs(3, true);
            $project->slug = Str::slug($project->title);

            $types = Type::all()->pluck('id')->toArray();
            $types[] = null;
            // Assegna casualmente una tipologia al progetto
            $project->type_id = $faker->randomElement($types);
            $project->save();
        }
    }
}
