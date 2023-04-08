<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DailyJournal>
 */
class DailyJournalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->date(),
            'class_id' => $this->faker->numberBetween(2, 25),
            'teacher_id' => $this->faker->numberBetween(3, 26),
            'subject_id' => $this->faker->numberBetween(1, 14),
        ];
    }
}
