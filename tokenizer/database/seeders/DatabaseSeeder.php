<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Src\Agenda\User\Infrastructure\EloquentModels\UserEloquentModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserEloquentModel::factory()->create([
            'mobile' => '09114904505',
            'password' => bcrypt('secret'),
        ]);
    }
}
