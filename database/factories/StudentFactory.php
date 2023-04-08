<?php

namespace Database\Factories;

use App\Enums\PositionType;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::create([
            'name' => $this->faker->name,
            'position_id' => PositionType::Student,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),            
            'is_active' => true,
        ]);

        return [            
            'nis' => $this->faker->unique()->numberBetween(100000, 999999),
            'nisn' => $this->faker->unique()->numberBetween(100000, 999999),            
            'user_id' => $user->id,
            'gender' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'birthplace' => $this->faker->city,
            'birthdate' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber,
            'religion' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'address' => $this->faker->address,
            'generation' => $this->faker->year,
            'alumni' => false,            
            'parent_id' => Parents::factory()->create()->id,
        ];
    }
}
