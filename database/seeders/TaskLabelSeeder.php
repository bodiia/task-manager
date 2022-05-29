<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskLabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tasks = Task::all();
        $labels = Label::all();

        foreach ($tasks as $task) {
            $task->labels()->attach($labels->random()->id);
        }
    }
}
