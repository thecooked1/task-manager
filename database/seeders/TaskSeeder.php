<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Task::create([
            'title' => 'Complete Laravel Project',
            'description' => 'Build CRUD functionality and UI.',
            'status' => 'pending',
            'deadline' => '2024-12-01'
        ]);
        
        Task::create([
            'title' => 'Review documentation',
            'description' => 'Read up on Eloquent ORM.',
            'status' => 'done',
            'deadline' => '2024-10-15'
        ]);
    }
}
