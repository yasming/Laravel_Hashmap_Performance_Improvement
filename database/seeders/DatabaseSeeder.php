<?php

namespace Database\Seeders;

use App\Models\Candidate\Candidate;
use App\Models\Developer\Developer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Candidate::factory(100000)->create();
        Developer::factory()->count(100000)
            ->state(function () {
                return ['email' => Candidate::query()->inRandomOrder()->first()->email];
            })->create();
    }
}
