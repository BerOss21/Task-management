<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id'=>fake()->uuid(),
            'title'=>fake()->unique()->sentence,
            'description'=>fake()->paragraphs(2,true),
            'due_date'=>Carbon::now()->addDays(fake()->numberBetween(1, 365)),
            'status'=>Task::getStatesFor('status')->random(),
            'user_id'=>User::inRandomOrder()->first()->id
        ];
    }
}
