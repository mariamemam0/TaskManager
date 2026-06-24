<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleAndPermissionSeeder::class);
        $users = User::factory(5)->create();

        $users->each(function ($user) {
            $projects = Project::factory(3)
                ->has(Task::factory(5))
                ->create();

            $projects->each(function ($project) use ($user) {
                $project->users()->attach($user->id);
            });
        });
    }
}
