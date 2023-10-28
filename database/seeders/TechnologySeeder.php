<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     *  @return void
     */
    public function run(Generator $faker)
    {
        $_technologies = [
            'HTML',
            'CSS',
            'JavaScript',
            'Php',
            'Laravel',
            'Angular',
            'Vue',
        ];

        foreach ($_technologies as $_technology) {
            $Technology = new Technology();
            $Technology->label = $_technology;
            $Technology->color = $faker->hexColor();
            $Technology->save();
        }
    }
}
