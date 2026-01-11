<?php

namespace Database\Seeders;

use App\Models\WatchingState;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WatchingStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Solo seedear si la tabla está vacía
        if (WatchingState::count() === 0) {
            WatchingState::create([
                'id' => 1,
                'name' => 'Viendo',
                'color' => 'green',
            ]);
            WatchingState::create([
                'id' => 2,
                'name' => 'Completa',
                'color' => 'blue',
            ]);
            WatchingState::create([
                'id' => 3,
                'name' => 'En Espera',
                'color' => 'yellow',
            ]);
            WatchingState::create([
                'id' => 4,
                'name' => 'Abandonada',
                'color' => 'red',
            ]);
            WatchingState::create([
                'id' => 5,
                'name' => 'Planeando Ver',
                'color' => 'purple',
            ]);
        }
    }
}
