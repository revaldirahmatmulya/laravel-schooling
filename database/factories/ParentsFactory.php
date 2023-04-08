<?php

namespace Database\Factories;

use App\Enums\PositionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ParentsFactory extends Factory
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
            'position_id' => PositionType::Parents,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'is_active' => true,
        ]);

        return [
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'user_id' => $user->id,
        ];
    }
}
