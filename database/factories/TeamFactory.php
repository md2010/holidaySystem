<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition()
    {
        static $counter = 0;
        $counter++;
        return [
            'name' => 'team'.$counter,
        ];
    }

}
