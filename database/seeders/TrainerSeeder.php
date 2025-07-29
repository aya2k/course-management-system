<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Trainer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trainer::factory()
            ->count(5)
            ->create()
            ->each(function ($trainer) {
                
                Course::factory()->count(3)->create([
                    'trainer_id' => $trainer->id,
                    'is_avaliable' => true,
                ]);
            });
    }
}
