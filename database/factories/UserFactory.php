<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        static $counter = 0;
        $counter++;
        return [
            'firstName' => $this->faker->firstName,
            'lastName' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,             
            'password' => Hash::make('password'.$counter),
            'passwordVisible' => 'password'.$counter,
            'position' => $this->faker->randomElement(['admin', 'employee', 'teamLeader', 'projectManager']), 
            'availableDays' => 20         
        ];
    }

}
