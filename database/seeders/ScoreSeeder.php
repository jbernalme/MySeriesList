<?php

namespace Database\Seeders;

use App\Models\Score;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Solo seedear si la tabla está vacía
        if (Score::count() === 0) {
            Score::create([
                'id' => 1,
                'name' => 'Appalling',
            ]);
            Score::create([
                'id' => 2,
                'name' => 'Horrible',
            ]);
            Score::create([
                'id' => 3,
                'name' => 'Very Bad',
            ]);
            Score::create([
                'id' => 4,
                'name' => 'Bad',
            ]);
            Score::create([
                'id' => 5,
                'name' => 'Average',
            ]);
            Score::create([
                'id' => 6,
                'name' => 'Fine',
            ]);
            Score::create([
                'id' => 7,
                'name' => 'Good',
            ]);
            Score::create([
                'id' => 8,
                'name' => 'Very Good',
            ]);
            Score::create([
                'id' => 9,
                'name' => 'Great',
            ]);
            Score::create([
                'id' => 10,
                'name' => 'Masterpiece',
            ]);
        }
    }
}
