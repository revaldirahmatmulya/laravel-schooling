<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {        
        return [            
            'major_id' => $this->faker->numberBetween(1, 3),
            'teacher_id' => $this->faker->numberBetween(1, 3),        
        ];
    }
}
