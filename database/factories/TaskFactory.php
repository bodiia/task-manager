<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(20),
            'description' => $this->faker->text(),
            'status_id' => Status::query()->inRandomOrder()->first()->id,
            'author_id' => User::query()->inRandomOrder()->first()->id,
            'executor_id' => User::query()->inRandomOrder()->first()->id,
        ];
    }
}
