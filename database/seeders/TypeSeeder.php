<?php

namespace Database\Seeders;

use Faker\Generator;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $_types = [
            'Sviluppo Web',
            'Applicazione Mobile',
            'Design Grafico',
            'Marketing Digitale',
            'Educazione ed Istruzione',
        ];

        foreach ($_types as $_type) {
            $type = new Type();
            $type->label = $_type;
            $type->color = $faker->hexColor();
            $type->save();
        }
    }
}
