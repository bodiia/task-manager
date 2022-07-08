<?php

namespace Database\Factories;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskLabelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'task_id' => Task::query()->inRandomOrder()->first()->id,
            'label_id' => Label::query()->inRandomOrder()->first()->id,
        ];
    }
}
