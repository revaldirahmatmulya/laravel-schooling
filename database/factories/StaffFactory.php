<?php

namespace Database\Factories;

use App\Enums\PositionType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $positions = [
            PositionType::StaffAkademik,
            PositionType::StaffKeuangan,            
            PositionType::StaffKeuangan,
            PositionType::StaffSarpras,
            PositionType::StaffUks,
            PositionType::StaffHumas,
        ];
        $user = User::create([
            'name' => $this->faker->name,
            'position_id' => $this->faker->randomElement($positions),
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'is_active' => true,
        ]);
        return [
            'user_id' => $user->id,            
            'gender' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'birthplace' => $this->faker->city,
            'birthdate' => $this->faker->date(),
            'phone' => $this->faker->phoneNumber,
            'religion' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha']),
            'address' => $this->faker->address,
        ];
    }
}
